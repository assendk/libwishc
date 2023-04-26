<?php

namespace App\Controller;

use App\Service\LibrariesIoApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    /**
     * @Route("/add-package", name="add_package", methods={"POST"})
     */
    public function addPackage(Request $request) {
        $name = $request->request->get('name');
        $url = $request->request->get('url');

        return new JsonResponse(['status' => 'success']);
    }

    /**
     * @Route("/remove-package", name="remove_package", methods={"POST"})
     */
    public function removePackage(Request $request)
    {
        $name = $request->request->get('name');
        $url = $request->request->get('url');

        // Your logic to remove the package from the user's list goes here
        // You can use Doctrine to delete the package entity from the database

        return new JsonResponse(['status' => 'success']);
    }
}
