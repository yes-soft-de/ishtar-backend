<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190906175330 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE social_media_artist_entity DROP FOREIGN KEY FK_2370004D64AE4959');
        $this->addSql('DROP TABLE social_media_artist_entity');
        $this->addSql('DROP TABLE social_media_entity');
        $this->addSql('ALTER TABLE artist_entity ADD facebook VARCHAR(25) DEFAULT NULL, ADD twitter VARCHAR(25) DEFAULT NULL, ADD linkedin VARCHAR(25) DEFAULT NULL, ADD instagram VARCHAR(25) DEFAULT NULL');
        $this->addSql('ALTER TABLE price_entity CHANGE created_date created_date DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE social_media_artist_entity (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, social_media_id INT NOT NULL, address VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX artist_id (artist_id), INDEX UNIQ_2370004D64AE4959 (social_media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE social_media_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE social_media_artist_entity ADD CONSTRAINT FK_2370004D64AE4959 FOREIGN KEY (social_media_id) REFERENCES social_media_entity (id)');
        $this->addSql('ALTER TABLE social_media_artist_entity ADD CONSTRAINT FK_2370004DB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE artist_entity DROP facebook, DROP twitter, DROP linkedin, DROP instagram');
        $this->addSql('ALTER TABLE price_entity CHANGE created_date created_date DATETIME DEFAULT CURRENT_TIMESTAMP');
    }
}
