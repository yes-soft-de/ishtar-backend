<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190811213708 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE artist_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, nationality VARCHAR(45) DEFAULT NULL, residence VARCHAR(45) DEFAULT NULL, birth_date DATE DEFAULT NULL, story LONGTEXT DEFAULT NULL, details LONGTEXT DEFAULT NULL, image VARCHAR(45) DEFAULT NULL, video VARCHAR(45) DEFAULT NULL, facebook VARCHAR(45) DEFAULT NULL, instagram VARCHAR(45) DEFAULT NULL, twitter VARCHAR(45) DEFAULT NULL, linkedin VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE art_type_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, history LONGTEXT NOT NULL, story LONGTEXT NOT NULL, image VARCHAR(45) NOT NULL, video VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE painting_entity (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, art_type_id INT NOT NULL, name VARCHAR(45) NOT NULL, state TINYINT(1) NOT NULL, deminsions VARCHAR(45) NOT NULL, colors_type VARCHAR(45) NOT NULL, price NUMERIC(10, 0) NOT NULL, story LONGTEXT NOT NULL, adding_date DATETIME NOT NULL, INDEX IDX_CFA9597EB7970CF8 (artist_id), INDEX IDX_CFA9597E71088DEF (art_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE painting_entity ADD CONSTRAINT FK_CFA9597EB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE painting_entity ADD CONSTRAINT FK_CFA9597E71088DEF FOREIGN KEY (art_type_id) REFERENCES art_type_entity (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE painting_entity DROP FOREIGN KEY FK_CFA9597EB7970CF8');
        $this->addSql('ALTER TABLE painting_entity DROP FOREIGN KEY FK_CFA9597E71088DEF');
        $this->addSql('DROP TABLE artist_entity');
        $this->addSql('DROP TABLE art_type_entity');
        $this->addSql('DROP TABLE painting_entity');
    }
}
