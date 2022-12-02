<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;



class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        $resultado = User::all();

        return view('users.listado_usuarios', ["resultado" => $resultado]);

    }
}
