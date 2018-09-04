@extends('back.layout')

@section('main')
<script type="text/javascript">
$(function() {

var start = moment().startOf('day'); // This will return a copy of the Date that the moment uses

var end =  moment().endOf('day'); // This will return a copy of the Date that the moment uses


    function cb(start, end) {
        $('#reportrange span').html(start.format('YYYY-MM-DD HH:mm:ss') + ' - ' + end.format('YYYY-MM-DD  HH:mm:ss'));
            }

    $('#reportrange').daterangepicker({

        startDate: start,
        endDate: end,
        timePicker:true,
        timePicker24Hour:true,
        timePickerSeconds:true,
        showDropdowns:true,
        ranges: {
           "Aujourd'hui": [moment().startOf('day'), moment().endOf('day')],
           'Hier': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
           'Les 7 derniers jours': [moment().subtract(6, 'days'), moment()],
           'Les 30 derniers jours': [moment().subtract(29, 'days'), moment()],
           'Ce mois-ci': [moment().startOf('month'), moment().endOf('month')],
           'Le mois dernier': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
           '365 derniers jours': [moment().subtract(1, 'year').startOf('days')],
           "L'année dernière": [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]

        }
    }, cb);

    cb(start, end);
  

  
});
</script>
<script type="text/javascript" >
function changeFunc() {
    $('#r').attr('style','display: none');

    $('#m').attr('style','display: blok');

  var from= $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
  var to=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
  /////////////////////////////////////////getalldepence//////////////////////
  $.getJSON('/Alldepence/'+from+'/'+to, function(jsonData) {
var measdata = jsonData.map(o => {
          return  [o['DEP_Lib'], o['depence']] ;
        });
var chart = c3.generate({
                        data: {
                            columns: measdata,  
                            type: 'pie'

                        },
                        donut: {
                            title:  "depence"
                        },bindto: '#chart1'

                    })
});
var chart = c3.generate({
    data: {
        url: '/Alldepence/'+from+'/'+to,
        mimeType: 'json',
            keys: {
               x: 'DEP_Lib', // it's possible to specify 'x' when category axis
                value: ['depence'],
            },type:'bar'
    },
    axis: {
        y: {
        label: { // ADD
            text: 'Totale des Depence En Dinar',
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
///////////////////////////get depence by user////////////////////////////
$.getJSON('/depencebyUser/'+from+'/'+to, function(jsonData) {
var measdata = jsonData.map(o => {
          return  [o['Nom'], o['depence']] ;
        });
var chart = c3.generate({
                        data: {
                            columns: measdata,  
                            type: 'pie'

                        },
                        donut: {
                            title:  "depence"
                        },bindto: '#chart3'

                    })
});
var chart = c3.generate({
    data: {
        url: '/depencebyUser/'+from+'/'+to,
        mimeType: 'json',
            keys: {
               x: 'Nom', // it's possible to specify 'x' when category axis
                value: ['depence'],
            },type:'bar'
    },
    axis: {
        y: {
        label: { // ADD
            text: 'Totale des Depence En Dinar',
        },
      
        tick: {
          format: d3.format(".3f") // ADD
        }
      },
            x: {
           
               type: 'category',
               
            }
        },bindto: '#chart2'
});
///////////////////////////////////////get detail by user///////////////////////
$('#select2').selectpicker('refresh');
let dropdown = $('#select2');

dropdown.empty();

dropdown.append('<option selected="true" disabled>choisir utilisateur</option>');
dropdown.prop('selectedIndex', 0);

const url = '/depencebyUser/'+from+'/'+to;

// Populate dropdown with list of provinces
$.getJSON(url, function (data) {

$.each(data, function (key, entry) {

dropdown.append($('<option></option>').attr('value', entry.Nom).text(entry.Nom));
})
$('#select2').selectpicker('refresh');


});

//////////////////////////////////////////////////////remplir table detail///////////////

}
</script>
<script>
 $(document).ready(function() {
    $('#user').DataTable( {
      aLengthMenu: [
        [0,25, 50, 100, 200, -1],
        [0,25, 50, 100, 200, "All"]
    ],
    dom: 'lBfrtip', select: true,
        buttons: [
            'copy', 'csv', 'excel','pdf', 'print'
            // ,
            // {
            //     extend: 'pdf',
            //     messageTop: 'Liste des Deponce'
            // }
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
        order: [ 1, 'asc' ],
     
    iDisplayLength: -1,
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 2 ).footer() ).html(
                pageTotal +' ('+ total +' total)'
            );
        }
    } );
} );
 </script>

 <script>
$(document).ready(function() {
    $('#usr').dataTable({
    	"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // computing column Total of the complete result 
       
	    var tueTotal = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
				
       
				
	    
				
	 
			
				
            // Update footer by showing the total with the reference of the column index 
	    $( api.column( 0 ).footer() ).html('Total');
            $( api.column( 2 ).footer() ).html(tueTotal);
        
        },
        "processing": true,
        "serverSide": true,
        "ajax": "server.php"
    } );
} );
</script>
<script type="text/javascript" >
function changeFunc2() {
    $('#r').attr('style','display: blok');

    var from= $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
  var to=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
com=   $('select[name="select2"]').val();
const url1 = '/depencebyUserDetail/'+from+'/'+to+'/'+com;

// Populate dropdown with list of provinces
$.getJSON(url1, function (data) {
    $("#user").DataTable().rows().remove().draw();
$.each(data, function (key, entry) {
  
    
	$("#user").DataTable().row.add([
   '', entry.Nom,numeral( entry.depence).format('0,0.000'),entry.DEP_Lib,''
]).draw();

})



});
}
</script>
<div class="content">
 <div class="row">
 <div class="col-md-4">
                    <h3 class="text-primary">choisir la période </h2> 
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
 <div class="row"  style="display: none;" id="m">

 <h3>Total des depences Par Type de Dépence</h3>
 <div class="row">
                        <div class="col-md-6">
                        
                                    <div id="chart" class="se-pre-con">
                                        
                                    <div class="margin-0-auto text-center"><img src="../adminlte/img/analytics.png" style="margin-bottom: 15px  height: auto; 
    width: auto; 
    max-width: 50px; 
    max-height: 50px;" alt="">
                <div translate="NO_DATA_TO_DISPLAY" class="text-center">Aucune donnée à afficher</div>
              </div>   
                                   </div>
                         
                        </div>
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
                        </br>
                        <h3>Total des depences Par utilisateur</h3>

                        <div class="row">
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
                        <div class="col-md-6">
                     
                                    <div id="chart3" class="se-pre-con">
                                    <div class="margin-0-auto text-center"><img src="../adminlte/img/analytics.png" style="margin-bottom: 15px  height: auto; 
    width: auto; 
    max-width: 50px; 
    max-height: 50px;" alt="">
                <div translate="NO_DATA_TO_DISPLAY" class="text-center">Aucune donnée à afficher</div>
              </div>   
                                   </div>
                       
                        </div> 
                        </div>    
                        <div class="col-md-8 col-md-offset-2">  
                        <h2>Détail</h2>
                        <select id ="select2" name ="select2" class="selectpicker" data-live-search="true"> 
<option>choisir utilisateur</option>


</select>
<button type="button" class="btn btn-primary mb-2" onclick="changeFunc2()">Valider</button>
</div>
<div class="row"  style="display: none;" id="r">

                    <div class="col-md-10 col-md-offset-1">
  <h2>Detaill par utilisateur</h2>

  <table id="user" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                              <th></th>
                            <th>utilisateur
                                </th>
                                <th>depence en dinar
                                </th>
                               
                                <th>Type de depence
                                </th>
                            </tr>
                            </thead>
                            <tfoot>
            <tr>
       
                <th></th>
            </tr>
        </tfoot>
                            <tbody>
                            
                            </tbody>
                         
                           
                        </table>
                        </div>
                        </div>
                    </div>


</script>


@endsection
