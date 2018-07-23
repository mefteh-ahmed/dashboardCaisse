@extends('back.layout')

@section('main')

<!-- You need an element with an id called "chart" to set a place where your chart will render-->
<!-- <div id="chart"></div> -->
<div class="content">
  

   <h3 class="text-primary">Chiffre d'affaire par vendeur </h2>
    <div class="row" id="chart6">              
    </div>    
         
  </div>



<script>
var chart = c3.generate({
    data: {
        url: 'http://127.0.0.1:8000/api/CaParVendeur',
        mimeType: 'json',
            keys: {
               x: 'Nom', // it's possible to specify 'x' when category axis
                value: ['TotaleVente'],
            }
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
        },bindto: '#chart6'
});
</script>

</html>
@endsection
