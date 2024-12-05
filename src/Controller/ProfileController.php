<?php

namespace App\Controller;

use App\Entity\Activities;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(EntityManagerInterface $entity): Response
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $partner = $this->getUser()->getPartner();
        

        $activities = $entity->getRepository(Activities::class)->findBy(['partner' => $partner]);
        return $this->render('profile/profile.html.twig', [
            'controller_name' => 'ProfileController',
            'activities'=>$activities,
        ]);
    }
}
