<?php

namespace App\Controller;

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
        $nom = $request->request->get ("nom")
        $password = $request->request->get ("password")
        $email = $request->request->get ("email")

        return $this->render('serveur/login.html.twig', [
            'controller_name' => 'ServeurController',
            'nom' =>$nom,
            'password'=> $password,
            'email' =>$email,
        ]);

    }
}