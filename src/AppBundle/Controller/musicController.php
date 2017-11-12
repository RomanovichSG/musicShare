<?php

namespace AppBundle\Controller;

use AppBundle\Repository\SongRepository;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Song;
use AppBundle\Form\SongType;
use AppBundle\Helper\AudioInfo;

class musicController extends Controller
{
    public function listAction()
    {
        $rm=$this->getDoctrine()
            ->getRepository(Song::class);

        $id=$rm->getId($_POST);
        $orderBy=$rm->sortMusic($_POST);

        $em=$this->getDoctrine()->getManager();
        $songs=$em->getRepository(Song::class)->createQueryBuilder('song')
            ->where('song.id >= ?1')
            ->setParameter('1' , $id)
            ->setMaxResults(20)
            ->orderBy($orderBy, 'ASC')
            ->getQuery()
            ->getResult();
        return $this->render('AppBundle:music:list.html.twig', array(
            'songs'=>$songs,'id'=>$id
        ));
    }

    public function addAction(Request $request)
    {
        $song = new Song();
        $form = $this->createFormBuilder($song)
            ->add('link', FileType::class, array('multiple' => true ,'label' => 'Select your files'))
            ->getForm()
            ->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $files = $song->getLink();
            if($files){
                $routes=[];
                foreach ($files as $file){
                    if($file->getClientMimeType()!='audio/mpeg')
                    {
                        return $this->render('AppBundle:music:add.html.twig',array(
                            'form'=>$form->createView(), 'error'=>'Not mp3'
                        ));
                    }
                    $fileName = md5(uniqid()).'.'.$file->guessExtension();
                    $file->move(
                        $this->getParameter('songs_directory'),
                        $fileName
                    );
                    $routes[]=$this->getParameter('songs_directory')."/".$fileName;
                }
                return $this->redirectToRoute('adding', array(
                    "routes"=>$routes
                ));
            }
        }
        return $this->render('AppBundle:music:add.html.twig',array(
            'form'=>$form->createView(), 'error'=>''
        ));
    }

    public function removeAction()
    {
        return $this->render('AppBundle:music:remove.html.twig', array(
            // ...
        ));
    }

    public function addingPreviewAction(Request $request)
    {
        $routes=$request->query->get("routes");
        $songs=[];
        foreach ($routes as $route) {
            $noInfo = "unknown";
            $track = new Song;
            $track->setName($noInfo)
                ->setSinger($noInfo)
                ->setAlbum($noInfo)
                ->setYear(0)
                ->setGenre($noInfo)
                ->setLink($route);
            $songs[] = $track;
        }
        return $this->render('AppBundle:music:addingPreview.html.twig', array(
            "songs"=>$songs
        ));
    }
    public function addToDataBaseAction()
    {
        $songs=$_POST["song"];
        foreach ($songs as $song)
        {
            $track=new Song();
            $track->setName($song["name"])
                ->setAlbum($song["album"])
                ->setSinger($song["singer"])
                ->setYear($song["year"])
                ->setGenre($song["genre"])
                ->setLink($song["link"]);
            $setSong=$this->getDoctrine()->getManager();
            $setSong->persist($track);
            $setSong->flush();
        }
        return $this->redirectToRoute('music');
    }

}
