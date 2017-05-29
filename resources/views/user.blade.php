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
				<div class="ui segments">
					<div class="ui fluid very padded piled segment"> @foreach ( $data as $d )
						<div class="massive ui blue label">{{ $d->name }}</div>
						<hr>
						<div class="row">
							<div class="container">
								<div class="ui huge labels">
									<div class="ui teal label"> <i class="ui icon user"></i>{{ $d->num_alunos}}
										<div class="detail"> Alunos </div>
									</div>
									<div class="ui teal label"> <i class="ui icon paste"></i>{{ $d->num_ocorrencias }}
										<div class="detail"> Ocorrências </div>
									</div>
									<div class="ui teal label"> <i class="ui icon users"></i>{{ $d->num_turmas }}
										<div class="detail"> Turmas </div>
									</div>
								</div>
							</div>
						</div>@endforeach
						<hr>
						<div class="row">
							<div class="ui basic segment">
								<div class="big ui blue label">10 alunos com mais ocorrências</div>
								<br>
								<br> @foreach ( $alunos_max as $a )
								<div href="/alunos/list" class="ui horizontal statistic">
									<div class="ui red circular label"> {{ $a->count}} </div>
									<div class="ui left pointing label"> {{ $a->aluno }}
										<div class="detail">{{ $a->turma }}</div>
									</div>
								</div>
								<br> @endforeach </div>
							<div class="ui basic segment">
								<div class="big ui blue label">Turmas com mais ocorrências</div>
								<br>
								<br> @foreach ( $turmas as $a )
								<div href="/alunos/list" class="ui horizontal statistic">
									<div class="ui red circular label"> {{ $a->count}} </div>
									<div class="ui left pointing label"> {{ $a->turma }} </div>
								</div>
								<br> @endforeach </div>
						</div>
						<hr>
						<div class="row">
							<div class="container">
								<button type="button" onclick="setar_dados({{ $d->id }})" class="massive ui green label" data-toggle="modal" data-target="#editar">Editar Perfil</button>
							</div>
						</div>
					</div>
				</div>
			</div>


<div class="modal fade" id="editar" role="dialog" aria-labelledby="editar">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Editar Perfil</h4> </div>
			<div class="modal-body">
				<form method="GET" action="/user/form/edit" class="ui massive form" id="formEdit">
					<div class="field"> {{ csrf_field() }}
						<label for="aluno">Nome da Escola</label>
						<input type="text" id="nomeEditar" name="nomeEditar" placeholder="Nome da Escola"> </div>
					<div class="ui error message"></div>
					<div class="ui buttons">
						<button type="button" class="big ui grey button" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="big ui submit green button" data-loading-text="Carregando..." id="adicionar">
							</i>Salvar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	function setar_dados(id) {
		$.ajax({
			url: "/user/form/selecionar_user/" + id
			, method: "get"
			, dataType: "json"
		, }).done(function (data) {
			$('#nomeEditar').val(data[0].name);
		});
	}
	$(document).ready(function () {
		$('#menu').click(function () {
			$('.ui.sidebar').sidebar('setting', 'transition', 'scale out').sidebar('toggle');
		});
		$('.ui.form').form({
			fields: {
				nomeEditar: {
					identifier: 'nomeEditar'
					, rules: [{
						type: 'empty'
						, prompt: 'Nome da escola não pode ficar em branco!'
          }]
				}
			}
		});
	});
</script> @endsection
