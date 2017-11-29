<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Aviso;
use Redirect;
use Carbon\Carbon;

class SecretariaController extends Controller {
  public function __construct()
  {
      $this->middleware('auth:admin');
  }

  public function avisos() {
      // Realiza la consulta a la BD
      $avisos = DB::table('avisos')
                    ->select('id', 'titulo', 'descripcion', 'idUsuario', 'created_at', 'updated_at')
                    ->where('activo', '=', '0')
                    ->orderBy('updated_at', 'ASC')
                    ->paginate(10);

      // Carga una vista con todos los avisos del usuario
      return view('admin.avisos', ['avisos' => $avisos]);
  }

  public function activarAviso($idAviso) {
      $idAdmin = Auth::id();

      DB::table('avisos')->where('id', $idAviso )->update(['activo' => '1', 'activadoPor' => $idAdmin]);
      return back();
  }

  public function rechazar(Request $request) {
      $idAdmin = Auth::id();
      $idAviso = $request->input('id');
      $comentario = $request->input('comentario');

      DB::table('avisos')->where('id', $idAviso )->update(['activo' => '-1',
                                                           'comentario' => $comentario,
                                                           'activadoPor' => $idAdmin]);
      return ($request);
  }

  /**
   * Muestra un aviso
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id) {
      // Se obtienen los datos de cada talba
      $data['aviso'] = Aviso::find($id);
      $data['fotos'] = DB::Select("SELECT * FROM fotos_avisos WHERE idAviso = $id");

      // Se muestra una vista con los datos del aviso
      return view('admin.aviso')->with('data', $data);
  }

  public function verMembresias(){
    // Realiza la consulta a la BD
    $solicitudes = DB::table('historial')
                  ->join('users', 'historial.idUsuario', '=', 'users.id')
                  ->join('membresias', 'historial.idMembresia', '=', 'membresias.id')
                  ->where('historial.activada', '=', '0')
                  ->orderBy('historial.id', 'ASC')
                  ->select('historial.id', 'historial.idMembresia', 'historial.idUsuario', 'historial.comprobante', 'historial.created_at', 'historial.updated_at', 'users.name', 'membresias.precio')
                  ->paginate(10);

    // Carga una vista con todos los avisos del usuario
    return view('admin.solicitudes_membresia', ['avisos' => $solicitudes]);
  }

  public function activarMembresia($id) {
    // Se obtiene el ID del administrador
    $idAdmin = Auth::id();

    // Se obtienen los datos del Usuario
    $solicitud = DB::table('historial')
                   ->where('historial.id', $id)
                   ->join('membresias', 'historial.idMembresia', '=', 'membresias.id')
                   ->select('historial.idUsuario as idUsuario', 'membresias.cant_meses as duracion')
                   ->first();
    // Se activa la membresia (en las tablas historial y user)
    DB::table('historial')->where('id', $id )->update(['activada' => '1', 'activadaPor' => $idAdmin]);
    DB::table('users')->where('id', $solicitud->idUsuario)->update(['expiracion_premium' => Carbon::now()->addMonths($solicitud->duracion)]);

    // Se vuelve a la pagina
    return back();
  }

  public function rechazarMembresia(Request $request) {
      $idAdmin = Auth::id();
      $idSolicitud = $request->input('id');
      $comentario = $request->input('comentario');

      DB::table('historial')->where('id', $idSolicitud )->update(['activada' => '-1',
                                                           'comentario' => $comentario,
                                                           'activadaPor' => $idAdmin]);
      return ($request);
  }

}
