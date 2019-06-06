<?php
declare(strict_types=1);
namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605101135 extends AbstractMigration
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
        $this->addSql('CREATE TABLE edition (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL,
         PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, content_id INT NOT NULL,
         session_date DATETIME NOT NULL, location VARCHAR(255) DEFAULT NULL, INDEX IDX_D044D5D484A0A3ED (content_id), 
         PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content (id INT AUTO_INCREMENT NOT NULL, edition_id INT DEFAULT NULL,
         title_fr VARCHAR(255) NOT NULL, content_type VARCHAR(255) NOT NULL, status INT NOT NULL,
          title_en VARCHAR(255) DEFAULT NULL, content_fr LONGTEXT DEFAULT NULL, content_en LONGTEXT DEFAULT NULL,
          country_fr VARCHAR(255) DEFAULT NULL, country_en VARCHAR(255) DEFAULT NULL,
           mapado_link LONGTEXT DEFAULT NULL, INDEX IDX_FEC530A974281A5E (edition_id), PRIMARY KEY(id)) DEFAULT 
           CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_si_file (content_id INT NOT NULL, si_file_id INT NOT NULL, INDEX 
            IDX_A78723FF84A0A3ED (content_id), INDEX IDX_A78723FF8C95266A (si_file_id), PRIMARY KEY(content_id, 
            si_file_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE si_file (id INT AUTO_INCREMENT NOT NULL, picture_content_id INT DEFAULT NULL, name
         VARCHAR(255) NOT NULL, mime_type VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, type INT NOT NULL, INDEX 
         IDX_788FFA4CA870E3EA (picture_content_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE
          utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D484A0A3ED FOREIGN KEY (content_id) REFERENCES 
            content (id)');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A974281A5E FOREIGN KEY (edition_id) REFERENCES
            edition (id)');
        $this->addSql('ALTER TABLE content_si_file ADD CONSTRAINT FK_A78723FF84A0A3ED FOREIGN KEY (content_id)
         REFERENCES content (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_si_file ADD CONSTRAINT FK_A78723FF8C95266A FOREIGN KEY (si_file_id)
         REFERENCES si_file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE si_file ADD CONSTRAINT FK_788FFA4CA870E3EA FOREIGN KEY (picture_content_id)
         REFERENCES content (id)');
    }
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed
         safely on \'mysql\'.');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A974281A5E');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D484A0A3ED');
        $this->addSql('ALTER TABLE content_si_file DROP FOREIGN KEY FK_A78723FF84A0A3ED');
        $this->addSql('ALTER TABLE si_file DROP FOREIGN KEY FK_788FFA4CA870E3EA');
        $this->addSql('ALTER TABLE content_si_file DROP FOREIGN KEY FK_A78723FF8C95266A');
        $this->addSql('DROP TABLE edition');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE content_si_file');
        $this->addSql('DROP TABLE si_file');
    }
}
