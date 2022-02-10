<?php

namespace App\Controller;


use App\Entity\NomClasseTable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ServeurController extends AbstractController
{
    /**
     * @Route("/serveur", name="serveur")
     */
    public function index(): Response
    {   
        
        return $this->render('serveur/index.html.twig', [
            'controller_name' => 'ServeurController',
        ]);
    }


    /**
     * @Route("/valide", name="valide")
     */
    public function valide(Request $request): Response
    {
        $nom=$request->request->get ("admin");
        $password=$request->request->get ("password");
        
        
          if($password == "password" && $nom == "admin"){
            $contenu = "valide";
           }
           else{
            $contenu = "non valide";
           }
        
        
        return $this->render('serveur/valide.html.twig', [
            'admin' =>$nom,
            'contenu' => $contenu,
        ]);
    }

    /**
        * @Route("/login", name="login")
        */
        public function login(Request $request,EntityManagerInterface $manager): Response
    {   
        $reponse = $manager -> getRepository(NomClasseTable :: class) -> findOneBy([ 'nomChamp' => 'admin']);
        $reponse -> getChamp();
        
        return $this->render('serveur/login.html.twig', [
            

        ]);
    }
 

    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function utilisateur(Request $request,EntityManagerInterface $manager): Response
    {
        $newlogin=$request->request->get("newlogin");
        $newpassword=$request->request->get("newpassword1");
        $utilisateur= new Utilisateur();
        $utilisateur->setlogin($newlogin);
        $utilisateur->setpassword($newpassword);
        $manager -> persist($utilisateur);
        $manager ->flush();
        return $this->redirectToRoute ('show');

}
   /**
     * @Route("/show", name="show")
     */
    public function show(): Response
    {
        
        return $this->render('serveur/show.html.twig', [
            'controller_name' => 'ServeurController',
        ]);

        
    } 

  

}