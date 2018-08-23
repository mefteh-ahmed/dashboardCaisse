<script>
var chart = c3.generate({
    data: {
        url: '/prodParYear',
        mimeType: 'json',
            keys: {
               x: 'year', // it's possible to specify 'x' when category axis
                value: ['TotaleAchat']
            },type:'bar'
    },
    axis: {
        y: {
        label: { // ADD
          text: 'Totale des achats ',
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
$.getJSON('/prodParYear', function(jsonData) {
var measdata = jsonData.map(o => {
          return  [o['year'], o['TotaleAchat']] ;
        });
var chart = c3.generate({
                        data: {
                            columns: measdata,  
                            type: 'pie'

                        },
                        donut: {
                            title:  "Top 10 des articles les plus achetés "
                        },bindto: '#chart0'

                    })
});
</script>
<script>
function changeFunc2() {

  var from= $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
  var to=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
  $.getJSON('/TotaleAchat/'+from+'/'+to, function(data1)
  {
    var totale=data1[0].TotaleAchat;
    document.getElementById("a").innerHTML =numeral(totale).format('0,0.000');
  })
  chart = c3.generate({
    data: {
        x: 'year',
      
        url: '/TotaleAchatDate/'+from+'/'+to,
        mimeType: 'json',
        keys: {
            x: 'year',
            value: ['TotaleAchat']
        }
    },
    axis: {
        x: {
            type: "timeseries",
            tick: { 
                        format: '%Y-%m-%d',
                        
                    }
        }
    },bindto: '#chart7'
});

}
</script>
<script>
function changeFunc() {

  var from= $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
  var to=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
  if(document.getElementById('sel1').value==1){
var chart = c3.generate({
    data: {
        url: '/Top10artAchat/'+document.getElementById('sel2').value+'/'+from+'/'+to,
        mimeType: 'json',
            keys: {
               x: 'ART_Designation', // it's possible to specify 'x' when category axis
                value: ['TotaleAchat']
            },type:'bar'
    },
    axis: {
        y: {
        label: { // ADD
          text: 'Totale des achats ',
          position: 'outer-middle'
        },
      
        tick: {
          format: d3.format(".3f") // ADD
        }
      },
            x: {
           
               type: 'category',
               
            }
        },bindto: '#chart1'
});

$.getJSON('/Top10artAchat/'+document.getElementById('sel2').value+'/'+from+'/'+to, function(jsonData) {
var measdata = jsonData.map(o => {
          return  [o['ART_Designation'], o['TotaleAchat']] ;
        });
var chart = c3.generate({
                        data: {
                            columns: measdata,  
                            type: 'pie'

                        },
                        donut: {
                            title:  "Top 10 des articles les plus achetés "
                        },bindto: '#chart2'

                    })
});
}
else if (document.getElementById('sel1').value==2) {
    var chart = c3.generate({
    data: {
        url: '/Top10Famil/'+document.getElementById('sel2').value+'/'+from+'/'+to,
        mimeType: 'json',
            keys: {
               x: 'FAM_Lib', // it's possible to specify 'x' when category axis
                value: ['TotaleAchat']
            },type:'bar'
    },
    axis: {
        y: {
        label: { // ADD
          text: 'Totale des achats ',
          position: 'outer-middle'
        },
      
        tick: {
          format: d3.format(".3f") // ADD
        }
      },
            x: {
           
               type: 'category',
               
            }
        },bindto: '#chart1'
});
$.getJSON('/Top10Famil/'+document.getElementById('sel2').value+'/'+from+'/'+to, function(jsonData) {
var measdata = jsonData.map(o => {
          return  [o['FAM_Lib'], o['TotaleAchat']] ;
        });
var chart = c3.generate({
                        data: {
                            columns: measdata,  
                            type: 'pie'

                        },
                        donut: {
                            title:  "Top 10 des articles les plus achetés "
                        },bindto: '#chart2'

                    })
});

}else if (document.getElementById('sel1').value==3){
    var chart = c3.generate({
    data: {
        url: '/Top10Marque/'+document.getElementById('sel2').value+'/'+from+'/'+to,
        mimeType: 'json',
            keys: {
               x: 'MAR_Designation', // it's possible to specify 'x' when category axis
                value: ['TotaleAchat']
            },type:'bar'
    },
    axis: {
        y: {
        label: { // ADD
          text: 'Totale des achats ',
          position: 'outer-middle'
        },
      
        tick: {
          format: d3.format(".3f") // ADD
        }
      },
            x: {
           
               type: 'category',
               
            }
        },bindto: '#chart1'
});
$.getJSON('/Top10Marque/'+document.getElementById('sel2').value+'/'+from+'/'+to, function(jsonData) {
var measdata = jsonData.map(o => {
          return  [o['MAR_Designation'], o['TotaleAchat']] ;
        });
var chart = c3.generate({
                        data: {
                            columns: measdata,  
                            type: 'pie'

                        },
                        donut: {
                            title:  "Top 10 des marques les plus achetés "
                        },bindto: '#chart2'

                    })
});
}
}
</script>



<script>
function changeFunc3() {

var from= $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
var to=$("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
var chart = c3.generate({
    data: {
        url: '/Top10Fournisseur/'+document.getElementById('sel2').value+'/'+from+'/'+to,
        mimeType: 'json',
            keys: {
               x: 'FRS_Nomf', // it's possible to specify 'x' when category axis
                value: ['TotaleAchat']
            },type:'bar'
    },
    axis: {
        y: {
        label: { // ADD
          text: 'Totale des achats ',
          position: 'outer-middle'
        },
      
        tick: {
          format: d3.format(".3f") // ADD
        }
      },
            x: {
           
               type: 'category',
            tick: {
                rotate: 75,
                multiline: false
            },
            height: 130
               
            }
        },bindto: '#chart6'
});
}
</script>

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