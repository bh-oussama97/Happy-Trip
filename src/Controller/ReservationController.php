<?php

namespace App\Controller;

use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Reservation;
use Symfony\Component\Routing\Annotation\Route;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\HttpFoundation\Request;





class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(): Response
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }


    /**
     * @param ReservationRepository $repository
     * @return Response
     * @Route("/AfficheReservation",name="AfficheReservation")
     */
    public function Affiche( ReservationRepository $repository){
        //$repo=$this->getDoctrine()->getRepository(Hotel::class) ;
        $Reservation=$repository->findAll();
        return $this->render(' reservation/Affiche.html.twig' , [' Reservation'=>$Reservation]);
    }

    /**
     * @Route ("/Supp/{id}",name="d")
     */
    function Delete($id, ReservationRepository $repository){
        $Reservation=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($Reservation);
        $em->flush();
        return $this->redirectToRoute('AfficheReservation');

    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/Reservation/Add")
     */
    function Add(Request $request){
        $Reservation=new Reservation();
        $form=$this->createForm(ReservationType::class,$Reservation);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
        //
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($Reservation);
            $em->flush();
            return $this->redirectToRoute('AfficheReservation');
        }
        return $this->render('reservation/Add.html.twig',[
            'form'=>$form->createView()
        ]) ;
    }

    /**
     * @Route ("reservation/Modifier/{id}",name="modifier")
     */
    function Modifier(ReservationRepository $repository,$id,Request $request)
    {
        $Reservation=$repository->find($id);
        $form=$this->createForm(ReservationType::class,$Reservation);
        $form->add('Modifier',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('AfficheReservation');
        }
        return $this->render('reservation/Modifier.html.twig',
            ['f'=>$form->createView()]);

    }

}
