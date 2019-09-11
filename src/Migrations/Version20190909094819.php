<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190909094819 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE auction_painting_entity DROP INDEX painting_id_2, ADD UNIQUE INDEX UNIQ_1F38BC90B00EB939 (painting_id)');
        $this->addSql('DROP INDEX painting_id ON auction_painting_entity');
        $this->addSql('DROP INDEX painting_id_3 ON auction_painting_entity');
        $this->addSql('ALTER TABLE client_entity CHANGE fisrt_name first_name VARCHAR(45) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX painting_id ON auction_painting_entity (painting_id)');
        $this->addSql('CREATE UNIQUE INDEX painting_id_3 ON auction_painting_entity (painting_id)');
        $this->addSql('ALTER TABLE auction_painting_entity RENAME INDEX uniq_1f38bc90b00eb939 TO painting_id_2');
        $this->addSql('ALTER TABLE client_entity CHANGE first_name fisrt_name VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
