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
<div class="col-md-8">
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
                          <th></th>
                              <th>
                              Nom
                                </th>
                                <th>
                                TotaleVente
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
function changeFunc() {
  var from= $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
  var to=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
  var chart = c3.generate({
    data: {
        url: '/CaParVendeur/'+from+'/'+to,
        mimeType: 'json',
            keys: {
              
               x: 'nom', // it's possible to specify 'x' when category axis
                value: ['TotaleVente'],
            }
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
		url: '/CaAnnulerParVendeur/'+from+'/'+to,
		async: true,
		contentType: "application/json; charset=utf-8",
		success: function (msg) {
        
         $("#example2").DataTable().rows().remove().draw();
			msg.forEach(function (m/*, index */){
                
				$("#example2").DataTable().row.add([
   '', m.nom, m.TotaleVente
]).draw();
			})
		}
	});

}
</script>




@endsection
