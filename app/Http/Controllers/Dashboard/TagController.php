<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $tags = Tag::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        // biar query search tetap ada di pagination link
        $tags->appends(['search' => $search]);

        return view('dashboard.tags.index', compact('tags', 'search'));
    }

    public function create()
    {
        return view('dashboard.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags,name',
            'slug' => 'nullable|unique:tags,slug',
        ]);

        Tag::create([
            'name' => $request->name,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name),
        ]);

        return redirect()->route('dashboard.tags.index')->with('success', 'Tag created successfully.');
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('dashboard.tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:tags,name,' . $tag->id,
            'slug' => 'nullable|unique:tags,slug,' . $tag->id,
        ]);

        $tag->update([
            'name' => $request->name,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name),
        ]);

        return redirect()->route('dashboard.tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('dashboard.tags.index')->with('success', 'Tag deleted successfully.');
    }

}
