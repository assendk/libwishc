<?php

namespace App\Controller;

use App\Service\LibrariesIoApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index(Request $request, LibrariesIoApi $librariesIoApi)
    {
        $results = [];

        if ($request->isMethod('POST')) {
            $keyword = $request->request->get('keyword');
            $results = $librariesIoApi->search($keyword);
        }

        return $this->render('search/index.html.twig', [
            'results' => $results,
        ]);
    }
}
