<?php


namespace App\Upload\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="files")
 */
class File
{
    /**
     * @ORM\Column(type="file_id")
     * @ORM\Id
     */
    private Id $id;
    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $date;
    /**
     * @ORM\Column
     */
    private string $filename;
    /**
     * @ORM\Column
     */
    private string $filesize;
    /**
     * @ORM\Column
     */
    private string $fileLink;
    /**
     * @ORM\Column
     */
    private ?string $previewLink;
    /**
     * @ORM\Column
     */
    private string $authorComment;

    public function __construct(
        Id $id,
        DateTimeImmutable $date,
        string $filename,
        string $filesize,
        string $fileLink,
        ?string $previewLink,
        string $authorComment,
    )
    {

        $this->id = $id;
        $this->date = $date;
        $this->filename = $filename;
        $this->filesize = $filesize;
        $this->fileLink = $fileLink;
        $this->previewLink = $previewLink ?? null;
        $this->authorComment = $authorComment;
    }
}