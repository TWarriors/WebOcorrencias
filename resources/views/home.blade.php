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
    <div class="ui blue piled segments">
      <div class="massive ui padded segment center aligned ">
        <div class="ui header">
          Notícias
        </div>
      </div>
      <div class="massive ui blue very padded segment center aligned ">
        <div class="ui header">
          Lançado!
        </div>
        <p>
          Lançada a primeira versão! Envie seu feedback para lucienrc@outloook.com.br, contamos com sua ajuda!
        </p>
        <div class="date">
          9 de Abril, 2017
        </div>
      </div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function(){

  $('.ui.card').transition().transition('slide out');

  $('#menu').click(function(){

    $('.ui.sidebar').sidebar('setting', 'transition', 'scale out').sidebar('toggle');

  });

});
</script>
@endsection
