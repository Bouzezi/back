<?php

namespace App\Controller;

use App\Entity\DossierVisite;
use App\Entity\PaysDestination;
use App\Entity\OrganismeEtranger;
use App\Entity\ProgrammeCooperation;
use App\Entity\CadreINS;
use App\Controller\PaysDestinationController;
use App\Controller\OrganismeEtrangerController;
use App\Controller\ProgrammeCooperationController;
use App\Controller\CadreINSController;
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
        //$cadres=array();
        foreach ($dossiers as $key => $dossier){
            $datas[$key]['id'] = $dossier->getId();
            $datas[$key]['date_arrive_visite'] = $dossier->getDateArriveInvitation();
            $datas[$key]['nature'] = $dossier->getNature();
            $datas[$key]['sujet'] = $dossier->getSujet();
            $datas[$key]['date_deb'] = $dossier->getDateDebut();
            $datas[$key]['date_fin'] = $dossier->getDateFin();
            $datas[$key]['type_visite'] = $dossier->getTypeVisite();
            $datas[$key]['nb_participant_ins'] = $dossier->getNbrParticipantINS();
            $datas[$key]['nb_participant_sp'] = $dossier->getNbrParticipantSP();
            $datas[$key]['frais_transport'] = $dossier->getFraisTransport();
            $datas[$key]['frais_residence'] = $dossier->getFraisResidence();
            $datas[$key]['date_limite_reponce'] = $dossier->getDateLimiteReponce();
            $datas[$key]['statut'] = $dossier->getStatut();
            $datas[$key]['langues'] = $dossier->getLangues();
            $datas[$key]['pays_destination_id'] = $dossier->getPaysDestination()->getLibellePays();
            $datas[$key]['organisme_etranger_id'] = $dossier->getOrganismeEtranger()->getLibelleOrg();
            $datas[$key]['organisme_etranger_id'] = $dossier->getOrganismeEtranger()->getLibelleOrg();
            $datas[$key]['annee'] = $dossier->getAnnee();
            //$cadres= $dossier->getParticipation();
            //$datas[$key]['participer']= $cadres;
            //print_r($cadres);
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
       $organisme_etranger_libelle =  isset($data['organisme_etranger_libelle']) ? $data['organisme_etranger_libelle'] : null; 
       $programme_libelle =  isset($data['programme_libelle']) ? $data['programme_libelle'] : null; 
        $cadre_id = array();
       $cadre_id =  isset($data['cadre_id']) ? $data['cadre_id'] : null;

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
            $repositoryOrg = $this->getDoctrine()->getRepository(OrganismeEtranger::class);
            $organismeEtranger = $repositoryOrg->findOneBy(['libelle_org' => $organisme_etranger_libelle]);
            $repositoryProg = $this->getDoctrine()->getRepository(ProgrammeCooperation::class);
            $programmeCooperation = $repositoryProg->findOneBy(['libelle_prog' => $programme_libelle]);
            
            $repositoryCadre = $this->getDoctrine()->getRepository(CadreINS::class);    
            
                   for ($i=0; $i < count($cadre_id); $i++) { 
                    $cadreINS = $repositoryCadre->findOneBy(['id' => $cadre_id[$i]]);
                    $dossiervisite->addParticipation($cadreINS);
                   }
                
                if ($organismeEtranger && $programmeCooperation) {
                    $organismeEtranger->addOrganismeProgrammes($programmeCooperation);
                    $dossiervisite->setOrganismeEtranger($organismeEtranger);
                    
                }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dossiervisite);
            $entityManager->flush();    
                
            
            return new JsonResponse($data);
            
            
    }

    /**
     * @Route("/{id}", name="dossiervisite_show", methods={"GET"})
     */
    public function show($id): Response
    {
        $dossier = $this->getDoctrine()
        ->getRepository(DossierVisite::class)
        ->find($id);

        $datas=array();

        $datas[0]['id'] = $dossier->getId();
        $datas[0]['date_arrive_visite'] = $dossier->getDateArriveInvitation();
        $datas[0]['nature'] = $dossier->getNature();
        $datas[0]['sujet'] = $dossier->getSujet();
        $datas[0]['date_deb'] = $dossier->getDateDebut();
        $datas[0]['date_fin'] = $dossier->getDateFin();
        $datas[0]['type_visite'] = $dossier->getTypeVisite();
        $datas[0]['nb_participant_ins'] = $dossier->getNbrParticipantINS();
        $datas[0]['nb_participant_sp'] = $dossier->getNbrParticipantSP();
        $datas[0]['frais_transport'] = $dossier->getFraisTransport();
        $datas[0]['frais_residence'] = $dossier->getFraisResidence();
        $datas[0]['date_limite_reponce'] = $dossier->getDateLimiteReponce();
        $datas[0]['statut'] = $dossier->getStatut();
        $datas[0]['langues'] = $dossier->getLangues();
        $datas[0]['pays_destination_id'] = $dossier->getPaysDestination()->getLibellePays();
        $datas[0]['organisme_etranger_id'] = $dossier->getOrganismeEtranger()->getLibelleOrg();
        $datas[0]['organisme_etranger_id'] = $dossier->getOrganismeEtranger()->getLibelleOrg();
        $datas[0]['annee'] = $dossier->getAnnee(); 
        $cadres=$dossier->getParticipation();
        
        $c=array();
        foreach ($cadres as $key => $cadre){
            $c[$key]['cadre_id']=$cadre->getId();
            $c[$key]['cadre_nom']=$cadre->getNom();
            $c[$key]['cadre_prenom']=$cadre->getPrenom();
            $c[$key]['cadre_grade']=$cadre->getGrade();
            $c[$key]['cadre_fonction']=$cadre->getFonction();
            $c[$key]['cadre_direction']=$cadre->getDirectionCentrale()->getLibelleDirection();
        }
        $datas[0]['cadre_participe']=$c;
        //array_push($datas,$c);
        
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
