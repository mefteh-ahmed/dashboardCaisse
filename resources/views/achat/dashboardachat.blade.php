@extends('back.layout')

@section('main')
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Gestion d'Achat! </title>
  
  <!-- Here are all the javascripts and css that you need, you can download them or linked them like here -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.10/c3.min.css">  
<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.10/c3.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</head>
<body>


<div class="content">
  <h3 class="text-primary">Récapitulatif des achats</h2>
  <div class="row">
     <div class="col-sm">
      <span class="badge badge-pill badge-info">
           <h4>Totale des<b> Achats</b> En Dinar :{{$ticketa[0]->TotaleAchat}}</h4>
      </span>
     </div>
  </div>
  <div class="row">
   
   
     <div class="col-sm">
         <h4 class="text-primary">Récapitulatif des achats par anneé</h4>
          <div class="row" id="chart0">  </div>
     </div>
    
      <div class="col-sm">
        <h4 class="text-primary">Récapitulatif des achats Par anneé</h4>
          <div class="row" id="chart">  </div>
      </div>
    
        
      
  </div>
  <div class="row">
  
     <div class="col-sm">
          <h4 class="text-primary">Les 10 premiers articles les plus achetés</h4>
          <div class="row" id="chart1">  </div>
      </div>
      <div class="col-sm">
          <h4 class="text-primary">Les 10 premiers articles les plus achetés</h4>
          <div class="row" id="chart2">  </div>
      </div>
  </div>
  <div class="row">
  
     <div class="col-sm">
          <h4 class="text-primary">Les 10 premiers familles les plus achetés</h4>
          <div class="row" id="chart3">  </div>
      </div>
      <div class="col-sm">
          <h4 class="text-primary">Les 10 premiers familles les plus achetés</h4>
          <div class="row" id="chart4">  </div>
      </div>
  </div>
  <div class="row">
  
  <div class="col-sm">
       <h4 class="text-primary">Les 10 premiers marques les plus achetés</h4>
       <div class="row" id="chart5">  </div>
   </div>
   <div class="col-sm">
       <h4 class="text-primary">Les 10 premiers fournisseurs</h4>
       <div class="row" id="chart6">  </div>
   </div>
</div>
  
  </div>

@include('achat.chartAchat.chart')

</body>

</html>
@endsection
