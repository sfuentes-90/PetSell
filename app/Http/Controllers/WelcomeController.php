<?php

namespace App\Http\Controllers;
use DB;
use App\Categoria;

class WelcomeController extends Controller {
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data;
        $destacados = DB::select("SELECT avisos.id, avisos.titulo FROM avisos,users WHERE users.expiracion_premium >= NOW()  ORDER BY RAND() LIMIT 15");

        $i = 0;
        foreach($destacados as $d){
            $id = $d->id;
            $data[$i]['id'] = $id;
            $data[$i]['titulo'] = $d->titulo;
            $foto = DB::Select("SELECT filename FROM fotos_avisos WHERE idAviso = $id LIMIT 1");
            $data[$i]['foto'] = $foto;
            $i = $i + 1;
        }

        $categorias = Categoria::all();

        return view('welcome')->with('data', $data)->with('categorias', $categorias);
    }
}
