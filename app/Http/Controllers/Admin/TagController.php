<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Brian2694\Toastr\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::OrderBy('id', 'DESC')->get();
        $title = 'Etiquetas';
        return view('admin.tags.index', compact('tags', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Crear etiquetas';
        return view('admin.tags.create', compact('title'));
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
           'name' => 'required|unique:tags'
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'name.unique' => 'La etiqueta ya existe'
        ]);

        Tag::create([
            'name' => $request->name,
            'slug' => str_slug($request->name),
        ]);

        Toastr()->success('Etiqueta fue creada con exito!',
            'Exitoso');

        return redirect()->route('admin.etiquetas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $title = 'editando a ' . $tag->slug;

        return view('admin.tags.edit', compact('tag', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'El campo nombre es obligatorio',
        ]);


        $tag->name = $request->name;
        $tag->slug = str_slug($request->name);
        $tag->save();

        Toastr()->success('Etiqueta fue actualizada con exito!',
            'Exitoso');

        return redirect()->route('admin.etiquetas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        Toastr()->success('Etiqueta fue borrada con exito :)!',
            'Exitoso');

        return redirect()->back();

    }
}
