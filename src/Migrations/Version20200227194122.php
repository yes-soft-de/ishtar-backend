<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200227194122 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_details_entity DROP FOREIGN KEY FK_567D84973256915B');
        $this->addSql('DROP INDEX IDX_567D84973256915B ON order_details_entity');
        $this->addSql('ALTER TABLE order_details_entity CHANGE relation_id order_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_details_entity ADD CONSTRAINT FK_567D84978D9F6D38 FOREIGN KEY (order_id) REFERENCES order_entity (id)');
        $this->addSql('CREATE INDEX IDX_567D84978D9F6D38 ON order_details_entity (order_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_details_entity DROP FOREIGN KEY FK_567D84978D9F6D38');
        $this->addSql('DROP INDEX IDX_567D84978D9F6D38 ON order_details_entity');
        $this->addSql('ALTER TABLE order_details_entity CHANGE order_id relation_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_details_entity ADD CONSTRAINT FK_567D84973256915B FOREIGN KEY (relation_id) REFERENCES order_entity (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_567D84973256915B ON order_details_entity (relation_id)');
    }
}
