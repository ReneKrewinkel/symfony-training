<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class HomepageController extends BaseController
{
    #[Route('/', name: 'app_homepage')]
    public function index(): Response
    {
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'Pietje',
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
      return $this->redirectToRoute('app_contact');
    }

#[Route(path: [
        'en' => '/contact-us',
        'nl' => '/neem-contact-op'
], name: 'app_contact')]
    public function contact(Request $request): Response
    {
        $locale = $request->getLocale();
        return new Response('Locale: ' . $locale);
    }

    #[Route('/api/data.{_format}', name: 'app_api', requirements: ['_format' => 'json|xml'])]
    public function api($_format) {
        $data = [
           ["id" => 1, 'name' => 'Pietje', 'age' => 12],
           ["id" => 2, 'name' => 'Harry', 'age' => 16],
        ];


        $a1 = ["jantje", "pietje", "klaasje"];
        $a2 = ["klaasje", "paultje", "henkie"];

        $a3 = [ ...$a1, ...$a2 ];
        $a4 = array_merge($a1,$a2);

        if($_format == 'json') return $this->json($a4);


        $d = "<data>";
        foreach($data as $record) {
            $id = $record["id"];
            $name = $record["name"];
            $d .= "<record id='$id'>$name</record>";
        }
        $d .= "</data>";
        return(new Response($d));
    }

    #[Route('/save-data', name:'homepage_save_data')]
    public function saveData(Request $request) {
        $params = $request->request->all();
        $headers = $request->headers->all();
        return $this->json([$params, $headers]);
    }
}

