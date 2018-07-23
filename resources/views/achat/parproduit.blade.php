@extends('back.layout')

@section('main')
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
 
  <!-- Here are all the javascripts and css that you need, you can download them or linked them like here -->
 <!--  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.10/c3.min.css">  
  <script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.10/c3.min.js"></script> -->
  <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->

</head>
<body>


<div class="content">
  
<div class="row">
<!-- <div class="col-md-4">
<div class="form-group">
  <label for="sel1">Select catégorie:</label>
  <select class="form-control" id="sel1">
  <option value="0">Sélectionner catégorie</option>
    <option value="1">les articles les plus vendus</option>
    <option value="2">les familles les plus vendus</option>
    <option value="3">les marques les plus vendus</option>
  </select>
</div>
</div> -->
<form action="" id="form_id">
<div class="col-md-4">
<div class="form-group">

  <label for="sel1">TOP:</label>
  <select class="form-control" id="sel2"name="sel2">
    <option value="5">5</option>
    <option value="10">10</option>
    <option value="15">15</option>
  </select>
</div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="sel1">Par Année:</label>
        <select class="form-control" id="sel3">
 
         <?php 
  $year=date('Y');
 echo "<option>$year</option>";
   for($i = 1999 ; $i < date('Y')+1; $i++){
      echo "<option value=$i>$i</option>";
   }
?>
</select>
</div>
</div>
<div class="col-md-4">
    <div class="form-group mx-sm-2 mb-2">
        <label for="sel1">Valider:</label><br>
       <!--  <button type="button" class="btn btn-primary mb-2" onclick="changeFunc()">Valider</button> -->
       <button class="btn btn-search btn-submit"><i class="glyphicon glyphicon-search"></i></button>
</div>
</div>
</form>
</div>

 
  <div class="row">
      <div class="col-md-6">
          <div id="chart1" class="se-pre-con">
              <div class="margin-0-auto text-center">
                 <img src="../images/icon_report_flat.png" style="margin-bottom: 15px" alt="">
                 <div translate="NO_DATA_TO_DISPLAY" class="text-center">Aucune donnée à afficher</div>
              </div>
           </div>
       </div>
       <div class="col-md-6">
          <div id="chart2" class="se-pre-con">
           </div>
         </div>
   </div>
</div>
@include('achat.chartAchat.chart')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
   $.ajaxSetup({

     headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }});



 $(".btn-submit").click(function(e){
alert('test');
var limite = $("select[name=sel2]").val();
 aleret(limite);
    e.preventDefault();
 
  
  /*
   var Labels = new Array();
   var valeur = new Array();
  $.ajax({
     type:'get',
     url:'/filterProduit',
     data:{limite:limite}, 
     }).done(function(response) {
   
      var chart = c3.generate({
    data: {
      
        mimeType: 'json',
            keys: {
               x: 'ART_Designation', // it's possible to specify 'x' when category axis
                value: ['LIG_BonEntree_Qte']
            },type:'bar'
    },
    axis: {
        y: {
        label: { // ADD
          text: 'Totale des achats ',
          position: 'outer-middle'
        },
      
        tick: {
          format: d3.format(".3f") // ADD
        }
      },
            x: {
           
               type: 'category',
               
            }
        },bindto: '#chart1'
});
    }); */
 });
</script>

</body>

</html>
@endsection
