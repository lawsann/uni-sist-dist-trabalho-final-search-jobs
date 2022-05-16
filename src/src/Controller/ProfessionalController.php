<?php

namespace App\Controller;

use App\Repository\SkillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfessionalController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function number(SkillRepository $skillRepository): Response
    {
        $skills = $skillRepository->findAll();
        return $this->render('professional/create-account.html.twig', ['skills' => $skills]);
    }
}
