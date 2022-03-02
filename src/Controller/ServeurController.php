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
        $nom=$request->request->get ("admin");
        //$reponse = $manager -> getRepository( login.html.twig :: class) -> findOneBy([ utilisateur.html.twig => 'admin']);
        //$reponse -> getChamp();
        
        if($nom=$request->request->get ("admin")){
            $contenu = "admin";
           }
           else{
            $contenu = "non valide";
           }
        
        return $this->render('serveur/login.html.twig', [
            'contenu'=>'xxx'

        ]);
    }
 

    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function utilisateur(Request $request,EntityManagerInterface $manager): Response
    {
        $newlogin=$request->request->get("newlogin");
        $newpassword=$request->request->get("newpassword1");
        $monutilisateur= new Utilisateur();
        $monutilisateur->setlogin($newlogin);
        $monutilisateur->setpassword($newpassword);
        $manager -> persist($monutilisateur);
        $manager ->flush();
        
        
        return $this->redirectToRoute ('show');

}
   /**
     * @Route("/show", name="show")
     */
    public function show(): Response
    {
        
        return $this->render('serveur/login.html.twig', [
            

        ]);

        
    } 

     
    

    /**
     * @Route("/liste_utilisateurs", name="liste_utilisateurs")
     */
    public function liste_utilisateurs(): Response
    {   
        
        return $this->render('serveur/liste_utilisateurs.html.twig',['lst_utilisateurs' => $mesUtilisateurs]);
    }



   
    /**
    * @Route("/supprimer_utilisateur/{id}",name="supprimer_utilisateur")
    */
    public function supprimer_utilisateur(EntityManagerInterface $manager,Utilisateur $editutil): Response {  
    $manager->remove($editutil);
    $manager->flush();
    // Affiche de nouveau la liste des utilisateurs
    return $this->redirectToRoute ('liste_utilisateurs');
 }
  
    
 
 


}