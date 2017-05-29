@extends('layouts.app')

@section('content')
<div class="three wide column">
  <div class="massive ui vertical menu">
    @if(Auth::id() == 1)
    <a href="/admin" class="item"><i class="icon setting"></i>Admin
    </a>
    @endif
    <a href="/home" class="item"><i class="icon bookmark"></i>Principal
    </a>
    <a href="/user" class="item"> <i class="icon user"></i>Perfil </a>
    <a href="/alunos/list" class="item"><i class="icon users"></i>Alunos
    </a>
    <a href="/ocorrencias/list" class="item"><i class="icon paste"></i>Ocorrências
    </a>
    <a href="/sobre" class="item"><i class="icon help"></i>Sobre
    </a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="item"><i class="icon sign out"></i>Sair
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }} </form>
  </div>
</div>

    <div class="twelve wide column">
      <br>
      <div class="ui input">
        <div class="ui icon input">
          <input class="prompt" type="text" placeholder="Pesquisar" alt="table">
          <i class="search icon"></i>
        </div>
      </div>
      <table style="word-wrap: break-word;" class="ui striped stackable very compact selectable sortable table hidden">
        <thead>
          <tr>
            <th class="center aligned">Aluno</th>
            <th class="center aligned">Turma</th>
            <th class="center aligned">Ocorrencia</th>
            <th class="center aligned">Adicionado em:</th>
            <th class="center aligned">
              <button type="button" class="large ui icon green button" data-toggle="modal" data-target="#adicionar_ocorrencia"><i class="icon add"></i>

              </button>
            </th>
          </tr>
        </thead>
        <tbody>

          @foreach ($data as $dado)

              <tr>
                <td class="center aligned">{{ $dado->aluno }}</td>
                <td class="center aligned">{{ $dado->turma }}</td>
                <td class="center aligned">{{ $dado->ocorrencia }}</td>
                <td class="center aligned">{{ $dado->created_at->format('H:m:s d/m/Y') }}</td>
                <td class="center aligned">
                  <div class="ui buttons" role="group">
                    <button type="button" onclick="setar_dados({{ $dado->id }})" class="large ui icon yellow button" data-toggle="modal" data-target="#editar_ocorrencia"><i class="icon edit"></i></button>
                    <button type="button" onclick="setar_dados({{ $dado->id }})" class="large ui icon red button" data-toggle="modal" data-target="#excluir_ocorrencia"><i class="icon trash outline"></i></button>
                  </div>
                </td>
              </tr>

          @endforeach

        </tbody>
      </table>

      {{ $data->links() }}

    </div>


<div class="modal fade" id="adicionar_ocorrencia" role="dialog" aria-labelledby="adicionar_ocorrencia">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Adicionar Ocorrência</h4>
      </div>
      <div class="modal-body">
        <form id="adicionarOcorrencia" method="GET" action="/ocorrencias/form/adicionar_ocorrencia" class="ui massive form">
        <div class="field">
          {{ csrf_field() }}
          <label for="idAlunoOcorrenciaAdicionar">Aluno</label>
          <select class="ui search dropdown" id="idAlunoOcorrenciaAdicionar" name="idAlunoOcorrenciaAdicionar">

            @foreach( $aluno as $a )

            <option value="{{ $a->id }}"> {{ $a->aluno }} </option>

            @endforeach

          </select>
        </div>
        <div class="field">
          <label for="ocorrenciaAdicionar">Ocorrencia</label>
          <textarea class="form-control" id="ocorrenciaAdicionar" name="ocorrenciaAdicionar" placeholder="Ocorrencia"></textarea>
        </div>
        <div class="ui error message"></div>
        <div class="ui buttons">
          <button type="submit" id="adicionar" class="ui big green button" data-loading-text="Carregando"><i class="icon add"></i>Adicionar</button>
          <button type="button" class="ui big button" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
      </div>
    </div>
  </div>
</div>


  <div class="modal fade" id="excluir_ocorrencia" role="dialog" aria-labelledby="excluir_ocorrencia">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Excluir ocorrencia</h4>
        </div>
        <div class="modal-body">
          <form action="/ocorrencias/form/excluir_ocorrencia" method="GET" class="ui massive form">
            {{ csrf_field() }}
            <div class="disabled field">
              <label for="alunoOcorrenciaExcluir">Aluno</label>
              <input type="text" class="form-control" id="alunoOcorrenciaExcluir" name="alunoOcorrenciaExcluir" placeholder="Nome do Aluno">
            </div>
            <div class="disabled field">
              <label for="turmaOcorrenciaExcluir">Turma</label>
              <input type="number" class="form-control" id="turmaOcorrenciaExcluir" name="turmaOcorrenciaExcluir" placeholder="Turma do Aluno">
            </div>
            <div class="disabled field">
              <label for="ocorrenciaExcluir">Ocorrencia</label>
              <textarea class="form-control" id="ocorrenciaExcluir" name="ocorrenciaExcluir" placeholder="Ocorrencia"></textarea>
            </div>
            <input type="number" hidden name="idOcorrenciaExcluir" id="idOcorrenciaExcluir">
            <div class="ui buttons">
              <button type="submit" class="ui big red button" id="excluir" data-loading-text="carregando"><i class="icon trash outline"></i>Excluir</button>
              <button type="button" class="ui big button" data-dismiss="modal">Sair</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editar_ocorrencia" role="dialog" aria-labelledby="editar_ocorrencia">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Editar Ocorrencia</h4>
        </div>
        <div class="modal-body">
          <form id="editarOcorrencia" action="/ocorrencias/form/editar_ocorrencia" method="GET" class="ui massive form">
            {{ csrf_field() }}
            <input type="number" hidden id="idOcorrenciaEditar" name="idOcorrenciaEditar"/>
          <div class="field">
            <label for="matriculaEditar">Ocorrencia</label>
            <textarea class="form-control" id="ocorrenciaEditar" name="ocorrenciaEditar" placeholder="Ocorrencia"></textarea>
          </div>
          <div class="ui error message"></div>
          <div class="ui buttons">
          <button type="submit" class="big ui yellow button" value="Salvar" id="editar" data-loading-text="Carregando"><i class="icon edit"></i>Editar</button>
          <button type="button" class="big ui button" data-dismiss="modal">Sair</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>

  function setar_dados(id){
    $("#idOcorrenciaExcluir").val(id);
    $("#idOcorrenciaEditar").val(id);

    $.ajax({

      url: "/ocorrencias/form/selecionar_ocorrencia_by_id/" + id,
      method: "get",
      dataType: "json",

    })

    .done(function(data){

      $("#alunoOcorrenciaExcluir").val(data[0].aluno);
      $("#turmaOcorrenciaExcluir").val(data[0].turma);
      $("#ocorrenciaExcluir").val(data[0].ocorrencia);
      $("#ocorrenciaEditar").val(data[0].ocorrencia);


    });
  }

  $(document).ready(function(){

    $('.ui.table').transition('slide down');

    $('#menu').click(function(){

      $('.ui.sidebar').sidebar('setting', 'transition', 'scale out').sidebar('toggle');

    });

    $('.prompt').popup({
      title : 'Procurar por aluno, turma, ocorrência',
      position : 'right center'
    });

    $('.button.icon.green').popup({
      title : 'Adicionar ocorrência',
      position : 'top center'
    });

    $('.button.icon.yellow').popup({
      title : 'Editar ocorrência',
      position : 'left center'
    });

    $('.button.icon.red').popup({
      title : 'Excluir ocorrência',
      position : 'right center'
    });

    $('#adicionarOcorrencia').form({
      fields: {
        Ocorrencia: {
            identifier: 'ocorrenciaAdicionar',
            rules: [{
              type: 'empty',
              prompt: 'Ocorrência incorreta!'
            }]
        }
      }
    });

    $('#editarOcorrencia').form({
      fields: {
        Ocorrencia: {
            identifier: 'ocorrenciaEditar',
            rules: [{
              type: 'empty',
              prompt: 'Ocorrência incorreta!'
            }]
        }
      }
    });

  })

</script>

@endsection
