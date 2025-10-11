<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index()
    {
        // Temporarily show all blogs to debug
        $blogs = Blog::latest('created_at')->paginate(12);
        
        // Uncomment this once you've published posts:
        // $blogs = Blog::published()->latest('published_at')->paginate(12);

        return Inertia::render('Blog/Index', [
            'blogs' => $blogs,
            'debug' => [
                'total' => Blog::count(),
                'published' => Blog::where('is_published', true)->count(),
            ]
        ]);
    }

    public function show($slug)
    {
        // Temporarily show all blogs for debugging
        $blog = Blog::where('slug', $slug)->firstOrFail();
        
        // Uncomment this once posts are published:
        // $blog = Blog::where('slug', $slug)->published()->firstOrFail();

        // Increment views
        $blog->increment('views');

        // Get related posts
        $relatedPosts = Blog::where('id', '!=', $blog->id)
            ->latest('created_at')
            ->take(3)
            ->get();

        return Inertia::render('Blog/Show', [
            'blog' => $blog,
            'relatedPosts' => $relatedPosts,
        ]);
    }
}
