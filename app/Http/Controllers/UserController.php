<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\AlunosModel;
use App\OcorrenciasModel;
use App\User;

class UserController extends Controller {

  public function __construct(){

        $this->middleware('auth');

    }

  public function index(){

    $id_user = Auth::id();

    $data = User::where(['id' => $id_user])->get();

    foreach($data as $d){

      $d['num_alunos'] = AlunosModel::where(['id_user' => $id_user])->count();

      $d['num_ocorrencias'] = OcorrenciasModel::where(['id_user' => $id_user])->count();

      $turmas = AlunosModel::select('turma')->where(['id_user' => $id_user])->orderBy('turma', 'desc')->get();

      $turmas = $turmas->unique('turma');

      $d['num_turmas'] = $turmas->count();

    }

    $alunos_max = AlunosModel::where(['id_user' => $id_user])->orderBy('aluno')->get();

    $turmas = AlunosModel::select('turma')->where(['id_user' => $id_user])->orderBy('turma', 'desc')->get();

    $turmas = $turmas->unique('turma');


    foreach ($turmas as $t) {

      $t['count'] = AlunosModel::join('ocorrencias', 'alunos.id', '=', 'ocorrencias.id_aluno')->where(['turma' => $t->turma])->count();

    }

    foreach($alunos_max as $d) {

      $d['count'] = AlunosModel::join('ocorrencias', 'alunos.id', '=', 'ocorrencias.id_aluno')->where(['alunos.id' => $d->id])->count();

    }

    $alunos_mais_ocorrencias = $alunos_max->sortByDesc('count')->take(10);

    $turmas = $turmas->sortByDesc('count');

    return view('user', with(['data' => $data, 'alunos_max' => $alunos_mais_ocorrencias, 'turmas' => $turmas]));

  }

  public function edit(Request $request){

    $input = $request->all();
    $id_user = Auth::id();

    User::where(['id' => $id_user])->update(['name' => $input['nomeEditar']]);

    return redirect('/user');

  }

  public function select_user($id){

    $data = User::select('name')->where(['id' => $id])->get();

    return Response($data);

  }

}
