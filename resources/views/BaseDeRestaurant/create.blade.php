@extends('BaseDeRestaurant.base')
@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Ajouter une Base </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('restaurantDB.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('DB_HOST') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">DB_HOST</label>

                            <div class="col-md-6">
                                <input id="DB_HOST" type="text" class="form-control" name="DB_HOST" value="{{ old('DB_HOST') }}" required autofocus>

                                @if ($errors->has('DB_HOST'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('DB_HOST') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('DB_DATABASE') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">DB_DATABASE</label>

                            <div class="col-md-6">
                                <input id="DB_DATABASE" type="text" class="form-control" name="DB_DATABASE" value="{{ old('DB_DATABASE') }}" required autofocus>

                                @if ($errors->has('DB_DATABASE'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('DB_DATABASE') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('DB_USERNAME') ? ' has-error' : '' }}">
                            <label for="DB_USERNAME" class="col-md-4 control-label">DB_USERNAME</label>

                            <div class="col-md-6">
                                <input id="DB_USERNAME" type="text" class="form-control" name="DB_USERNAME" value="{{ old('DB_USERNAME') }}"  autofocus>

                                @if ($errors->has('DB_USERNAME'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('DB_USERNAME') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('DB_PASSWORD') ? ' has-error' : '' }}">
                            <label for="DB_PASSWORD" class="col-md-4 control-label">DB_PASSWORD</label>

                            <div class="col-md-6">
                                <input id="DB_PASSWORD" type="text" class="form-control" name="DB_PASSWORD" value="{{ old('DB_PASSWORD') }}"  autofocus>

                                @if ($errors->has('DB_PASSWORD'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('DB_PASSWORD') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="col-md-4 control-label"> Magasin </label>
                        <div class="col-md-6">
                            <select class="form-control" name="id_magasin">
                                @foreach ($restaurants  as $restaurant)
                                    <option value="{{$restaurant->id}}">{{$restaurant->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
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
