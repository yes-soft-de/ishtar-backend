<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190814102059 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE clap_entity (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, page_name VARCHAR(25) NOT NULL, row_num INT NOT NULL, value INT NOT NULL, INDEX IDX_E455DDC919EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment_entity (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, page_name VARCHAR(25) NOT NULL, row_num INT NOT NULL, body LONGTEXT NOT NULL, date DATETIME NOT NULL, last_edit DATETIME NOT NULL, INDEX IDX_C43B1C7A19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_entity (id INT AUTO_INCREMENT NOT NULL, painting_id INT NOT NULL, artist_id INT NOT NULL, url VARCHAR(255) NOT NULL, adding_date DATETIME NOT NULL, INDEX IDX_A1351AA0B00EB939 (painting_id), INDEX IDX_A1351AA0B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE painting_transaction_entity (id INT AUTO_INCREMENT NOT NULL, painting_id INT NOT NULL, client_id INT NOT NULL, date DATETIME NOT NULL, price NUMERIC(10, 0) NOT NULL, INDEX IDX_586982CCB00EB939 (painting_id), INDEX IDX_586982CC19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_entity (id INT AUTO_INCREMENT NOT NULL, painting_id INT NOT NULL, artist_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, adding_date DATETIME NOT NULL, INDEX IDX_367FE4A5B00EB939 (painting_id), INDEX IDX_367FE4A5B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clap_entity ADD CONSTRAINT FK_E455DDC919EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE comment_entity ADD CONSTRAINT FK_C43B1C7A19EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE image_entity ADD CONSTRAINT FK_A1351AA0B00EB939 FOREIGN KEY (painting_id) REFERENCES painting_entity (id)');
        $this->addSql('ALTER TABLE image_entity ADD CONSTRAINT FK_A1351AA0B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE painting_transaction_entity ADD CONSTRAINT FK_586982CCB00EB939 FOREIGN KEY (painting_id) REFERENCES painting_entity (id)');
        $this->addSql('ALTER TABLE painting_transaction_entity ADD CONSTRAINT FK_586982CC19EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE video_entity ADD CONSTRAINT FK_367FE4A5B00EB939 FOREIGN KEY (painting_id) REFERENCES painting_entity (id)');
        $this->addSql('ALTER TABLE video_entity ADD CONSTRAINT FK_367FE4A5B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE clap_entity');
        $this->addSql('DROP TABLE comment_entity');
        $this->addSql('DROP TABLE image_entity');
        $this->addSql('DROP TABLE painting_transaction_entity');
        $this->addSql('DROP TABLE video_entity');
    }
}
