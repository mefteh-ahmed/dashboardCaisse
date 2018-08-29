@extends('back.layout')

@section('main')
<!DOCTYPE html>
<div class="content">
<div class="row">
    <div class='col-md-4'>
    <h3 class="text-primary">Récapitulatif des achats Par periode</h2>
    </div>
 <div class='col-md-4'>
      <div class="form-group">
      <label for="sel1">Choisir Période:</label>

<div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
    <i class="fa fa-calendar"></i>&nbsp;
    <span></span> <i class="fa fa-caret-down"></i>
</div>
      </div>
      </div>
      <div class="col-md-2">
      <div class="form-group">
      <label for="sel1">Valider:</label>
    <div class="form-group mx-sm-3 mb-2">
        <button type="button" class="btn btn-primary mb-2" onclick="changeFunc2()">Valider</button>
</div>
</div>
</div>
</div>
  <div class="row">
  <div class="col-sm-4">
    <h3>Total des achats En Dinar <span class="text-primary"><div id="a">0.000</div></span></h3>
    </div>
  </div>

  <div class="row">

 
      <div class="col-sm">
           <div class="row" id="chart7"> 
           <div class="margin-0-auto text-center"><img src="../adminlte/img/analytics.png" style="margin-bottom: 15px  height: auto; 
    width: auto; 
    max-width: 50px; 
    max-height: 50px;" alt="">
                <div translate="NO_DATA_TO_DISPLAY" class="text-center">Aucune donnée à afficher</div>
              </div>  
            </div>

      </div>
     
   </div>
  <div class="row">
   
  <h4 class="text-primary">Récapitulatif des achats Par Exercice</h4>

   
    
      <div class="col-sm-8">
          <div class="row" id="chart">  </div>
      </div>
        <div class="col-sm-4">
          <div class="row" id="chart0">  </div>
     </div>
  </div>
 
  
  </div>

@include('achat.chartAchat.chart')

</body>

</html>
@endsection
