<?php

namespace App\Controller;

use App\Repository\DossierVisiteRepository;
use App\Repository\CadreINSRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * @Route("/dashbord")
 */
class DashbordController extends AbstractController
{
     /**
     * @Route("/", name="dashbord_index", methods={"GET"})
     */
    public function index(DossierVisiteRepository $dossierVisiteRepository, CadreINSRepository  $cadreINSRepository): JsonResponse
    {
        /* $nbrDossier=$dossierVisiteRepository->nbrDossier();
        $nbrDossierMission=$dossierVisiteRepository->nbrDossierMission();
        $nbrDossierFormation=$dossierVisiteRepository->nbrDossierFormation();
        $nbrCadre=$dashbordRepository->nbrCadre(); */
        $datas=array();
            $datas['nbrDossier'] =$dossierVisiteRepository->nbrDossier()['1'];
            $datas['nbrDossierMission'] = $dossierVisiteRepository->nbrDossierMission()['1'];
            $datas['nbrDossierFormation'] = $dossierVisiteRepository->nbrDossierFormation()['1'];
            $datas['nbrCadre'] = $cadreINSRepository->nbrCadre()['1'];
        return new JsonResponse($datas);
    }

}
