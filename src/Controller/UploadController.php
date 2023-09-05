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
     * @Route("/files", name="app_files_index")
     * @method({"GET"})
     * @param FileUploader $file_uploader
     * @return Response
     */

    // function to list all files
    public function index(FileUploader $file_uploader)
    {
     
        // redirect C:/xampp/htdocs/projet-annuel/public/uploads to https://127.0.0.1:8000/public/uploads
        $directory = $file_uploader->getTargetDirectory();
        $full_path = $directory;
        $files = scandir($full_path);
        $files = array_diff(scandir($full_path), array('.', '..'));


            return $this->render('upload/index.html.twig', [
            'files' => $files,
        ]);
    }

  
  /**
   * @Route("/files/new", name="app_files_new")
   * @method({"GET", "POST"})
   * @param Request $request
   * @param FileUploader $file_uploader
   * @return Response
   
   */


  public function newUploadFile(Request $request, FileUploader $file_uploader)
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
   return $this->render('upload/new.html.twig', [
      'form' => $form->createView(),
    ]);
  }
  
    

    /**
     * @Route("/delete/{file}", name="app_files_delete")
     * @method({"DELETE"})
     * @param $file
     * @param FileUploader $file_uploader
     * @return Response
     * 
     */

     
    // function to delete a file
    public function deleteUploadFile($file, FileUploader $file_uploader)
    {
        $directory = $file_uploader->getTargetDirectory();
        $full_path = $directory.'/'.$file;
        $filesystem = new Filesystem();
        try {
            $filesystem->remove($full_path);
        } catch (IOExceptionInterface $exception) {
            echo "An error occurred while deleting your file at ".$exception->getPath();
        }
        return $this->redirectToRoute('app_files_index');
    }

}
