@extends('Client.base')
@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">modifier Base</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('clientASM.update', ['id' => $client->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $client->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">email</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ $client->email}}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                      
                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                <label for="role" class="col-md-4 control-label">role</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="role">
                                        <option value="2">Supadmin</option>
                                        <option value="1">admin</option>
                                    </select>
                                </div>
                            </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"> Magasin </label>
                            <div class="col-md-6">
                                <select class="form-control" name="id_magasin">
                                    @foreach ($restaurant  as $rest)
                                        <option value="{{$rest->id}}" {{ $rest->id == $client->id_resto ? 'selected' :'' }}>{{$rest->nom}}</option>
                                        @endforeach
                                </select>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Changer Mot De Passe
</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('clientASM.updatepass',  $client->id) }}">
                        <!-- <input type="hidden" name="_method" value="PATCH"> -->
                        <meta name="csrf_token" content="{ csrf_token() }" />

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">password</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="password" value=""  autofocus>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
       
      </div>
        </form>
    </div>
  </div>
</div>
@endsection
