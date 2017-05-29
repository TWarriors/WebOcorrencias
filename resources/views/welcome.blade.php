@extends('layouts.app')

@section('content')

<example></example>
<div class="pusher">
  <div class="ui inverted vertical masthead center aligned segment">
    <div class="ui text container">
      <h1>Ocorrências Web</h1>
      <h2>Tenha disponível as ocorrências de seus alunos online</h2>
      <div class="ui huge primary button" data-toggle="modal" data-target="#myModal">Área dos Pais<i class="right arrow icon"></i></div>
    </div>
  </div>


<div class="massive ui vertical raised very padded center aligned segment">
    <div class="ui text">
      <h1 class="ui horizontal header divider ani">Simples</h1>
      <p class="hidden">De maneira simples adicione e deixe disponível para pais e professores visualizarem todo o histórico dos alunos.</p>
      <h1 class="ui horizontal header divider hidden">Sem instalações</h1>
      <p class="hidden">Totalmente online e direto no navegador, sem instalações.</p>
      <h1 class="ui horizontal header divider hidden">Começe Agora</h1>
      <p class="hidden">Experimente agora sem custos</p>
      <a href="/register" class="ui huge button primary hidden">Registrar</a>
    </div>
  </div>

<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pesquise pela escola e matricula</h4>
          </div>
          <div class="modal-body">
            <label class="control-label" >Escola</label>
            <form id="form" class="ui massive form" action="/pesquisar_publico" method="GET">
              <div class="field">
                <select class="form-control" id="idEscola" name="id_escola" value="" placeholder="Escola">

                  @foreach ($data as $a)

                    <option value="{{ $a->id }}">{{ $a->name }}</option>

                  @endforeach

                </select>
              </div>
              <div class="field">
                <label >Matricula</label>
                <input type="text" id="matricula" name="matricula" placeholder="Matricula">
              </div>
              <div class="ui error message"></div>
              <div class="ui buttons">
                <button type="button" class="big ui button" data-dismiss="modal">Fechar</button>
                <button type="submit" class="big ui blue button" id="pesquisar"><i class="icon search"></i>Pesquisar</button>
              </div>
            </form>
          </div>
          </div>
        </div>
      </div>
    </div>


<script>

  $(document).ready(function(){

    $('.ui.card').transition().transition('slide down');

    $('#menu').click(function(){

      $('.ui.sidebar').sidebar('setting', 'transition', 'scale out').sidebar('toggle');

    });

    $('.hidden').transition({
      animation : 'scale',
      duration : 750,
      interval  : 500
    });

     $('#form').form({
      fields: {
        Matricula: {
            identifier: 'matricula',
            rules: [{
              type: 'integer[1..99999999999]',
              prompt: 'Matricula incorreta!'
            }]
        }
      }
    });

  });

</script>

@endsection
