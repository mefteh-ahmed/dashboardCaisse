@extends('Client.base')
@section('action-content')
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="box-title">Liste des Clients </h3>
                    </div>
                    <div class="col-sm-4">
                        <a class="btn btn-primary" href="{{ route('clientASM.create') }}">Ajouter un Client</a>
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
                                <th>Nom
                                </th>
                                <th>Email
                                </th>

                              
                                <th>Nom Du Magasin
                                </th>

<th>Nom Du chaine
                                </th>
                             

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($clients as $cl)
                                <tr>
                                    <td></td>
                                    <td style="text-align: center;">
                                   <form class="row" method="POST" action="{{ route('clientASM.destroy', ['id' => $cl->id]) }}" onsubmit = "return confirm('Are you sure?')">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <a href="{{ route('clientASM.edit', ['id' => $cl->id])}}"  class="btn btn-info">
                                        <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                       <button type="submit" class="btn btn-danger">
                                       <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                    </form>
                                </td>
                                    <td>{{ $cl->name }}</td>
                                    <td>{{ $cl->email }}</td>
                                    <td>{{ $cl->magasin_name }}</td>
                                    <td>{{ $cl->nom_chaine }}</td>
                           
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
