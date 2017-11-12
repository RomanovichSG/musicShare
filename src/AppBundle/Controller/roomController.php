<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Playlist;
use AppBundle\Entity\user;
use AppBundle\Entity\Song;
use AppBundle\Form\PlaylistType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Repository\PlaylistRepository;
use Symfony\Component\HttpFoundation\Request;

class roomController extends Controller
{
    public function platformAction()
    {
        $user = $this->getUser();
        $userInfo=[];
        $userInfo["Name"]=$user->getName();
        $userInfo["Email"]=$user->getEmail();
        $userInfo["Created"]=$user->getDateLastLogin()->format('Y-m-d H:i:s');

        $playlists=$user->getPlaylist();
        return $this->render('AppBundle:room:platform.html.twig', array(
            "userInfo"=>$userInfo, 'playlists'=>$playlists
        ));
    }

    public function addingAction()
    {
        $user=$this->getUser();
        $addedSongs=$this->getDoctrine()
            ->getRepository(Playlist::class)
            ->getAddedSongsInfo($_POST,'songList','addToPlaylist');
        $playlists=$user->getPlaylist();
        return $this->render('AppBundle:room:adding.html.twig', array(
            'songs'=>$addedSongs, 'playlists'=>$playlists
        ));
    }

    public function createPlaylistAction(Request $request)
    {
        $user=$this->getUser();

        $playlist=new Playlist();
        $form = $this->createForm(PlaylistType::class, $playlist)
            ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $playlist=$form->getData();
            $playlist->setUser($user);
            $addToDataBase=$this->addSong($_POST,'addToPlaylist',$playlist,$user);
            return $this->redirectToRoute('room');
        }

        return $this->render('AppBundle:room:createPlaylist.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function addSongsToPlaylistAction()
    {
        foreach($_POST['addedPlaylists'] as $playlistId)
        {
            $playlist=$this->getDoctrine()
                ->getRepository(Playlist::class)
                ->find($playlistId);
            $user=$playlist->getUser();
            $addToDataBase=$this->addSong($_POST,'addToPlaylist',$playlist,$user);
        }
        return $this->redirectToRoute('room');
    }

    public function viewAction($id)
    {
        $playlist=$this->getDoctrine()
            ->getRepository(Playlist::class)
            ->find($id);
        $name=$playlist->getName();
        $songs=$playlist->getSong();
        return $this->render('AppBundle:room:view.html.twig', array(
            'songs'=>$songs, 'name'=>$name ,'playlistId'=>$id
        ));
    }
    public function removeFromPlaylistAction($playlistId,$id)
    {
        $playlist=$this->getDoctrine()
            ->getRepository(Playlist::class)
            ->find($playlistId);
        $song=$this->getDoctrine()
            ->getRepository(Song::class)
            ->find($id);
        $playlist->removeSong($song);
        $em=$this->getDoctrine()
            ->getManager();
        $em->persist($playlist);
        $em->persist($song);
        $em->flush();
        return $this->redirectToRoute('songsInPlaylist',array(
            'id'=>$playlistId
        ));
    }
    public function addSong($array,$listName,Playlist $playlist,user $user)
    {
        foreach($array[$listName] as $id)
        {
            $song=$this->getDoctrine()
                ->getRepository(Song::class)
                ->find($id);
            $playlist->addSong($song);
        }
        $em=$this->getDoctrine()
            ->getManager();
        $em->persist($playlist);
        $em->persist($user);
        $em->flush();
    }
}
