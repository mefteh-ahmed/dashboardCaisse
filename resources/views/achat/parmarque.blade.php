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
<h4 class="text-primary">Les 10 premiers marques les plus achetés</h4>
  <div class="row">
  
  <div class="row">
      <div class="col-md-6">
          <div id="chart5" class="se-pre-con">
              <div class="margin-0-auto text-center">
                 <img src="../images/icon_report_flat.png" style="margin-bottom: 15px" alt="">
                 <div translate="NO_DATA_TO_DISPLAY" class="text-center">Aucune donnée à afficher</div>
              </div>
           </div>
       </div>
       <div class="col-md-6">
          <div id="chart7" class="se-pre-con">
           </div>
         </div>
   </div>
</div>
  
  </div>

@include('achat.chartAchat.chart')

</body>

</html>
@endsection
