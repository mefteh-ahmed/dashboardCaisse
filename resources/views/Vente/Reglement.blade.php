@extends('back.layout')


@section('main')
<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('YYYY-MM-DD HH:mm:ss') + ' - ' + end.format('YYYY-MM-DD HH:mm:ss'));
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
<script type="text/javascript" >
function changeFunc() {
  var from= $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
  var to=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');

  $.getJSON('/api/reglementTotal/'+from+'/'+to, function(data)
  {
    var da=data[0].MontantTotale;
    document.getElementById("a").innerHTML =da;
  })
}
</script>
<!-- You need an element with an id called "chart" to set a place where your chart will render-->
<!-- <div id="chart"></div> -->
<div class="content">
<div class="row">
<div class='col-md-4'>
<h3 class="text-primary">Total des Réglements par :</h3>
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

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner" >
              <h3><div id="a"><?php echo number_format($Totalespece[0]->Totalespece,3,'.', ' '); ?></div></h3>

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
              <h3><?php echo number_format($Totalcheque[0]->Totalcheque,3,'.', ' '); ?></h3>

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
              <h3><?php echo number_format($Totalcarte[0]->Totalcarte,3,'.', ' '); ?></h3>

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
