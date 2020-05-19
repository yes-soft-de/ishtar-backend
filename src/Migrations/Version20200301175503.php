<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200301175503 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE payment_entity (id INT AUTO_INCREMENT NOT NULL, order_id INT DEFAULT NULL, payment_id VARCHAR(255) NOT NULL, payer_id VARCHAR(255) NOT NULL, transaction VARCHAR(255) DEFAULT NULL, payment_amount NUMERIC(10, 0) DEFAULT NULL, payment_state VARCHAR(255) DEFAULT NULL, invoice VARCHAR(255) DEFAULT NULL, created_date DATETIME DEFAULT NULL, updated_date DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_2B10DFFE8D9F6D38 (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE payment_entity ADD CONSTRAINT FK_2B10DFFE8D9F6D38 FOREIGN KEY (order_id) REFERENCES order_entity (id)');
        $this->addSql('ALTER TABLE painting_entity CHANGE state state SMALLINT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE payment_entity');
        $this->addSql('ALTER TABLE painting_entity CHANGE state state TINYINT(1) NOT NULL');
    }
}
