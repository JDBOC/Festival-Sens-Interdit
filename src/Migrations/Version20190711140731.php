<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190711140731 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()
                ->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql(
            'CREATE TABLE si_file (id INT AUTO_INCREMENT NOT NULL, picture_content_id INT DEFAULT NULL, 
                name VARCHAR(255) DEFAULT NULL, type INT NOT NULL, media_file_name VARCHAR(255) NOT NULL, 
                updated_at DATETIME NOT NULL, INDEX IDX_788FFA4CA870E3EA (picture_content_id),
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, logo_id INT DEFAULT NULL,
                link VARCHAR(255) DEFAULT NULL, type INT DEFAULT NULL, name VARCHAR(255) NOT NULL,
                UNIQUE INDEX UNIQ_312B3E16F98F144A (logo_id), 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL,
                password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76F85E0677 (username),
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE content (id INT AUTO_INCREMENT NOT NULL, edition_id INT DEFAULT NULL,
                cover_id INT DEFAULT NULL, thumbnail_id INT DEFAULT NULL, carousel_picture_id INT DEFAULT NULL,
                title_fr VARCHAR(255) NOT NULL, content_type INT NOT NULL, title_en VARCHAR(255) DEFAULT NULL,
                content_fr LONGTEXT DEFAULT NULL, content_en LONGTEXT DEFAULT NULL,
                country_fr VARCHAR(255) DEFAULT NULL, country_en VARCHAR(255) DEFAULT NULL,
                complete TINYINT(1) NOT NULL,
                translated TINYINT(1) NOT NULL, archive TINYINT(1) NOT NULL, duree VARCHAR(100) DEFAULT NULL,
                lieu VARCHAR(255) DEFAULT NULL, date VARCHAR(255) DEFAULT NULL,
                author VARCHAR(255) DEFAULT NULL, director VARCHAR(255) DEFAULT NULL,
                note VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL,
                top_article TINYINT(1) DEFAULT NULL, INDEX IDX_FEC530A974281A5E (edition_id),
                UNIQUE INDEX UNIQ_FEC530A9922726E9 (cover_id),
                UNIQUE INDEX UNIQ_FEC530A9FDFF2E92 (thumbnail_id),
                UNIQUE INDEX UNIQ_FEC530A966B05914 (carousel_picture_id),
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE content_si_file (content_id INT NOT NULL, si_file_id INT NOT NULL,
                INDEX IDX_A78723FF84A0A3ED (content_id),
                INDEX IDX_A78723FF8C95266A (si_file_id), PRIMARY KEY(content_id, si_file_id))
                DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE content_content (content_source INT NOT NULL, content_target INT NOT NULL,
                INDEX IDX_21CDE91A37BC0FDF (content_source),
                INDEX IDX_21CDE91A2E595F50 (content_target), PRIMARY KEY(content_source, content_target))
                DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE tarif (id INT AUTO_INCREMENT NOT NULL, pass_festival INT DEFAULT NULL,
                pass_jeune INT DEFAULT NULL, plein_tarif INT DEFAULT NULL, reduce INT DEFAULT NULL,
                jeune INT DEFAULT NULL, rsa INT DEFAULT NULL, grille INT NOT NULL,
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE tarif_session (tarif_id INT NOT NULL, session_id INT NOT NULL,
                INDEX IDX_A325A791357C0A59 (tarif_id), INDEX IDX_A325A791613FECDF (session_id),
                PRIMARY KEY(tarif_id, session_id)) DEFAULT CHARACTER SET utf8mb4
                COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, content_id INT NOT NULL,
                session_date DATETIME NOT NULL, location VARCHAR(255) DEFAULT NULL, mapado_link VARCHAR(255)
                DEFAULT NULL, INDEX IDX_D044D5D484A0A3ED (content_id),
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE edition (id INT AUTO_INCREMENT NOT NULL, edition_picture_id INT DEFAULT NULL,
                name VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL,
                status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_A891181F203F1692 (edition_picture_id),
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4
                COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, picture_id INT NOT NULL, name VARCHAR(255) NOT NULL,
                UNIQUE INDEX UNIQ_9775E708EE45BDBF (picture_id), PRIMARY KEY(id))
                DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'CREATE TABLE theme_content (theme_id INT NOT NULL, content_id INT NOT NULL,
                INDEX IDX_A7A6358A59027487 (theme_id), INDEX IDX_A7A6358A84A0A3ED (content_id),
                PRIMARY KEY(theme_id, content_id)) DEFAULT CHARACTER SET utf8mb4
                COLLATE utf8mb4_unicode_ci ENGINE = InnoDB'
        );

        $this->addSql(
            'ALTER TABLE si_file ADD CONSTRAINT FK_788FFA4CA870E3EA
                FOREIGN KEY (picture_content_id) REFERENCES content (id)'
        );

        $this->addSql(
            'ALTER TABLE partner ADD CONSTRAINT FK_312B3E16F98F144A FOREIGN KEY (logo_id) REFERENCES si_file (id)'
        );

        $this->addSql(
            'ALTER TABLE content ADD CONSTRAINT FK_FEC530A974281A5E FOREIGN KEY (edition_id) REFERENCES edition (id)'
        );

        $this->addSql(
            'ALTER TABLE content ADD CONSTRAINT FK_FEC530A9922726E9 FOREIGN KEY (cover_id) REFERENCES si_file (id)'
        );

        $this->addSql(
            'ALTER TABLE content ADD CONSTRAINT FK_FEC530A9FDFF2E92 FOREIGN KEY (thumbnail_id) REFERENCES si_file (id)'
        );

        $this->addSql(
            'ALTER TABLE content ADD CONSTRAINT FK_FEC530A966B05914
                FOREIGN KEY (carousel_picture_id) REFERENCES si_file (id)'
        );

        $this->addSql(
            'ALTER TABLE content_si_file ADD CONSTRAINT FK_A78723FF84A0A3ED
                FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE CASCADE'
        );

        $this->addSql(
            'ALTER TABLE content_si_file ADD CONSTRAINT FK_A78723FF8C95266A
                FOREIGN KEY (si_file_id) REFERENCES si_file (id) ON DELETE CASCADE'
        );

        $this->addSql(
            'ALTER TABLE content_content ADD CONSTRAINT FK_21CDE91A37BC0FDF
                FOREIGN KEY (content_source) REFERENCES content (id) ON DELETE CASCADE'
        );

        $this->addSql(
            'ALTER TABLE content_content ADD CONSTRAINT FK_21CDE91A2E595F50
                FOREIGN KEY (content_target) REFERENCES content (id) ON DELETE CASCADE'
        );

        $this->addSql(
            'ALTER TABLE tarif_session ADD CONSTRAINT FK_A325A791357C0A59
                FOREIGN KEY (tarif_id) REFERENCES tarif (id) ON DELETE CASCADE'
        );

        $this->addSql(
            'ALTER TABLE tarif_session ADD CONSTRAINT FK_A325A791613FECDF
                FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE'
        );

        $this->addSql(
            'ALTER TABLE session ADD CONSTRAINT FK_D044D5D484A0A3ED
                FOREIGN KEY (content_id) REFERENCES content (id)'
        );

        $this->addSql(
            'ALTER TABLE edition ADD CONSTRAINT FK_A891181F203F1692
                FOREIGN KEY (edition_picture_id) REFERENCES si_file (id)'
        );

        $this->addSql(
            'ALTER TABLE theme ADD CONSTRAINT FK_9775E708EE45BDBF FOREIGN KEY (picture_id) REFERENCES si_file (id)'
        );

        $this->addSql(
            'ALTER TABLE theme_content ADD CONSTRAINT FK_A7A6358A59027487
                FOREIGN KEY (theme_id) REFERENCES theme (id) ON DELETE CASCADE'
        );

        $this->addSql(
            'ALTER TABLE theme_content ADD CONSTRAINT FK_A7A6358A84A0A3ED
                FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE CASCADE'
        );
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('ALTER TABLE partner DROP FOREIGN KEY FK_312B3E16F98F144A');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9922726E9');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9FDFF2E92');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A966B05914');
        $this->addSql('ALTER TABLE content_si_file DROP FOREIGN KEY FK_A78723FF8C95266A');
        $this->addSql('ALTER TABLE edition DROP FOREIGN KEY FK_A891181F203F1692');
        $this->addSql('ALTER TABLE theme DROP FOREIGN KEY FK_9775E708EE45BDBF');
        $this->addSql('ALTER TABLE si_file DROP FOREIGN KEY FK_788FFA4CA870E3EA');
        $this->addSql('ALTER TABLE content_si_file DROP FOREIGN KEY FK_A78723FF84A0A3ED');
        $this->addSql('ALTER TABLE content_content DROP FOREIGN KEY FK_21CDE91A37BC0FDF');
        $this->addSql('ALTER TABLE content_content DROP FOREIGN KEY FK_21CDE91A2E595F50');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D484A0A3ED');
        $this->addSql('ALTER TABLE theme_content DROP FOREIGN KEY FK_A7A6358A84A0A3ED');
        $this->addSql('ALTER TABLE tarif_session DROP FOREIGN KEY FK_A325A791357C0A59');
        $this->addSql('ALTER TABLE tarif_session DROP FOREIGN KEY FK_A325A791613FECDF');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A974281A5E');
        $this->addSql('ALTER TABLE theme_content DROP FOREIGN KEY FK_A7A6358A59027487');
        $this->addSql('DROP TABLE si_file');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE content_si_file');
        $this->addSql('DROP TABLE content_content');
        $this->addSql('DROP TABLE tarif');
        $this->addSql('DROP TABLE tarif_session');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE edition');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE theme_content');
    }
}
