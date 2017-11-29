<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;
use Hash;
use Redirect;
use DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Muestra el menu del usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('usuario.profile');
    }

    /**
    * Entrega las notificiones pemdientes del usuario
    * @return JSON
    */
    public function notificaciones(){
        $userID = Auth::id();       // Obtiene el id del usuario logueado

        // Obtiene los avisos que contienen notificaciones pertenecientes al usuario
        $notificaciones = DB::select("SELECT id, titulo, comentario, activadoPor
                                      FROM avisos
                                      WHERE idUsuario = $userID
                                      AND activo = '-1'");

        // Devuelve un JSON con los avisos que tienen notificiaciones
        return $notificaciones;
    }

    public function mostrarMembresia() {
        $data['membresias'] = DB::select("SELECT id, cant_meses, precio, descripcion FROM membresias");

        return view('usuario.membresia')->with('data', $data);
    }

    public function info(){
        $userID = Auth::id();       // Obtiene el id del usuario logueado

        // Obtiene los datos del usuario
        $info = DB::table('users')
                  ->where('id', $userID)
                  ->select('name', 'email', 'rut', 'cuenta', 'banco', 'telefono', 'expiracion_premium', 'valoraciones_negativas', 'valoraciones_positivas', 'created_at')
                  ->first();

        // Muestra la pagina con la informacion
        return view('usuario.info')->with('info', $info);
    }

    public function editarUsuario(){
        $userID = Auth::id();       // Obtiene el id del usuario logueado

        // Obtiene los datos del usuario
        $info = DB::table('users')
                  ->where('id', $userID)
                  ->select('email', 'telefono', 'banco', 'cuenta')
                  ->first();

        return view('usuario.edit_user')->with('info', $info);
    }

    public function updateInfo(Request $request) {
        $idUsuario = Auth::id();

        // Se obtiene el usuario
        $user = User::find($idUsuario);

        // Se cambian los campos
        $user->email = $request->input('email');
        $user->telefono = $request->input('telefono');
        $user->banco = $request->input('banco');
        $user->cuenta = $request->input('cuenta');

        // Si se escribio una contraseña se hace el cambio
        if( $request->has('password') ){
          // Se crea un validador
          $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'confirm_password' => 'same:password',
          ]);

          // Si la contraseña no es valida la cambiamos
          if( $validator->passes() ){
              $user->password = Hash::make($request->password);
          }
          // Sino volvemos
          else{
              return redirect()->back();
          }
        }

        // Se actualizan los datos, se envia un mensaje y se redirecciona al usuario
        $user->save();
        $msg = "{ 'title':'Se han actualizado los datos!','msg':'Revisa que los datos sean correctos.'}";
        \Session::flash('message', $msg);
        return redirect('user/info');
    }
}
