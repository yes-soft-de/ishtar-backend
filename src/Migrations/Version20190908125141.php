<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190908125141 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client_entity ADD birth_date DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE price_entity CHANGE created_date created_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE art_type_entity ADD story LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE auction_painting_entity RENAME INDEX uniq_1f38bc90b00eb939 TO painting_id_2');
        $this->addSql('ALTER TABLE client_entity DROP birth_date');
        $this->addSql('ALTER TABLE price_entity CHANGE created_date created_date DATETIME DEFAULT CURRENT_TIMESTAMP');
    }
}
