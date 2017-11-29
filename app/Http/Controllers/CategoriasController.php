<?php

namespace App\Http\Controllers;

class CategoriasController extends Controller
{
  /**
   * Muestra todas las categorias.
   *
   * @return Response
   */
  public function index() {
      // obtiene todas las categorias
      $avisos = Categorias::all();

      // Muestra una vista con las categorias
      return View::make('categorias.index')->with('categorias', categorias);
  }

  /**
   * Muestra un formulario para crear una nueva categoria
   *
   * @return Response
   */
  public function create() {
      return View::make('categorias.create');
  }

  /**
   * Registra una nueva categoria en la BD
   *
   * @return Response
   */

  public function store() {
      $categoria = new categoria;

      // Se obtienen los datos del formulario
      $categoria->nombreCategoria = Input::get('nombreCategoria');
      $categoria->creadaPor       = 'ADMIN';

      // Se guarda la categoria en la BD
      $aviso->save();

      Session::flash('message', 'Se creo la categoria!');
      return Redirect::to('home');
  }


  /**
   * Muestra un formulario para editar una categoria
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id) {
      $aviso = Avisos::find($id);

      return View::make('aviso.edit')->with('aviso', $aviso);
  }

  /**
   * Actualiza un registro en la tabla categorias
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id) {
      $aviso = Avisos::find($id);

      $aviso->titulo      = Input::get('titulo');
      $aviso->descripcion = Input::get('descripcion');
      $aviso->precio      = Input::get('precio');
      $aviso->activo      = 0;
      $aviso->activadoPor = null;
      $aviso->imagen_1    = 'URL_1';
      $aviso->imagen_2    = 'URL_2';
      $aviso->imagen_3    = 'URL_3';
      $aviso->imagen_4    = 'URL_4';
      $aviso->imagen_5    = 'URL_5';

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
