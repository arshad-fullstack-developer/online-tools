<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        
        return Inertia::render('Admin/Blog/Index', [
            'blogs' => $blogs,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Blog/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blogs,slug',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'author' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blog-images', 'public');
        }

        // Set published_at if publishing
        if (!empty($validated['is_published'])) {
            if (empty($validated['published_at'])) {
                $validated['published_at'] = now();
            }
        } else {
            $validated['published_at'] = null;
        }

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully!');
    }

    public function edit(Blog $blog)
    {
        return Inertia::render('Admin/Blog/Edit', [
            'blog' => $blog,
        ]);
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blogs,slug,' . $blog->id,
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'author' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blog-images', 'public');
        }

        // Set published_at if publishing
        if (!empty($validated['is_published'])) {
            if (empty($blog->published_at) && empty($validated['published_at'])) {
                $validated['published_at'] = now();
            }
        } else {
            $validated['published_at'] = null;
        }

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post updated successfully!');
    }

    public function destroy(Blog $blog)
    {
        // Delete featured image
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post deleted successfully!');
    }

    public function togglePublish(Blog $blog)
    {
        $blog->is_published = !$blog->is_published;
        
        if ($blog->is_published && !$blog->published_at) {
            $blog->published_at = now();
        }
        
        $blog->save();

        return back()->with('success', 'Blog post ' . ($blog->is_published ? 'published' : 'unpublished') . ' successfully!');
    }
}
