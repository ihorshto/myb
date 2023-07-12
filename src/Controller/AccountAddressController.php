<?php

namespace App\Controller;

use App\Services\Cart;
use App\Entity\Address;
use App\Form\AddressType;
use App\Repository\AddressRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountAddressController extends AbstractController
{
    #[Route('/compte/adresses', name: 'account_address')]
    public function index(AddressRepository $repo): Response
    {



        // dd($adresses);

        return $this->render('account/address.html.twig', [
            'adresses' => $repo->findByUser($this->getUser())
        ]);
    }

    #[Route('/compte/ajouter-une-adresse', name: 'add_address')]
    public function add(Cart $cart,Request $request, EntityManagerInterface $manager): Response
    {



        $address = new Address();

        $form = $this->createForm(AddressType::class, $address);


        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $address->setUser($this->getUser());
            $manager->persist($address);
            $manager->flush();

            $this->addFlash(
                'success',
                'L\'adresse ' . $address->getName() . ' a été correctement enregistré'
            );

            if ($cart->getProduct()){

                Return $this->redirectToRoute('order');
            }
            

            return $this->redirectToRoute('account_address');
        }

        return $this->render('account/add_address.html.twig', [
            'form' => $form->createView()
        ]);
    }



    #[Route('/compte/modifier-une-adresse{id}', name: 'edit_address')]
    public function edit(Request $request, EntityManagerInterface $manager, Address $adresse): Response
    {


        if ($adresse->getUser() != $this->getUser()) {

            $this->addFlash(
                'danger',
                'L\'adresse ne vous appartient pas'
            );

            return $this->redirectToRoute('account_address');
        }

        $form = $this->createForm(AddressType::class, $adresse);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($adresse);
            $manager->flush();

            $this->addFlash(
                'success',
                'L\'adresse ' . $adresse->getName() . ' a bien été modifiée'
            );

            return $this->redirectToRoute('account_address');
        }

        return $this->render('account/add_address.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('/compte/supprimer-une-adresse{id}', name: 'delete_address')]
    public function delete(EntityManagerInterface $manager, Address $adresse): Response
    {

        if ($adresse->getUser() == $this->getUser()) {
            $manager->remove($adresse);
            $manager->flush();

            $this->addFlash(
                'success',
                'L\'adresse ' . $adresse->getName() . ' a été correctement supprimée'
            );
        } else {

            $this->addFlash(
                'danger',
                'L\'adresse ne vous appartient pas'
            );
        }



        return $this->redirectToRoute('account_address');
    }
}
