@extends('layouts.app')

@section('content')
    <div class="column">
        <div class="container">
            <div class="ui fluid blue card">
                <div class="content">
                    @if (session('status'))
                        <div class="alert success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="massive ui form" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="field{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="field">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <div class="field">
                                <button type="submit" class="big ui button primary">
                                    Enviar Link de Recuperação
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
