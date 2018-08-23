@extends('Restaurant.base')
@section('action-content')
    <section class="content">
    <div class="box">
        <div class="box-header">
            <div class="row">
                <div class="col-sm-8">
                    <h3 class="box-title">Liste des  Magasins </h3>
                </div>
                <div class="col-sm-4">
                    <a class="btn btn-primary" href="{{ route('magasin.create') }}">Ajouter un Magasin</a>
                </div>
            </div>
        </div>
    </div>
        
    <div class="box-body">
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6"></div>
        </div>
     
        
        
            <div class="row">
                <div class="col-sm-12">
                
                    <table id="example2" class="display nowrap" style="width:100%">
                        <thead>
                        <tr>
                        <th></th>
                        <th width="10%" >Action</th>
                            <th width="20%" >Nom du magasin </th>
                            <th width="20%" >Adresse</th>
                            <th width="20%" >N°Téléphone </th>
                            <th width="30%" >Email</th>
                            <th width="20%">Nom du chaine </th>

                        </tr>
                        </thead>
                        <tbody>
                  @foreach ($restaurants as $restaurant)
                            <tr>
                            <td></td>
                              <td style="text-align: center;">
                                   <form class="row" method="POST" action="{{ route('magasin.destroy', ['id' => $restaurant->id]) }}" onsubmit = "return confirm('Are you sure?')">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <a href="{{ route('magasin.edit', ['id' => $restaurant->id])}}"  class="btn btn-info">
                                        <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                       <button type="submit" class="btn btn-danger">
                                       <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $restaurant->nom }}</td>
                                <td>{{ $restaurant->adresse }}</td>
                                <td>{{ $restaurant->Telphone }}</td>
                                <td>{{ $restaurant->email }}</td>
                                <td>{{ $restaurant->chaine_name }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
        
        
        </div>
        </div>
    </div>
    <!-- /.box-body -->
 
    </section>
   
@endsection


