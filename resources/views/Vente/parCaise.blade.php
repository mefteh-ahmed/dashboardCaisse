@extends('back.layout')

@section('main')

<div class="content">
 
    <div class="row">
                    <div class="col-md-8">
                    <h3 class="text-primary">Nombre de passage par Caisse </h2> 

                                <div id="chart7">
                               </div>
                     
                    </div>
                    <div class="col-md-4">
                    <h3 class="text-primary">Nombre Totale de passage </h3>

                         <h2> <?php echo $TotaleTik[0]->NBTick; ?></h2>
                         <h3 class="text-primary">Panier Moyen en dinar</h3>

                         <h2> <?php echo number_format(($vente[0]->TotaleVente/$TotaleTik[0]->NBTick),3,'.', ' '); ?> </h2>
                    </div>
                </div>       
  </div>


</script>
<script>
var chart = c3.generate({
    data: {
        url: 'http://127.0.0.1:8000/api/NBTickParCaisse',
        mimeType: 'json',
            keys: {
               x: 'CAI_DesCaisse', // it's possible to specify 'x' when category axis
                value: ['NBTick'],
            }
    },
    axis: {
                        x: {
           
               type: 'category',
               
            }
        },bindto: '#chart7'
});
</script>

@endsection
