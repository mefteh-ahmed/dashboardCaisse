@extends('ChaineDeRestauration.base')
@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">modifier Chaine</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('chaine.update', ['id' => $chaine->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('nom_chaine') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">nom chaine</label>

                            <div class="col-md-6">
                                <input id="nom_chaine" type="text" class="form-control" name="nom_chaine"  value="{{ $chaine->nom_chaine }}" required autofocus>

                                @if ($errors->has('nom_chaine'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nom_chaine') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Fondateur') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Fondateur</label>

                            <div class="col-md-6">
                                <input id="Fondateur" type="text" class="form-control" name="Fondateur" value="{{ $chaine->Fondateur}}" required autofocus>

                                @if ($errors->has('Fondateur'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Fondateur') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Mail') ? ' has-error' : '' }}">
                            <label for="Mail" class="col-md-4 control-label">Mail</label>

                            <div class="col-md-6">
                                <input id="Mail" type="text" class="form-control" name="Mail" value="{{ $chaine->Mail }}" required autofocus>

                                @if ($errors->has('Mail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Mail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                            <label for="telephone" class="col-md-4 control-label">telephone</label>

                            <div class="col-md-6">
                                <input id="telephone" type="text" class="form-control" name="telephone" value="{{ $chaine->telephone }}" required autofocus>

                                @if ($errors->has('telephone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
