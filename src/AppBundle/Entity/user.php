<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
/**
 * user
 */
class user implements UserInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $email;

    /**
     * @var \DateTime
     */
    private $dateLastLogin;


    /**
     * Get id
     *
     * @return int
     */
    private $role;


    /**
     * Set role
     *
     * @param string $role
     *
     * @return user
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return user
     */

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set password
     *
     * @param string $password
     *
     * @return user
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return user
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateLastLogin
     *
     * @param \DateTime $dateLastLogin
     *
     * @return user
     */
    public function setDateLastLogin($dateLastLogin)
    {
        $this->dateLastLogin = $dateLastLogin;

        return $this;
    }

    /**
     * Get dateLastLogin
     *
     * @return \DateTime
     */
    public function getDateLastLogin()
    {
        return $this->dateLastLogin;
    }
    /**
     * @var string
     */

    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getRoles()
    {
        return [$this->role];
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->name;
    }

    public function eraseCredentials()
    {

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
     * @return user
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
