<?php

namespace App\Controller;

use App\Entity\Partner;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PartnerController extends AbstractController
{
    #[Route('/partner', name: 'app_partner')]
    public function partner(EntityManagerInterface $entity): Response
    {
        $partner = $entity->getRepository(Partner::class)->findAll();
        return $this->render('partner/partner.html.twig', [
            'controller_name' => 'PartnerController',
            'partner' => $partner,
        ]);
    }

    #[Route('/partner/{id}', name: 'app_partner')]
    public function partnerid($id, EntityManagerInterface $entity): Response
    {
        $partner = $entity->getRepository(Partner::class)->findAll();
        $partners = $entity->getRepository(Partner::class)->findOneBy(['id' => $id]);
        return $this->render('partner/partner.html.twig', [
            'controller_name' => 'PartnerController',
            'id' => $id,
            'partners' => $partners,
            'partner'=> $partner,

        ]);
    }
}
