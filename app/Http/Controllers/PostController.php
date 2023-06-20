<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostView;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\FlareClient\Http\Exceptions\NotFound;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::query()
            ->where('active', '=', 1)
            ->whereDate('published_at', '<', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->paginate(5);

        return view('home', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, Request $request)
    {
        if(!$post->active || $post->published_at > Carbon::now()) {
            throw new NotFoundHttpException();
        }

        $nextPost = Post::query()
            ->where('active', true)
            ->whereDate("published_at", '<=', Carbon::now())
            ->whereDate("published_at", '<', $post->published_at)
            ->orderBy("published_at", 'desc')
            ->limit(1)
            ->first();
        
        $previousPost = Post::query()
            ->where('active', true)
            ->whereDate("published_at", '<=', Carbon::now())
            ->whereDate("published_at", '>', $post->published_at)
            ->orderBy("published_at", 'asc')
            ->limit(1)
            ->first();

        $user = $request->user();

        PostView::firstOrCreate([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'post_id' => $post->id,
            'user_id' => $user?->id
        ]);

        $views = PostView::where('post_id', '=', $post->id)->count();

        return view('post.view', compact('post', 'nextPost', 'previousPost', 'views'));
    }

    public function ByCategory(Category $category) {
        
        $posts = Post::query()
            ->join('category_post', 'posts.id', '=', 'category_post.post_id')
            ->where('category_post.category_id', '=', $category->id)
            ->where('active', '=', true)
            ->whereDate('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->paginate(10);
        
        return view('post.index', compact('posts', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
