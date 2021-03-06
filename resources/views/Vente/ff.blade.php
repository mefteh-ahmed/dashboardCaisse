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
<div class="row" id="chart" style="display: none;">
<div   id="chart6" style="display: none;" >   
</div> 
<br>
</br>
<div class="row">
  <select id ="select2" name ="select2" class="selectpicker" data-live-search="true"> 
<option>Select Commercial</option>
</select>
<select id ="select1" name ="select1" class="selectpicker" data-live-search="true"> 
<option>Detaill Par</option>
<option>Par Article</option>
<option>Par Client</option>

</select>
<button type="button" class="btn btn-primary mb-2" onclick="changeFunc2()">Valider</button>

  </div>
</div> 
<div class="row">

<div   id="load" style="display: none;" >
   
    <div class="margin-0-auto text-center"><img src="../adminlte/img/analytics.png" style="margin-bottom: 15px  height: auto; 
    width: auto; 
    max-width: 50px; 
    max-height: 50px;" alt="">
    
    
                <div translate="NO_DATA_TO_DISPLAY" class="text-center">Aucune donnée à afficher</div>
                </div>
              </div>                 
           </div>   
              <div class="row">  
   
  
                 
                         
                <div style="display: none;" id="z">
                <h3 class="text-primary">Total des Ticket Annuler En Dinar </h3>

<h2> <div id="a">0</div></h2>
                    <div class="col-sm-12">
                         <table id="example2" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                              <th></th>
                            <th>Nom Du Commercial
                                </th>
                                <th>Chiffre D'affaire Annuler
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                         
                           
                        </table>
                      
                        </div>
                    </div>
                </div>  
                
  </div>
<br>

 
  <div class="row"  style="display: none;" id="r">
  <h2>Detaill par article</h2>

                    <div class="col-sm-12">
  <table id="article" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                              <th></th>
                            <th>Article
                                </th>
                                <th>Totale Vente En Dinar
                                </th>
                                <th>
                                Coût d'achat en dinar
                                </th>
                                <th>Marge de Gain En Dinar 
                                </th>
                                <th>% Marge
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                         
                           
                        </table>
                        </div>
                        </div>
                     
                        <br>
                      
                        <div class="row" style="display: none;" id="m">
                        <h2>Detaill par Client</h2>

                    <div class="col-sm-12">
  <table id="client" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                              <th></th>
                            <th>Client
                                </th>
                                </th>
                                <th>Totale Vente En Dinar
                                </th>
                                <th>Coût d'achat en dinar
                                </th>
                                <th>Marge de Gain En Dinar 
                                </th>
                                <th>% Marge
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                         
                           
                        </table>
                        </div>
                        </div>
                    
                        </div>
  </html>

<script type="text/javascript" >
function changeFunc2() {
  
    var from= $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
  var to=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
    let dropdown = $('#select2');
    let dropdown1 = $('#select1');

if($('select[name="select1"]').val()=="Par Article"){
     $('#r').attr('style','display: block');
    var table = $('#article').DataTable( {
        destroy: true,
                lengthChange: false,
        dom: 'Bfrtip', select: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   0
        } ],
        order: [ 1, 'asc' ]
    } );
    

    $('#article').show();
    com=   $('select[name="select2"]').val();
const url = '/CaParCommercialByArticle/'+from+'/'+to+'/'+com;
// Populate dropdown with list of provinces
$.getJSON(url, function (data) {
    $("#article").DataTable().rows().remove().draw();
$.each(data, function (key, entry) {
    marge =numeral(( entry.TotaleVente- entry.TotaleAchat)).format('0,0.000');
    pour =numeral((marge/entry.TotaleVente)*100).format('0,0');
    pour+="%";
	$("#article").DataTable().row.add([
   '', entry.ART_Designation,numeral( entry.TotaleVente).format('0,0.000'), numeral(entry.TotaleAchat).format('0,0.000'),marge,pour
]).draw();

})



});
}else
if($('select[name="select1"]').val()=="Par Client"){
    $('#m').attr('style','display: block');
    var table = $('#client').DataTable( {
        destroy: true,
                lengthChange: false,
        dom: 'Bfrtip', select: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   0
        } ],
        order: [ 1, 'asc' ]
    } );
    

    $('#article').show();

    $("#article").DataTable().rows().remove().draw();

 com=   $('select[name="select2"]').val();
const url = '/CaParCommercialByClient/'+from+'/'+to+'/'+com;

// Populate dropdown with list of provinces
$.getJSON(url, function (data) {
    $("#client").DataTable().rows().remove().draw();
$.each(data, function (key, entry) {
    marge =numeral(( entry.TotaleVente- entry.TotaleAchat)).format('0,0.000');
    pour =numeral((marge/entry.TotaleVente)*100).format('0,0');
    pour+="%";
    
	$("#client").DataTable().row.add([
   '', entry.CLI_NomPren,numeral( entry.TotaleVente).format('0,0.000'), numeral(entry.TotaleAchat).format('0,0.000'),marge,pour
]).draw();

})



});
}
}
function changeFunc() {
    $('#load').attr('style','display: block');
    $('#chart').attr('style','display: none');
    $('#chart6').attr('style','display: none');
  setTimeout(function() {
    // rest of code here

      $('#load').attr('style','display: none');

    $('#z').attr('style','display: block');
    $('#chart').attr('style','display: block');
    $('#chart6').attr('style','display: block');

    var table = $('#example2').DataTable( {
        destroy: true,
                lengthChange: false,
        dom: 'Bfrtip', select: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   0
        } ],
        order: [ 1, 'asc' ]
    } );
    

    $('#example2').show();
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
///////////////////////totale des ticket Annuler//////////////////////////////
$.getJSON('/TotalVenteAnnulerfilter/'+from+'/'+to, function(data)
  {
    var TotaleVenteAnnuler=data[0].TotaleVenteAnnuler;
    document.getElementById("a").innerHTML =numeral(TotaleVenteAnnuler).format('0,0.000');
 

  })
/////////////////////////////////////////////remplir Commercial Tiket Annuler////////////////////////
  $.ajax({
		type: "GET", //rest Type
		dataType: 'json', //mispelled
		url: '/CaAnnulerParCommercial/'+from+'/'+to,
		async: true,
		contentType: "application/json; charset=utf-8",
		success: function (msg) {
        
         $("#example2").DataTable().rows().remove().draw();
			msg.forEach(function (m/*, index */){
                
				$("#example2").DataTable().row.add([
   '', m.TIK_DESIG_COMMERCIAL, m.TotaleVente
]).draw();
			})
		}
	});
/////////////////////////Remplir Commercial list//////////////////////////
$('#select2').selectpicker('refresh');
let dropdown = $('#select2');

dropdown.empty();

dropdown.append('<option selected="true" disabled>select Commercial</option>');
dropdown.prop('selectedIndex', 0);

const url = '/CaParCommercial/'+from+'/'+to;

// Populate dropdown with list of provinces
$.getJSON(url, function (data) {

$.each(data, function (key, entry) {

dropdown.append($('<option></option>').attr('value', entry.TIK_DESIG_COMMERCIAL).text(entry.TIK_DESIG_COMMERCIAL));
})
$('#select2').selectpicker('refresh');


});


}, 2000);
}
</script>
<script type="text/javascript">
$(function() {
   
  $("#laod").hide();
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
