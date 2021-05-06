<?php


namespace App\Upload\Entity;


class File
{
    private Id $id;
    private string $filename;
    private string $filesize;
    private string $fileLink;
    private ?string $previewLink;
    private string $authorComment;

    public function __construct(
        Id $id,
        string $filename,
        string $filesize,
        string $fileLink,
        ?string $previewLink,
        string $authorComment,
    )
    {

        $this->id = $id;
        $this->filename = $filename;
        $this->filesize = $filesize;
        $this->fileLink = $fileLink;
        $this->previewLink = $previewLink ?? null;
        $this->authorComment = $authorComment;
    }
}