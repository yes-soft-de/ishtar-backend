<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190902170433 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artist_entity DROP image, DROP video, DROP facebook, DROP instagram, DROP twitter, DROP linkedin');
        $this->addSql('ALTER TABLE art_type_entity DROP image, DROP video');
        $this->addSql('ALTER TABLE auction_entity ADD name VARCHAR(45) NOT NULL');
        $this->addSql('ALTER TABLE auction_painting_entity ADD client_id INT DEFAULT NULL, ADD highiest_price NUMERIC(10, 0) DEFAULT NULL');
        $this->addSql('ALTER TABLE auction_painting_entity ADD CONSTRAINT FK_1F38BC9019EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('CREATE INDEX IDX_1F38BC9019EB6921 ON auction_painting_entity (client_id)');
        $this->addSql('ALTER TABLE clap_entity ADD entity_id INT NOT NULL, DROP page_name');
        $this->addSql('ALTER TABLE clap_entity ADD CONSTRAINT FK_E455DDC981257D5D FOREIGN KEY (entity_id) REFERENCES entity (id)');
        $this->addSql('CREATE INDEX IDX_E455DDC981257D5D ON clap_entity (entity_id)');
        $this->addSql('ALTER TABLE client_entity ADD last_name VARCHAR(45) NOT NULL, ADD phone VARCHAR(20) DEFAULT NULL, ADD roll SMALLINT DEFAULT NULL, ADD created_by VARCHAR(25) DEFAULT NULL, ADD create_date DATETIME DEFAULT NULL, ADD updated_by VARCHAR(25) DEFAULT NULL, ADD update_date DATETIME DEFAULT NULL, CHANGE name fisrt_name VARCHAR(45) NOT NULL');
        $this->addSql('ALTER TABLE image_entity CHANGE artist_id artist_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE art_type_entity ADD image VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, ADD video VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE artist_entity ADD image VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD video VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD facebook VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD instagram VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD twitter VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD linkedin VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE auction_entity DROP name');
        $this->addSql('ALTER TABLE auction_painting_entity DROP FOREIGN KEY FK_1F38BC9019EB6921');
        $this->addSql('DROP INDEX IDX_1F38BC9019EB6921 ON auction_painting_entity');
        $this->addSql('ALTER TABLE auction_painting_entity DROP client_id, DROP highiest_price');
        $this->addSql('ALTER TABLE clap_entity DROP FOREIGN KEY FK_E455DDC981257D5D');
        $this->addSql('DROP INDEX IDX_E455DDC981257D5D ON clap_entity');
        $this->addSql('ALTER TABLE clap_entity ADD page_name VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci, DROP entity_id');
        $this->addSql('ALTER TABLE client_entity ADD name VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, DROP fisrt_name, DROP last_name, DROP phone, DROP roll, DROP created_by, DROP create_date, DROP updated_by, DROP update_date');
        $this->addSql('ALTER TABLE image_entity CHANGE artist_id artist_id INT NOT NULL');
    }
}
