<?php


namespace App\Factory;


use JetBrains\PhpStorm\Pure;
use Ramsey\Uuid\UuidInterface;
use SpazzMarticus\Tus\Factories\OriginalFilenameFactory;
use SplFileInfo;

class TusFilenameFactory extends OriginalFilenameFactory
{
    #[Pure] public function __construct(string $directory)
    {
        parent::__construct($directory);
        $this->directory = realpath($directory).DIRECTORY_SEPARATOR;
    }

    public function generateFilename(UuidInterface $uuid, array $metadata): SplFileInfo
    {
        $filename = $metadata['name'] ?? $metadata['filename'] ?? null;
        $this->directory = $this->directory.$uuid->getHex().DIRECTORY_SEPARATOR;
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