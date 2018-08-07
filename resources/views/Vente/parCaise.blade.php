@extends('back.layout')

@section('main')

<script type="text/javascript" >
function changeFunc() {
  
  var from= $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
  var to=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
  
  $.getJSON('/api/TotalVentefilter/'+from+'/'+to, function(data1)
  {
    var totale=data1[0].TotaleVente;
    $.getJSON('/api/TotaleTick/'+from+'/'+to, function(data)
  {
    var totaletik=data[0].NBTick;
    document.getElementById("a").innerHTML =totaletik;
 var panier =totale/totaletik;
 document.getElementById("b").innerHTML =numeral(panier).format('0,0.000');

  })
  })
var chart = c3.generate({
    data: {
        url: '/api/NBTickParCaisse/'+from+'/'+to,
        mimeType: 'json',
            keys: {
               x: 'CAI_DesCaisse', // it's possible to specify 'x' when category axis
                value: ['NBTick','TotaleVente'],
            },
            axes: {
                TotaleVente: 'y2'
        }
    },
    axis: {
                        x: {
           
               type: 'category',
               
            },y: {
            label: 'Nombre de ticket'
        },
        y2: {
            show: true,
            label: 'Vente Totale'
        }
        },bindto: '#chart7'
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
<div class="content">
 <div class="row">
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
                    <div class="col-md-8">
                    <h3 class="text-primary">Nombre de passage par Caisse </h2> 

                                <div id="chart7">
                                <div class="margin-0-auto text-center"><img src="../adminlte/img/analytics.png" style="margin-bottom: 15px  height: auto; 
    width: auto; 
    max-width: 50px; 
    max-height: 50px;" alt="">
                <div translate="NO_DATA_TO_DISPLAY" class="text-center">Aucune donnée à afficher</div>
              </div>   
                               </div>
                     
                    </div>

                    <div class="col-md-4">
                    <h3 class="text-primary">Nombre Totale de passage </h3>

                         <h2> <div id="a">0</div></h2>
                         <h3 class="text-primary">Panier Moyen en dinar</h3>

                         <h2> <div id="b">0.000</div> </h2>
                    </div>
                </div>  
                     
  </div>


</script>


@endsection
