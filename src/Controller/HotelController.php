<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Form\HotelType;
use App\Repository\HotelRepository;
//use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 *
 * @Route ("/hotel")
 */
class HotelController extends AbstractController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var Environment
     * HotelController constructor.
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="hotel")
     * @return Response
     */
    public function index(): Response
    {
        return new Response($this->twig->render('hotel/index.html.twig', [
            'controller_name' => 'HotelController',
        ]));
    }

    /**
     * @param HotelRepository $repository
     * @return Response
     * @Route("/AfficheHotel",name="AfficheHotel")
     */
    public function Affiche(HotelRepository $repository){
        //$repo=$this->getDoctrine()->getRepository(Hotel::class) ;
        $Hotel=$repository->findAll();
        return $this->render('hotel/Affiche.html.twig' , ['Hotel'=>$Hotel]);
    }

    /**
     * @Route ("/Supp/{id}",name="d")
     * @param Request $request
     * @param Hotel $hotel
     */
    public function Delete(Request $request, Hotel $hotel)
    {
        $form = $this->createDeleteForm($hotel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hotel);
            $em->flush();
        }

        return $this->redirectToRoute('AfficheHotel');
    }
    //function Delete($id,HotelRepository $repository){
     //   $Hotel=$repository->find($id);
     //   $em=$this->getDoctrine()->getManager();
     //   $em->remove($Hotel);
     //   $em->flush();
     //   return $this->redirectToRoute('AfficheHotel');

   // }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/Add",name="ADD")
     */
    function Add(Request $request){
        $Hotel=new Hotel();
        $form=$this->createForm(HotelType::class,$Hotel);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
       //
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($Hotel);
            $em->flush();
            return $this->redirectToRoute('AfficheHotel');
        }
        return $this->render('hotel/Add.html.twig',[
            'form'=>$form->createView()
        ]) ;
    }

    /**
     * @Route ("Modifier/{id}",name="modifier")
     */
    function Modifier(HotelRepository $repository,$id,Request $request)
    {
        $Hotel=$repository->find($id);
        $form=$this->createForm(HotelType::class,$Hotel);
        $form->add('Modifier',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('AfficheHotel');
        }
        return $this->render('hotel/Modifier.html.twig',
        ['f'=>$form->createView()]);

    }

}


