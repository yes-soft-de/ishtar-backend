<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190902163054 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE auction_client_entity (id INT AUTO_INCREMENT NOT NULL, auction_id INT NOT NULL, client_id INT NOT NULL, application_date DATE DEFAULT NULL, state TINYINT(1) DEFAULT NULL, INDEX IDX_7C75A80A57B8F0DE (auction_id), INDEX IDX_7C75A80A19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entity_art_type_entity (id INT AUTO_INCREMENT NOT NULL, art_type_id INT NOT NULL, entity_id INT NOT NULL, row INT NOT NULL, INDEX IDX_261826B371088DEF (art_type_id), INDEX IDX_261826B381257D5D (entity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entity_interaction_entity (id INT AUTO_INCREMENT NOT NULL, interaction_id INT NOT NULL, entity_id INT NOT NULL, client_id INT NOT NULL, row INT NOT NULL, INDEX IDX_636E1C29886DEE8F (interaction_id), INDEX IDX_636E1C2981257D5D (entity_id), INDEX IDX_636E1C2919EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entity_media_entity (id INT AUTO_INCREMENT NOT NULL, entity_id INT NOT NULL, media_id INT NOT NULL, name VARCHAR(45) DEFAULT NULL, path VARCHAR(45) NOT NULL, row INT NOT NULL, created_by VARCHAR(45) DEFAULT NULL, created_date DATETIME DEFAULT NULL, updated_by VARCHAR(25) DEFAULT NULL, update_date DATETIME DEFAULT NULL, INDEX IDX_AD09678281257D5D (entity_id), INDEX IDX_AD096782EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorite_entity (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, painting_id INT NOT NULL, INDEX IDX_329D289219EB6921 (client_id), INDEX IDX_329D2892B00EB939 (painting_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery_entity (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, name VARCHAR(45) NOT NULL, date DATE DEFAULT NULL, place VARCHAR(45) DEFAULT NULL, INDEX IDX_ACABA8CAB7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE price_entity (id INT AUTO_INCREMENT NOT NULL, painting_id INT NOT NULL, price NUMERIC(10, 0) NOT NULL, created_date DATETIME NOT NULL, INDEX IDX_43B1EC38B00EB939 (painting_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_media_artist_entity (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, social_media_id INT NOT NULL, address VARCHAR(45) NOT NULL, UNIQUE INDEX UNIQ_2370004DB7970CF8 (artist_id), UNIQUE INDEX UNIQ_2370004D64AE4959 (social_media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_media_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auction_client_entity ADD CONSTRAINT FK_7C75A80A57B8F0DE FOREIGN KEY (auction_id) REFERENCES auction_entity (id)');
        $this->addSql('ALTER TABLE auction_client_entity ADD CONSTRAINT FK_7C75A80A19EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
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
        $this->addSql('ALTER TABLE price_entity ADD CONSTRAINT FK_43B1EC38B00EB939 FOREIGN KEY (painting_id) REFERENCES painting_entity (id)');
        $this->addSql('ALTER TABLE social_media_artist_entity ADD CONSTRAINT FK_2370004DB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE social_media_artist_entity ADD CONSTRAINT FK_2370004D64AE4959 FOREIGN KEY (social_media_id) REFERENCES social_media_entity (id)');
        $this->addSql('DROP TABLE artist_art_type_entity');
                }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clap_entity DROP FOREIGN KEY FK_E455DDC981257D5D');
        $this->addSql('ALTER TABLE entity_art_type_entity DROP FOREIGN KEY FK_261826B381257D5D');
        $this->addSql('ALTER TABLE entity_interaction_entity DROP FOREIGN KEY FK_636E1C2981257D5D');
        $this->addSql('ALTER TABLE entity_media_entity DROP FOREIGN KEY FK_AD09678281257D5D');
        $this->addSql('ALTER TABLE entity_media_entity DROP FOREIGN KEY FK_AD096782EA9FDD75');
        $this->addSql('ALTER TABLE social_media_artist_entity DROP FOREIGN KEY FK_2370004D64AE4959');
        $this->addSql('CREATE TABLE artist_art_type_entity (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, art_type_id INT NOT NULL, UNIQUE INDEX UNIQ_F5C603E4B7970CF8 (artist_id), UNIQUE INDEX UNIQ_F5C603E471088DEF (art_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE artist_art_type_entity ADD CONSTRAINT FK_F5C603E471088DEF FOREIGN KEY (art_type_id) REFERENCES art_type_entity (id)');
        $this->addSql('ALTER TABLE artist_art_type_entity ADD CONSTRAINT FK_F5C603E4B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
        $this->addSql('DROP TABLE auction_client_entity');
        $this->addSql('DROP TABLE entity');
        $this->addSql('DROP TABLE entity_art_type_entity');
        $this->addSql('DROP TABLE entity_interaction_entity');
        $this->addSql('DROP TABLE entity_media_entity');
        $this->addSql('DROP TABLE favorite_entity');
        $this->addSql('DROP TABLE gallery_entity');
        $this->addSql('DROP TABLE media_entity');
        $this->addSql('DROP TABLE price_entity');
        $this->addSql('DROP TABLE social_media_artist_entity');
        $this->addSql('DROP TABLE social_media_entity');
        $this->addSql('ALTER TABLE art_type_entity ADD image VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, ADD video VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE artist_entity ADD image VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD video VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD facebook VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD instagram VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD twitter VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD linkedin VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE auction_entity DROP name');
        $this->addSql('ALTER TABLE auction_painting_entity DROP FOREIGN KEY FK_1F38BC9019EB6921');
        $this->addSql('DROP INDEX IDX_1F38BC9019EB6921 ON auction_painting_entity');
        $this->addSql('ALTER TABLE auction_painting_entity DROP client_id, DROP highiest_price');
        $this->addSql('DROP INDEX IDX_E455DDC981257D5D ON clap_entity');
        $this->addSql('ALTER TABLE clap_entity ADD page_name VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci, DROP entity_id');
        $this->addSql('ALTER TABLE client_entity ADD name VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, DROP fisrt_name, DROP last_name, DROP phone, DROP roll, DROP created_by, DROP create_date, DROP updated_by, DROP update_date');
        $this->addSql('ALTER TABLE image_entity CHANGE artist_id artist_id INT NOT NULL');
    }
}
