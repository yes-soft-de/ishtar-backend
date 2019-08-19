<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190813200935 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, user_name VARCHAR(45) NOT NULL, password VARCHAR(32) NOT NULL, email VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interaction_entity (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, page_name VARCHAR(25) NOT NULL, interaction_type VARCHAR(20) NOT NULL, row_num INT NOT NULL, INDEX IDX_F891F0F719EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE interaction_entity ADD CONSTRAINT FK_F891F0F719EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE interaction_entity DROP FOREIGN KEY FK_F891F0F719EB6921');
        $this->addSql('DROP TABLE client_entity');
        $this->addSql('DROP TABLE interaction_entity');
    }
}
