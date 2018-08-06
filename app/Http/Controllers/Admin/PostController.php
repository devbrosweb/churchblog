<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Notifications\AuthorPostApproved;
use App\Notifications\NewPostNotify;
use App\Post;
use App\Subscriber;
use App\Tag;
use Brian2694\Toastr\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Posts';
        $posts =  Post::where('approved', true)->latest()->get();
        return view('admin.posts.index', compact('posts', 'title'));
    }

    public function pending()
    {
        $title = 'Posts Pendientes';
        $posts =  Post::where('approved', false)->get();
        return view('admin.posts.pending', compact('posts', 'title'));
    }

    public function approval(Post $post)
    {
        //checkn if the post is approved
       if($post->approved == true)
       {
           Toastr()->info('Este post ya esta aprobado!', 'Info.');
           return redirect()->back();
       }

        $post->approved = true;
        $post->save();

        $post->user->notify(new AuthorPostApproved($post));

        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber)
        {
            Notification::route('mail', $subscriber->email)
                ->notify( new NewPostNotify($post));
        }

        Toastr()->success('Post fue aprobado con exitos :)', 'Exito.');
        return redirect()->back();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'crear Post';
        $categories = Category::All();
        $tags = Tag::All();

        return view('admin.posts.create',
            compact('title', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $request->validate([
            'title' => 'required',
            'image' => 'required',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);

        if(isset($image))
        {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'-.'.$image->getClientOriginalExtension();

            //check if not exists, but create it
            if(!Storage::disk('public')->exists(('posts'))){
                Storage::disk('public')->makeDirectory('posts');
            }

            //make image
            $postIMmge = Image::make($image)->resize(1600, 1066)->save($image->getClientOriginalExtension());

            Storage::disk('public')->put('posts/'.$imageName, $postIMmge);

        } else {
            $imageName = 'default.png';
        }


        $post = new Post();
        $post->title = $request->title;
        $post->user_id = Auth::id();
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;

        if(isset($request->status))
        {
            $status = true;

        } else {
            $status = false;
        }
        $post->status = $status;
        $post->approved = true;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber)
        {
            Notification::route('mail', $subscriber->email)
                ->notify( new NewPostNotify($post));
        }

        Toastr()->success('Post fue creado con exitos :)', 'Exito.');
        return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $title = $post->title;
        return view('admin.posts.show', compact('post', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $title = 'editar Post';
        $categories = Category::All();
        $tags = Tag::All();

        return view('admin.posts.edit',
            compact('title', 'categories', 'tags', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'image',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);

        if(isset($image))
        {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'-.'.$image->getClientOriginalExtension();

            //check if not exists, but create it
            if(!Storage::disk('public')->exists(('posts'))){
                Storage::disk('public')->makeDirectory('posts');
            }

            //delete old image
            if(Storage::disk('public')->exists('posts/'.$post->image))
            {
                Storage::disk('public')->delete('posts/'.$post->image);
            }

            //make image
            $postIMmge = Image::make($image)->resize(1600, 1066)->save($image->getClientOriginalExtension());

            Storage::disk('public')->put('posts/'.$imageName, $postIMmge);

        } else {
            $imageName = $post->image;
        }

        $post->title = $request->title;
        $post->user_id = Auth::id();
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;

        if(isset($request->status))
        {
            $status = true;

        } else {
            $status = false;
        }
        $post->status = $status;
        $post->approved = true;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr()->success('Post fue actualizado con exitos :)', 'Exito.');
        return redirect()->route('admin.posts.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //if image exist delete it.
        if(Storage::disk('public')->exists('posts/'.$post->image))
        {
            Storage::disk('public')->delete('posts/'.$post->image);
        }

        //delete categories attach post
        $post->categories()->detach();
        //delete tags attach post
        $post->tags()->detach();
        //delete post
        $post->delete();


        Toastr()->success('Post fue borrado con exito :)!',
            'Exitoso');

        return redirect()->back();
    }
}
