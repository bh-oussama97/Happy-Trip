<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Form\HotelType;
use App\Repository\HotelRepository;
//use http\Env\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 *
 * @Route ("/hotels")
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
     * @param HotelRepository $repository
     * @return Response
     * @Route("/all",name="afficheHotel")
     */
    public function Affiche(Request $request,PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();

        $hotel= $em->getRepository(Hotel::class)->findAll();

        $hotel = $paginator->paginate(
            $hotel,
            $request->query->getInt('page',1),
            3
        );
        return $this->render('hotel/Affiche.html.twig' , ['hotels'=>$hotel]);
    }

    /**
     * @param HotelRepository $repository
     * @return Response
     * @Route("/details/{id}",name="details_hotels")
     */

        public function details($id,HotelRepository $repository)
        {
            $details_hotels = $repository->find($id);

            return $this->render('hotel/Details.html.twig',['details'=>$details_hotels]);

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


