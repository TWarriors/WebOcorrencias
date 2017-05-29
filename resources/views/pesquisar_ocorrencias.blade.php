@extends('layouts.app')

@section('content')

    <div class="container">
      <br>
      <div class="colunm">
          <div class="huge ui blue label">Aluno: {{ $aluno[0] }}</div>
          <div class="huge ui blue label">Turma: {{ $turma[0] }}</div>
          <a href="/" class="big ui blue button">
              Nova Pesquisa <i class="icon search"></i>
          </a>
          <br><br>
      </div>
      <div class="ui input">
        <div class="ui icon input">
          <input class="prompt" type="text" placeholder="Pesquisar" alt="table">
          <i class="search icon"></i>
        </div>
      </div>

      <table style="word-wrap: break-word;" class="ui striped stackable very compact selectable sortable table hidden">
        <thead>
          <tr>
            <th class="center aligned">Ocorrencia</th>
            <th class="center aligned">Adicionado em:</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($data as $dado)

              <tr>
                <td class="center aligned">{{ $dado->ocorrencia }}</td>
                <td class="center aligned">{{ $dado->created_at->format('H:m:s d/m/Y') }}</td>
              </tr>

          @endforeach

        </tbody>
      </table>
    </div>



<script>

  $(document).ready(function(){

    $('.ui.card').transition('slide down');

    $('#menu').click(function(){

      $('.ui.sidebar').sidebar('setting', 'transition', 'scale out').sidebar('toggle');

    });

    $('.hidden').transition('slide down');

  });

</script>

@endsection
