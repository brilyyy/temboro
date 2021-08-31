<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('tag')->orderBy('id', 'desc')->paginate(10);
        return view('index', ['posts' => $posts]);
    }

    public function allPosts()
    {
        $posts = Post::with('tag')->get();
        return view('dashboard.post.all-post', ['posts' => $posts]);
    }
    public function createPost()
    {
        $tags = Tag::all();
        return view('dashboard.post.create', ['tags' => $tags]);
    }
    public function create(Request $request)
    {
        if ($request->hasFile('header')) {
            $originalName = $request->file('header')->getClientOriginalName();

            $fileName = pathinfo($originalName, PATHINFO_FILENAME);

            $ext = $request->file('header')->getClientOriginalExtension();

            $storeName = $fileName . '_' . time() . '.' . $ext;

            $uploaded = $request->file('header')->storeAs('public/media', $storeName);
        }


        $post = new Post();
        $post->number = Post::all()->count() + 1;
        $post->title = $request->title;
        $post->desc = $request->desc;
        $post->tag_id = $request->tag_id;
        $post->header = Storage::url($uploaded);
        $post->slug = Str::slug(request('title'));

        if ($post->save()) {
            return redirect()->route('home.admin');
        }
    }

    public function postsByTag($tag)
    {
        $tag = Tag::where('slug', $tag)->get();
        $posts = Post::where('tag_id', $tag[0]->id)->paginate(10);

        return view('index', ['posts' => $posts]);
    }

    public function showPost($slug, $postSlug)
    {
        $prev = [];
        $next = [];
        $post = Post::where('slug', $postSlug)->with('tag')->get()[0];
        $prevId = Post::where('id', '<', $post->id)->max('id');
        $nextId = Post::where('id', '>', $post->id)->min('id');
        if (!is_null($prevId)) {
            $prev = Post::find($prevId)->with('tag')->get()[0];
        }
        if (!is_null($nextId)) {
            $next = Post::find($nextId)->with('tag')->get()[0];
        }
        if ($post->tag->slug == $slug) {
            return view('post', ['post' => $post, 'prev' => $prev, 'next' => $next]);
        }
    }
}
