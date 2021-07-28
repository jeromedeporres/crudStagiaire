<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Panier
{
    private $lignePanier;

    public function __construct(){
        $this->lignePanier = new ArrayCollection();
    }
    public function getLignePanier(): ?Collection
    {
        return $this->lignePanier;
    }

    public function setLignePanier(Collection $lignePanier): self
    {
        $this->lignePanier = $lignePanier;

        return $this;
    }

    public function addLignePanier(LignePanier $lignePanier): self
    {
        //vérifier si produit deja présent dans panier
        foreach ($this->lignePanier as $ligne) {
            if($ligne->getProduit()->getId() == $lignePanier->getProduit()->getId())
            {
                //si, oui
                    // on modifier lignepanier en ajoutant la nouvelle quantité 
                //si, non
                    // on l'ajoute dans panier
                $qte = $lignePanier->getQuantite()+$ligne->getQuantite();
                $lignePanier->setQuantite($qte); 
                break;
            }
        }
        $this->lignePanier[] = $lignePanier;
        return $this;
    }

    public function updateLignePanier($idProduit, $quantite): self
    {
        foreach ($this->lignePanier as $ligne) {
            if($ligne->getProduit()->getId() == $idProduit)
            {
                $ligne->setQuantite($quantite); 
                return $this;
            }
        }
        return $this;
    }

    public function removeLignePanier(int $idProduit): self
    {
        $this->lignePanier = $this->lignePanier -> filter(function($ligne) use ($idProduit){
            return $ligne->getProduit()->getId() != $idProduit;
        });

        return $this;
    }
}
