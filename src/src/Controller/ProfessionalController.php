<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfessionalController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function number(): Response
    {
        return $this->render('professional/create-account.html.twig');
    }
}
