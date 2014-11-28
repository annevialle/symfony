<?php
/**
 * Created by PhpStorm.
 * User: annevialle
 * Date: 27/11/2014
 * Time: 13:54
 */

namespace Cergy\BookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Behavior;

/**
 * Class Category
 * @ORM\Entity
 * @ORM\Table(name="category")
 *
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Cergy\BookBundle\Entity\Book", mappedBy="category")
     */
    protected $book;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
} 