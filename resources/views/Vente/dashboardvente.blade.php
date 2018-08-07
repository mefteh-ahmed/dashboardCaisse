@extends('back.layout')

@section('main')
<script type="text/javascript" >
function changeFunc() {
  
  var from= $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
  var to=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
  $.getJSON('/api/TotalVentefilter/'+from+'/'+to, function(data1)
  {
    var totale=data1[0].TotaleVente;
    document.getElementById("a").innerHTML =numeral(totale).format('0,0.000');
    $.getJSON('/api/TotalAchatfilter/'+from+'/'+to, function(data)
  {
    var TotaleAchat=data[0].TotaleAchat;
    document.getElementById("b").innerHTML =numeral(TotaleAchat).format('0,0.000');
 var gain =totale-TotaleAchat;
 document.getElementById("c").innerHTML =numeral(gain).format('0,0.000');

  })
  })
  chart = c3.generate({
    data: {
        x: 'year',
      
        url: '/api/TotalVenteDate/'+from+'/'+to,
        mimeType: 'json',
        keys: {
            x: 'year',
            value: ['TotaleVente','TotaleAchat']
        }
    },
    axis: {
        x: {
            type: "timeseries",
            tick: { 
                        format: '%Y-%m-%d',
                        
                    }
        }
    },bindto: '#chart2'
});
}
</script>
<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('YYYY-MM-DD HH:mm:ss') + ' - ' + end.format('YYYY-MM-DD HH:mm:ss'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        timePicker:true,
        timePicker24Hour:true,
        timePickerSeconds:true,
        showDropdowns:true,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
           'Last 365 jour': [moment().subtract(1, 'year')
           .startOf('days')],
           'Last year': [moment().subtract(1, 'year')
           .startOf('year'), moment().subtract(1, 'year').endOf('year')]

        }
    }, cb);

    cb(start, end);

});
</script>
<!-- You need an element with an id called "chart" to set a place where your chart will render-->
<!-- <div id="chart"></div> -->
<div class="content">
<div class="row">
    <div class='col-md-4'>
    <h3 class="text-primary">Récapitulatif des ventes Par periode</h2>
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
        <button type="button" class="btn btn-primary mb-2" onclick="changeFunc()">Valider</button>
</div>
</div>
</div>
 </div>
  <div class="row">
    <div class="col-sm-4">
    <h3>Totale des ventes En Dinar <span class="text-primary"><div id="a">0.000</div></span></h3>
    </div>
    <div class="col-sm-4">
    <h3>Totale des Achats En Dinar <span class="text-primary"><div id="b">0.000</div></span></h3>
    </div>
    <div class="col-sm-4">
    <h3>Gain En Dinar  <span class="text-primary"><div id="c">0.000</div></span></h3>
    </div>
  </div>
  <div class="row" id="chart2">   
  <div class="margin-0-auto text-center"><img src="../adminlte/img/analytics.png" style="margin-bottom: 15px  height: auto; 
    width: auto; 
    max-width: 50px; 
    max-height: 50px;" alt="">
                <div translate="NO_DATA_TO_DISPLAY" class="text-center">Aucune donnée à afficher</div>
              </div>           
    </div>
    
  <br>
  <h3 class="text-primary">Récapitulatif des ventes Par Exercice</h2>
    <div class="row" id="chart">              
    </div>
  </div>


<script>
var chart = c3.generate({
    data: {
        url: '/api/tolalex',
        mimeType: 'json',
            keys: {
               x: 'LT_Exerc', // it's possible to specify 'x' when category axis
                value: ['TotaleVente','TotaleAchat']
            },type:'bar'
               },
    axis: {
        y: {
        label: { // ADD
          text: 'Totale des Ventes ',
          position: 'outer-middle'
        },
      
        tick: {
          format: d3.format(".3f") // ADD
        }
      },
            x: {
           
               type: 'category',
               
            }
        },bindto: '#chart'
});
</script>
<script>


</script>
</html>
@endsection
