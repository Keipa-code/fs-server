<?php


namespace App\Http\Listener;

use App\Upload\Command\UploadByTUS\Command;
use App\Upload\Command\UploadByTUS\Handler;
use App\Upload\Helper\GetID;
use DomainException;
use getID3;
use JsonException;
use Psr\Log\LoggerInterface;
use SpazzMarticus\Tus\Events\UploadComplete;

class Complete
{
    private Handler $handler;
    private LoggerInterface $logger;

    public function __construct(Handler $handler, LoggerInterface $logger)
    {
        $this->handler = $handler;
        $this->logger = $logger;
    }

    /**
     * @throws JsonException
     */
    public function handle(UploadComplete $event): void
    {
        $command = new Command();
        if (!$event->getFile()->getFilename()) {
            throw new DomainException('$event is empty');
        }
        $getID3 = new getID3;
        $fullInfo = $getID3->analyze($event->getFile()->getPathname());
        $this->logger->warning($event->getFile()->getExtension());
        $fileInfo = [
            "size" => $event->getFile()->getSize() ?? '',
            "fileFormat" => $fullInfo['fileformat'] ?? $event->getFile()->getExtension() ?? '',
            "resolution" =>
                $fullInfo["video"]["resolution_x"] && $fullInfo["video"]["resolution_y"]  ?
                    $fullInfo["video"]["resolution_x"] .'x'. $fullInfo["video"]["resolution_y"] :
                    '',
            "codec" => $fullInfo["video"]["fourcc_lookup"]  ?? '',
            "playTime" => $fullInfo["playtime_string"]  ?? '',
        ];

        $command->filename = $event->getFile()->getFilename() ?? '';
        $command->uuidLink = $event->getUuid() ?? '';
        $command->pathName = $event->getFile()->getPathname() ?? '';
        $command->fileInfo = json_encode($fileInfo, JSON_THROW_ON_ERROR);
        if($event->getFile()->getExtension() == 'jpg' || 'jpeg' || 'png' || 'gif') {
            $command->previewLink = '/thumbs/'.$event->getUuid();
        }
        $this->handler->handle($command);
    }
}