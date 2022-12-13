<?php
namespace App\Http\Controllers;

use App\Mail\DestroyMailable;
use App\Models\Activity;
use App\Models\Place;
use App\Models\Teaching;
use App\Models\type_activities;
use App\Models\User_activities;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf as PDF;



class UserActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function listar()
    {
        $fecha_actual = date("Y/m/d H:i:s");
        $resultado = User_activities::where("id_user","=",Auth::id())->join('activities', 'usersActivities.id_activity', '=', 'activities.id')
            ->where("activities.date",">=",$fecha_actual)->orderBy('activities.date', 'asc')->get();

        return view('Profesor.mis_actividades', ["resultado" => $resultado ,"bActivity" => "pendientes"]);

    }

    public function listarRealizadas()
    {
        $fecha_actual = date("Y-m-d H:i:s");
        $resultado = User_activities::select('*')->join('activities', 'usersActivities.id_activity', '=', 'activities.id')->where("usersActivities.id_user","=",Auth::id())
            ->whereDate("activities.date","<",$fecha_actual)->orderBy('activities.date', 'asc')->get();

        return view('Profesor.mis_actividades', ["resultado" => $resultado ,"bActivity" => "realizadas"]);

    }

    public function listarParticipantesActividad(Request $data)
    {
        $actividad = User_activities::where("id_activity","=",$data->id)->get();


        return view('Profesor.participantes_actividad', ["resultado" => $actividad]);
    }


    public function listarTodas()
    {
        $fecha_actual = date("Y/m/d H:i:s");
        $resultado = Activity::where("activities.date",">=",$fecha_actual)->orderBy('date', 'asc')->get();

        return view('Profesor.actividades', ["resultado" => $resultado]);

    }

    public function listarCuerpo()
    {
        $fecha_actual = date("Y/m/d H:i:s");
        $resultado = Activity::where("activities.date",">=",$fecha_actual)->where("teaching",'=',Auth::user()->body)->orderBy('date', 'asc')->get();

        return view('Profesor.actividades', ["resultado" => $resultado,"mias" => "mias"]);

    }

    public function anularActividad(Request $data){

        $activity = User_activities::where('id_user','=',Auth::id())->where('id_activity','=',$data->id)->first();
        $activity->delete();

        return to_route('mis_actividades')->with('notification', "¡Se borró de esa actividad con exito!");
    }


    public function inscribirActividad(Request $data){

        $actividad_actual = Activity::find($data->id);

        $actividades_posibles = User_activities::select('activities.id')->join('activities', 'usersActivities.id_activity', '=', 'activities.id')->where("usersActivities.id_user","=",Auth::id())
            ->where("activities.date","=",$actividad_actual->date)->get();


        if (count($actividades_posibles) > 0)
        {
            $array[0] = $actividades_posibles[0]->id;
            $array[1] = $data->id;

            return redirect()->route('actividades')->with('actividad_actual' , $array);
        }

      User_activities::create([
            'id_user' => Auth::id(),
            'id_activity'=>$data->id
        ]);

      $actividad = Activity::find($data->id);

        return to_route('mis_actividades')->with('notification', "¡Se ha inscrito con exito a la actividad : ".$actividad->name."!");
    }


    public function procesarCambioActividad(Request $data){

        User_activities::where('id_user','=',Auth::id())->where('id_activity','=',$data->actividad_actual)->delete();

        User_activities::create([
            'id_user' => Auth::id(),
            'id_activity'=>$data->actividad_cambio
        ]);

        return to_route('mis_actividades')->with('notification', "¡Se proceso el cambio con exito!");
    }


    public function descargarparticipantesPDF(Request $data){

        $Registroactividad = User_activities::all()->where('id_activity','=',$data->id_registro);

        $users = [];

        foreach ($Registroactividad as $registro)
        {
            $users[] = User::withTrashed()->find($registro->id_user);
        }

        $pdf = PDF::loadView('pdfs.listadoParticipantesPDF',['resultado' => $users , 'nombre'=> $data->name_activity] );

        return $pdf->download('listadoActividades.pdf');
    }

}
