<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Produit;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i < 10; $i++) { 
            $Produit = new Produit();
            $Produit->setNom("produit".$i);
            $Produit->setPrix($i*3);
            $manager->persist($Produit);
        }
        

        $manager->flush();
    }
}
