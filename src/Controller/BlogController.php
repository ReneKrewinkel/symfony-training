<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Psr\Log\LoggerInterface;

#[Route('/info/blog')]
final class BlogController extends AbstractController
{
    private LoggerInterface $log;

    public function __construct() {
       // $this->log = $log;
    }


    #[Route('/', name: 'app_blog')]
    public function index(): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }



    #[Route('/edit/{slug}', name:'blog_show')]
    public function edit(LoggerInterface $log, $slug) {
        $log->debug('Dit is info!');
        dd("EDIT", $slug);
    }

    #[Route('/list/{page}', name:'blog_list', requirements: ['page' => '\d+'])]
    public function list($page)
    {

        dd("LIST", $page);
    }


}
