<?php

namespace AppBundle\Entity;

/**
 * Song
 */
class Song
{
    private $link;
    /**
     * @var int
     */
    private $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $singer;

    /**
     * @var string
     */
    private $album;

    /**
     * @var integer
     */
    private $year;

    /**
     * @var string
     */
    private $genre;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Song
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set singer
     *
     * @param string $singer
     *
     * @return Song
     */
    public function setSinger($singer)
    {
        $this->singer = $singer;

        return $this;
    }

    /**
     * Get singer
     *
     * @return string
     */
    public function getSinger()
    {
        return $this->singer;
    }

    /**
     * Set album
     *
     * @param string $album
     *
     * @return Song
     */
    public function setAlbum($album)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album
     *
     * @return string
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return Song
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set genre
     *
     * @param string $genre
     *
     * @return Song
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }
    /**
     * @var string
     */
    private $mimeType;


    /**
     * Set mimeType
     *
     * @param string $mimeType
     *
     * @return Song
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get mimeType
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Playlist;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Playlist = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add playlist
     *
     * @param \AppBundle\Entity\Playlist $playlist
     *
     * @return Song
     */
    public function addPlaylist(\AppBundle\Entity\Playlist $playlist)
    {
        $this->Playlist[] = $playlist;

        return $this;
    }

    /**
     * Remove playlist
     *
     * @param \AppBundle\Entity\Playlist $playlist
     */
    public function removePlaylist(\AppBundle\Entity\Playlist $playlist)
    {
        $this->Playlist->removeElement($playlist);
    }

    /**
     * Get playlist
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlaylist()
    {
        return $this->Playlist;
    }
}
