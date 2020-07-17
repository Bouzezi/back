<?php

namespace App\Controller;

use App\Entity\Rapport;
use App\Entity\CadreINS;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/uploadFiles")
 */
class UploadController extends AbstractController
{
    /**
     * @Route("/upload", name="upload_test")
     */
    public function upload(Request $request)
    {
        $file=$request->files->get('file');
	    $extension_autorisees =['rar','zip'];
            $filename=$file->getClientOriginalName();
          //  $fileName = md5(uniqid()).'.'.$file->guessExtension(); 
        if(in_array($file->guessExtension() ,$extension_autorisees)){
            $file->move($this->getParameter('upload_directory'), $filename);
            return new JsonResponse("file is successfully uploaded"); 
        }
        else
        {
            throw $this->createNotFoundException(
                'False Extension'
            );
        }
        
    }
    /**
     * @Route("/new", name="upload_rapport", methods={"POST"})
     */
    public function  cadreUpload(Request $request){
        $data = json_decode($request->getContent(),true);
        $id =  isset($data['id']) ? $data['id'] : null;
            $cadre= $this->getDoctrine()
            ->getRepository(CadreINS::class)
            ->find($id);
            if($cadre != null){
                $rapport=new Rapport();
                $rapport->setCadre($cadre);
                $rapport->setPath("C:\xampp\htdocs\backend_pfe\public\uploads");
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($rapport);
                $entityManager->flush();
                $cadre->addRapport($rapport);    
                return new JsonResponse("rapport ajoutée "); 
            }
            else
            return new JsonResponse("verifier le cadre"); 
            
    }

}
   