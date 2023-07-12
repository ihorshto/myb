<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;

class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'home')]
    public function home(RequestStack $requestStack,ProductRepository $repo): Response
    {


//dd($repo->myFindProduct(10,50));


        /*
        $panier = $requestStack->getSession()->get('cart', []);
        dump($panier);

        // 3 produits d'id = 301
        $panier[301] = 3;
        dump($panier);

        $requestStack->getSession()->set('cart', $panier);

        $requestStack->getSession()->get('cart');

        $panier[401] = 1;
        $requestStack->getSession()->set('cart', $panier);

        dd($requestStack->getSession()->get('cart'));
*/


        return $this->render('home/index.html.twig', []);
    }
}
