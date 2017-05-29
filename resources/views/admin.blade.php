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
		<div class="ten wide column">
			<div class="ui fluid very padded piled segment">
				<div class="row">
					<div class="ui input">
						<div class="ui icon input">
							<input class="prompt" type="text" placeholder="Pesquisar" alt="table"> <i class="search icon"></i> </div>
					</div>
					<div class="ui big blue label">Número de Escolas: {{ $count_escolas }}</div>
					<div class="ui big blue label">Número de Alunos: {{ $count_alunos }}</div>
					<div class="ui big blue label">Número de Ocorrências: {{ $count_ocorrencias }}</div>
				</div>
				<div class="row">
					<br>
					<table style="word-wrap: break-word;" class="ui striped stackable very compact selectable sortable table">
						<thead>
							<tr>
								<th class="center aligned">Escola</th>
								<th class="center aligned">Número de Alunos</th>
								<th class="center aligned">Número de Ocorrências</th>
							</tr>
						</thead>
						<tbody> @foreach ($escolas as $e)
							<tr>
								<td class="center aligned">{{ $e->name }}</td>
								<td class="center aligned">{{ $e->num_alunos }}</td>
								<td class="center aligned">{{ $e->num_ocorrencias }}</td>
							</tr> @endforeach </tbody>
					</table>
				</div>
			</div>
		</div>

<script type="text/javascript">
	$(document).ready(function () {
		$('.ui.card').transition().transition('slide down');
		$('#menu').click(function () {
			$('.ui.sidebar').sidebar('setting', 'transition', 'scale out').sidebar('toggle');
		});
		$('.menu .item').tab();
	});
</script> @endsection
