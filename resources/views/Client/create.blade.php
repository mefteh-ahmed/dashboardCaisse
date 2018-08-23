@extends('Client.base')
@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Ajouter un Client</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('clientASM.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required autofocus>

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
                                    <input id="email" type="text" class="form-control" name="email"
                                           value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">password</label>

                                <div class="col-md-6">
                                    <input id="password" type="text" class="form-control" name="password"
                                           value="{{ old('password') }}" required autofocus>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                       
                            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                <label for="role" class="col-md-4 control-label">role</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="role" id="role">
                                    <option value="">select Role</option>
                                        <option value="1">Supadmin</option>
                                        <option value="2">admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Liste des Chaine</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="chaine" id="chaine" >
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"> Magasin </label>
                                <div class="col-md-6">
                                    <select class="form-control" name="id_magasin" id="id_magasin">
                                     
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
<script src="https://code.jquery.com/jquery-3.2.0.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

<script type="text/javascript">
    
    
    $(document).ready(function() {

$('select[name="role"]').on('change', function(){

    var role = $(this).val();
    if(role==1) {
        $( "#id_magasin" ).prop( "disabled", true );
let dropdown = $('#chaine');
dropdown.empty();
dropdown.prop('selectedIndex', 0);
dropdown.append('<option selected="true"disabled>select chaine</option>');

const url = '/get';
// Populate dropdown with list of provinces
$.getJSON(url, function (data) {

 $.each(data, function (key, entry) {

    dropdown.append($('<option></option>').attr('value', entry.id).text(entry.nom_chaine));
  })
  
});
    }else
    if(role==2) 
    {
        $( "#id_magasin" ).prop( "disabled", false );

        const url1 = '/get';
        let dropdown1 = $('#chaine');
        dropdown1.empty();
        dropdown1.append('<option selected="true" disabled>select chaine</option>');
        dropdown1.append('<option value="0">aucun</option>');
        dropdown1.prop('selectedIndex', 0);

// Populate dropdown with list of provinces
$.getJSON(url1, function (data1) {

 $.each(data1, function (key, entry) {

    dropdown1.append($('<option></option>').attr('value', entry.id).text(entry.nom_chaine));
  })
});

        let dropdown = $('#id_magasin');

dropdown.empty();

dropdown.append('<option selected="true" disabled>select magasin</option>');

dropdown.prop('selectedIndex', 0);

    }

});
$('select[name="chaine"]').on('change', function(){
    $('#id_magasin').empty();
    if($('#role').val()==2) {
   
    let dropdown = $('#id_magasin');

    const url = '/getMagByChaine/'+$('#chaine').val();

$.getJSON(url, function (data) {

 $.each(data, function (key, entry) {

    dropdown.append($('<option></option>').attr('value', entry.id).text(entry.nom));
  })


});
}
}); 
});
    
    </script>