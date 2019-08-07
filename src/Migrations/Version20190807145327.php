<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190807145327 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE painting DROP FOREIGN KEY FK_66B9EBA071088DEF');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F9F442369');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C9F442369');
        $this->addSql('CREATE TABLE art_type_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, history LONGTEXT NOT NULL, story LONGTEXT NOT NULL, image VARCHAR(45) NOT NULL, video VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE painting_entity (id INT AUTO_INCREMENT NOT NULL, artist_id INT DEFAULT NULL, art_type_id INT DEFAULT NULL, relation_id INT NOT NULL, name VARCHAR(45) NOT NULL, state TINYINT(1) NOT NULL, dimensions VARCHAR(45) NOT NULL, colors_type VARCHAR(45) DEFAULT NULL, price NUMERIC(8, 6) NOT NULL, story LONGTEXT NOT NULL, adding_date DATETIME DEFAULT NULL, INDEX IDX_CFA9597EB7970CF8 (artist_id), INDEX IDX_CFA9597E71088DEF (art_type_id), INDEX IDX_CFA9597E3256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panting_image_entity (id INT AUTO_INCREMENT NOT NULL, painting_id_id INT NOT NULL, artist_id_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, date DATETIME DEFAULT NULL, INDEX IDX_C35E2C199F442369 (painting_id_id), INDEX IDX_C35E2C191F48AE04 (artist_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_entity (id INT AUTO_INCREMENT NOT NULL, painting_id_id INT NOT NULL, artist_id_id INT NOT NULL, url VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_367FE4A59F442369 (painting_id_id), INDEX IDX_367FE4A51F48AE04 (artist_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE painting_entity ADD CONSTRAINT FK_CFA9597EB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE painting_entity ADD CONSTRAINT FK_CFA9597E71088DEF FOREIGN KEY (art_type_id) REFERENCES art_type_entity (id)');
        $this->addSql('ALTER TABLE painting_entity ADD CONSTRAINT FK_CFA9597E3256915B FOREIGN KEY (relation_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE panting_image_entity ADD CONSTRAINT FK_C35E2C199F442369 FOREIGN KEY (painting_id_id) REFERENCES painting_entity (id)');
        $this->addSql('ALTER TABLE panting_image_entity ADD CONSTRAINT FK_C35E2C191F48AE04 FOREIGN KEY (artist_id_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE video_entity ADD CONSTRAINT FK_367FE4A59F442369 FOREIGN KEY (painting_id_id) REFERENCES painting_entity (id)');
        $this->addSql('ALTER TABLE video_entity ADD CONSTRAINT FK_367FE4A51F48AE04 FOREIGN KEY (artist_id_id) REFERENCES artist_entity (id)');
        $this->addSql('DROP TABLE art_type');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE painting');
        $this->addSql('DROP TABLE video');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE painting_entity DROP FOREIGN KEY FK_CFA9597E71088DEF');
        $this->addSql('ALTER TABLE panting_image_entity DROP FOREIGN KEY FK_C35E2C199F442369');
        $this->addSql('ALTER TABLE video_entity DROP FOREIGN KEY FK_367FE4A59F442369');
        $this->addSql('CREATE TABLE art_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, history LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, story LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, image VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, video VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, painting_id_id INT NOT NULL, artist_id_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, date DATETIME DEFAULT NULL, INDEX IDX_C53D045F1F48AE04 (artist_id_id), INDEX IDX_C53D045F9F442369 (painting_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE painting (id INT AUTO_INCREMENT NOT NULL, artist_id INT DEFAULT NULL, art_type_id INT DEFAULT NULL, relation_id INT NOT NULL, name VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, state TINYINT(1) NOT NULL, dimensions VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, colors_type VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci, price NUMERIC(8, 6) NOT NULL, story LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, adding_date DATETIME DEFAULT NULL, INDEX IDX_66B9EBA071088DEF (art_type_id), INDEX IDX_66B9EBA0B7970CF8 (artist_id), INDEX IDX_66B9EBA03256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, painting_id_id INT NOT NULL, artist_id_id INT NOT NULL, url VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, date DATETIME NOT NULL, INDEX IDX_7CC7DA2C1F48AE04 (artist_id_id), INDEX IDX_7CC7DA2C9F442369 (painting_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F1F48AE04 FOREIGN KEY (artist_id_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F9F442369 FOREIGN KEY (painting_id_id) REFERENCES painting (id)');
        $this->addSql('ALTER TABLE painting ADD CONSTRAINT FK_66B9EBA03256915B FOREIGN KEY (relation_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE painting ADD CONSTRAINT FK_66B9EBA071088DEF FOREIGN KEY (art_type_id) REFERENCES art_type (id)');
        $this->addSql('ALTER TABLE painting ADD CONSTRAINT FK_66B9EBA0B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C1F48AE04 FOREIGN KEY (artist_id_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C9F442369 FOREIGN KEY (painting_id_id) REFERENCES painting (id)');
        $this->addSql('DROP TABLE art_type_entity');
        $this->addSql('DROP TABLE painting_entity');
        $this->addSql('DROP TABLE panting_image_entity');
        $this->addSql('DROP TABLE video_entity');
    }
}
