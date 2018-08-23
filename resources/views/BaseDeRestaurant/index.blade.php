@extends('BaseDeRestaurant.base')
@section('action-content')
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="box-title">Liste des Bases </h3>
                    </div>
                    <div class="col-sm-4">
                        <a class="btn btn-primary" href="{{ route('magasinDB.create') }}">Ajouter une base</a>
                    </div>
                </div>
            </div>
        </div>
      
        <div class="box-body">
        
           

      
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example2" class="display nowrap" style="width:100%">
                            <thead>
                            <tr role="row">
                                <th></th>
                            <th>Action
                                </th>
                                <th > Adresse IP
                                </th>
                                <th>Nom base donnée
                                </th>
                                <th>Login BD
                                </th>
                                <th>password BD
                                </th>
                                <th>Nom du Magasin
                                </th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($restaurantsD as $rd)
                                <tr>
                                    <td></td>
                                  <td style="text-align: center;">
                                   <form class="row" method="POST" action="{{ route('magasinDB.destroy', ['id' => $rd->id]) }}" onsubmit = "return confirm('Are you sure?')">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <a href="{{ route('magasinDB.edit', ['id' => $rd->id])}}"  class="btn btn-info">
                                        <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                       <button type="submit" class="btn btn-danger">
                                       <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                    </form>
                                </td>
                                    <td>{{ $rd->DB_HOST }}</td>
                                    <td>{{ $rd->DB_DATABASE }}</td>
                                    <td>{{ $rd->DB_USERNAME }}</td>
                                    <td>{{ $rd->DB_PASSWORD }}</td>
                                    <td>{{ $rd->resto_name }}</td>

                                </tr>
                            @endforeach
                            </tbody>
                          
                        </table>
                   
                <div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">liste
                            de {{count($restaurantsD)}}/ {{count($restaurantsD)}} database
                        </div>
                    </div>
                   
                </div>
            
            </div>
            </div>
        </div>
        <!-- /.box-body -->
    </section>
@endsection
