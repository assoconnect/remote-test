<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Routing\Attribute\Route;

class FormController extends AbstractController
{
    #[Route(path: '/countries', name: 'countries', methods: ['GET'])]
    public function countries(): JsonResponse
    {
        $countries = Countries::getNames('fr');
        ksort($countries);
        return new JsonResponse($countries);
    }
}
