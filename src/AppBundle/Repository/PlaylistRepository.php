<?php

namespace AppBundle\Repository;

/**
 * PlaylistRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PlaylistRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAddedSongsInfo($array,$list,$addedId)
    {
        $addedSongsInfo=[];
        foreach($array[$addedId] as $id)
        {
            $addedSongsInfo[]=$array[$list][$id];
        }
        return $addedSongsInfo;
    }
}
