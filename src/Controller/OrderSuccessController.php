<?php

namespace App\Controller;

use App\Entity\Order;
use App\Services\Cart;
use Stripe\StripeClient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderSuccessController extends AbstractController
{
    #[Route('/commande/merci/{stripeSessionId}', name: 'order_success')]
    public function index(Order $order, $stripeSessionId,EntityManagerInterface $manager, Cart $cart): Response
    {

        if ($this->getUser()!= $order->getUser()) return $this->redirectToRoute('home');

        $stripe = new StripeClient(

            'sk_test_51JT9IbHRDvPKVo02qmLidvZVnnXwApuVBpso6wtGbJn8VMldmaHcFeG8n3Pd6CiokwielNqWJhLO2j3OcQhQnsrw00NdcKT7mY'
            );

            $session = $stripe->checkout->sessions->retrieve($stripeSessionId);

            if ($session->payment_status!="paid") return $this->redirectToRoute('order_cancel',['stripeSessionId'=>$stripeSessionId]);

            // on passe le statut de la commande à 1
            $order->setStatut(1);

            $manager->flush();

            $cart->deleteCart();

            $messageEmail='message html';
            mail($this->getUser()->getEmail(),'Validation de votre commande',$messageEmail);

        return $this->render('order_success/index.html.twig', [
            'order' => $order,
        ]);
    }
}
