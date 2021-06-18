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
    private string $fileInfo;
    /**
     * @ORM\Column
     */
    private string $uuidLink;
    /**
     * @ORM\Column
     */
    private ?string $previewLink;

    public function __construct(
        Id $id,
        DateTimeImmutable $date,
        string $filename,
        string $fileInfo,
        string $uuidLink,
        ?string $previewLink,
    )
    {

        $this->id = $id;
        $this->date = $date;
        $this->filename = $filename;
        $this->fileInfo = $fileInfo;
        $this->uuidLink = $uuidLink;
        $this->previewLink = $previewLink ?? null;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }
    /**
     * @return string|null
     */
    public function getPreviewLink(): ?string
    {
        return $this->previewLink;
    }

}