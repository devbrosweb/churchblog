<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $categories = Category::OrderBy('id', 'DESC')->get();
        $categories = Category::latest()->get();
        $title = 'Category';

        return view('admin.categories.index', compact('categories', 'title'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Crear Categorias';
        return view('admin.categories.create', compact('title'));
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
           'name' => 'required|unique:categories',
           'image' => 'required|mimes:jpeg,bmp,png,jpg'
        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'name.unique' => 'La etiqueta ya existe',
            'image.required' => 'La imagen es obligatoria',
            'image.mimes' => 'El formato de la imagen debe ser tipo: jpeg, bmp, png, jpg'
        ]);
        //get form image
        $image = $request->file('image');
        $slug = str_slug($request->name);

        if(isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '-.' . $image->getClientOriginalExtension();


            //check category directory is exists
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk()->makeDirectory('category');
            }

            //resize image for category an upload
            $category = Image::make($image)->resize(1600,479)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('category/' . $imageName, $category);


            //check category slider directory is exists
            if (!Storage::disk('public')->exists('category/slider')) {
                Storage::disk()->makeDirectory('category/slider');
            }
            //resize image for category slider and upload
            $slider = Image::make($image)->resize(1600,479)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('category/slider/' . $imageName, $slider);

        }
        else {
            $imageName = 'default.png';
        }

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'image' => $imageName
        ]);

        Toastr()->success('Categoria fue creada con exito!',
            'Exitoso');

        return redirect()->route('admin.categorias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $title = 'editando a ' . $category->slug;
        return view('admin.categories.edit', compact('category', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'mimes:jpeg,bmp,png,jpg'
        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'image.mimes' => 'El formato de la imagen debe ser tipo: jpeg, bmp, png, jpg'
        ]);
        //get form image
        $image = $request->file('image');
        $slug = str_slug($request->name);

        if(isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '-.' . $image->getClientOriginalExtension();


            //check category directory is exists
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk()->makeDirectory('category');
            }

            //if image exist delete it.
            if(Storage::disk('public')->exists('category/'.$category->image))
            {
                Storage::disk('public')->delete('category/'.$category->image);
            }

            //resize image for category an upload
            $categoryImage = Image::make($image)->resize(1600,479)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('category/' . $imageName, $categoryImage);


            //check category slider directory is exists
            if (!Storage::disk('public')->exists('category/slider')) {
                Storage::disk()->makeDirectory('category/slider');
            }

            //if slider exist delete it.
            if(Storage::disk('public')->exists('category/slider/'.$category->image))
            {
                Storage::disk('public')->delete('category/slider/'.$category->image);
            }

            //resize image for category slider and upload
            $slider = Image::make($image)->resize(1600,479)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('category/slider/' . $imageName, $slider);

        }
        else {
            $imageName = $category->image;
        }

        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imageName;
        $category->save();

        Toastr()->success('Categoria fue actualizada con exito!',
            'Exitoso');

        return redirect()->route('admin.categorias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        //if image exist delete it.
        if(Storage::disk('public')->exists('category/'.$category->image))
        {
            Storage::disk('public')->delete('category/'.$category->image);
        }
        //if slider exist delete it.
        if(Storage::disk('public')->exists('category/slider/'.$category->image))
        {
            Storage::disk('public')->delete('category/slider/'.$category->image);
        }

        $category->delete();
        Toastr()->success('Categoria fue borrada con exito :)!',
            'Exitoso');

        return redirect()->back();
    }
}
