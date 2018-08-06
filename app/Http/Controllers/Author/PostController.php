<?php

namespace App\Http\Controllers\Author;

use App\Category;
use App\Notifications\NewAuthorPost;
use App\Post;
use App\Tag;
use App\User;
use Brian2694\Toastr\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
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
        $posts =  Auth::user()->posts()->latest()->get();
        return view('author.posts.index', compact('posts', 'title'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Crear Post';
        $categories = Category::All();
        $tags = Tag::All();

        return view('author.posts.create',
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
        ],[
            'title.required' => 'El título es obligatorio',
            'image.required' => 'La Imagen es obligatoria',
            'categories.required' => 'Debes elegir una categoria',
            'tags.required' => 'Debes elegir una etiqueta',
            'body.required' => 'El contenido del post  es obligatorio',

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
        $post->approved = false;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $users = User::where('role_id', '1')->get();
        Notification::send($users, new NewAuthorPost($post));

        Toastr()->success('Post fue creado con exitos :)', 'Exito.');
        return redirect()->route('author.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr()->error('No esta autorizado acceder a este post', 'Error.');
            return redirect()->back();
        }
        $title = $post->title;
        return view('author.posts.show', compact('post', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr()->error('No esta autorizado acceder a este post', 'Error.');
            return redirect()->back();
        }

        $title = 'editar Post';
        $categories = Category::All();
        $tags = Tag::All();

        return view('author.posts.edit',
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
        if($post->user_id != Auth::id())
        {
            Toastr()->error('No esta autorizado acceder a este post', 'Error.');
            return redirect()->back();
        }

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
        return redirect()->route('author.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr()->error('No esta autorizado acceder a este post', 'Error.');
            return redirect()->back();
        }

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
