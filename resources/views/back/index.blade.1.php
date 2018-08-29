
@extends('back.layout')

@section('main')
<script type="text/javascript" >
function changeFunc() {
  var from = moment().format('2017-07-17 00:00:00');
    var to = moment().format('2017-07-17 23:59:59');

 if(document.getElementById('sel1').value==1){
    var chart = c3.generate({
    data: {
        url: '/Top10art/'+document.getElementById('sel2').value+'/'
        +from+'/'+to,
        mimeType: 'json',
            keys: {
               x: 'ART_Designation', // it's possible to specify 'x' when category axis
                value: ['TotaleVente'],
            },type:'bar'
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
           
               type: 'category',
               
            }
        },bindto: '#chart'
});

$.getJSON('/Top10art/'+document.getElementById('sel2').value+'/'+from+'/'+to, function(jsonData) {
var measdata = jsonData.map(o => {
          return  [o['ART_Designation'], o['TotaleVente']] ;
        });
var chart = c3.generate({
                        data: {
                            columns: measdata,  
                            type: 'pie'

                        },
                        donut: {
                            title:  "Top 10 des articles les plus vendus "
                        },bindto: '#chart1'

                    })
});
 }else if (document.getElementById('sel1').value==2)
 {
    var chart = c3.generate({
    data: {
        url: '/Top10fam/'+document.getElementById('sel2').value
        +'/'
        +from+'/'+to,
        mimeType: 'json',
            keys: {
               x: 'FAM_Lib', // it's possible to specify 'x' when category axis
                value: ['TotaleVente'],
            },type:'bar'
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
           
               type: 'category',
               
            }
        },bindto: '#chart'
});
$.getJSON('/Top10fam/'+document.getElementById('sel2').value
+'/'+from+'/'+to, function(jsonData) {
var measdata = jsonData.map(o => {
          return  [o['FAM_Lib'], o['TotaleVente']] ;
        });
var chart = c3.generate({
                        data: {
                            columns: measdata,  
                            type: 'pie'

                        },
                        donut: {
                            title:  "Top 10 des familles les plus vendus "
                        },bindto: '#chart1'

                    })
});

 }else if (document.getElementById('sel1').value==3)
 {
    var chart = c3.generate({
    data: {
        url: '/Top10mar/'+document.getElementById('sel2').value
        +'/'+from+'/'+to,
        mimeType: 'json',
            keys: {
               x: 'MAR_Designation', // it's possible to specify 'x' when category axis
                value: ['TotaleVente'],
            },type:'bar'
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
           
               type: 'category',
               
            }
        },bindto: '#chart'
});

$.getJSON('/Top10mar/'+document.getElementById('sel2').value
+'/'+from+'/'+to, function(jsonData) {
var measdata = jsonData.map(o => {
          return  [o['MAR_Designation'], o['TotaleVente']] ;
        });
var chart = c3.generate({
                        data: {
                            columns: measdata,  
                            type: 'pie'

                        },
                        donut: {
                            title:  "Top 10 des marques les plus vendus "
                        },bindto: '#chart1'

                    })
});

 }
}

</script>
<script type="text/javascript" >
$(function() {
  var from = moment().format('2017-07-17 00:00:00');
    var to = moment().format('2017-07-17 23:59:59');
  $.getJSON('/reglement/'+from+'/'+to, function(data)
  {
    $.getJSON('/TotalVentefilter/'+from+'/'+to, function(data1)
  {
    var totale=data1[0].TotaleVente;
    document.getElementById("f").innerHTML =numeral(totale).format('0,0.000');
    var credit=data1[0].TotaleVente-data[0].MontantTotale;
    document.getElementById("g").innerHTML =numeral(credit).format('0,0.000');
  })
    var totale=data[0].MontantTotale;
    var espece=data[0].Totalespece;
    var cheque=data[0].Totalcheque;
    var carte=data[0].Totalcarte;
    var ticketResto=data[0].TotaltTicketResto;
    
    document.getElementById("a").innerHTML =numeral(totale).format('0,0.000');
    document.getElementById("b").innerHTML =numeral(espece).format('0,0.000');
    document.getElementById("c").innerHTML =numeral(cheque).format('0,0.000');
    document.getElementById("d").innerHTML =numeral(carte).format('0,0.000');
    document.getElementById("e").innerHTML =numeral(ticketResto).format('0,0.000');


})
  });
 

</script>
<script type="text/javascript" >
$(function() {
  var from = moment().format('2017-07-17 00:00:00');
    var to = moment().format('2017-07-17 23:59:59');
 

  $.getJSON('/TotalVentefilter/'+from+'/'+to, function(data1)
  {
    var totale=data1[0].TotaleVente;
    document.getElementById("h").innerHTML =numeral(totale).format('0,0.000');
    $.getJSON('/TotalAchatfilter/'+from+'/'+to, function(data)
  {
    var TotaleAchat=data[0].TotaleAchat;
    document.getElementById("j").innerHTML =numeral(TotaleAchat).format('0,0.000');
 var gain =totale-TotaleAchat;
 document.getElementById("k").innerHTML =numeral(gain).format('0,0.000');

  })
  })

});
</script>

<!-- You need an element with an id called "chart" to set a place where your chart will render-->
<!-- <div id="chart"></div> -->
<div class="content">

<div class='col-sm-6'>
<div class="row">

    <div class='col-md-8'>
    <h3 class="text-primary">Récapitulatif des ventes D'aujourd'hui</h2>
    </div>

     
 </div>
  <div class="row">
    <div class="col-sm-4">
    <h3>Totale des ventes En Dinar <span class="text-primary"><div id="h">0.000</div></span></h3>
    </div>
    <div class="col-sm-4">
    <h3>Coût d'achat en dinar <span class="text-primary"><div id="j">0.000</div></span></h3>
    </div>
    <div class="col-sm-4">
    <h3>Gain En Dinar  <span class="text-primary"><div id="k">0.000</div></span></h3>
    </div>
  </div>
  <div class="row">
<div class="col-md-6">
<div class="form-group">

  <label for="sel1">Select catégorie:</label>
  <select class="form-control" id="sel1">
  <option value="0">Sélectionner catégorie</option>
    <option value="1">les articles les plus vendus</option>
    <option value="2">les familles les plus vendus</option>
    <option value="3">les marques les plus vendus</option>
  </select>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
  <label for="sel1">TOP:</label>
  <select class="form-control" id="sel2">
    <option value="5">5</option>
    <option value="10">10</option>
    <option value="15">15</option>
  </select>
</div>
</div>
<div class="col-md-2">
    <div class="form-group mx-sm-3 mb-2">
        <label for="sel1">Valider:</label>
        <button type="button" class="btn btn-primary mb-2" onclick="changeFunc()">Valider</button>

</div>
</div>

</div>
                    <div class="row">
                        <div class="col-md-12">
                        
                                    <div id="chart" class="se-pre-con">
                                        
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

  
    
<div class='col-sm-6'>
<div class='col-md-10'>
    <h3 class="text-primary">Récapitulatif des Reglement D'aujourd'hui</h2>
    </div>
    <div class="row">

<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-aqua">
    <div class="inner" >
      <h3><div id="b">0.000</div></h3>
      <p>espèce</p>
    </div>
    <div class="icon">
      <i class="ion ion-bag"></i>
    </div>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-yellow">
    <div class="inner">
      <h3><div id="c">0.000</div></h3>

      <p>chéque</p>
    </div>
    <div class="icon">
      <i class="ion ion-stats-bars"></i>
    </div>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-green">
    <div class="inner">
      <h3><div id="d">0.000</div></h3>

      <p>carte bancaire</p>
    </div>
    <div class="icon">
      <i class="ion ion-person-add"></i>
    </div>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-red">
    <div class="inner">
      <h3><div id="e">0.000</div></h3>

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

<h4>Totale des ventes En Dinar <span class="text-primary"><div id="f">0,000</div></span></h4>
</div>
<div class="row">
<h4>Totale des Réglement En Dinar<span class="text-primary">   <div id="a">
0,000</div></span></h4> 

</div>
<div class="row">
<h4>Credit En Dinar<span class="text-danger"><div id="g">
0,000  </div></h4> 
</div>
</div>
 



</html>
@endsection
