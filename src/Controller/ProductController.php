<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\SearchFilters;
use App\Form\SearchFiltersType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route(path: '/nos-produits', name: 'products')]
    public function index(ProductRepository $repo, Request $request): Response
    {
        //$products = $repo->find(121);

        // on peut remplacer le X par n'importe nom de propriétés
        //$products = $repo->findByX();

        //$products = $repo->findBySubtitle('inventore eum qui');

        //$products = $repo->findBy(['category'=>[87,88]],['price'=>'desc']);
        //$products=$repo->findBy(['id'=>121]);
        //$products=$repo->findById(121);

        //    $products=$repo->findAll();

        // presence de produits ou pas
        $error=null;

        $search = new SearchFilters();

        $form = $this->createForm(SearchFiltersType::class, $search);


        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {


            if (count($search->getCategories()) > 0) {
                foreach ($search->getCategories() as $categorie) {
                    $catId[] = $categorie->getId();
                }

                $products = $repo->findBy(['category' => $catId], ['price' => 'desc']);
                 
                // si il n'y a pas de produits dans les categories sélectionnées
                if(!$products){
                    $error = "Il n'y a pas de produits disponibles dans les catégories sélectionnées ";

                }


            } else {


                $products = $repo->findAll();
            }
        }
        else{

            $products = $repo->findAll();

        }



        return $this->render('product/index.html.twig', [
            'products' => $products,
            'form' => $form->createView(),
            'error' =>$error
        ]);
    }

    #[Route(path: '/produit/{slug}', name: 'product')]
    public function show(Product $product)
    {

        //$product = $repo->findBySlug($slug);





        return $this->render('product/show.html.twig', [
            'product' => $product,
            
        ]);
    }
}
