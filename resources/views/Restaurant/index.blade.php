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
                    <a class="btn btn-primary" href="{{ route('restaurant.create') }}">Ajouter un Magasin</a>
                </div>
            </div>
        </div>
    </div>
        <form action="{{ route('restaurant.search') }}" method="post" class="body-form">
            {{ csrf_field() }}

            @include('layouts.search')
        </form>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6"></div>
        </div>

        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
                <div class="col-sm-12">
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                        <thead>
                        <tr role="row">
                            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="restaurant: activate to sort column ascending">Nom du magasin </th>
                            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="restaurant: activate to sort column ascending">Adresse</th>
                            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="restaurant: activate to sort column ascending">N°Téléphone </th>
                            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="restaurant: activate to sort column ascending">Email</th>
                            <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                  @foreach ($restaurants as $restaurant)
                            <tr role="row" class="odd">
                                <td>{{ $restaurant->nom }}</td>
                                <td>{{ $restaurant->adresse }}</td>
                                <td>{{ $restaurant->Telphone }}</td>
                                <td>{{ $restaurant->email }}</td>
                                <td>
                                   <form class="row" method="POST" action="{{ route('restaurant.destroy', ['id' => $restaurant->id]) }}" onsubmit = "return confirm('Are you sure?')">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <a href="{{ route('restaurant.edit', ['id' => $restaurant->id])}}"  class="btn btn-warning col-sm-5 col-xs-5 btn-margin">
                                            Modifier
                                        </a>
                                       <button type="submit" class="btn btn-danger col-sm-5 col-xs-5 btn-margin">
                                           Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        {{--<tfoot>
                        <tr>
                            <th width="20%" rowspan="1" colspan="1">restaurant Name</th>
                            <th rowspan="1" colspan="2">Action</th>
                        </tr>
                        </tfoot>--}}
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">liste de {{count($restaurants)}}/ {{count($restaurants)}} restaurants</div>
                </div>
                <div class="col-sm-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                        {{ $restaurants->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    </section>
@endsection
