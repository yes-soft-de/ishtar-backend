<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191007095723 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment_entity CHANGE date date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE last_edit last_edit DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE painting_entity DROP FOREIGN KEY FK_CFA9597E4E7AF8F');
        $this->addSql('ALTER TABLE painting_entity DROP FOREIGN KEY FK_CFA9597EB7970CF8');
        $this->addSql('ALTER TABLE painting_entity CHANGE width width NUMERIC(6, 0) NOT NULL');
        $this->addSql('ALTER TABLE painting_entity ADD CONSTRAINT FK_CFA9597E4E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery_entity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE painting_entity ADD CONSTRAINT FK_CFA9597EB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE price_entity DROP FOREIGN KEY FK_43B1EC38B00EB939');
        $this->addSql('ALTER TABLE price_entity ADD CONSTRAINT FK_43B1EC38B00EB939 FOREIGN KEY (painting_id) REFERENCES painting_entity (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment_entity CHANGE date date DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE last_edit last_edit DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE painting_entity DROP FOREIGN KEY FK_CFA9597EB7970CF8');
        $this->addSql('ALTER TABLE painting_entity DROP FOREIGN KEY FK_CFA9597E4E7AF8F');
        $this->addSql('ALTER TABLE painting_entity CHANGE width width NUMERIC(6, 2) NOT NULL');
        $this->addSql('ALTER TABLE painting_entity ADD CONSTRAINT FK_CFA9597EB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE painting_entity ADD CONSTRAINT FK_CFA9597E4E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery_entity (id)');
        $this->addSql('ALTER TABLE price_entity DROP FOREIGN KEY FK_43B1EC38B00EB939');
        $this->addSql('ALTER TABLE price_entity ADD CONSTRAINT FK_43B1EC38B00EB939 FOREIGN KEY (painting_id) REFERENCES painting_entity (id)');
    }
}
