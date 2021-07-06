<?php

declare(strict_types=1);

namespace App\Http\Listener;

use App\Factory\Thumb;
use App\Upload\Command\UploadByTUS\Command;
use App\Upload\Command\UploadByTUS\Handler;
use DomainException;
use Exception;
use getID3;
use InvalidArgumentException;
use JsonException;
use Psr\Log\LoggerInterface;
use SpazzMarticus\Tus\Events\UploadComplete;

final class Complete
{
    private Handler $handler;
    private string $dir = '/var/www/var/';
    private int $thumbWidth = 300;
    private int $thumbHeight = 200;

    public function __construct(Handler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @throws JsonException
     * @throws Exception
     */
    public function handle(UploadComplete $event): void
    {
        $command = new Command();
        if (!$event->getFile()->getFilename()) {
            throw new DomainException('$event is empty');
        }
        $getID3 = new getID3();
        $fullInfo = $getID3->analyze($event->getFile()->getPathname());
        $fileInfo = [
            'size' => $event->getFile()->getSize() ?? '',
            'fileFormat' => $fullInfo['fileformat'] ?? $event->getFile()->getExtension() ?? '',
            'resolution' => $fullInfo['video']['resolution_x'] && $fullInfo['video']['resolution_y'] ?
                    $fullInfo['video']['resolution_x'] . 'x' . $fullInfo['video']['resolution_y'] :
                    '',
            'codec' => $fullInfo['video']['fourcc_lookup']  ?? '',
            'playTime' => $fullInfo['playtime_string']  ?? '',
        ];

        $command->filename = $event->getFile()->getFilename() ?? '';
        $command->uuidLink = $event->getUuid()->toString() ?? '';
        $command->pathName = $event->getFile()->getPathname() ?? '';
        $command->fileInfo = json_encode($fileInfo, JSON_THROW_ON_ERROR);
        if (
            $fileInfo['fileFormat'] === 'jpg' ||
            $fileInfo['fileFormat'] === 'jpeg' ||
            $fileInfo['fileFormat'] === 'png' ||
            $fileInfo['fileFormat'] === 'gif'
        ) {
            $command->previewLink = '/thumbs/' . $event->getUuid();
            $sourceFile = $command->pathName;
            if (!is_file($sourceFile)) {
                throw new InvalidArgumentException('Source file not found');
            }
            $image = new Thumb($sourceFile);
            $image->thumb($this->thumbWidth, $this->thumbHeight);
            $image->save($this->dir . $command->previewLink . '.jpg', 60);
        }
        $this->handler->handle($command);
    }
}
