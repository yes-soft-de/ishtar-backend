<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200224171931 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE report_entity (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, email_id INT NOT NULL, sending_date DATE NOT NULL, status TINYINT(1) NOT NULL, email_data LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_27DB91F7B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE report_entity ADD CONSTRAINT FK_27DB91F7B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
        $this->addSql('DROP TABLE painting_transaction_entity');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('ALTER TABLE client_entity CHANGE google google TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE comment_entity CHANGE date date DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE last_edit last_edit DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE entity_interaction_entity CHANGE date date DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE painting_transaction_entity (id INT AUTO_INCREMENT NOT NULL, painting_id INT NOT NULL, client_id INT NOT NULL, date DATETIME NOT NULL, price NUMERIC(10, 0) NOT NULL, details VARCHAR(45) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_586982CC19EB6921 (client_id), INDEX IDX_586982CCB00EB939 (painting_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, username VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE painting_transaction_entity ADD CONSTRAINT FK_586982CC19EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE painting_transaction_entity ADD CONSTRAINT FK_586982CCB00EB939 FOREIGN KEY (painting_id) REFERENCES painting_entity (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE report_entity');
        $this->addSql('ALTER TABLE client_entity CHANGE google google TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE comment_entity CHANGE date date DATETIME DEFAULT NULL, CHANGE last_edit last_edit DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE entity_interaction_entity CHANGE date date DATETIME NOT NULL');
    }
}
