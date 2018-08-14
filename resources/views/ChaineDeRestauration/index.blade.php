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
        <form action="{{ route('chaine.search') }}" method="post" class="body-form">
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
                            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="chaine: activate to sort column ascending">Nom chaine </th>
                            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="chaine: activate to sort column ascending">Fondateur du chaine</th>
                            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="chaine: activate to sort column ascending">Email </th>
                            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="chaine: activate to sort column ascending">N°téléphone</th>
                            <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                  @foreach ($chaines as $chaine)
                            <tr role="row" class="odd">
                                <td>{{ $chaine->nom_chaine }}</td>
                                <td>{{ $chaine->Fondateur }}</td>
                                <td>{{ $chaine->Mail }}</td>
                                <td>{{ $chaine->telephone }}</td>
                                <td>
                                   <form class="row" method="POST" action="{{ route('chaine.destroy', ['id' => $chaine->id]) }}" onsubmit = "return confirm('Vous êtes sûrs?')">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <a href="{{ route('chaine.edit', ['id' => $chaine->id])}}" class="btn btn-warning col-sm-5 col-xs-5 btn-margin">
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
                            <th width="20%" rowspan="1" colspan="1">chaine Name</th>
                            <th rowspan="1" colspan="2">Action</th>
                        </tr>
                        </tfoot>--}}
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">liste de {{count($chaines)}}/ {{count($chaines)}} chaines</div>
                </div>
                <div class="col-sm-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                        {{ $chaines->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    </section>
@endsection
