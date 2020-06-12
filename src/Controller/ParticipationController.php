<?php

namespace App\Controller;

use App\Entity\Participation;
use App\Repository\ParticipationRepository;
use App\Entity\CadreINS;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
/**
 * @Route("/participation")
 */
class ParticipationController extends AbstractController
{
    /**
     * @Route("/count", name="nombreParticipation", methods={"POST","GET"})
     */
    public function count(Request $request,ParticipationRepository $participationRepository): Response
    {
        
        $participations=$participationRepository->findAll();
        $nbr=0;
        $data = json_decode($request->getContent(),true);

        
        $cadre_id =  isset($data['cadre_id']) ? $data['cadre_id'] : null;
        $annee =  isset($data['annee']) ? $data['annee'] : null;
        $repositoryCadre = $this->getDoctrine()->getRepository(CadreINS::class); 
        $cadreINS = $repositoryCadre->findOneBy(['id' => $cadre_id]);
        foreach ($participations as $key => $participe){
            if($cadreINS == $participe->getCadre() && $annee == $participe->getAnnee())
                $nbr++;
        }
            return new Response($nbr);        
    }

}
