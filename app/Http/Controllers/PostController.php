<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Lang;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      request()->validate([
        'body' => 'required'
      ]);

      Post::create([
        'body' =>  request('body'),
        'user_id' => auth()->id()
      ]);

      return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        abort_unless(auth()->user()->owns($post), 403);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        abort_unless(auth()->user()->owns($post), 403);
        request()->validate([
          'body' => 'required'
        ]);

        $post->update(request(['body']));

        return back()->with('status', Lang::get('post.updated_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        abort_unless(auth()->user()->owns($post), 403);
        $post->delete();

        return redirect('home');
    }
}
