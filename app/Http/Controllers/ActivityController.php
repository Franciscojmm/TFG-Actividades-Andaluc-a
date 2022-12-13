<?php
namespace App\Http\Controllers;

use App\Mail\DestroyMailable;
use App\Models\Activity;
use App\Models\Place;
use App\Models\Teaching;
use App\Models\type_activities;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Dompdf\Dompdf;

use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listarTodasParaInicio(){
        $resultado = Activity::all();

        return view('/', ["resultado" => $resultado ]);
    }



    public function listar(Request $request)
    {
        $resultado = Activity::select('*')->enseñanza($request->teaching)->get();
        $enseñanzas = Teaching::all();

        return view('welcome', ["resultado" => $resultado ,"enseñanzas"=>$enseñanzas]);

    }

    public function crearActividad(Request $data)
    {

        $data->validate([
            'name' => ['required', 'string', 'max:80'],
            'description' => [ 'max:255'],
            'date' => ['required','date', 'max:255']
        ]);

         Activity::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'date' => $data['date'],
            'type' => $data['type'],
            'place' => $data['place'],
            'teaching' => $data['teaching']
        ]);

        return back()->with('notification', "Se creo la actividad de manera correcta.");
    }


    public function combosActividad()
    {
        $places = Place::all();
        $types = type_activities::all();
        $teachings = Teaching::all();

        return view('/Activities.crear_actividad',["places" => $places ,"types" => $types , "teachings" => $teachings]);
    }

    public function combosEditarActividad(Request $data)
    {
        $actividad = Activity::find($data->id);

        $places = Place::where("id","!=",$actividad->place)->get();
        $types = type_activities::where("id","!=",$actividad->type)->get();
        $teachings = Teaching::where("id","!=",$actividad->teaching)->get();

        return view('/Activities.editar_actividad',["actividad"=> $actividad ,"places" => $places ,"types" => $types , "teachings" => $teachings]);
    }

    public function actualizar_actividad(Request $data)
    {
        $data->validate([
            'name' => ['required', 'string', 'max:80'],
            'description' => [ 'max:255'],
            'date' => ['required','date', 'max:255']
        ]);

        $actividad = Activity::find($data->id);


            $actividad->name = $data->name;
            $actividad->description = $data->description;
            $actividad->date = $data->date;
            $actividad->type = $data->type;
            $actividad->type = $data->type;
            $actividad->teaching = $data->teaching;

        $actividad->save();

        return back()->with('notification', "Se guardaron los cambios en la actividad.");
    }

    public function eliminar_actividad (Request $data)
    {
        $user = Activity::find($data->id);
        $user->delete();

        return back()->with('notificationE', "Se elimino la actividad.");
    }

    public function descargarListadoPDF(){
        $actividades = Activity::all();

        $pdf = PDF::loadView('pdfs.listadoActividadesPDF',['resultado' => $actividades]);
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('listadoActividades.pdf');
    }

    }
