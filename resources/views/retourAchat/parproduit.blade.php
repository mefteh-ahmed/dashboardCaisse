@extends('back.layout')

@section('main')


<div class="content">
  
<div class="row">
<div class="col-md-4">
<div class="form-group">
  <label for="sel1">Select catégorie:</label>
  <select class="form-control" id="sel1">
  <option value="0">Sélectionner catégorie</option>
    <option value="1">les articles les plus retourné</option>
    <option value="2">les familles les plus retourné</option>
    <option value="3">les marques les plus retourné</option>
  </select>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
  <label for="sel1">TOP:</label>
  <select class="form-control" id="sel2">
    <option value="5">5</option>
    <option value="10">10</option>
    <option value="15">15</option>
  </select>
</div>
</div>
    <div class='col-md-4'>
      <div class="form-group">
      <label for="sel1">entre:</label>

<div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
    <i class="fa fa-calendar"></i>&nbsp;
    <span></span> <i class="fa fa-caret-down"></i>
</div>
      </div>
      </div>
<div class="col-md-2">
    <div class="form-group mx-sm-3 mb-2">
        <label for="sel1">Valider:</label>
        <button type="button" class="btn btn-primary mb-2" onclick="changeFunc()">Valider</button>

</div>
</div>
</div>

  

<br>


  <div class="row">
      <div class="col-md-6">
          <div id="chart1" class="se-pre-con">
          <div class="margin-0-auto text-center"><img src="../adminlte/img/analytics.png" style="margin-bottom: 15px  height: auto; 
    width: auto; 
    max-width: 50px; 
    max-height: 50px;" alt="">
                <div translate="NO_DATA_TO_DISPLAY" class="text-center">Aucune donnée à afficher</div>
              </div>   
           </div>
       </div>
       <div class="col-md-6">
          <div id="chart2" class="se-pre-con">
          <div class="margin-0-auto text-center"><img src="../adminlte/img/analytics.png" style="margin-bottom: 15px  height: auto; 
    width: auto; 
    max-width: 50px; 
    max-height: 50px;" alt="">
                <div translate="NO_DATA_TO_DISPLAY" class="text-center">Aucune donnée à afficher</div>
              </div>   
           </div>
         </div>
   </div>
</div>
@include('retourAchat.chartAchat.chart')

@endsection
