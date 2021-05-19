<?php


namespace App\Factory;


use Ramsey\Uuid\UuidInterface;
use SpazzMarticus\Tus\Factories\OriginalFilenameFactory;
use SplFileInfo;

class TusFilenameFactory extends OriginalFilenameFactory
{
    public function __construct(string $directory)
    {
        parent::__construct($directory);
    }

    public function generateFilename(UuidInterface $uuid, array $metadata): SplFileInfo
    {
        $filename = $metadata['name'] ?? $metadata['filename'] ?? null;
        $this->directory = $this->directory.DIRECTORY_SEPARATOR.$uuid->getHex().DIRECTORY_SEPARATOR;
        mkdir($this->directory);
        /**
         * Fallback to UUID if no $filename given, or file already exists
         */
        if (!$filename || file_exists($this->directory . $filename)) {
            $filename = $uuid->getHex();
        }

        return new SplFileInfo($this->directory . $filename);
    }
}