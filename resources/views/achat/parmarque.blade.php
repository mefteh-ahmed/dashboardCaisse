@extends('back.layout')

@section('main')


<div class="content">
<h4 class="text-primary">Les 10 premiers marques les plus achetés</h4>
  <div class="row">
  
  <div class="row">
      <div class="col-md-6">
          <div id="chart5" class="se-pre-con">
              <div class="margin-0-auto text-center">
                 <img src="../images/icon_report_flat.png" style="margin-bottom: 15px" alt="">
                 <div translate="NO_DATA_TO_DISPLAY" class="text-center">Aucune donnée à afficher</div>
              </div>
           </div>
       </div>
       <div class="col-md-6">
          <div id="chart7" class="se-pre-con">
           </div>
         </div>
   </div>
</div>
  
  </div>

@include('achat.chartAchat.chart')

</body>

</html>
@endsection
