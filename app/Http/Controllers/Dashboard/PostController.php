<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category', 'tags')->latest()->paginate(10);
        return view('dashboard.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('dashboard.posts.create', compact('categories','tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|unique:posts,title',
            'slug'         => 'nullable|unique:posts,slug',
            'category_id'  => 'required|exists:categories,id',
            'status'       => 'required|in:draft,published',
            'publish_date' => 'nullable|date',
            'content'      => 'required',
            'avatar'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tags'         => 'nullable|array',
            'tags.*'       => 'exists:tags,id',
        ]);

        $avatar = null;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store('posts', 'public');
        }

        $post = Post::create([
            'title'        => $request->title,
            'slug'         => $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
            'category_id'  => $request->category_id,
            'status'       => $request->status,
            'publish_date' => $request->publish_date,
            'content'      => $request->content,
            'avatar'       => $avatar,
        ]);

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('dashboard.posts.index')->with('success','Post created successfully.');
    }

    public function show($id)
    {
        $post = Post::with('category','tags')->findOrFail($id);
        $post->increment('views');
        return view('dashboard.posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::with('tags')->findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('dashboard.posts.edit', compact('post','categories','tags'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title'        => 'required|unique:posts,title,'.$post->id,
            'slug'         => 'nullable|unique:posts,slug,'.$post->id,
            'category_id'  => 'required|exists:categories,id',
            'status'       => 'required|in:draft,published',
            'publish_date' => 'nullable|date',
            'content'      => 'required',
            'avatar'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tags'         => 'nullable|array',
            'tags.*'       => 'exists:tags,id',
        ]);

        $avatar = $post->avatar;
        if ($request->hasFile('avatar')) {
            if ($avatar) {
                Storage::disk('public')->delete($avatar);
            }
            $avatar = $request->file('avatar')->store('posts', 'public');
        }

        $post->update([
            'title'        => $request->title,
            'slug'         => $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
            'category_id'  => $request->category_id,
            'status'       => $request->status,
            'publish_date' => $request->publish_date,
            'content'      => $request->content,
            'avatar'       => $avatar,
        ]);

        $post->tags()->sync($request->tags ?? []);

        return redirect()->route('dashboard.posts.index')->with('success','Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->avatar) {
            Storage::disk('public')->delete($post->avatar);
        }
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('dashboard.posts.index')->with('success','Post deleted successfully.');
    }
}
