<html>
<head>
  <meta charset="utf-8">
  <title>Liste des Magasin </title>

</head>
<body>
<table class="table table-bordered table-hover" >
    
    <thead>
      <tr>
       <th>nom</th>
        
      </tr>
    </thead>
    <tbody >
      
   @foreach($listMagasin as $list)
      
     <tr>
     <td><a href="{{ URL::to('/magasinRoute',$list->id) }}">{{$list->nom}}</a></td>
     
      </tr> 
    @endforeach 
    </tbody>
</table>
</body>

</html>