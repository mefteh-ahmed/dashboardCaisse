@extends('profil.base')
@section('action-content')
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

              <a href="{{ Route('profil.edit', ['id' => Auth::user()->id]) }}" class="btn btn-primary btn-block"><b>Modifier</b></a>
            </div>
            <!-- /.box-body -->
          </div>
</div>
</div>
    </section>
@endsection
