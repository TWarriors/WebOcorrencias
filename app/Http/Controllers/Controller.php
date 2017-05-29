<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\User;
use App\OcorrenciasModel;
use App\AlunosMOdel;

class Controller extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function list_escolas(){

      $data = User::select('id', 'name')->orderBy('name')->get();

      return view('welcome')->with(['data' => $data]);

    }

      public function pesquisar(Request $request){

    $id_escola = $request->input('id_escola');

    $matricula = $request->input('matricula');

    $count = OcorrenciasModel::select('ocorrencias.ocorrencia',
        'ocorrencias.created_at',
          'alunos.aluno',
            'alunos.turma')->join('alunos', 'ocorrencias.id_aluno', '=', 'alunos.id')->where(['ocorrencias.id_user' =>  $id_escola, 'alunos.matricula' => $matricula])->count();

            if($count == 0){

              return redirect('/');

            }else{

              $data = OcorrenciasModel::select('ocorrencias.ocorrencia',
                  'ocorrencias.created_at',
                    'alunos.aluno',
                      'alunos.turma')->join('alunos', 'ocorrencias.id_aluno', '=', 'alunos.id')->where(['ocorrencias.id_user' =>  $id_escola, 'alunos.matricula' => $matricula])->orderBy('ocorrencias.created_at')->get();


                      foreach( $data as $d){

                        $aluno[0] = $d->aluno;
                        $turma[0] = $d->turma;

                      }

                      return view('pesquisar_ocorrencias', ['data' => $data, 'aluno' => $aluno, 'turma' => $turma]);

            }

  }

}
