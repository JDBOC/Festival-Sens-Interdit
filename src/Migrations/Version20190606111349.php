<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190606111349 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('ALTER TABLE content DROP status, DROP mapado_link, 
            CHANGE content_type content_type INT NOT NULL');
        $this->addSql('ALTER TABLE si_file DROP INDEX IDX_788FFA4CA870E3EA, ADD UNIQUE INDEX UNIQ_788FFA4CA870E3EA 
            (picture_content_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('ALTER TABLE content ADD status INT NOT NULL, ADD mapado_link LONGTEXT DEFAULT NULL COLLATE 
            tf8mb4_unicode_ci, CHANGE content_type content_type VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE si_file DROP INDEX UNIQ_788FFA4CA870E3EA, ADD INDEX IDX_788FFA4CA870E3EA
         (picture_content_id)');
    }
}
