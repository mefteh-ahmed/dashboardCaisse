@extends('ChaineDeRestauration.base')
@section('action-content')
    <section class="content">
    <div class="box">
        <div class="box-header">
            <div class="row">
                <div class="col-sm-8">
                    <h3 class="box-title">Liste des  chaines </h3>
                </div>
                <div class="col-sm-4">
                    <a class="btn btn-primary" href="{{ route('chaine.create') }}">Ajouter une chaine</a>
                </div>
            </div>
        </div>
    </div>
        
    <div class="box-body">
   
            <div class="row">
                <div class="col-sm-12">
                    <table id="example2" class="display nowrap" style="width:100%" >
                        <thead>
                          
                        <tr>
                            <th></th>
                            <th >Action</th>
                            <th width="20%" >Nom chaine </th>
                            <th width="20%" >Fondateur du chaine</th>
                            <th width="20%" >Email </th>
                            <th width="20%">N°téléphone</th>

                        </tr>
                        </thead>
                        <tbody>
                  @foreach ($chaines as $chaine)
                            <tr>
                            <td></td>
                            <td style="text-align: center;">
                                   <form class="row" method="POST" action="{{ route('chaine.destroy', ['id' => $chaine->id]) }}" onsubmit = "return confirm('Are you sure?')">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <a href="{{ route('chaine.edit', ['id' => $chaine->id])}}"  class="btn btn-info">
                                        <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                       <button type="submit" class="btn btn-danger">
                                       <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $chaine->nom_chaine }}</td>
                                <td>{{ $chaine->Fondateur }}</td>
                                <td>{{ $chaine->Mail }}</td>
                                <td>{{ $chaine->telephone }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            
        </div>
    </div>
    <!-- /.box-body -->
    </section>
@endsection
