<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;

use App\Models\Post;
use App\Models\User;


class PostController extends Controller
{
    public function index()
    {
        // $numberOfPosts = 10;
        // \App\Models\User::factory(10)->create();
        // Post::factory($numberOfPosts)->create([
        //     'user_id' => User::inRandomOrder()->first()->id, // Assign a random user ID to each post
        // ]);

        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create', ['users' => User::all()]);
    }

    public function store(StorePost $request)
    {
        $postData = $request->validated();
        $postData['enabled'] = $request->has('enabled');

        Post::create($postData);
        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $post->published_at = new \DateTime($post->published_at);
        $users = User::all();
        return view('posts.edit', compact('post', 'users'));
    }


    public function update(StorePost $request, $id)
    {
        $postData = $request->validated();
        $postData['enabled'] = $request->has('enabled');

        $post = Post::find($id);
        $post->update($postData);

        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();

        return redirect()->route('posts.index');
    }

    public function trash()
    {
        $deletedPosts = Post::onlyTrashed()->get();
        return view('posts.trash', compact('deletedPosts'));
    }
}
