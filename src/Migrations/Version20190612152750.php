<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190612152750 extends AbstractMigration
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

        $this->addSql('ALTER TABLE edition ADD edition_picture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE edition ADD CONSTRAINT FK_A891181F203F1692 FOREIGN KEY (edition_picture_id) 
            REFERENCES si_file (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A891181F203F1692 ON edition (edition_picture_id)');
        $this->addSql('ALTER TABLE si_file ADD updated_at DATETIME NOT NULL, DROP mime_type, DROP link');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('ALTER TABLE edition DROP FOREIGN KEY FK_A891181F203F1692');
        $this->addSql('DROP INDEX UNIQ_A891181F203F1692 ON edition');
        $this->addSql('ALTER TABLE edition DROP edition_picture_id');
        $this->addSql('ALTER TABLE si_file ADD mime_type VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci,
         ADD link VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP updated_at');
    }
}
