<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191130235756 extends AbstractMigration
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
        $this->addSql('DROP TABLE report');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, email_id INT NOT NULL, sending_date DATE NOT NULL, status TINYINT(1) NOT NULL, email_data LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', INDEX IDX_C42F7784B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
        $this->addSql('DROP TABLE report_entity');
    }
}
