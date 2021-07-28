<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\LignePanier;
use App\Entity\Panier;
use App\Entity\Produit;
class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(SessionInterface $session): Response
    {
        $panier = $session->get("panier", new Panier);
        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
        ]);
    }
    /**
     * @Route("/panier/add", name="panier_add")
     */
    public function add(SessionInterface $session, Request $request): Response
    {
        // get id produit
        $idProduit = $request->get("id");
        $repo = $this->getDoctrine()->getRepository(Produit::class);
        $produit= $repo->find($idProduit);
/*         var_dump($idProduit); */
             // get quantité
        $quantite = $request->get("quantite");
        // créer lign Panier
        $lignePanier = new LignePanier();
        $lignePanier->setProduit($produit);
        $lignePanier->setQuantite($quantite);
             // get panier
        $panier = $session->get("panier", new Panier());
        $panier->addLignePanier($lignePanier);
        $session->set("panier", $panier);
      return $this->redirectToRoute("panier"); 

    }
    /**
     * @Route("/panier/edit", name="panier_edit", methods="POST")]
     */
    public function edit(SessionInterface $session, Request $request): Response
    {
        $id = $request->get("id");
        $quantite = $request->get("quantite");
        $panier = $session->get("panier", new Panier());
        $err = "";
        if($quantite == 0){
            try {
                $panier->removeLignePanier($id);
            } catch (\Throwable $th) {
                $err = $th->getMessage();
            }
            
        }
        else{
            $panier->updateLignePanier($id, $quantite);
        }
        $session->set("panier", $panier);
        return $this->json(["res"=>"OK", "err"=>$err]);
    }

}
