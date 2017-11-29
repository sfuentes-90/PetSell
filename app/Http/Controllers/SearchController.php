<?php

namespace App\Http\Controllers;

use DB;
use App\Aviso;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Input;

class SearchController extends Controller {

  public function buscar2() {
    // Se obtiene la query
    $query = request('busqueda');

    // Se obtiene el Modelo inicial (aviso actido, uniendo la tabla de usuarios y fotos, para determinar la imagen que se mostrara y si el usuario es premium o no)
    $resultado = Aviso::where('activo', '>', '0')                                         // El aviso debe estar activo
                        ->join('users', 'avisos.idUsuario', '=', 'users.id')              // Hacemos un Join a la tabla users
                        ->join('fotos_avisos', 'avisos.id', '=', 'fotos_avisos.idAviso')  // Hacemos un Join a la tabla fotos_avisos
                        ->groupBy('avisos.id')                                            // Agrupamos por id de aviso (para limitar el numero de fotos)
                        ->take(1)                                                         // Se toma el primer registro de aviso (obtenemos solo la primera foto)
                        ->orderBy('users.expiracion_premium', 'DESC');                    // Se ordena

    // Si hay una palabra clave se filtra
    if(request()->has('busqueda')){
        $resultado = $resultado->where('titulo', 'like', "%$query%");
    }

    // Si hay una region se filtra
    if(request()->has('region')){
        $resultado = $resultado->where('region','=', request('region'));
    }

    // Si hay una categoria se filtra
    if(request()->has('categoria')){
        $resultado = $resultado->where('idCategoria','=', request('categoria'));
    }

    // Se genera la paquinacion de los resultados con los filtros si estos existen
    $resultado = $resultado->paginate(5)->appends([ 'busqueda' => request('busqueda'),
                                                    'region' => request('region'),
                                                    'categoria' => request('categoria')
                                                  ]);
    // Se devuelve la pagina con los resultados
    return view('resultados', ['resultados' => $resultado]);
  }


  public function buscar(){
      $query = Input::get('busqueda');
      // Busqueda por palabra, filtrada por region
      if($query){
        if(request()->has('region')){
          $r = Aviso::where('titulo', 'like', "%$query%")
                      ->where('region','=', request('region'))
                      ->where('activo', '>', '0')
                      ->join('users', 'avisos.idUsuario', '=', 'users.id')
                      ->join('fotos_avisos', 'avisos.id', '=', 'fotos_avisos.idAviso')
                      ->groupBy('avisos.id')
                      ->take(1)
                      ->orderBy('users.expiracion_premium', 'DESC')
                      ->paginate(5)
                      ->appends('region', request('region'));
        }
        else{
          $r = Aviso::where('titulo', 'like', "%$query%")
                    ->where('activo', '>', '0')
                    ->join('users', 'avisos.idUsuario', '=', 'users.id')
                    ->join('fotos_avisos', 'avisos.id', '=', 'fotos_avisos.idAviso')
                    ->groupBy('avisos.id')
                    ->take(1)
                    ->orderBy('users.expiracion_premium', 'DESC')
                    ->paginate(5);
        }

      }

      // Busqueda por todo, filtrada por region
      else{
        if(request()->has('region')){
          $r = Aviso::where('activo', '>', '0')
                      ->where('region', request('region'))
                      ->join('users', 'avisos.idUsuario', '=', 'users.id')
                      ->join('fotos_avisos', 'avisos.id', '=', 'fotos_avisos.idAviso')
                      ->groupBy('avisos.id')
                      ->take(1)
                      ->orderBy('users.expiracion_premium', 'DESC')
                      ->paginate(5)
                      ->appends('region', request('region'));
        }
        else{
          $r = Aviso::where('activo', '>', '0')
                      ->join('users', 'avisos.idUsuario', '=', 'users.id')
                      ->join('fotos_avisos', 'avisos.id', '=', 'fotos_avisos.idAviso')
                      ->groupBy('avisos.id')
                      ->take(1)
                      ->orderBy('users.expiracion_premium', 'DESC')
                      ->paginate(5);
        }
      }

      return view('resultados', ['users' => $r]);
  }
}
