<?php

declare(strict_types=1);

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
     * @ORM\Column(name="file_info")
     */
    private string $fileInfo;
    /**
     * @ORM\Column(name="uuid_link")
     */
    private string $uuidLink;
    /**
     * @ORM\Column(name="path_name")
     */
    private string $pathName;
    /**
     * @ORM\Column(name="preview_link")
     */
    private ?string $previewLink;

    public function __construct(
        Id $id,
        DateTimeImmutable $date,
        string $filename,
        string $fileInfo,
        string $uuidLink,
        string $pathName,
        ?string $previewLink,
    ) {
        $this->id = $id;
        $this->date = $date;
        $this->filename = $filename;
        $this->fileInfo = $fileInfo;
        $this->uuidLink = $uuidLink;
        $this->pathName = $pathName;
        $this->previewLink = $previewLink ?? null;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getPreviewLink(): ?string
    {
        return $this->previewLink;
    }

    public function getPathName(): string
    {
        return $this->pathName;
    }
}
