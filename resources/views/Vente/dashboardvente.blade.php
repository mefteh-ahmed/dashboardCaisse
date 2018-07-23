@extends('back.layout')

@section('main')
<!-- You need an element with an id called "chart" to set a place where your chart will render-->
<!-- <div id="chart"></div> -->
<div class="content">
  <h3 class="text-primary">Récapitulatif des ventes</h2>
  <div class="row">
    
    <div class="col-sm">
    <h3>Totale des ventes En Dinar <span class="text-primary"><?php echo number_format($vente[0]->TotaleVente,3,'.', ' '); ?></span></h3>
    </div>
    <div class="col-sm">
    <h3>Totale des Achats En Dinar <span class="text-primary"><?php echo number_format($achat[0]->TotaleAchat,3,'.', ' '); ?></span></h3>
    </div>
    <div class="col-sm">
    <h3>Gain En Dinar  <span class="text-primary"><?php echo number_format(($vente[0]->TotaleVente - $achat[0]->TotaleAchat),3,'.', ' '); ?></span></h3>
    </div>
  </div>
  <br>
  <h3 class="text-primary">Récapitulatif des ventes Par Exercice</h2>
    <div class="row" id="chart">              
    </div>
    <h3 class="text-primary">Récapitulatif des ventes Par Année</h2>
    <div class="row" id="chart2">              
    </div>
  </div>


<script>
var chart = c3.generate({
    data: {
        url: 'http://127.0.0.1:8000/api/tolalex',
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

chart = c3.generate({
    data: {
        x: 'year',
      
        url: 'http://127.0.0.1:8000/api/TotalVenteDate',
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
</script>
</html>
@endsection
