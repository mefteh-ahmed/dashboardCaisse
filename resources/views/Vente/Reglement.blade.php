@extends('back.layout')

@section('main')
<!-- You need an element with an id called "chart" to set a place where your chart will render-->
<!-- <div id="chart"></div> -->
<div class="content">

  
<h3 class="text-primary">Totale des Réglements par :</h3>
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo number_format($Totalespece[0]->Totalespece,3,'.', ' '); ?></h3>

              <p>éspece</p>
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
              <h3><?php echo number_format($Totalcheque[0]->Totalcheque,3,'.', ' '); ?></h3>

              <p>cheque</p>
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
              <h3><?php echo number_format($Totalcarte[0]->Totalcarte,3,'.', ' '); ?></h3>

              <p>Carte Boncaire</p>
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
              <h3><?php echo number_format($Totaltrait[0]->Totaltrait,3,'.', ' '); ?></h3>

              <p>Traite</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>


<div class="row">
                    <div class="col-md-6">
                    
                                <div id="chart">
                               </div>
                     
                    </div>
                    <div class="col-md-6">
                 
                    <div class="row">
    
    <h4>Totale des ventes En Dinar <span class="text-primary"><?php echo number_format($vente[0]->TotaleVente,3,'.', ' '); ?></span></h4>
</div>
   <div class="row">
    <h4>Totale des Réglement En Dinar<span class="text-primary">
<?php echo number_format($TotalRecu[0]->MontantTotale,3,'.', ' '); ?></span></h4> 
   
  </div>
  <div class="row">
    <h4>Credit En Dinar<span class="text-danger">
    <?php echo number_format(($vente[0]->TotaleVente-$TotalRecu[0]->MontantTotale),3,'.', ' '); ?>  </h4> 
  </div>
                   
                    </div>
                </div>

  
  </div>
<script type="text/javascript">
  var chart = c3.generate({
    data: {
        // iris data from R
        columns: [
            ['Espéce', <?php echo  ($Totalespece[0]->Totalespece); ?>],
            ['Chéque', <?php echo ($Totalcheque[0]->Totalcheque); ?>],
            ['Carte Banquaire',<?php echo  ($Totalcarte[0]->Totalcarte); ?>],
            ['Traite', <?php echo ($Totaltrait[0]->Totaltrait); ?>],

          ],
        type : 'pie',
        onclick: function (d, i) { console.log("onclick", d, i); },
        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    },bindto:'#chart'
});

  </script>

</html>
@endsection
