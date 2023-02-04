<?php

namespace App\Http\Controllers;

use App\Models\livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        livro::create([
            'titulo' => $request->titulo,
            'autor' => $request->autor,
            'user_id' => Auth::user()->id,
            'genero' => $request->genero,
            'ano' => $request->ano,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function show(livro $livro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function edit(livro $livro)
    {
        return Inertia::render('EditForm', [
            'livro' => $livro
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, livro $livro)
    {
        $livro->titulo = $request->titulo;
        $livro->autor = $request->autor;
        $livro->genero= $request->genero;
        $livro->ano= $request->ano;
        $livro->save();

        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function destroy(livro $livro)
    {
        $livro->delete();
    }
}
