<?php

namespace App\Controller;

use App\Entity\Interventions;
use App\Entity\Partner;
use App\Form\InterventionsType;
use App\Repository\InterventionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InterventionsController extends AbstractController
{

    public function __construct(
        private readonly EntityManagerInterface $entityManagerInterface,
    )
    {}

    #[Route('/interventions', name: 'app_interventions')]
    public function planInterevntions(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $intervention = new Interventions();
        $form = $this->createForm(InterventionsType::class, $intervention);
        $form->handleRequest($request);

        $partner = $this->getUser()->getPartner();
        $interventions = $partner->getInterventions();


        if($form->isSubmitted() && $form->isValid()){
            $intervention->setPartner($this->getUser()->getPartner());
            $this->entityManagerInterface->persist($intervention);
            $this->entityManagerInterface->flush();

        }

        return $this->render('interventions/interventions.html.twig', [
            'controller_name' => 'InterventionsController',
            'form' => $form->createView(),
            'interventions'=>$interventions
        ]);
    }

    #[Route('/delete/{id}', name: 'app_delete')]
    public function deleteIntervention($id, EntityManagerInterface $entityManagerInterface): Response
    {
        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $partner = $this->getUser()->getPartner();
        $interventions = $partner->getInterventions();
        $interventions = $entityManagerInterface->getRepository(Interventions::class)->find($id);

        $interventions->setPartner(null);

        $this->entityManagerInterface->remove($interventions);
        $this->entityManagerInterface->flush();


        return $this->redirectToRoute('app_interventions', [
            'controller_name' => 'InterventionsController',
            'interventions'=>$interventions,
        ]);
    }
    
}
