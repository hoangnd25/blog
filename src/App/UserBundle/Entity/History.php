<?php

namespace App\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="history")
 */
class History
{
    const WORK = 'work';
    const EDUCATION = 'education';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(length=60)
     */
    protected $title;

    /**
     * @ORM\Column(length=60)
     */
    protected $at;

    /**
     * @ORM\Column(type="integer",length=4)
     */
    protected $year;

    /**
     * @ORM\Column(length=10)
     */
    protected $type;

    /**
     * @ORM\Column(length=255)
     */
    protected $description;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $current;

    /**
     * @param mixed $at
     */
    public function setAt($at)
    {
        $this->at = $at;
    }

    /**
     * @return mixed
     */
    public function getAt()
    {
        return $this->at;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $current
     */
    public function setCurrent($current)
    {
        $this->current = $current;
    }

    /**
     * @return mixed
     */
    public function getCurrent()
    {
        return $this->current;
    }

    public function __construct()
    {
        $this->setCurrent(false);
    }
}