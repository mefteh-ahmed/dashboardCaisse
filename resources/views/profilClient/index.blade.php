@extends('back.layout')

@section('main')
    <section class="content">
    <div class="row">
    <div class="col-md-6 col-md-offset-2">
    <div class="box box-primary">
            <div class="box-body box-profile">
             


              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>nom</b> <a class="pull-right">{{ Auth::user()->name }}</a>
                </li>
                <li class="list-group-item">
                  <b>email</b> <a class="pull-right">{{ Auth::user()->email }}</a>
                </li>
              </ul>

            </div>
            <!-- /.box-body -->
          </div>
          <div class="col-md-4">

<a href="{{ Route('profilC.edit', ['id' => Auth::user()->id]) }}" class="btn btn-primary btn-block"><b>Modifier</b></a>
</div>
<div class="col-md-4">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
Changer Mot De Passe
</button>
</div>
</div>
</div>
    </section>
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
      <form class="form-horizontal" role="form" method="POST" action="{{ route('profilC.updatepass', Auth::user()->id) }}">
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

