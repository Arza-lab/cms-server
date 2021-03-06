<?php

namespace App\Controller;

use App\Service\EntityGenerator;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContentModelController extends AbstractController
{
    #[Route('/content/model', name: 'app_content_model')]
    public function index(EntityGenerator $generator, KernelInterface $kernel): Response
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
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput([
            'command' => 'make:entity',
            // (optional) define the value of command arguments
            // (optional) pass options to the command
            '--regenerate',
            '--overwrite',
            'name' => 'App\Entity',
        ]);

        $input->setInteractive(false);
        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);

        // return the output, don't use if you used NullOutput()
        $content = $output->fetch();

        // return new Response(""), if you used NullOutput()
        return new Response($content);

        //return response


        return $this->render('content_model/index.html.twig', [
            'controller_name' => 'ContentModelController',
        ]);
    }
}
