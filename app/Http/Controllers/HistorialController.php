<?php

namespace App\Http\Controllers;

class HistorialController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      // get all the nerds
      $avisos = Nerd::all();

      // load the view and pass the nerds
      return View::make('avisos.index')
          ->with('avisos', $avisos);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
      return View::make('avisos.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
      $aviso = new Aviso;

      $aviso->titulo      = Input::get('titulo');
      $aviso->descripcion = Input::get('descripcion');
      $aviso->precio      = Input::get('precio');
      $aviso->activo      = 0;
      $aviso->activadoPor = null;
      $aviso->categoria   = Input::get('categoria');


      $aviso->save();
      Session::flash('message', 'Se creo el aviso!');
      return Redirect::to('home');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
      $aviso = Aviso::find($id);

      return View::make('avisos-show')->with('aviso', $aviso);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
      $aviso = Avisos::find($id);

      return View::make('aviso.edit')->with('aviso', $aviso);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
      $aviso = Avisos::find($id);

      $aviso->titulo      = Input::get('titulo');
      $aviso->descripcion = Input::get('descripcion');
      $aviso->precio      = Input::get('precio');
      $aviso->activo      = 0;
      $aviso->activadoPor = null;

      $aviso->save(;
      Session::flash('message', 'Se ha actualizado el aviso!');
      return Redirect::to('home');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
      $aviso = Avisos::find($id);
      $aviso->delete();

      Session::flash('message', 'Se ha borrado el aviso!');
      return Redirect::to('home');
  }
}
