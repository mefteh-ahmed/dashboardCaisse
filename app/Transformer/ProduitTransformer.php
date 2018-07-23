<?php

namespace App\Transformer;

use App\Models\Produit;
use League\Fractal;

class ProduitTransformer extends Fractal\TransformerAbstract {

    /**
     * 
     * @param Produit $produit
     * @return type
     */
    public function transform(Produit $produit) {
        return [
            'code'    =>$produit->PRO_code,
            'prix' => $produit->PRO_prix,
            'desgination' => $produit->PRO_desg
        ];
    }
    
}
