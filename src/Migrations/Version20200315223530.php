<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200315223530 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE artist_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, nationality VARCHAR(45) DEFAULT NULL, residence VARCHAR(45) DEFAULT NULL, birth_date DATE DEFAULT NULL, story LONGTEXT DEFAULT NULL, details LONGTEXT DEFAULT NULL, created_by VARCHAR(25) DEFAULT NULL, create_date DATE DEFAULT NULL, updated_by VARCHAR(25) DEFAULT NULL, update_date DATE DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, linkedin VARCHAR(255) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_translation_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, nationality VARCHAR(45) NOT NULL, residence VARCHAR(45) NOT NULL, art_type VARCHAR(255) NOT NULL, story LONGTEXT DEFAULT NULL, details LONGTEXT DEFAULT NULL, origin_id INT NOT NULL, language VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE art_type_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, history LONGTEXT NOT NULL, created_by VARCHAR(25) DEFAULT NULL, create_date DATE DEFAULT NULL, updated_by VARCHAR(25) DEFAULT NULL, update_date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auction_client_entity (id INT AUTO_INCREMENT NOT NULL, auction_id INT NOT NULL, client_id INT NOT NULL, application_date DATE DEFAULT NULL, state TINYINT(1) DEFAULT NULL, INDEX IDX_7C75A80A57B8F0DE (auction_id), INDEX IDX_7C75A80A19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auction_entity (id INT AUTO_INCREMENT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, name VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auction_painting_entity (id INT AUTO_INCREMENT NOT NULL, painting_id INT NOT NULL, auction_id INT NOT NULL, client_id INT DEFAULT NULL, start_price NUMERIC(10, 0) NOT NULL, final_price NUMERIC(10, 0) DEFAULT NULL, highiest_price NUMERIC(10, 0) DEFAULT NULL, UNIQUE INDEX UNIQ_1F38BC90B00EB939 (painting_id), UNIQUE INDEX UNIQ_1F38BC9057B8F0DE (auction_id), INDEX IDX_1F38BC9019EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clap_entity (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, entity_id INT NOT NULL, row INT NOT NULL, value INT NOT NULL, date DATETIME DEFAULT NULL, INDEX IDX_E455DDC919EB6921 (client_id), INDEX IDX_E455DDC981257D5D (entity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_entity (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) DEFAULT NULL, password VARCHAR(500) NOT NULL, is_active TINYINT(1) NOT NULL, email VARCHAR(190) NOT NULL, full_name VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', created_by VARCHAR(255) DEFAULT NULL, create_date DATETIME DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, update_date DATETIME DEFAULT NULL, birth_date DATE DEFAULT NULL, google TINYINT(1) NOT NULL, language VARCHAR(7) DEFAULT NULL, UNIQUE INDEX UNIQ_5B8E0FDBE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment_entity (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, entity_id INT NOT NULL, row INT NOT NULL, body LONGTEXT NOT NULL, date DATETIME DEFAULT CURRENT_TIMESTAMP, last_edit DATETIME DEFAULT CURRENT_TIMESTAMP, spacial TINYINT(1) NOT NULL, INDEX IDX_C43B1C7A19EB6921 (client_id), INDEX IDX_C43B1C7A81257D5D (entity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entity_art_type_entity (id INT AUTO_INCREMENT NOT NULL, art_type_id INT NOT NULL, entity_id INT NOT NULL, row INT NOT NULL, INDEX IDX_261826B371088DEF (art_type_id), INDEX IDX_261826B381257D5D (entity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entity_interaction_entity (id INT AUTO_INCREMENT NOT NULL, interaction_id INT NOT NULL, entity_id INT NOT NULL, client_id INT DEFAULT NULL, row INT NOT NULL, date DATETIME DEFAULT NULL, INDEX IDX_636E1C29886DEE8F (interaction_id), INDEX IDX_636E1C2981257D5D (entity_id), INDEX IDX_636E1C2919EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entity_media_entity (id INT AUTO_INCREMENT NOT NULL, entity_id INT NOT NULL, media_id INT NOT NULL, name VARCHAR(45) DEFAULT NULL, path VARCHAR(255) NOT NULL, row INT NOT NULL, created_by VARCHAR(45) DEFAULT NULL, created_date DATETIME DEFAULT NULL, updated_by VARCHAR(25) DEFAULT NULL, update_date DATETIME DEFAULT NULL, thumb_image VARCHAR(255) DEFAULT NULL, INDEX IDX_AD09678281257D5D (entity_id), INDEX IDX_AD096782EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorite_entity (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, painting_id INT NOT NULL, INDEX IDX_329D289219EB6921 (client_id), INDEX IDX_329D2892B00EB939 (painting_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery_entity (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, name VARCHAR(45) NOT NULL, date DATE DEFAULT NULL, place VARCHAR(45) DEFAULT NULL, INDEX IDX_ACABA8CAB7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interaction_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE painting_entity (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, gallery_id INT DEFAULT NULL, name VARCHAR(45) NOT NULL, state TINYINT(1) NOT NULL, colors_type VARCHAR(45) NOT NULL, key_words LONGTEXT NOT NULL, height NUMERIC(6, 0) NOT NULL, width NUMERIC(6, 0) NOT NULL, active TINYINT(1) DEFAULT NULL, image VARCHAR(255) NOT NULL, created_by VARCHAR(25) DEFAULT NULL, create_date DATE DEFAULT NULL, updeted_by VARCHAR(25) DEFAULT NULL, update_date DATE DEFAULT NULL, signed VARCHAR(65) DEFAULT NULL, is_featured TINYINT(1) DEFAULT NULL, thumb_image VARCHAR(255) DEFAULT NULL, INDEX IDX_CFA9597EB7970CF8 (artist_id), INDEX IDX_CFA9597E4E7AF8F (gallery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE painting_transaction_entity (id INT AUTO_INCREMENT NOT NULL, painting_id INT NOT NULL, client_id INT NOT NULL, date DATETIME NOT NULL, price NUMERIC(10, 0) NOT NULL, details VARCHAR(45) DEFAULT NULL, INDEX IDX_586982CCB00EB939 (painting_id), INDEX IDX_586982CC19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE painting_translation_entity (id INT AUTO_INCREMENT NOT NULL, origin_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, created_by VARCHAR(25) DEFAULT NULL, create_date DATE DEFAULT NULL, updeted_by VARCHAR(25) DEFAULT NULL, update_date DATE DEFAULT NULL, language VARCHAR(10) NOT NULL, artist VARCHAR(255) NOT NULL, key_words LONGTEXT DEFAULT NULL, art_type VARCHAR(300) NOT NULL, colors_type VARCHAR(255) DEFAULT NULL, story LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE price_entity (id INT AUTO_INCREMENT NOT NULL, entity_id INT NOT NULL, price NUMERIC(10, 0) NOT NULL, created_date DATETIME DEFAULT CURRENT_TIMESTAMP, row INT NOT NULL, INDEX IDX_43B1EC3881257D5D (entity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE report_entity (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, email_id INT NOT NULL, sending_date DATE NOT NULL, status TINYINT(1) NOT NULL, email_data LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_27DB91F7B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statue_entity (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, name VARCHAR(45) NOT NULL, length NUMERIC(6, 0) NOT NULL, height NUMERIC(6, 0) NOT NULL, width NUMERIC(6, 0) NOT NULL, material VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, style VARCHAR(50) DEFAULT NULL, period VARCHAR(45) DEFAULT NULL, weight NUMERIC(6, 0) DEFAULT NULL, mediums VARCHAR(55) DEFAULT NULL, features VARCHAR(75) DEFAULT NULL, image VARCHAR(255) NOT NULL, active TINYINT(1) DEFAULT NULL, key_word VARCHAR(255) DEFAULT NULL, create_date DATETIME DEFAULT NULL, created_by VARCHAR(45) DEFAULT NULL, updated_date DATETIME DEFAULT NULL, updated_by VARCHAR(45) DEFAULT NULL, state TINYINT(1) DEFAULT NULL, INDEX IDX_9B6D489B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE story_entity (id INT AUTO_INCREMENT NOT NULL, entity_id INT NOT NULL, story LONGTEXT NOT NULL, row INT NOT NULL, INDEX IDX_412BF69A81257D5D (entity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auction_client_entity ADD CONSTRAINT FK_7C75A80A57B8F0DE FOREIGN KEY (auction_id) REFERENCES auction_entity (id)');
        $this->addSql('ALTER TABLE auction_client_entity ADD CONSTRAINT FK_7C75A80A19EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE auction_painting_entity ADD CONSTRAINT FK_1F38BC90B00EB939 FOREIGN KEY (painting_id) REFERENCES painting_entity (id)');
        $this->addSql('ALTER TABLE auction_painting_entity ADD CONSTRAINT FK_1F38BC9057B8F0DE FOREIGN KEY (auction_id) REFERENCES auction_entity (id)');
        $this->addSql('ALTER TABLE auction_painting_entity ADD CONSTRAINT FK_1F38BC9019EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE clap_entity ADD CONSTRAINT FK_E455DDC919EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE clap_entity ADD CONSTRAINT FK_E455DDC981257D5D FOREIGN KEY (entity_id) REFERENCES entity (id)');
        $this->addSql('ALTER TABLE comment_entity ADD CONSTRAINT FK_C43B1C7A19EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE comment_entity ADD CONSTRAINT FK_C43B1C7A81257D5D FOREIGN KEY (entity_id) REFERENCES entity (id)');
        $this->addSql('ALTER TABLE entity_art_type_entity ADD CONSTRAINT FK_261826B371088DEF FOREIGN KEY (art_type_id) REFERENCES art_type_entity (id)');
        $this->addSql('ALTER TABLE entity_art_type_entity ADD CONSTRAINT FK_261826B381257D5D FOREIGN KEY (entity_id) REFERENCES entity (id)');
        $this->addSql('ALTER TABLE entity_interaction_entity ADD CONSTRAINT FK_636E1C29886DEE8F FOREIGN KEY (interaction_id) REFERENCES interaction_entity (id)');
        $this->addSql('ALTER TABLE entity_interaction_entity ADD CONSTRAINT FK_636E1C2981257D5D FOREIGN KEY (entity_id) REFERENCES entity (id)');
        $this->addSql('ALTER TABLE entity_interaction_entity ADD CONSTRAINT FK_636E1C2919EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE entity_media_entity ADD CONSTRAINT FK_AD09678281257D5D FOREIGN KEY (entity_id) REFERENCES entity (id)');
        $this->addSql('ALTER TABLE entity_media_entity ADD CONSTRAINT FK_AD096782EA9FDD75 FOREIGN KEY (media_id) REFERENCES media_entity (id)');
        $this->addSql('ALTER TABLE favorite_entity ADD CONSTRAINT FK_329D289219EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE favorite_entity ADD CONSTRAINT FK_329D2892B00EB939 FOREIGN KEY (painting_id) REFERENCES painting_entity (id)');
        $this->addSql('ALTER TABLE gallery_entity ADD CONSTRAINT FK_ACABA8CAB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE painting_entity ADD CONSTRAINT FK_CFA9597EB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE painting_entity ADD CONSTRAINT FK_CFA9597E4E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery_entity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE painting_transaction_entity ADD CONSTRAINT FK_586982CCB00EB939 FOREIGN KEY (painting_id) REFERENCES painting_entity (id)');
        $this->addSql('ALTER TABLE painting_transaction_entity ADD CONSTRAINT FK_586982CC19EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE price_entity ADD CONSTRAINT FK_43B1EC3881257D5D FOREIGN KEY (entity_id) REFERENCES entity (id)');
        $this->addSql('ALTER TABLE report_entity ADD CONSTRAINT FK_27DB91F7B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE statue_entity ADD CONSTRAINT FK_9B6D489B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE story_entity ADD CONSTRAINT FK_412BF69A81257D5D FOREIGN KEY (entity_id) REFERENCES entity (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gallery_entity DROP FOREIGN KEY FK_ACABA8CAB7970CF8');
        $this->addSql('ALTER TABLE painting_entity DROP FOREIGN KEY FK_CFA9597EB7970CF8');
        $this->addSql('ALTER TABLE report_entity DROP FOREIGN KEY FK_27DB91F7B7970CF8');
        $this->addSql('ALTER TABLE statue_entity DROP FOREIGN KEY FK_9B6D489B7970CF8');
        $this->addSql('ALTER TABLE entity_art_type_entity DROP FOREIGN KEY FK_261826B371088DEF');
        $this->addSql('ALTER TABLE auction_client_entity DROP FOREIGN KEY FK_7C75A80A57B8F0DE');
        $this->addSql('ALTER TABLE auction_painting_entity DROP FOREIGN KEY FK_1F38BC9057B8F0DE');
        $this->addSql('ALTER TABLE auction_client_entity DROP FOREIGN KEY FK_7C75A80A19EB6921');
        $this->addSql('ALTER TABLE auction_painting_entity DROP FOREIGN KEY FK_1F38BC9019EB6921');
        $this->addSql('ALTER TABLE clap_entity DROP FOREIGN KEY FK_E455DDC919EB6921');
        $this->addSql('ALTER TABLE comment_entity DROP FOREIGN KEY FK_C43B1C7A19EB6921');
        $this->addSql('ALTER TABLE entity_interaction_entity DROP FOREIGN KEY FK_636E1C2919EB6921');
        $this->addSql('ALTER TABLE favorite_entity DROP FOREIGN KEY FK_329D289219EB6921');
        $this->addSql('ALTER TABLE painting_transaction_entity DROP FOREIGN KEY FK_586982CC19EB6921');
        $this->addSql('ALTER TABLE clap_entity DROP FOREIGN KEY FK_E455DDC981257D5D');
        $this->addSql('ALTER TABLE comment_entity DROP FOREIGN KEY FK_C43B1C7A81257D5D');
        $this->addSql('ALTER TABLE entity_art_type_entity DROP FOREIGN KEY FK_261826B381257D5D');
        $this->addSql('ALTER TABLE entity_interaction_entity DROP FOREIGN KEY FK_636E1C2981257D5D');
        $this->addSql('ALTER TABLE entity_media_entity DROP FOREIGN KEY FK_AD09678281257D5D');
        $this->addSql('ALTER TABLE price_entity DROP FOREIGN KEY FK_43B1EC3881257D5D');
        $this->addSql('ALTER TABLE story_entity DROP FOREIGN KEY FK_412BF69A81257D5D');
        $this->addSql('ALTER TABLE painting_entity DROP FOREIGN KEY FK_CFA9597E4E7AF8F');
        $this->addSql('ALTER TABLE entity_interaction_entity DROP FOREIGN KEY FK_636E1C29886DEE8F');
        $this->addSql('ALTER TABLE entity_media_entity DROP FOREIGN KEY FK_AD096782EA9FDD75');
        $this->addSql('ALTER TABLE auction_painting_entity DROP FOREIGN KEY FK_1F38BC90B00EB939');
        $this->addSql('ALTER TABLE favorite_entity DROP FOREIGN KEY FK_329D2892B00EB939');
        $this->addSql('ALTER TABLE painting_transaction_entity DROP FOREIGN KEY FK_586982CCB00EB939');
        $this->addSql('DROP TABLE artist_entity');
        $this->addSql('DROP TABLE artist_translation_entity');
        $this->addSql('DROP TABLE art_type_entity');
        $this->addSql('DROP TABLE auction_client_entity');
        $this->addSql('DROP TABLE auction_entity');
        $this->addSql('DROP TABLE auction_painting_entity');
        $this->addSql('DROP TABLE clap_entity');
        $this->addSql('DROP TABLE client_entity');
        $this->addSql('DROP TABLE comment_entity');
        $this->addSql('DROP TABLE entity');
        $this->addSql('DROP TABLE entity_art_type_entity');
        $this->addSql('DROP TABLE entity_interaction_entity');
        $this->addSql('DROP TABLE entity_media_entity');
        $this->addSql('DROP TABLE favorite_entity');
        $this->addSql('DROP TABLE gallery_entity');
        $this->addSql('DROP TABLE interaction_entity');
        $this->addSql('DROP TABLE media_entity');
        $this->addSql('DROP TABLE painting_entity');
        $this->addSql('DROP TABLE painting_transaction_entity');
        $this->addSql('DROP TABLE painting_translation_entity');
        $this->addSql('DROP TABLE price_entity');
        $this->addSql('DROP TABLE report_entity');
        $this->addSql('DROP TABLE statue_entity');
        $this->addSql('DROP TABLE story_entity');
    }
}
