<?php

namespace App\Controller;

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
     * @Route("/new", name="upload_test")
     */
    public function upload(Request $request)
    {
	    $file=$request->files->get('file');
	    $extension_autorisees =['pdf', 'jpeg','png','docx'];
            $filename=$file->getClientOriginalName();
          //  $fileName = md5(uniqid()).'.'.$file->guessExtension(); 
        if(in_array($file->guessExtension() ,$extension_autorisees)){
            $file->move($this->getParameter('upload_directory'), $filename); 
            return new JsonResponse("file is successfully uploaded"); 
        }
        else
        {
            throw $this->createNotFoundException(
                'mauvais fichier'
            );
        }
        
    }

}
   