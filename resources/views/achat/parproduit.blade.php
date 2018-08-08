@extends('back.layout')

@section('main')


<div class="content">
  
<div class="row">
<div class="col-md-4">
<div class="form-group">
  <label for="sel1">Select catégorie:</label>
  <select class="form-control" id="sel1">
  <option value="0">Sélectionner catégorie</option>
    <option value="1">les articles les plus achetés</option>
    <option value="2">les familles les plus achetés</option>
    <option value="3">les marques les plus achetés</option>
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
   <select name="select1"id="select1" class="selectpicker" data-show-subtext="true" data-live-search="true">
  <option>Select Famille</option>

  @foreach($ALLfamille as $fam)
<option value='{{ $fam->FAM_Code }}'>{{ $fam->FAM_Lib }}</option>
  @endforeach
      
</select>
<select id ="select2" name ="select2" class="selectpicker" data-live-search="true"> 
<option>Select Articles</option>
</select>
<div id="chart5"></div>
<script type="text/javascript">
    
       
    
    $(document).ready(function() {

$('select[name="select1"]').on('change', function(){

    var countryId = $(this).val();
    if(countryId) {
let dropdown = $('#select2');

dropdown.empty();

dropdown.append('<option selected="true" disabled>select Article</option>');
dropdown.prop('selectedIndex', 0);

const url = '/api/ALLarticle/'+countryId;

// Populate dropdown with list of provinces
$.getJSON(url, function (data) {

  $.each(data, function (key, entry) {

    dropdown.append($('<option></option>').attr('value', entry.ART_Code).text(entry.ART_Designation));
  })
  $('#select2').selectpicker('refresh');


});
    }

});

});
    
    </script>
<script type="text/javascript">
$(document).ready(function() {
$('select[name="select2"]').on('change', function(){
    var from= $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
  var to=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
  var art = $(this).val();
      chart = c3.generate({
    data: {
        x: 'year',
      
        url: '/api/articleachat/'+art+'/'+from+'/'+to,
        mimeType: 'json',
        type: 'bar',
        keys: {
            x: 'year',
            value: ['TotaleAchat','qte']
        }
        ,axes: {
            qte: 'y2'
        }
    },
    axis: {
        x: {
            type: "timeseries",
            tick: { 
                        format: '%Y-%m-%d',
        
                    }
        },y: {
            label: 'TotaleAchat',
            tick: {
          format: d3.format(".3f") // ADD
        }
        },
        y2: {
            show: true,
            label: 'qte Totale'
            
        }
    },bindto: '#chart5'
});
});
});
    </script>
</div>

@include('achat.chartAchat.chart')

@endsection
