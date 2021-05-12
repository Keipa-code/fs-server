<?php


namespace App\Upload\Command\UploadByTUS;


use App\Flusher;
use App\Upload\Entity\File;
use App\Upload\Entity\FileRepository;
use App\Upload\Entity\Id;
use DateTimeImmutable;

class Handler
{
    private FileRepository $files;
    private Flusher $flusher;

    public function __construct(FileRepository $files, Flusher $flusher)
    {
        $this->files = $files;
        $this->flusher = $flusher;
    }
    
    public function handle(Command $command): void
    {
        $id = Id::generate();
        
        $file = new File(
            $id,
            new DateTimeImmutable(),
            $command->filename,
            $command->size,
            $command->fileLink,
            $command->authorComment,
            $command->previewLink
        );
        
        $this->files->add($file);
        
        $this->flusher->flush();
    }
}
