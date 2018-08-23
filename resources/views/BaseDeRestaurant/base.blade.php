@extends('layouts.app-template')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Base de Restauration
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Retour</a></li>
                <li class="active">Base de Magasin </li>
            </ol>
        </section>
    @yield('action-content')
    <!-- /.content -->
    </div>
@endsection