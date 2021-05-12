<?php

declare(strict_types=1);

namespace App\Data\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210512095023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE files (id UUID NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, filename VARCHAR(255) NOT NULL, filesize VARCHAR(255) NOT NULL, file_link VARCHAR(255) NOT NULL, preview_link VARCHAR(255) NOT NULL, author_comment VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN files.id IS \'(DC2Type:file_id)\'');
        $this->addSql('COMMENT ON COLUMN files.date IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE files');
    }
}
