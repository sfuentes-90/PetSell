<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use Illuminate\Pagination\Paginator;
use Redirect;
use Auth;
use DB;
use Input;
use App\Categoria;
use App\FotosAviso;
use App\Aviso;

class AvisosController extends Controller{
  /**
   * Muestra un listado con todos los avisos del usuario.
   *
   * @return Response
   */
  public function index() {
      $idUsuario = Auth::id();        // Obtiene el ID del usuario logueado

      // Realiza la consulta a la BD
       $avisos = Aviso::where('idUsuario', $idUsuario)
                      ->join('categorias', 'avisos.idCategoria', '=', 'categorias.id')
                      ->join('admins', 'avisos.activadoPor', '=', 'admins.id')
                      ->select('avisos.*', 'categorias.nombreCategoria', 'admins.name');

      // Si filtra por estado
      if(request()->has('estado')){
          $avisos = $avisos->where('activo','=', request('estado'));
      }

      $avisos = $avisos->paginate(5)->appends([ 'estado' => request('estado') ]);

      // Carga una vista con todos los avisos del usuario
      return view('usuario.index')->with('avisos', $avisos);
  }




  /**
   * Muestra el formulario para crear un nuevo aviso
   *
   * @return Response
   */
  public function create() {
      // Obtiene las categorias en que es posible publicar
      $categorias = Categoria::all();

      // Se muestra el formulario (se envian las cateogiras para llenar el combobox)
      return view('usuario.create')->with('categorias', $categorias);
  }

  /* MOVIDO A SearchController */
  public function search($palabra) {
      // Busca un aviso basado en su titulo o descripcion
      $avisos = DB::select("SELECT avisos.id, avisos.titulo, avisos.descripcion, avisos.precio
                            FROM avisos
                            WHERE titulo LIKE '%'.$palabra.'%' OR
                                  descripcion LIKE '%'.$palabra.'%'"
                            );
      return $avisos;
  }

  public function uploadSubmit(UploadRequest $request) {
      $aviso['idUsuario']   =  Auth::id();                       // clave primaria del usuario logueado
      $aviso['titulo']      =  $request->input('titulo');        // titulo ingresado en el formulario
      $aviso['descripcion'] =  $request->input('descripcion');   // descripcion ingresada en el formulario
      $aviso['precio']      =  $request->input('precio');        // precio ingresado en el formulario
      $aviso['activo']      =  0;                                // por defecto un aviso estara inactivo al ser creado
      $aviso['activadoPor'] =  1;                                // por defecto el aviso sera vinculado al administrador con id=1
      $aviso['idCategoria'] =  $request->input('idCategoria');   // categoria elegida en el formulario
      $aviso['region']      =  $request->input('region');

      // Se agregan los datos del aviso a la tabla avisos
      $p = Aviso::create($aviso);

      // Se agregan las fotografias a la tabla FotosAviso
      foreach ($request->imagenes as $imagen) {                 // Se recorre el objeto imagenes (contiene las rutas a las imagenes)
            $filename = $imagen->store('fotos_avisos');         // Se guarda el archivo en la carpeta 'photos'
            FotosAviso::create([                                // Se agrega un registro a la BD con la clave del aviso y el nombre del archivo
                'idAviso' => $p->id,                            // id del aviso
                'filename' => $filename                         // nombre del archivo guardado
            ]);
      }

      $msg = "{ 'title':'Se ha creado el aviso!','msg':'Ahora se encuentra en revisión para ser publicado en el sitio.'}";
      \Session::flash('message', $msg);

      return Redirect::to('home');                         // se redirecciona a la pagina de inicio del usuasrio
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
      $idVendedor = $data['aviso']['idUsuario'];
      $data['fotos'] = DB::Select("SELECT * FROM fotos_avisos WHERE idAviso = $id");
      $data['vendedor'] = DB::Select("SELECT name, email, rut, telefono, banco, cuenta, valoraciones_positivas, valoraciones_negativas FROM users WHERE id = $idVendedor");

      // Se muestra una vista con los datos del aviso
      return view('aviso')->with('data', $data);
  }

  /**
   * Muestra el formulario para editar un aviso.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id) {
      // Se obtiene el aviso por su ID
      $aviso = Aviso::find($id);
      $categorias = Categoria::all();
      //$user =  User::find($aviso->idUsuario);

      // Se muestra una vista con los datos del aviso
      return view('usuario.edit')->with('aviso', $aviso)->with('categorias', $categorias);
  }

  /**
   * Actualiza un aviso en la BD.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id) {
      $aviso = Aviso::find($id);

      // Se obtiene los datos del aviso desde el formulario
      $aviso->titulo      = Input::get('titulo');
      $aviso->descripcion = Input::get('descripcion');
      $aviso->precio      = Input::get('precio');
      $aviso->region      = Input::get('region');
      $aviso->activo      = 0;
      $aviso->activadoPor = 1;

      // Se guarda el aviso en la BD
      $aviso->save();

      $msg = "{ 'title':'Se ha editado el aviso!','msg':'Ahora se encuentra en revisión para ser publicado en el sitio.'}";
      \Session::flash('message', $msg);

      return Redirect::to('user/avisos');
  }

  /**
   * Elimina un aviso de la BD (borrado logico).
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id) {
      // Se buca el aviso por su ID
      $aviso = Avisos::find($id);

      // Se elimina el aviso (logicamente)
      $aviso->delete();

      return Redirect::to('home');
  }
}
