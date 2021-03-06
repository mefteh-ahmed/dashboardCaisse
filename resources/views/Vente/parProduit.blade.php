@extends('back.layout')

@section('main')


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

<script type="text/javascript" >
function changeFunc() {
  var from= $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
  var to=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');

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
    <div class='col-md-4'>
      <div class="form-group">
      <label for="sel1">entre:</label>

<div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
    <i class="fa fa-calendar"></i>&nbsp;
    <span></span> <i class="fa fa-caret-down"></i>
</div>
      </div>
      </div>
<div class="col-md-2">
    <div class="form-group mx-sm-3 mb-2">
        <label for="sel1">Valider:</label>
        <button type="button" class="btn btn-primary mb-2" onclick="changeFunc()">Valider</button>

</div>
</div>
</div>

  

<br>

                    <div class="row">
                        <div class="col-md-8">
                        
                                    <div id="chart" class="se-pre-con">
                                        
                                    <div class="margin-0-auto text-center"><img src="../adminlte/img/analytics.png" style="margin-bottom: 15px  height: auto; 
    width: auto; 
    max-width: 50px; 
    max-height: 50px;" alt="">
                <div translate="NO_DATA_TO_DISPLAY" class="text-center">Aucune donnée à afficher</div>
              </div>   
                                   </div>
                         
                        </div>
                        <div class="col-md-4">
                     
                                    <div id="chart1" class="se-pre-con">
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
  <select name="select1"id="select1" class="selectpicker" data-show-subtext="true" data-live-search="true">
  <option>Select Famille</option>

  @foreach($ALLfamille as $fam)
<option value='{{ $fam->FAM_Code }}'>{{ $fam->FAM_Lib }}</option>
  @endforeach
      
</select>
<select id ="select2" name ="select2" class="selectpicker" data-live-search="true"> 
<option>Select Articles</option>
</select>
<div id="chart5"></div>
<script type="text/javascript">
    
       
    
    $(document).ready(function() {

$('select[name="select1"]').on('change', function(){

    var countryId = $(this).val();
    if(countryId) {
let dropdown = $('#select2');

dropdown.empty();

dropdown.append('<option selected="true" disabled>select Article</option>');
dropdown.prop('selectedIndex', 0);

const url = '/ALLarticle/'+countryId;

// Populate dropdown with list of provinces
$.getJSON(url, function (data) {

  $.each(data, function (key, entry) {

    dropdown.append($('<option></option>').attr('value', entry.ART_Code).text(entry.ART_Designation));
  })
  $('#select2').selectpicker('refresh');


});
    }

});

});
    
    </script>
<script type="text/javascript">
$(document).ready(function() {
$('select[name="select2"]').on('change', function(){
    var from= $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
  var to=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
  var art = $(this).val();
      chart = c3.generate({
    data: {
        x: 'year',
      
        url: '/articlevente/'+art+'/'+from+'/'+to,
        mimeType: 'json',
        type: 'bar',
        keys: {
            x: 'year',
            value: ['TotaleVente','qte']
        }
        ,axes: {
            qte: 'y2'
        }
    },
    axis: {
        x: {
            type: "timeseries",
            tick: { 
                        format: '%Y-%m-%d',
        
                    }
        },y: {
            label: 'Totale Vente En Dinar',
            tick: {
          format: d3.format(".3f") // ADD
        }
        },
        y2: {
            show: true,
            label: 'qte Totale'
            
        }
    },bindto: '#chart5'
});
});
});
    </script>

@endsection
