<script>
var chart = c3.generate({
    data: {
        url: '/api/prodParYear',
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
$.getJSON('/api/prodParYear', function(jsonData) {
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
var chart = c3.generate({
    data: {
        url: '/api/Top10artAchat',
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
</script>
<script>
$.getJSON('/api/Top10artAchat', function(jsonData) {
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
</script>

<script>
var chart = c3.generate({
    data: {
        url: '/api/Top10Famil',
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
        },bindto: '#chart3'
});
</script>
<script>
$.getJSON('/api/Top10Famil', function(jsonData) {
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
                        },bindto: '#chart4'

                    })
});
</script>
<script>
var chart = c3.generate({
    data: {
        url: '/api/Top10Marque',
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
        },bindto: '#chart5'
});
</script>
<script>
var chart = c3.generate({
    data: {
        url: '/api/Top10Fournisseur',
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
               
            }
        },bindto: '#chart6'
});
</script>
<script>
$.getJSON('/api/Top10Marque', function(jsonData) {
var measdata = jsonData.map(o => {
          return  [o['MAR_Designation'], o['TotaleAchat']] ;
        });
var chart = c3.generate({
                        data: {
                            columns: measdata,  
                            type: 'pie'

                        },
                        donut: {
                            title:  "Top 10 des Marque "
                        },bindto: '#chart7'

                    })
});
</script>