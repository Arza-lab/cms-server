<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContentModelController extends AbstractController
{
    #[Route('/content/model', name: 'app_content_model')]
    public function index(): Response
    {

        //read request

        //create doctrine entity

        //create database table

        //execute database table

        //return response


        return $this->render('content_model/index.html.twig', [
            'controller_name' => 'ContentModelController',
        ]);
    }
}
