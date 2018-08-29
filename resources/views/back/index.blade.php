@extends('back.layout')

@section('main')
<script type="text/javascript" >
function changeFunc() {
  
  var from= $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
  var to=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
  $.getJSON('/TotalVentefilter/'+from+'/'+to, function(data1)
  {
    var totale=data1[0].TotaleVente;
    document.getElementById("a").innerHTML =numeral(totale).format('0,0.000');
    $.getJSON('/TotalAchatfilter/'+from+'/'+to, function(data)
  {
    var TotaleAchat=data[0].TotaleAchat;
    document.getElementById("h").innerHTML =numeral(TotaleAchat).format('0,0.000');
 var gain =totale-TotaleAchat;
 document.getElementById("i").innerHTML =numeral(gain).format('0,0.000');

  })
  })
  $.getJSON('/reglement/'+from+'/'+to, function(data)
  {
    $.getJSON('/TotalVentefilter/'+from+'/'+to, function(data1)
  {
   
    var credit=data1[0].TotaleVente-data[0].MontantTotale;
    document.getElementById("g").innerHTML =numeral(credit).format('0,0.000');
  })
  $.getJSON('/TotalVenteAnnulerfilter/'+from+'/'+to, function(data)
  {
    var TotaleVenteAnnuler=data[0].TotaleVenteAnnuler;
    document.getElementById("m").innerHTML =numeral(TotaleVenteAnnuler).format('0,0.000');
 

  })
  var totale=data[0].MontantTotale;
    var espece=data[0].Totalespece;
    var cheque=data[0].Totalcheque;
    var carte=data[0].Totalcarte;
    var ticketResto=data[0].TotaltTicketResto;

    document.getElementById("k").innerHTML =numeral(totale).format('0,0.000');
    document.getElementById("b").innerHTML =numeral(espece).format('0,0.000');
    document.getElementById("c").innerHTML =numeral(cheque).format('0,0.000');
    document.getElementById("d").innerHTML =numeral(carte).format('0,0.000');
    document.getElementById("e").innerHTML =numeral(ticketResto).format('0,0.000');

})
$.getJSON('/TotalVentefilter/'+from+'/'+to, function(data1)
  {
    var totale=data1[0].TotaleVente;
    $.getJSON('/TotaleTick/'+from+'/'+to, function(data)
  {
    var totaletik=data[0].NBTick;
    document.getElementById("o").innerHTML =totaletik;
 var panier =totale/totaletik;
 document.getElementById("p").innerHTML =numeral(panier).format('0,0.000');

  })
  })
}
$(function() {
  
  var from=moment().format('YYYY-MM-DD 00:00:00');;
  var to=moment().format('YYYY-MM-DD 23:59:59');;
  $.getJSON('/TotalVentefilter/'+from+'/'+to, function(data1)
  {
    var totale=data1[0].TotaleVente;
    document.getElementById("a").innerHTML =numeral(totale).format('0,0.000');
    $.getJSON('/TotalAchatfilter/'+from+'/'+to, function(data)
  {
    var TotaleAchat=data[0].TotaleAchat;
    document.getElementById("h").innerHTML =numeral(TotaleAchat).format('0,0.000');
 var gain =totale-TotaleAchat;
 document.getElementById("i").innerHTML =numeral(gain).format('0,0.000');

  })
  $.getJSON('/reglement/'+from+'/'+to, function(data)
  {
    $.getJSON('/TotalVentefilter/'+from+'/'+to, function(data1)
  {
   
    var credit=data1[0].TotaleVente-data[0].MontantTotale;
    document.getElementById("g").innerHTML =numeral(credit).format('0,0.000');
  })
  $.getJSON('/TotalVenteAnnulerfilter/'+from+'/'+to, function(data)
  {
    var TotaleVenteAnnuler=data[0].TotaleVenteAnnuler;
    document.getElementById("m").innerHTML =numeral(TotaleVenteAnnuler).format('0,0.000');
 

  })
  var totale=data[0].MontantTotale;
    var espece=data[0].Totalespece;
    var cheque=data[0].Totalcheque;
    var carte=data[0].Totalcarte;
    var ticketResto=data[0].TotaltTicketResto;

    document.getElementById("k").innerHTML =numeral(totale).format('0,0.000');
    document.getElementById("b").innerHTML =numeral(espece).format('0,0.000');
    document.getElementById("c").innerHTML =numeral(cheque).format('0,0.000');
    document.getElementById("d").innerHTML =numeral(carte).format('0,0.000');
    document.getElementById("e").innerHTML =numeral(ticketResto).format('0,0.000');

})
  })
  $.getJSON('/TotalVentefilter/'+from+'/'+to, function(data1)
  {
    var totale=data1[0].TotaleVente;
    $.getJSON('/TotaleTick/'+from+'/'+to, function(data)
  {
    var totaletik=data[0].NBTick;
    document.getElementById("o").innerHTML =totaletik;
 var panier =totale/totaletik;
 document.getElementById("p").innerHTML =numeral(panier).format('0,0.000');

  })
  })

});
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
<!-- You need an element with an id called "chart" to set a place where your chart will render-->
<!-- <div id="chart"></div> -->
<div class="content">
<div class="row">
    <div class='col-md-4'>
    <h3 class="text-primary">Récapitulatif des ventes Par periode En Dinar</h2>
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
    <div class="col-sm-3">
    <h3>Totale des ventes <span class="text-primary"><div id="a">0.000</div></span></h3>
    </div>
    <div class="col-sm-3">
    <h3>Coût d'achat <span class="text-primary"><div id="h">0.000</div></span></h3>
    </div>
    <div class="col-sm-3">
    <h3>Gain  <span class="text-primary"><div id="i">0.000</div></span></h3>
    </div>
    <div class="col-sm-3">
    <h3>Totale des Tiket Annuler <span class="text-primary"><div id="m">0.000</div></span></h3>
    </div>
  </div>

<div class="row">

<div class="col-sm-3">
  <!-- small box -->
  <div class="small-box bg-aqua">
    <div class="inner" >
      <h3><div id="b" style=" font-size: 25px;">0.000</div></h3>
      <p>espèce</p>
    </div>
    <div class="icon">
      <i class="ion ion-bag"></i>
    </div>
  </div>
</div>
<!-- ./col -->
<div class="col-sm-3">
  <!-- small box -->
  <div class="small-box bg-yellow">
    <div class="inner">
      <h3><div id="c" style=" font-size: 25px;">0.000</div></h3>

      <p>chéque</p>
    </div>
    <div class="icon">
      <i class="ion ion-stats-bars"></i>
    </div>
  </div>
</div>
<!-- ./col -->
<div class="col-sm-3">
  <!-- small box -->
  <div class="small-box bg-green">
    <div class="inner">
      <h3><div id="d" style=" font-size: 25px;">0.000</div></h3>

      <p>carte bancaire</p>
    </div>
    <div class="icon">
      <i class="ion ion-person-add"></i>
    </div>
  </div>
</div>
<!-- ./col -->
<div class="col-sm-3">
  <!-- small box -->
  <div class="small-box bg-red">
    <div class="inner">
      <h3><div id="e" style=" font-size: 25px;">0.000</div></h3>

      <p>Ticket Resto</p>
    </div>
    <div class="icon">
      <i class="ion ion-pie-graph"></i>
    </div>
  </div>
</div>
<!-- ./col -->
</div>
<div class="row">
    
    <div class="col-sm-3">
    <h3>Totale des Réglement <span class="text-primary"><div id="k">0.000</div></span></h3>
    </div>
    <div class="col-sm-3">
    <h3>Credit <span class="text-primary"><div id="g">0.000</div></span></h3>
    </div>
    <div class="col-sm-3">
    <h3>Nombre Total de passage <span class="text-primary"><div id="o">0.000</div></span></h3>
    </div>
    <div class="col-sm-3">
    <h3>Panier Moyen <span class="text-primary"><div id="p">0.000</div></span></h3>
    </div>
  </div>
                

</html>
@endsection
