<?php

namespace App\Controller;

use App\Entity\Problematic;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function problematics(EntityManagerInterface $entity): Response
    {
        $problematics = $entity->getRepository(Problematic::class)->findAll();
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'problematics' => $problematics,
        ]);
    }
    
}
