@extends('back.layout')

@section('main')


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

@endsection
