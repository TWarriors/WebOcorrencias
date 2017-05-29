<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\OcorrenciasModel;
use App\AlunosModel;
use App\User;

class OcorrenciasController extends Controller {

  public function __construct(){

        $this->middleware('auth');

    }

  public function list(){

    $id_user = Auth::id();
    $data = OcorrenciasModel::select('ocorrencias.id',
       'ocorrencias.ocorrencia',
        'ocorrencias.created_at',
          'alunos.aluno',
            'alunos.turma')->join('alunos', 'ocorrencias.id_aluno', '=', 'alunos.id')->where(['ocorrencias.id_user' =>  $id_user])->orderBy('alunos.aluno')->paginate(50);

    $aluno = AlunosModel::select('id', 'aluno')->where(['id_user' => $id_user])->orderBy('aluno')->get();

    return view('visualizar_ocorrencias', ['data' => $data, 'aluno' => $aluno]);

  }

  public function adicionar_ocorrencia(Request $request){

    $id_user = Auth::id();
    $input = $request->all();

    OcorrenciasModel::where(['id_user' => $id_user])->insert(
      ['id_user' => $id_user,
        'id_aluno' => $input['idAlunoOcorrenciaAdicionar'],
         'ocorrencia' => $input['ocorrenciaAdicionar'],
          'created_at' => date("Y/m/d H:m:s")]);

    return redirect('/ocorrencias/list');

  }

  public function editar_ocorrencia(Request $request){

    $input = $request->all();

    OcorrenciasModel::where(['id' => $input['idOcorrenciaEditar']])->update(['ocorrencia' => $input['ocorrenciaEditar'],
                                                                                  'updated_at' => date("Y/m/d H:m:s")]);

    return redirect('/ocorrencias/list');

  }

  public function excluir_ocorrencia(Request $request){

    $id_ocorrencia = $request->input('idOcorrenciaExcluir');

    OcorrenciasModel::destroy($id_ocorrencia);

    return redirect('/ocorrencias/list');

  }

  public function select_ocorrencia_by_id($id){

    $id_user = Auth::id();

    $data = OcorrenciasModel::select('ocorrencias.id',
       'ocorrencias.ocorrencia',
          'alunos.aluno',
           'alunos.turma')->join('alunos', 'ocorrencias.id_aluno', '=', 'alunos.id')->where(['ocorrencias.id_user' => $id_user, 'ocorrencias.id' => $id])->get();

    return Response($data);

  }

}
