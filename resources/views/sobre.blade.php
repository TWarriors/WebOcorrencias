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
      <div class="massive ui blue piled very padded segment center aligned">
        <h1 class="ui header center aligned">O projeto</h1>
        <p>Web Ocorrências é um projeto que visa facilitar a comumicação entre escola e pais, disponibilizando via web uma ferramenta de registro de ocorrências escolares.</p>
      </div>
      <div class="massive ui blue piled very padded segment center aligned">
        <h1 class="ui header center aligned">Versão Beta</h1>
        <p>Estamos ainda na versão de testes, contamos com uma hospedagem gratuita, que ao caso não possui estabilidade podendo ocorrer erros de servidor. Mudanças estão previstas conforme os testes e uma aquisição do plano pago de hospedagem para remover as limitações atuais, isso com o apoio das escolas e pais por meio de doação ao projeto.¹</p>
        <br><br>
        ¹ Ainda não disponível!
      </div>
    </div>




<script type="text/javascript">
$(document).ready(function(){

  $('.ui.card').transition().transition('slide down');

  $('#menu').click(function(){

    $('.ui.sidebar').sidebar('setting', 'transition', 'scale out').sidebar('toggle');

  });

});
</script>
@endsection
