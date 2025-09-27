<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Models\Ebook;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EbookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $ebooks = Ebook::with('category','tags')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('tags', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10);

        // biar query search nempel di pagination
        $ebooks->appends(['search' => $search]);

        return view('dashboard.ebooks.index', compact('ebooks', 'search'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('dashboard.ebooks.create', compact('categories','tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|unique:ebooks,title',
            'slug'         => 'nullable|unique:ebooks,slug',
            'type'         => 'required|in:ebook,source code',
            'category_id'  => 'required|exists:categories,id',
            'description'  => 'nullable|string',
            'status'       => 'required|in:draft,published',
            'publish_date' => 'nullable|date',
            'file_upload'  => 'required|file|max:1000000',
            'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tags'         => 'nullable|array',
            'tags.*'       => 'exists:tags,id',
        ]);

        $file = $request->file('file_upload')->store('ebooks/files', 'public');
        $thumbnail = $request->thumbnail ? $request->file('thumbnail')->store('ebooks/thumbnails', 'public') : null;

        $ebook = Ebook::create([
            'title'        => $request->title,
            'slug'         => $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
            'type'         => $request->type,
            'category_id'  => $request->category_id,
            'description'  => $request->description,
            'status'       => $request->status,
            'publish_date' => $request->publish_date,
            'file_upload'  => $file,
            'thumbnail'    => $thumbnail,
        ]);

        if ($request->tags) {
            $ebook->tags()->attach($request->tags);
        }

        return redirect()->route('dashboard.ebooks.index')->with('success','Ebook created successfully.');
    }

    public function show($id)
    {
        $ebook = Ebook::with('category','tags')->findOrFail($id);
        $ebook->increment('views'); // increment views
        return view('dashboard.ebooks.show', compact('ebook'));
    }

    public function edit($id)
    {
        $ebook = Ebook::with('tags')->findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('dashboard.ebooks.edit', compact('ebook','categories','tags'));
    }

    public function update(Request $request, $id)
    {
        $ebook = Ebook::findOrFail($id);

        $request->validate([
            'title'        => 'required|unique:ebooks,title,'.$ebook->id,
            'slug'         => 'nullable|unique:ebooks,slug,'.$ebook->id,
            'type'         => 'required|in:ebook,source code',
            'category_id'  => 'required|exists:categories,id',
            'description'  => 'nullable|string',
            'status'       => 'required|in:draft,published',
            'publish_date' => 'nullable|date',
            'file_upload'  => 'nullable|file|max:10000',
            'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tags'         => 'nullable|array',
            'tags.*'       => 'exists:tags,id',
        ]);

        $file = $ebook->file_upload;
        if ($request->hasFile('file_upload')) {
            Storage::disk('public')->delete($file);
            $file = $request->file('file_upload')->store('ebooks/files', 'public');
        }

        $thumbnail = $ebook->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($thumbnail) Storage::disk('public')->delete($thumbnail);
            $thumbnail = $request->file('thumbnail')->store('ebooks/thumbnails', 'public');
        }

        $ebook->update([
            'title'        => $request->title,
            'slug'         => $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
            'type'         => $request->type,
            'category_id'  => $request->category_id,
            'description'  => $request->description,
            'status'       => $request->status,
            'publish_date' => $request->publish_date,
            'file_upload'  => $file,
            'thumbnail'    => $thumbnail,
        ]);

        $ebook->tags()->sync($request->tags ?? []);

        return redirect()->route('dashboard.ebooks.index')->with('success','Ebook updated successfully.');
    }

    public function destroy($id)
    {
        $ebook = Ebook::findOrFail($id);

        if ($ebook->file_upload) {
            Storage::disk('public')->delete($ebook->file_upload);
        }
        if ($ebook->thumbnail) {
            Storage::disk('public')->delete($ebook->thumbnail);
        }

        $ebook->tags()->detach();
        $ebook->delete();

        return redirect()->route('dashboard.ebooks.index')->with('success','Ebook deleted successfully.');
    }
}
