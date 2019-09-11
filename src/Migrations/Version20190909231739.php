<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190909231739 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment_entity DROP INDEX entity_id_2, ADD INDEX IDX_C43B1C7A81257D5D (entity_id)');
        $this->addSql('ALTER TABLE comment_entity DROP FOREIGN KEY FK_C43B1C7A81257D5D');
        $this->addSql('ALTER TABLE comment_entity DROP FOREIGN KEY FK_C43B1C7A19EB6921');
        $this->addSql('ALTER TABLE comment_entity ADD CONSTRAINT FK_C43B1C7A81257D5D FOREIGN KEY (entity_id) REFERENCES entity (id)');
        $this->addSql('ALTER TABLE comment_entity ADD CONSTRAINT FK_C43B1C7A19EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE price_entity CHANGE created_date created_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment_entity DROP INDEX IDX_C43B1C7A81257D5D, ADD UNIQUE INDEX entity_id_2 (entity_id)');
        $this->addSql('ALTER TABLE comment_entity DROP FOREIGN KEY FK_C43B1C7A19EB6921');
        $this->addSql('ALTER TABLE comment_entity DROP FOREIGN KEY FK_C43B1C7A81257D5D');
        $this->addSql('ALTER TABLE comment_entity ADD CONSTRAINT FK_C43B1C7A19EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_entity ADD CONSTRAINT FK_C43B1C7A81257D5D FOREIGN KEY (entity_id) REFERENCES entity (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE price_entity CHANGE created_date created_date DATETIME DEFAULT CURRENT_TIMESTAMP');
    }
}
