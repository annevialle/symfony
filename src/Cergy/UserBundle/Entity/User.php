<?php
/**
 * Created by PhpStorm.
 * User: annevialle
 * Date: 26/11/2014
 * Time: 13:56
 */

namespace Cergy\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;



/**
 * Class User
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */

class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected  $id;

    /**
     * @ORM\OneToMany(targetEntity="Cergy\NewsBundle\Entity\News", mappedBy="author")
     */
    protected $news;

    /**
     * @ORM\OneToMany(targetEntity="Cergy\BookBundle\Entity\Book", mappedBy="author")
     */
    protected $book;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->news = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add news
     *
     * @param \Cergy\NewsBundle\Entity\News $news
     * @return User
     */
    public function addNews(\Cergy\NewsBundle\Entity\News $news)
    {
        $this->news[] = $news;

        return $this;
    }

    /**
     * Remove news
     *
     * @param \Cergy\NewsBundle\Entity\News $news
     */
    public function removeNews(\Cergy\NewsBundle\Entity\News $news)
    {
        $this->news->removeElement($news);
    }

    /**
     * Get news
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNews()
    {
        return $this->news;
    }
}
