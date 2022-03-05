<?php

namespace App\Controller;

use App\Entity\Utilisateur;
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
        public function valide(Request $request,EntityManagerInterface $manager): Response
    {   
        $nom=$request->request->get ("admin");
        $password=$request->request->get ("password");
        $reponse = $manager -> getRepository( Utilisateur :: class) -> findOneBy([ login => 'admin']);
        
        
        if($response == NULL){
            $contenu = "non valide";
        }
        else
        ($response -> getpassword() == "password" ){
            $contenu = "valide" ;
           }
        
        return $this-> render('serveur/valide.html.twig', [
            'contenu' => $contenu 

        ]);
    }
 

  /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request,EntityManagerInterface $manager): Response
    {
        $newlogin=$request->request->get("admin");
        $newpassword=$request->request->get("password");
        $monutilisateur= new Utilisateur();
        $monutilisateur->setlogin($newlogin);
        $monutilisateur->setpassword($newpassword);
        $manager -> persist($monutilisateur);
        $manager ->flush(); 
        
        return $this->redirectToRoute ('serveur');
        
    }
 
     
    /**
     * @Route("/réel", name="réel")
     */
    public function réel(Request $request,EntityManagerInterface $manager): Response
    {
        
        
        return $this->render('serveur/inscrption.html.twig');
    }

    /**
     * @Route("/liste_utilisateurs", name="liste_utilisateurs")
     */
    public function liste_utilisateurs(Request $request,EntityManagerInterface $manager): Response
    {
        $liste_utilisateurs=$manager->getRepository(Utilisateur::class)->findAll();
        
        return $this->render('serveur/liste_utilisateurs.html.twig',[
           'liste_utilisateurs' => $liste_utilisateurs
    ]);
    }



}