@extends('back.layout')

@section('main')

<!-- You need an element with an id called "chart" to set a place where your chart will render-->
<!-- <div id="chart"></div> -->
<div class="content">
<div class="row">
<div class='col-md-4'>
<h3 class="text-primary">Total des Vente par Vendeur :</h3>
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
      <div class="col-md-4">
      <div class="form-group">
      <label for="sel1">Valider:</label>
    <div class="form-group mx-sm-3 mb-2">
        <button type="button" class="btn btn-primary mb-2" onclick="changeFunc()">Valider</button>
</div>
</div>
</div>
<br>
<div class="row">
<div class="col-md-6">
    <div class="row" id="chart6">     
    <div class="margin-0-auto text-center"><img src="../adminlte/img/analytics.png" style="margin-bottom: 15px  height: auto; 
    width: auto; 
    max-width: 50px; 
    max-height: 50px;" alt="">
    
    
                <div translate="NO_DATA_TO_DISPLAY" class="text-center">Aucune donnée à afficher</div>
                </div>
              </div>                 
        </div>         
      
   
   <div class="col-md-4">
                    <h3 class="text-primary">Total des Ticket Annuler En Dinar </h3>

                         <h2> <div id="a">0</div></h2>
                         <table id="example2" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                              
                            <th>Nom Du Commercial
                                </th>
                                <th>Chiffre D'affaire Annuler
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                             <tr>
                             </tr>
                            </tbody>
                         
                           
                        </table>
                    </div>
                </div>  
  </div>

  </html>
<script type="text/javascript" >
function changeFunc() {
  var from= $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
  var to=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
  var chart = c3.generate({
    data: {
        url: '/CaParCommercial/'+from+'/'+to,
        mimeType: 'json',
            keys: {
              
               x: 'TIK_DESIG_COMMERCIAL', // it's possible to specify 'x' when category axis
                value: ['TotaleVente'],
            }
    }, line: {
    connectNull: false,
},
    axis: {
        y: {
        label: { // ADD
            text: 'Totale des Ventes En Dinar',
        },
      
        tick: {
          format: d3.format(".3f") // ADD
        }
      },
     
            x: {
           
               type: 'category'
            }
        },bindto: '#chart6'
});
$.getJSON('/TotalVenteAnnulerfilter/'+from+'/'+to, function(data)
  {
    var TotaleVenteAnnuler=data[0].TotaleVenteAnnuler;
    document.getElementById("a").innerHTML =numeral(TotaleVenteAnnuler).format('0,0.000');
 

  })
  $.ajax({
		type: "GET", //rest Type
		dataType: 'json', //mispelled
		url: '/CaAnnulerParCommercial/'+from+'/'+to,
		async: true,
		contentType: "application/json; charset=utf-8",
		success: function (msg) {
            $("tbody").empty();
			msg.forEach(function (m/*, index */){
				var ligne = $("<tr></tr>");
				ligne.append($("<td>" + m.TIK_DESIG_COMMERCIAL + "</td>"));
				ligne.append($("<td>" + m.TotaleVente + "</td>"));
				
				$("tbody").append(ligne);
                
			})

		}
	});
}
</script>
<script type="text/javascript">
$(function() {

    var start = moment();
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('YYYY-MM-DD 00:00:00') + ' - ' + end.format('YYYY-MM-DD 23:59:59'));
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


@endsection