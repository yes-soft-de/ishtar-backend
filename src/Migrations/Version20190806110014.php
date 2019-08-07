<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190806110014 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE painting (id INT AUTO_INCREMENT NOT NULL, artist_id INT DEFAULT NULL, art_type_id INT DEFAULT NULL, relation_id INT NOT NULL, name VARCHAR(45) NOT NULL, state TINYINT(1) NOT NULL, dimensions VARCHAR(45) NOT NULL, colors_type VARCHAR(45) DEFAULT NULL, price NUMERIC(8, 6) NOT NULL, story LONGTEXT NOT NULL, adding_date DATETIME DEFAULT NULL, string VARCHAR(45) NOT NULL, INDEX IDX_66B9EBA0B7970CF8 (artist_id), INDEX IDX_66B9EBA071088DEF (art_type_id), INDEX IDX_66B9EBA03256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE painting ADD CONSTRAINT FK_66B9EBA0B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE painting ADD CONSTRAINT FK_66B9EBA071088DEF FOREIGN KEY (art_type_id) REFERENCES art_type (id)');
        $this->addSql('ALTER TABLE painting ADD CONSTRAINT FK_66B9EBA03256915B FOREIGN KEY (relation_id) REFERENCES artist_entity (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE painting');
    }
}
