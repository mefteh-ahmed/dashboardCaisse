@extends('back.layout')

@section('main')
<script >
    $(document).ready(function() {
  $(function() {
    $('#datetimepicker6').datetimepicker();
    $('#datetimepicker7').datetimepicker({
      useCurrent: false //Important! See issue #1075
    });
    $("#datetimepicker6").on("dp.change", function(e) {
      $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepicker7").on("dp.change", function(e) {
      $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
    });
  });
});
</script>


<script type="text/javascript">

function changeFunc() {
   
 if(document.getElementById('sel1').value==1){
    var chart = c3.generate({
    data: {
        url: 'http://127.0.0.1:8000/api/Top10art/'+document.getElementById('sel2').value+'/'
        +document.getElementById('sel3').value,
        mimeType: 'json',
            keys: {
               x: 'ART_Designation', // it's possible to specify 'x' when category axis
                value: ['TotaleVente'],
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

$.getJSON('http://127.0.0.1:8000/api/Top10art/'+document.getElementById('sel2').value+'/'+document.getElementById('sel3').value, function(jsonData) {
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
        url: 'http://127.0.0.1:8000/api/Top10fam/'+document.getElementById('sel2').value
        +'/'
        +document.getElementById('sel3').value,
        mimeType: 'json',
            keys: {
               x: 'FAM_Lib', // it's possible to specify 'x' when category axis
                value: ['TotaleVente'],
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
$.getJSON('http://127.0.0.1:8000/api/Top10fam/'+document.getElementById('sel2').value
+'/'+document.getElementById('sel3').value, function(jsonData) {
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
        url: 'http://127.0.0.1:8000/api/Top10mar/'+document.getElementById('sel2').value
        +'/'+document.getElementById('sel3').value,
        mimeType: 'json',
            keys: {
               x: 'MAR_Designation', // it's possible to specify 'x' when category axis
                value: ['TotaleVente'],
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

$.getJSON('http://127.0.0.1:8000/api/Top10mar/'+document.getElementById('sel2').value
+'/'+document.getElementById('sel3').value, function(jsonData) {
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
</head>
<body>
<div class="content">

<div class="row">
<div class="col-md-4">
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
<div class="col-md-2">
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
    <div class="form-group">
        <label for="sel1">Par Année:</label>
        <select class="form-control" id="sel3">
 
         <?php 
  $year=date('Y');
 echo "<option>$year</option>";
   for($i = 2000 ; $i < date('Y')+1; $i++){
      echo "<option value=$i>$i</option>";
   }
?>
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

  <div class="container">
    <div class='col-md-5'>
      <div class="form-group">
        <div class='input-group date' id='datetimepicker6'>
          <input type='text' class="form-control" />
          <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
    </div>
    <div class='col-md-5'>
      <div class="form-group">
        <div class='input-group date' id='datetimepicker7'>
          <input type='text' class="form-control" />
          <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
    </div>
  </div>

<br>

                    <div class="row">
                        <div class="col-md-8">
                        
                                    <div id="chart" class="se-pre-con">
                                        
                                    <div class="margin-0-auto text-center"><img src="../images/icon_report_flat.png" style="margin-bottom: 15px" alt="">
                <div translate="NO_DATA_TO_DISPLAY" class="text-center">Aucune donnée à afficher</div>
              </div>
                                   </div>
                         
                        </div>
                        <div class="col-md-4">
                     
                                    <div id="chart1" class="se-pre-con">
                                   </div>
                       
                        </div>
                    </div>
                   
  </div> 




@endsection
