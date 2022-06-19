<?php

namespace App\Controller;

use App\Service\EntityGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContentModelController extends AbstractController
{
    #[Route('/content/model', name: 'app_content_model')]
    public function index(EntityGenerator $generator): Response
    {
        $entityName = 'Post';
        $tableName = 'post';

        $entity = $generator->create($entityName, $tableName, []);
        //$entityFile = $fileGenerator->create($entity);

        echo($entity);

        $entityDir = __DIR__.'/../Entity/';

        //write to file in src/Entity
        $file = fopen($entityDir.$entityName.'.php', 'w');

        fwrite(  $file, $entity);

        fclose($file);

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
