<?php


namespace App\Controller;


use App\Entity\User;
use App\Entity\TemporalUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class VerifyController extends AbstractController {

  /**
   * @Route("/verify/{id}", name="app_verify")
   */
   public function verify(Request $request, $id) {
     $em = $this->getDoctrine()->getManager();
     $tempuser= $em->getRepository(TemporalUser::class)->find($id);
     //$user = $this->getUser();
     $user = $this->getUser();

     if ($request->isMethod('POST')) {
       $verifyCode = $request->get('securityCode');
       if ($user->getUsername() == $tempuser->getUsername()) {
         if($verifyCode == $tempuser->getCodeGenerated()) {
            $user->setCodeGenerated($tempuser->getCodeGenerated());
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('home');
        }
       }
     }
     return $this->render('verification/verify.html.twig');
   }
}
