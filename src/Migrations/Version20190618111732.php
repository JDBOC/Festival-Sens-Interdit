<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190618111732 extends AbstractMigration
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
        $this->addSql('ALTER TABLE content ADD cover_id INT DEFAULT NULL, ADD thumbnail_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9922726E9 FOREIGN KEY (cover_id)
         REFERENCES si_file (id)');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9FDFF2E92 FOREIGN KEY (thumbnail_id)
         REFERENCES si_file (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FEC530A9922726E9 ON content (cover_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FEC530A9FDFF2E92 ON content (thumbnail_id)');
        $this->addSql('ALTER TABLE si_file DROP INDEX UNIQ_788FFA4CA870E3EA,
         ADD INDEX IDX_788FFA4CA870E3EA (picture_content_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9922726E9');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9FDFF2E92');
        $this->addSql('DROP INDEX UNIQ_FEC530A9922726E9 ON content');
        $this->addSql('DROP INDEX UNIQ_FEC530A9FDFF2E92 ON content');
        $this->addSql('ALTER TABLE content DROP cover_id, DROP thumbnail_id');
        $this->addSql('ALTER TABLE si_file DROP INDEX IDX_788FFA4CA870E3EA,
         ADD UNIQUE INDEX UNIQ_788FFA4CA870E3EA (picture_content_id)');
    }
}
