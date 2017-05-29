<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\AlunosModel;
use App\OcorrenciasModel;
use App\User;

class AdminController extends Controller {

    public function __construct(){

        $this->middleware('auth');
        
    }

    public function index(){

        $escolas = User::orderBy('name')->get();

        foreach( $escolas as $e ){

            $e['num_alunos'] = AlunosModel::where(['id_user' => $e->id])->count();

            $e['num_ocorrencias'] = OcorrenciasModel::where(['id_user' => $e->id])->count();

        }

        $countEscolas = User::count();

        $countAlunos = AlunosModel::count();

        $countOcorrencias = OcorrenciasModel::count();

        return view('admin', with(['escolas' => $escolas, 'count_escolas' => $countEscolas, 'count_alunos' => $countAlunos, 'count_ocorrencias' => $countOcorrencias]));

    }

}