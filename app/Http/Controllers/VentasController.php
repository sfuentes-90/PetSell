<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use DB;
use App\Aviso;
use App\User;
use App\Venta;
use Illuminate\Http\Request;
use DateTime;

class VentasController extends Controller {
    public function __construct() {
          // Requiere estar logueado con usuario
          $this->middleware('auth:web');
    }

    /**
     *  Muestra todas las compras realizadas por un usuario
     *
     * @return Response
     */
    public function index() {
       // Obtiene el id del usuario
       $idComprador   =  Auth::id();

       // Obtiene las compras realizadas por el usuario
       $compras = DB::select("SELECT ventas.id, ventas.fechaCompra, ventas.valorada, ventas.comprobante, users.id AS idUsuario,
                                     users.name,
                                     avisos.id as idAviso, avisos.titulo, avisos.precio
                              FROM ventas,users,avisos
                              WHERE ventas.idComprador = $idComprador AND
                                    ventas.idVendedor = users.id AND
                                    ventas.idAviso = avisos.id"
                            );

       // Carga una vista con todas las compras del usuario
       return view('ventas.compras')->with('compras', $compras);
   }



   /**
    *  Muestra todas las ventas realizadas por un usuario
    *
    * @return Response
    */
    public function ventas($id) {
        // Obtiene el id del usuario
        $idVendedor   =  Auth::id();

        // Obtiene las compras realizadas por el usuario
        $compras = DB::select("SELECT ventas.id,ventas.fechaCompra,ventas.valorada, ventas.comprobante,users.id AS idUsuario,users.name,avisos.id as idAviso,avisos.titulo,avisos.precio
                               FROM ventas,users,avisos
                               WHERE ventas.idVendedor = $idVendedor AND
                                     ventas.idAviso = $id AND
                                     ventas.idComprador = users.id AND
                                     ventas.idAviso = avisos.id"
                             );

        // Carga una vista con todas las compras del usuario
        return view('ventas.ventas')->with('compras', $compras);
    }



   /**
    *  Muestra los un formulario para realizar una compra
    *
    * @return Response vista con los datos de la compra
    */
  public function show($id) {
      // Obtiene los datos del aviso
      $data['aviso'] = Aviso::find($id);

      // Obtiene los datos del vendedor
      $data['usuario'] = User::find($data['aviso']->idUsuario);

      // Muestra el formulario
      return view('ventas.comprar')->with('data', $data);
  }



  /**
   *  Almacena la venta en la BD
   *
   * @return Response
   */
    public function store(Request $data) {
          $venta = new Venta;

          // Obtiene los datos del formulario
          $venta->idComprador          =  Auth::id();                    // id del comprador (obtenido por la session)
          $venta->idVendedor           =  $data->input('idVendedor');    // id del vendedor (obtenido del formulario)
          $venta->idAviso              =  $data->input('idAviso');       // id del aviso
          $venta->fechaCompra          =  new DateTime();                // fecha actual
          $venta->valorada             =  0;                             // se indica que aun no se valora la compra
          $venta->direccion_envio      =  $data->input('direccion_envio');
          $venta->comentario_comprador =  $data->input('comentario_comprador');
          $venta->comprobante_valido   =  0;
          // Se guarda la imagen subida en la carpeta comprobantes y se obtiene su nombre
          $filename = $data->comprobante->store('comprobantes');
          // Se guarda el nombre del comprobante subido en la BD
          $venta->comprobante   =  $filename;                     // url del comprobante subido
          $venta->save();                                         // se guarda el registro en la BD

          // Cambiar la cantidad de ventas del aviso
          DB::table('avisos')->whereId($venta->idAviso)->increment('ventas');

          // Se envia un mensaje al usuario y se redirecciona
          $msg = "{ 'title':'Se ha realizado la compra!','msg':'Espere a que el vendedor acepte su comprobante, o no dude en ponerse en contacto con él'}";
          \Session::flash('message', $msg);
          return Redirect::to('home');                        // se redirecciona a la pagina de inicio del usuasrio
      }



      /**
       * Valora al usuario dueño del aviso comprado negativamente
       *
      */
      public function valorar_negativa($id){
          // Se obtiene el aviso
          $venta = Venta::find($id);

          // Si ya se valoro no hacemos nada
          if($venta['valorada'] == 1){
            $msg = "{ 'title':'Ya se valoro esta compra!','msg':'No puedes volver a valorar esta compra'}";
            \Session::flash('message', $msg);
          }

          // Se valora la compra
          else{
            // Se cambia la valoracion del usuario
            $venta->valorada = 1;
            $venta->save();

            // Se muestra un mensaje al usuario
            $idUsuario = $venta->idVendedor;
            DB::table('users')->whereId($idUsuario)->increment('valoraciones_negativas');
          }

          // Volvemos a la pagina
          return Redirect::back();
      }



      /**
       * Valora al usuario dueño del aviso comprado positivamente
       *
      */
      public function valorar_positiva($id){
          // Se obtiene el aviso
          $venta = Venta::find($id);

          // Si ya se valoro no hacemos nada
          if($venta['valorada'] == 1){
            $msg = "{ 'title':'Ya se valoro esta compra!','msg':'No puedes volver a valorar esta compra'}";
            \Session::flash('message', $msg);
          }

          // Se valora la compra
          else{
            $venta->valorada = 1;     // Se cambia el estado de la transaccion
            $venta->save();           // Se guarda el nuevo estado en la BD

            // Se cambia la valoracion del usuario
            $idUsuario = $venta->idVendedor;
            DB::table('users')->whereId($idUsuario)->increment('valoraciones_positivas');

            // Se muestra un mensaje al usuario
            $msg = "{ 'title':'Se ha valorado la compra!','msg':'Gracias por darnos la opinión de tu compra!'}";
            \Session::flash('message', $msg);
          }

          // Volvemos a la pagina
          return Redirect::back();
      }
}
