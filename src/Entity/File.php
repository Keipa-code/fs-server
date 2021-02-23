<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="file")
 */

class File
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    /**
     * @ORM\Column(type="string")
     */
    protected $size;
    /**
     * @ORM\Column(type="string")
     */
    protected $uploadDate;
    /**
     * @ORM\Column(type="string")
     */
    protected $authorComment;
    /**
     * @ORM\Column(type="string")
     */
    protected $preview;
    /**
     * @ORM\Column(type="string")
     */
    protected $link;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSize()
    {
        return $this->size;
    }
    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getUploadDate()
    {
        return $this->uploadDate;
    }
    public function setUploadDate($uploadDate)
    {
        $this->uploadDate = $uploadDate;
    }

    public function getAuthorComment()
    {
        return $this->authorComment;
    }
    public function setAuthorComment($authorComment)
    {
        $this->authorComment = $authorComment;
    }

    public function getPreview()
    {
        return $this->preview;
    }
    public function setPreview($preview)
    {
        $this->preview = $preview;
    }

    public function getLink()
    {
        return $this->link;
    }
    public function setLink($link)
    {
        $this->link = $link;
    }
}