<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Service\FileUploader;
use App\Form\FileUploadType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;


class UploadController extends AbstractController
{
  
  /**
   * @Route("/test-upload", name="app_test_upload")
   */


  public function excelCommunesAction(Request $request, FileUploader $file_uploader)
  {
    $form = $this->createForm(FileUploadType::class);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) 
    {
      $file = $form['upload_file']->getData();
      if ($file) 
      {
        $file_name = $file_uploader->upload($file);
        if (null !== $file_name) // for example
        {
          $directory = $file_uploader->getTargetDirectory();
          $full_path = $directory.'/'.$file_name;
          // Do what you want with the full path file...
          // Why not read the content or parse it !!!
        }
        else
        {
          // Oups, an error occured !!!
        }
      }
    }
   return $this->render('upload/index.html.twig', [
      'form' => $form->createView(),
    ]);
  }
  // function to list of files in a directory
    /**
     * @Route("/files", name="app_list_files")
     */
    public function listFilesAction(FileUploader $file_uploader)
    {
     
        // redirect C:/xampp/htdocs/projet-annuel/public/uploads to https://127.0.0.1:8000/public/uploads
        $directory = $file_uploader->getTargetDirectory();
        $full_path = $directory;
        $files = scandir($full_path);
        $files = array_diff(scandir($full_path), array('.', '..'));
            return $this->render('upload/view.html.twig', [
            'files' => $files,
        ]);
    }


    
}