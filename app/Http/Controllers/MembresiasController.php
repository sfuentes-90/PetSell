<?php

namespace App\Http\Controllers;
use App\Membresia;
use App\Historial;

use Illuminate\Http\Request;
use Redirect;
use Auth;

class MembresiasController extends Controller {
  /**
   * Muestra las membresias disponibles
   *
   * @return Response
   */
  public function index()  {

  }

  /**
   * Muestra el formulario para comprar una membresia.
   *
   * @return Response
   */
  public function show($id)  {
      $data = Membresia::find($id);

      return view('usuario.membresia')->with('data', $data);
  }

  /**
   * Guarda la compra de una membresia
   *
   * @return Response
   */
  public function store(Request $data)  {
      // Se obtienen los datos
      $idUsuario = Auth::id();
      $idMembresia =  $data->input('idMembresia');

      // Se gaurda el comprobante
      $filename = $data->comprobante->store('comprobantes_membresia');

      // Se crea un objeto para ser almacenado
      $membresia = new Historial;

      // Se setean los campos
      $membresia->idMembresia = $idMembresia;
      $membresia->idUsuario = $idUsuario;
      $membresia->activada = 0;
      $membresia->activadaPor = 1;
      $membresia->comprobante = $filename;

      // Se guarda en la BD
      $membresia->save();

      // Se muestra un mensaje y redicecciona
      $msg = "{ 'title':'Se ha realizado la compra de la membresia!','msg':'Espere a que el administrador acepte su comprobante.'}";
      \Session::flash('message', $msg);
      return Redirect::to('home');
  }
}
