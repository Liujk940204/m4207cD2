<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServeurController extends AbstractController
{
    /**
     * @Route("/serveur", name="serveur")
     */
    public function index(Request $request): Response
    {
        return $this->render('serveur/index.html.twig', [
            'controller_name' => 'ServeurController',
        ]);
    }


    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request): Response
    {
        $nom=$request->request->get ("root")
        $password=$request->request->get ("root")
        

        return $this->render('serveur/login.html.twig', [
            'controller_name' => 'ServeurController',
            'nom' =>$nom,
            'password'=> $password,
            
        ]);

    }
}