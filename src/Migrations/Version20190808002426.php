<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190808002426 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE artist_art_type_entity (id INT AUTO_INCREMENT NOT NULL, artist_id_id INT NOT NULL, art_type_id_id INT NOT NULL, INDEX IDX_F5C603E41F48AE04 (artist_id_id), INDEX IDX_F5C603E444093CE8 (art_type_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, nationality VARCHAR(45) DEFAULT NULL, residence VARCHAR(45) DEFAULT NULL, birth_date DATE DEFAULT NULL, story LONGTEXT DEFAULT NULL, details LONGTEXT DEFAULT NULL, image VARCHAR(45) DEFAULT NULL, video VARCHAR(45) DEFAULT NULL, facebook VARCHAR(45) DEFAULT NULL, instagram VARCHAR(45) DEFAULT NULL, twitter VARCHAR(45) DEFAULT NULL, linkedin VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE art_type_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, history LONGTEXT NOT NULL, story LONGTEXT NOT NULL, image VARCHAR(45) NOT NULL, video VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auction_entity (id INT AUTO_INCREMENT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auction_painting_entity (id INT AUTO_INCREMENT NOT NULL, painting_id_id INT NOT NULL, start_price NUMERIC(8, 5) NOT NULL, final_price NUMERIC(8, 5) NOT NULL, INDEX IDX_1F38BC909F442369 (painting_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clap_entity (id INT AUTO_INCREMENT NOT NULL, client_id_id INT NOT NULL, page_name VARCHAR(25) NOT NULL, row_num INT NOT NULL, value INT NOT NULL, INDEX IDX_E455DDC9DC2902E0 (client_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, user_name VARCHAR(45) NOT NULL, password VARCHAR(32) NOT NULL, email VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment_entity (id INT AUTO_INCREMENT NOT NULL, client_id_id INT NOT NULL, page_name VARCHAR(25) NOT NULL, row_num INT NOT NULL, body LONGTEXT NOT NULL, date DATETIME NOT NULL, last_update DATETIME DEFAULT NULL, INDEX IDX_C43B1C7ADC2902E0 (client_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interaction_entity (id INT AUTO_INCREMENT NOT NULL, client_id_id INT NOT NULL, page_name VARCHAR(25) NOT NULL, row_num INT NOT NULL, interaction_type VARCHAR(20) NOT NULL, INDEX IDX_F891F0F7DC2902E0 (client_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE painting_entity (id INT AUTO_INCREMENT NOT NULL, artist_id INT DEFAULT NULL, art_type_id INT DEFAULT NULL, relation_id INT NOT NULL, name VARCHAR(45) NOT NULL, state TINYINT(1) NOT NULL, dimensions VARCHAR(45) NOT NULL, colors_type VARCHAR(45) DEFAULT NULL, price NUMERIC(8, 6) NOT NULL, story LONGTEXT NOT NULL, adding_date DATETIME DEFAULT NULL, INDEX IDX_CFA9597EB7970CF8 (artist_id), INDEX IDX_CFA9597E71088DEF (art_type_id), INDEX IDX_CFA9597E3256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE painting_transaction_entity (id INT AUTO_INCREMENT NOT NULL, painting_id_id INT NOT NULL, client_id_id INT NOT NULL, date DATETIME NOT NULL, price NUMERIC(8, 5) NOT NULL, INDEX IDX_586982CC9F442369 (painting_id_id), INDEX IDX_586982CCDC2902E0 (client_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panting_image_entity (id INT AUTO_INCREMENT NOT NULL, painting_id_id INT NOT NULL, artist_id_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, date DATETIME DEFAULT NULL, INDEX IDX_C35E2C199F442369 (painting_id_id), INDEX IDX_C35E2C191F48AE04 (artist_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_entity (id INT AUTO_INCREMENT NOT NULL, painting_id_id INT NOT NULL, artist_id_id INT NOT NULL, url VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_367FE4A59F442369 (painting_id_id), INDEX IDX_367FE4A51F48AE04 (artist_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist_art_type_entity ADD CONSTRAINT FK_F5C603E41F48AE04 FOREIGN KEY (artist_id_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE artist_art_type_entity ADD CONSTRAINT FK_F5C603E444093CE8 FOREIGN KEY (art_type_id_id) REFERENCES art_type_entity (id)');
        $this->addSql('ALTER TABLE auction_painting_entity ADD CONSTRAINT FK_1F38BC909F442369 FOREIGN KEY (painting_id_id) REFERENCES painting_entity (id)');
        $this->addSql('ALTER TABLE clap_entity ADD CONSTRAINT FK_E455DDC9DC2902E0 FOREIGN KEY (client_id_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE comment_entity ADD CONSTRAINT FK_C43B1C7ADC2902E0 FOREIGN KEY (client_id_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE interaction_entity ADD CONSTRAINT FK_F891F0F7DC2902E0 FOREIGN KEY (client_id_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE painting_entity ADD CONSTRAINT FK_CFA9597EB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE painting_entity ADD CONSTRAINT FK_CFA9597E71088DEF FOREIGN KEY (art_type_id) REFERENCES art_type_entity (id)');
        $this->addSql('ALTER TABLE painting_entity ADD CONSTRAINT FK_CFA9597E3256915B FOREIGN KEY (relation_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE painting_transaction_entity ADD CONSTRAINT FK_586982CC9F442369 FOREIGN KEY (painting_id_id) REFERENCES painting_entity (id)');
        $this->addSql('ALTER TABLE painting_transaction_entity ADD CONSTRAINT FK_586982CCDC2902E0 FOREIGN KEY (client_id_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE panting_image_entity ADD CONSTRAINT FK_C35E2C199F442369 FOREIGN KEY (painting_id_id) REFERENCES painting_entity (id)');
        $this->addSql('ALTER TABLE panting_image_entity ADD CONSTRAINT FK_C35E2C191F48AE04 FOREIGN KEY (artist_id_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE video_entity ADD CONSTRAINT FK_367FE4A59F442369 FOREIGN KEY (painting_id_id) REFERENCES painting_entity (id)');
        $this->addSql('ALTER TABLE video_entity ADD CONSTRAINT FK_367FE4A51F48AE04 FOREIGN KEY (artist_id_id) REFERENCES artist_entity (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artist_art_type_entity DROP FOREIGN KEY FK_F5C603E41F48AE04');
        $this->addSql('ALTER TABLE painting_entity DROP FOREIGN KEY FK_CFA9597EB7970CF8');
        $this->addSql('ALTER TABLE painting_entity DROP FOREIGN KEY FK_CFA9597E3256915B');
        $this->addSql('ALTER TABLE panting_image_entity DROP FOREIGN KEY FK_C35E2C191F48AE04');
        $this->addSql('ALTER TABLE video_entity DROP FOREIGN KEY FK_367FE4A51F48AE04');
        $this->addSql('ALTER TABLE artist_art_type_entity DROP FOREIGN KEY FK_F5C603E444093CE8');
        $this->addSql('ALTER TABLE painting_entity DROP FOREIGN KEY FK_CFA9597E71088DEF');
        $this->addSql('ALTER TABLE clap_entity DROP FOREIGN KEY FK_E455DDC9DC2902E0');
        $this->addSql('ALTER TABLE comment_entity DROP FOREIGN KEY FK_C43B1C7ADC2902E0');
        $this->addSql('ALTER TABLE interaction_entity DROP FOREIGN KEY FK_F891F0F7DC2902E0');
        $this->addSql('ALTER TABLE painting_transaction_entity DROP FOREIGN KEY FK_586982CCDC2902E0');
        $this->addSql('ALTER TABLE auction_painting_entity DROP FOREIGN KEY FK_1F38BC909F442369');
        $this->addSql('ALTER TABLE painting_transaction_entity DROP FOREIGN KEY FK_586982CC9F442369');
        $this->addSql('ALTER TABLE panting_image_entity DROP FOREIGN KEY FK_C35E2C199F442369');
        $this->addSql('ALTER TABLE video_entity DROP FOREIGN KEY FK_367FE4A59F442369');
        $this->addSql('DROP TABLE artist_art_type_entity');
        $this->addSql('DROP TABLE artist_entity');
        $this->addSql('DROP TABLE art_type_entity');
        $this->addSql('DROP TABLE auction_entity');
        $this->addSql('DROP TABLE auction_painting_entity');
        $this->addSql('DROP TABLE clap_entity');
        $this->addSql('DROP TABLE client_entity');
        $this->addSql('DROP TABLE comment_entity');
        $this->addSql('DROP TABLE interaction_entity');
        $this->addSql('DROP TABLE painting_entity');
        $this->addSql('DROP TABLE painting_transaction_entity');
        $this->addSql('DROP TABLE panting_image_entity');
        $this->addSql('DROP TABLE video_entity');
    }
}
