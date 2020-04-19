<?php

namespace App\Controller;

use App\Entity\DossierVisite;
use App\Entity\PaysDestination;
use App\Controller\PaysDestinationController;
use App\Repository\DossierVisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use \Datetime;
/**
 * @Route("/dossiervisite")
 */
class DossierVisiteController extends AbstractController
{
    /**
     * @Route("/", name="dossiervisite_index", methods={"GET"})
     */
    public function index(DossierVisiteRepository $dossiervisiteRepository): Response
    {
        $dossiers=$dossiervisiteRepository->findAll();
        $datas=array();
        foreach ($dossiers as $key => $dossier){
            $datas[$key]['id'] = $dossier->getId();
            $datas[$key]['date_arrive_visite'] = $dossier->getDateArriveVisite()->format('Y/m/d');
            $datas[$key]['nature'] = $dossier->getNature();
            $datas[$key]['sujet'] = $dossier->getSujet();
            $datas[$key]['date_deb'] = $dossier->getDateDeb()->format('Y/m/d');;
            $datas[$key]['date_fin'] = $dossier->getDateFin()->format('Y/m/d');;
            $datas[$key]['date_limite_rep'] = $dossier->getDateLimiteRep()->format('Y/m/d');;
            $datas[$key]['paye_destination'] = $dossier->getPayeDestination();
            $datas[$key]['ville_destination'] = $dossier->getVilleDestination();
            $datas[$key]['annee'] = $dossier->getAnnee();

        }
        return new JsonResponse($datas);
    }

    /**
     * @Route("/new", name="dossiervisite_new", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        

        $dossiervisite = new DossierVisite();
        $data = json_decode($request->getContent(),true);

        $date_arrive_invitation =  isset($data['date_arrive_invitation']) ? $data['date_arrive_invitation'] : null;
        $nature =  isset($data['nature']) ? $data['nature'] : null;
        $sujet =  isset($data['sujet']) ? $data['sujet'] : null;
        $date_deb =  isset($data['date_deb']) ? $data['date_deb'] : null;
        $date_fin =  isset($data['date_fin']) ? $data['date_fin'] : null;
        $date_limite_rep =  isset($data['date_limite_reponce']) ? $data['date_limite_reponce'] : null;
       // $ville_destination =  isset($data['ville_destination']) ? $data['ville_destination'] : null;
        $annee =  isset($data['annee']) ? $data['annee'] : null;
        $type_visite =  isset($data['type_visite']) ? $data['type_visite'] : null;
        $nbr_participant_ins =  isset($data['nbr_participant_ins']) ? $data['nbr_participant_ins'] : null;
        $nbr_participant_sp =  isset($data['nbr_participant_sp']) ? $data['nbr_participant_sp'] : null;
        $frais_transport =  isset($data['frais_transport']) ? $data['frais_transport'] : null;
        $frais_residence =  isset($data['frais_residence']) ? $data['frais_residence'] : null;
        $statut	 =  isset($data['statut']) ? $data['statut'] : null;
        $nature =  isset($data['nature']) ? $data['nature'] : null;
        $langues =  isset($data['langues']) ? $data['langues'] : null;
       $pays_destination_libelle =  isset($data['pays_destination_libelle']) ? $data['pays_destination_libelle'] : null;
        
       
        $dossiervisite->setDateArriveInvitation($date_arrive_invitation);
        $dossiervisite->setDateDebut($date_deb);
        $dossiervisite->setDateFin($date_fin);
        $dossiervisite->setDateLimiteReponce($date_limite_rep);
        $dossiervisite->setSujet($sujet);
        $dossiervisite->setAnnee($annee);
        $dossiervisite->setTypeVisite($type_visite);
        $dossiervisite->setNbrParticipantINS($nbr_participant_ins);
        $dossiervisite->setNbrParticipantSP($nbr_participant_sp);
        $dossiervisite->setFraisTransport($frais_transport);
        $dossiervisite->setFraisResidence($frais_residence);
        $dossiervisite->setStatut($statut);
        $dossiervisite->setNature($nature);
        $dossiervisite->setLangues($langues); 

        $repository = $this->getDoctrine()->getRepository(PaysDestination::class);
        $pays_destination = $repository->findOneBy(['libelle_pays' => $pays_destination_libelle]);

            if ($pays_destination) {
                $dossiervisite->setPaysDestination($pays_destination);
               
                //$paysdestination=$dossiervisite->getPaysDestination();
                //return new JsonResponse($paysdestination->getLibellePays());
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dossiervisite);
            $entityManager->flush();    
                
            
            return new JsonResponse($data);
            
            
    }

    /**
     * @Route("/{id}", name="dossiervisite_show", methods={"GET"})
     */
    public function show(Dossiervisite $dossiervisite): Response
    {
        
        $datas=array();
        
            $datas[0]['id'] = $dossiervisite->getId();
            $datas[0]['date_arrive_visite'] = $dossiervisite->getDateArriveVisite()->format('Y/m/d');
            $datas[0]['nature'] = $dossiervisite->getNature();
            $datas[0]['sujet'] = $dossiervisite->getSujet();
            $datas[0]['date_deb'] = $dossiervisite->getDateDeb()->format('Y/m/d');;
            $datas[0]['date_fin'] = $dossiervisite->getDateFin()->format('Y/m/d');;
            $datas[0]['date_limite_rep'] = $dossiervisite->getDateLimiteRep()->format('Y/m/d');;
            $datas[0]['paye_destination'] = $dossiervisite->getPayeDestination();
            $datas[0]['ville_destination'] = $dossiervisite->getVilleDestination();
            $datas[0]['annee'] = $dossiervisite->getAnnee();

        
        return new JsonResponse($datas);
    }

    /**
     * @Route("/{id}/edit", name="dossiervisite_edit", methods={"GET","PUT"})
     */
    public function edit(Request $request, Dossiervisite $dossiervisite): Response
    {
        $data = json_decode($request->getContent(),true);

        $date_arrive_visite =  isset($data['date_arrive_visite']) ? $data['date_arrive_visite'] : null;
        $nature =  isset($data['nature']) ? $data['nature'] : null;
        $sujet =  isset($data['sujet']) ? $data['sujet'] : null;
        $date_deb =  isset($data['date_deb']) ? $data['date_deb'] : null;
        $date_fin =  isset($data['date_fin']) ? $data['date_fin'] : null;
        $date_limite_rep =  isset($data['date_limite_rep']) ? $data['date_limite_rep'] : null;
        $paye_destination =  isset($data['paye_destination']) ? $data['paye_destination'] : null;
        $ville_destination =  isset($data['ville_destination']) ? $data['ville_destination'] : null;
        $annee =  isset($data['annee']) ? $data['annee'] : null;

        if($dossiervisite->getId() != null){
            $dossiervisite->setDateArriveVisite(new \DateTime($date_arrive_visite));
            $dossiervisite->setSujet($sujet);
            $dossiervisite->setNature($nature);
            $dossiervisite->setDateDeb(new \DateTime($date_deb));
            $dossiervisite->setDateFin(new \DateTime($date_fin));
            $dossiervisite->setDateLimiteRep(new \DateTime($date_limite_rep));
            $dossiervisite->setPayeDestination($paye_destination);
            $dossiervisite->setVilleDestination($ville_destination);
            $dossiervisite->setAnnee($annee);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dossiervisite);
            $entityManager->flush();

            return new JsonResponse("updated!!");
        }
        
    }

    /**
     * @Route("/{id}", name="dossiervisite_delete", methods={"DELETE"})
     */
    public function delete(Dossiervisite $dossiervisite): Response
    {
        
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dossiervisite);
            $entityManager->flush();
        

        return new JsonResponse("deleted!!");
    }
}
