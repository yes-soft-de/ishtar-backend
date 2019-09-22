<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190902171900 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE image_entity');
        $this->addSql('DROP TABLE video_entity');
        $this->addSql('ALTER TABLE comment_entity ADD row INT NOT NULL, ADD spacial TINYINT(1) NOT NULL, DROP page_name, CHANGE row_num entity_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment_entity ADD CONSTRAINT FK_C43B1C7A81257D5D FOREIGN KEY (entity_id) REFERENCES entity (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C43B1C7A81257D5D ON comment_entity (entity_id)');
        $this->addSql('ALTER TABLE interaction_entity DROP FOREIGN KEY FK_F891F0F719EB6921');
        $this->addSql('DROP INDEX IDX_F891F0F719EB6921 ON interaction_entity');
        $this->addSql('ALTER TABLE interaction_entity DROP client_id, DROP interaction_type, DROP row_num, CHANGE page_name name VARCHAR(25) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE image_entity (id INT AUTO_INCREMENT NOT NULL, painting_id INT NOT NULL, artist_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, adding_date DATETIME NOT NULL, INDEX IDX_A1351AA0B00EB939 (painting_id), INDEX IDX_A1351AA0B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE video_entity (id INT AUTO_INCREMENT NOT NULL, painting_id INT NOT NULL, artist_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, adding_date DATETIME NOT NULL, INDEX IDX_367FE4A5B00EB939 (painting_id), INDEX IDX_367FE4A5B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE image_entity ADD CONSTRAINT FK_A1351AA0B00EB939 FOREIGN KEY (painting_id) REFERENCES painting_entity (id)');
        $this->addSql('ALTER TABLE image_entity ADD CONSTRAINT FK_A1351AA0B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE video_entity ADD CONSTRAINT FK_367FE4A5B00EB939 FOREIGN KEY (painting_id) REFERENCES painting_entity (id)');
        $this->addSql('ALTER TABLE video_entity ADD CONSTRAINT FK_367FE4A5B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE comment_entity DROP FOREIGN KEY FK_C43B1C7A81257D5D');
        $this->addSql('DROP INDEX UNIQ_C43B1C7A81257D5D ON comment_entity');
        $this->addSql('ALTER TABLE comment_entity ADD page_name VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci, ADD row_num INT NOT NULL, DROP entity_id, DROP row, DROP spacial');
        $this->addSql('ALTER TABLE interaction_entity ADD client_id INT NOT NULL, ADD interaction_type VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, ADD row_num INT NOT NULL, CHANGE name page_name VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE interaction_entity ADD CONSTRAINT FK_F891F0F719EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('CREATE INDEX IDX_F891F0F719EB6921 ON interaction_entity (client_id)');
    }
}
