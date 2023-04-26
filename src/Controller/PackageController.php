<?php

namespace App\Controller;

use App\Service\LibrariesIoApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;

class PackageController extends AbstractController
{
    /**
     * @Route("/package/{platform}/{name}", name="package_details", methods={"GET"})
     */
    public function showPackage($platform, $name, LibrariesIoApi $librariesIoApi)
    {
        $apiKey = $this->getParameter('libraries_io_api_key');
        $platform = strtolower(filter_var($platform, FILTER_SANITIZE_STRING));
        $name = str_replace('/', '_', urldecode(filter_var($name, FILTER_SANITIZE_STRING)));

        $result = $librariesIoApi->getPackageDetails($platform, $name);

        return $this->render('package/index.html.twig', [
            'package' => $result,
        ]);
        //        return $this->json($result);
//        return $this->render('package/index.html.twig');
    }

    /**
     * @Route("/package/showkey", name="package_key")
     */
    public function showKey()
    {
        $apiKey = $this->getParameter('libraries_io_api_key');
        return $this->json([$apiKey]);
    }

}
