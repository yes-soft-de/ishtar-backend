<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190806112750 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, painting_id_id INT NOT NULL, artist_id_id INT NOT NULL, url VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_7CC7DA2C9F442369 (painting_id_id), INDEX IDX_7CC7DA2C1F48AE04 (artist_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C9F442369 FOREIGN KEY (painting_id_id) REFERENCES painting (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C1F48AE04 FOREIGN KEY (artist_id_id) REFERENCES artist_entity (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE video');
    }
}
