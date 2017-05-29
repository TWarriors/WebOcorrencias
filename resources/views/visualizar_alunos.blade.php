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
      <div class="ui imput">
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
            <th class="center aligned">Matricula</th>
            <th class="center aligned">Núm. Ocorrências</th>
            <th class="center aligned">
              <button type="button" class="large ui icon green button" data-toggle="modal" data-target="#adicionar_aluno"><i class="icon add"></i>

              </button>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $aluno)

              <tr>
                <td class="center aligned">{{ $aluno->aluno }}</td>
                <td class="center aligned">{{ $aluno->turma }}</td>
                <td class="center aligned">{{ $aluno->matricula }}</td>
                <td class="center aligned">{{ $aluno->count }}</td>
                <td class="center aligned">
                  <div class="ui buttons" role="group">
                    <button type="button" onclick="setar_dados({{ $aluno->id }})" class="large ui icon yellow button" data-toggle="modal" data-target="#editar_aluno"><i class="icon edit"></i></button>
                    <button type="button" onclick="setar_dados({{ $aluno->id }})" class="large ui icon red button" data-toggle="modal" data-target="#excluir_aluno"><i class="icon trash outline"></i></button>
                  </div>
                </td>
              </tr>

          @endforeach

        </tbody>
      </table>

      {{ $data->links() }}

    </div>

<div class="modal fade" id="adicionar_aluno" role="dialog" aria-labelledby="adicionar_aluno">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Adicionar Aluno</h4>
      </div>
      <div class="modal-body">
        <form method="GET" action="/alunos/form/adicionar_aluno" class="ui massive form" id="formAdd">
        <div class="field">
          {{ csrf_field() }}
          <label for="aluno">Aluno</label>
          <input type="text" class="form-control" id="aluno" name="aluno" placeholder="Nome do Aluno">
        </div>
        <div class="field">
          <label for="turma">Turma</label>
          <input type="text" class="form-control" id="turma" name="turma" placeholder="Turma do Aluno">
        </div>
        <div class="field">
          <label for="matricula">Matricula</label>
          <input type="text" class="form-control" id="matricula" name="matricula" placeholder="Matricula do Aluno">
        </div>
        <div class="ui error message"></div>
        <div class="ui buttons">
          <button type="button" class="big ui grey button" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="big ui green button" data-loading-text="Carregando..." id="adicionar"><i class="icon add"></i>Adicionar</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="excluir_aluno" role="dialog" aria-labelledby="excluir_aluno">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="description" id="myModalLabel">Excluir Aluno</h4>
      </div>
      <div class="modal-body">
        <form action="/alunos/form/excluir_aluno" method="GET" class="ui massive form">
          {{ csrf_field() }}
          <div class="disabled field">
            <label for="alunoEditar">Aluno</label>
            <input type="text" disabled class="form-control" id="alunoExcluir" name="alunoExcluir" placeholder="Nome do Aluno">
          </div>
          <div class="disabled field">
            <label for="turmaEditar">Turma</label>
            <input type="text" disabled class="form-control" id="turmaExcluir" name="turmaExcluir" placeholder="Turma do Aluno">
          </div>
          <div class="disabled field">
            <label for="matriculaEditar">Matricula</label>
            <input type="text" disabled class="form-control" id="matriculaExcluir" name="matriculaExcluir" placeholder="Matricula do Aluno">
          </div>
          <input type="text" hidden id="idAlunoExcluir" name="idAlunoExcluir"/>
          <div class="ui buttons">
        	   <button type="button" class="big ui grey button" data-dismiss="modal">Sair</button>
			       <button type="submit" class="big ui red button" id="excluir" data-loading-text="Carregando"><i class="icon trash outline"></i>Excluir</button>
		      </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="editar_aluno" role="dialog" aria-labelledby="editar_aluno">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Aluno</h4>
      </div>
      <div class="modal-body">
        <form action="/alunos/form/editar_aluno" method="GET" class="ui massive form">
          {{ csrf_field() }}
          <input type="text" hidden id="idAlunoEditar" name="idAlunoEditar"/>
        <div class="field">
          <label for="alunoEditar">Aluno</label>
          <input type="text" class="form-control" id="alunoEditar" name="alunoEditar" placeholder="Nome do Aluno">
        </div>
        <div class="field">
          <label for="turmaEditar">Turma</label>
          <input type="text" class="form-control" id="turmaEditar" name="turmaEditar" placeholder="Turma do Aluno">
        </div>
        <div class="field">
          <label for="matriculaEditar">Matricula</label>
          <input type="text" class="form-control" id="matriculaEditar" name="matriculaEditar" placeholder="Matricula do Aluno">
        </div>
        <div class="ui buttons">
          <button type="button" class="big ui grey button" data-dismiss="modal">Sair</button>
		      <button type="submit" class="big ui yellow button" id="editar" data-loading-text="Carregando">Editar <i class="icon edit"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

<script>

  function setar_dados(id){

    $("#idAlunoExcluir").val(id);
    $("#idAlunoEditar").val(id);

    $.ajax({
      url: "/alunos/form/selecionar_aluno_by_id/" + id,
      method: "get",
      dataType: "json",
    })

    .done(function(data){

      $("#alunoExcluir").val(data[0].aluno);
      $("#turmaExcluir").val(data[0].turma);
      $("#matriculaExcluir").val(data[0].matricula);
      $("#alunoEditar").val(data[0].aluno);
      $("#turmaEditar").val(data[0].turma);
      $("#matriculaEditar").val(data[0].matricula);

    });
  }

  $(document).ready(function(){

    $('.ui.table').transition('slide down');

    $('.prompt').popup({
      title : 'Procurar por aluno, turma, matricula',
      position : 'right center'
    });

    $('.button.icon.green').popup({
      title : 'Adicionar aluno',
      position : 'top center'
    });

    $('.button.icon.yellow').popup({
      title : 'Editar aluno',
      position : 'left center'
    });

    $('.button.icon.red').popup({
      title : 'Excluir aluno',
      position : 'right center'
    });

    $('#formAdd').form({
      fields: {
        aluno: {
            identifier: 'aluno',
            rules: [{
              type: 'minLength[10]',
              prompt: 'Aluno incorreto!'
            }]
        },
        turma: {
            identifier: 'turma',
            rules: [{
              type: 'integer[1..999]',
              prompt: 'Turma incorreta!'
            }]
        },
        matricula: {
            identifier: 'matricula',
            rules: [{
              type: 'integer[1..99999999999]',
              prompt: 'Matricula incorreta!'
            }]
        }
      }
    });

    $('#formEdit').form({
      fields: {
        aluno: {
            identifier: 'alunoEditar',
            rules: [{
              type: 'minLength[10]',
              prompt: 'Aluno incorreto!'
            }]
        },
        turma: {
            identifier: 'turmaEditar',
            rules: [{
              type: 'integer[1..999]',
              prompt: 'Turma incorreta!'
            }]
        },
        matricula: {
            identifier: 'matriculaEditar',
            rules: [{
              type: 'integer[1..999999999]',
              prompt: 'Matricula incorreta!'
            }]
        }
      }
    });

  });

</script>
@endsection
