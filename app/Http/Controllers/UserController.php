<?php
namespace App\Http\Controllers;

use App\Mail\DestroyMailable;
use App\Models\Activity;
use App\Models\Teaching;
use App\Models\User_activities;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\PDF;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    protected function validator(Request $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'surname' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email', 'unique:users' , "regex:/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/"],
            'dni' => ['required', 'unique:users','regex: /(^[0-9]{8})([-]?)([A-Za-z]{1})$/'],
            'center_code' => ['required', 'digits:8'],
        ]);
    }
    /*   public function listar(Request $request)
       {
           if ($request->ajax()) {
               $data = User::all();
               return Datatables::of($data)
                   ->addColumn('action', function($row){
                       $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                       return $actionBtn;
                   })
                   ->rawColumns(['action'])
                   ->make(true);
           }
       }
   */

    public function listar(Request $request)
    {
        $request->actividadSeleccionada = intval($request->actividadSeleccionada);

        if (($request->actividadSeleccionada) != null)
        $resultado = User::select('*')->teach($request->actividadSeleccionada)->get();
        else
            $resultado = User::all();

        $actividades = Teaching::all();

        return view('users.listado_usuarios', ["resultado" => $resultado, "actividades" => $actividades, "actividadSeleccionada" => $request->actividadSeleccionada]);



    }

public function crearUsu(Request $data)
{

    $data->validate([
        'name' => ['required', 'string', 'max:100'],
        'surname' => ['required', 'string', 'max:150'],
        'email' => ['required', 'string', 'email', 'unique:users' , "regex:/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/"],
        'password' => ['required', 'string', Password::min(8)
            ->mixedCase()
            ->numbers()
            ->symbols()
        ],
        'dni' => ['required', 'unique:users','regex: /(^[0-9]{8})([-]?)([A-Za-z]{1})$/'],
        'center_code' => ['required', 'digits:8'],
    ]);

 $usuario = User::create([
        'name' => $data['name'],
        'surname' => $data['surname'],
        'email' => $data['email'],
        'dni' => $data['dni'],
        'body' => $data['body'],
        'center_code' => $data['center_code'],
        'password' => Hash::make($data['password']),
    ]);

 $usuario->assignRole($data['tipo_user']);

    return back()->with('notification', "Usuario creado correctamente");
}

    public function editar_usu(Request $data){
        $usuario_buscado = User::find($data->id);
        $ense??anzas = Teaching::where("id","!=",$usuario_buscado->body)->get();

        return view('/users.editar_usuario' , ["usu" => $usuario_buscado, "ense??anzas" =>$ense??anzas ]);
    }


    public function guardar_datos_usu(Request $data)
    {
        $data->validate([
            'name' => ['required', 'string', 'max:100'],
            'surname' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email' , "regex:/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/"],
            'dni' => ['required','regex: /(^[0-9]{8})([-]?)([A-Za-z]{1})$/'],
            'center_code' => ['required', 'digits:8'],
        ]);

        $usuario_log = User::find($data->id);

        if($usuario_log->dni != $data->dni)
            $data->validate([
                    'dni' => ['unique:users']
                ]);

        if($usuario_log->email != $data->email)
            $data->validate([
                'email' => ['unique:users']
            ]);

        $usuario_log->name = $data->name;
        $usuario_log->surname = $data->surname;
        $usuario_log->dni = $data->dni;
        $usuario_log->body = $data->body;
        $usuario_log->email = $data->email;
        $usuario_log->center_code = $data->center_code;

        $usuario_log->save();

        return to_route('listado_usu')->with('notification', "Se actualizo la informaci??n del usuario");
    }

    public function eliminar_usu (Request $data)
    {
        $user = User::find($data->id);
        $user->delete();


        return back()->with('notificationE', "Se elimino al usuario , pero no sus datos en la BBDD");
    }

    public function listado_usus_eliminados()
    {
        $ususElim = User::onlyTrashed()->get();

        return view('/users.listado_borrados',["resultado" => $ususElim]);
    }

    public function restaura_usu(Request $data)
    {
        $usu = User::onlyTrashed()->findOrFail($data->id);
        $usu->restore();

        return to_route('listado_usus_eliminados')->with('notification', "Usuario restaurado correctamente");
    }

    public function destruir_usu(Request $data)
    {
        $usu = User::onlyTrashed()->findOrFail($data->id);
        $usu->forceDelete();

        return to_route('listado_usus_eliminados')->with('notificationE', "Usuario eliminado de forma permanente");
    }

    public function descargarLitadoPdf(Request $request){


        if (($request->selecc) != "0")
            $usus = User::select('*')->teach($request->selecc)->get();
        else
            $usus = User::all();

            $tabla = '<table id="users" class="table" style="border:1px solid black; width: 100%;">'
                . '<thead style="background-color: #a0aec0">'
                . '<tr><th>Nombre</th> <th>Apellidos</th>  <th>DNI</th> <th>Email</th> <th>Codigo del centro</th></tr>'
                . '</thead>'
                . '<tbody style="text-align: center">';

            foreach ($usus as $resul) {
                $tabla .= '<tr style="border:1px solid black;"> <td>' . $resul->name . '</td>'
                    . '<td>' . $resul->surname . '</td>'
                    . '<td>' . $resul->dni . '</td>'
                    . '<td>' . $resul->email . '</td>'
                    . '<td>' . $resul->center_code . '</td></tr>';
            }

            $tabla .= "</tbody></table>";



        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($tabla);

        return $pdf->download('listadoUsus.pdf');
    }

    public function enviarComboEnse??anzas()
    {
        $ense??anzas = Teaching::all();

        return view('/users.crear_usuario')->with('ense??anzas', $ense??anzas);
    }

    public function perfil_usu(){

        $usuario_log = User::find(Auth::id());

        $ense??anzas = Teaching::where("id","!=",$usuario_log->body)->get();

        return view('/users.perfil',["usu" => $usuario_log ,"ense??anzas" => $ense??anzas]);

        // para el boton de modificar usuario ser??a parecido al de abajo , hacer tmb el destroy. pasar datos por Post
    }


    public function actualizar_perfil(Request $data)
    {
        $data->validate([
            'name' => ['required', 'string', 'max:100'],
            'surname' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email', "regex:/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/"],
            'dni' => ['required','regex: /(^[0-9]{8})([-]?)([A-Za-z]{1})$/'],
            'center_code' => ['required', 'digits:8'],
            'avatar' => ['image']
        ]);

        $usuario_log = User::find(Auth::id());

        if($usuario_log->dni != $data->dni)
            $data->validate([
                'dni' => ['unique:users']
            ]);

        if($usuario_log->email != $data->email)
            $data->validate([
                'email' => ['unique:users']
            ]);


        $usuario_log->name = $data->name;
        $usuario_log->surname = $data->surname;
        $usuario_log->dni = strtoupper($data->dni);
        $usuario_log->body = $data->body;
        $usuario_log->email = $data->email;
        $usuario_log->center_code = $data->center_code;

        $usuario_log->save();

        if ($data->avatar != "") {
            $usuario_log->clearMediaCollection();
            $usuario_log->addMedia($data->avatar)->toMediaCollection();
        }

        return back()->with('notification', "Se actualizo su perfil.");
    }




}
