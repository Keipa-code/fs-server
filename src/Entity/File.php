<?php


namespace App\Entity;


use DateTime;
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
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=60, nullable=false, options={"fixed"=true})
     */
    protected $filename;
    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string", length=30, nullable=false, options={"fixed"=true})
     */
    protected $size;
    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    protected $uploadDate;
    /**
     * @var string|null
     *
     * @ORM\Column(name="authorComment", type="string", length=200, nullable=true, options={"default"="null","fixed"=true})
     */
    protected $authorComment;
    /**
     * @var string|null
     *
     * @ORM\Column(name="preview", type="string", length=200, nullable=true, options={"default"="null","fixed"=true})
     */
    protected $preview;
    /**
     * @ORM\Column(name="link", type="string", length=200, nullable=false)
     */
    protected $link;

    public function getId()
    {
        return $this->id;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    public function getSize()
    {
        return $this->size;
    }
    public function setSize($size)
    {
        $this->size = $size;
    }

    public function setUploadDate(DateTime $uploadDate)
    {
        $this->uploadDate = $uploadDate;
    }
    public function getUploadDate()
    {
        return $this->uploadDate;
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