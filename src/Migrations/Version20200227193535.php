<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200227193535 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE order_details_entity (id INT AUTO_INCREMENT NOT NULL, entity_id INT NOT NULL, relation_id INT NOT NULL, row_id INT NOT NULL, price NUMERIC(10, 0) NOT NULL, adding_date DATETIME DEFAULT NULL, INDEX IDX_567D849781257D5D (entity_id), INDEX IDX_567D84973256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_entity (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, delivery_address VARCHAR(255) NOT NULL, subtotal NUMERIC(10, 0) NOT NULL, tax NUMERIC(10, 0) DEFAULT NULL, total NUMERIC(10, 0) NOT NULL, adding_date DATETIME DEFAULT NULL, updating_date DATETIME DEFAULT NULL, order_state TINYINT(1) DEFAULT NULL, shipping_state TINYINT(1) DEFAULT NULL, INDEX IDX_CDA754BD19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_details_entity ADD CONSTRAINT FK_567D849781257D5D FOREIGN KEY (entity_id) REFERENCES entity (id)');
        $this->addSql('ALTER TABLE order_details_entity ADD CONSTRAINT FK_567D84973256915B FOREIGN KEY (relation_id) REFERENCES order_entity (id)');
        $this->addSql('ALTER TABLE order_entity ADD CONSTRAINT FK_CDA754BD19EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_details_entity DROP FOREIGN KEY FK_567D84973256915B');
        $this->addSql('DROP TABLE order_details_entity');
        $this->addSql('DROP TABLE order_entity');
    }
}
