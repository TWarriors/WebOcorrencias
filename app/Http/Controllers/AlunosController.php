<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\AlunosModel;

class AlunosController extends Controller {

  public function __construct(){

        $this->middleware('auth');

    }

  public function list(){

    $id_user = Auth::id();
    $data = AlunosModel::where(['id_user' => $id_user])->orderBy('aluno')->paginate(50);

    foreach($data as $d) {

      $d['count'] = AlunosModel::join('ocorrencias', 'alunos.id', '=', 'ocorrencias.id_aluno')->where(['alunos.id' => $d->id])->count();

    }

    return view('visualizar_alunos', ['data' => $data]);

  }

  public function adicionar_aluno(Request $request){

    $id_user = Auth::id();
    $input = $request->all();

    AlunosModel::where(['id_user' => $id_user])->insert(
      ['id_user' => $id_user,
        'aluno'=> $input['aluno'],
       'turma' => $input['turma'],
       'matricula' => $input['matricula'],
     'created_at' => date("Y/m/d H:m:s")]
     );
    return redirect('/alunos/list');

  }

  public function editar_aluno(Request $request){

    $input = $request->all();

    AlunosModel::where(['id' => $input['idAlunoEditar']])->update(['aluno' => $input['alunoEditar'], 'turma' => $input['turmaEditar'], 'matricula' => $input['matriculaEditar'], 'updated_at' => date("Y/m/d H:m:s")]);

    return redirect('/alunos/list');

  }

  public function excluir_aluno(Request $request){

    $id_aluno = $request->input('idAlunoExcluir');

    AlunosModel::destroy($id_aluno);

    return redirect('/alunos/list');

}

  public function select_aluno_by_id($id){

    $data = AlunosModel::where(['id' => $id])->get();

    return Response($data);

  }

}
