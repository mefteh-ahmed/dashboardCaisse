@extends('back.layout')

@section('main')
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Gestion d'Achat! </title>

</head>
<body>
<table class="table table-bordered table-hover" >
    
    <thead>
      <tr>
       <th>Code_FR</th>
        <th>Nom_FR</th>
        <th>Telephone_FR</th>
        <th>Solde_FR</th>
      </tr>
    </thead>
    <tbody >
      
   @foreach($fournisseurs as $fourn)
      
     <tr>
        <td>{{$fourn['FRS_codef']}}</td>
        <td>{{$fourn['FRS_Nomf']}}</td>
        <td>{{$fourn['FRS_Gsm']}}</td>
        <td>{{$fourn['FRS_Solde']}}</td>
      </tr> 
    @endforeach 
    </tbody>
</table>
<span id="pagination">{{ $fournisseurs->links()}}</span>
</body>

</html>
@endsection