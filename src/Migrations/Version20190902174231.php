<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190902174231 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE painting_transaction (id INT AUTO_INCREMENT NOT NULL, deatils VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist_entity ADD created_by VARCHAR(25) DEFAULT NULL, ADD create_date DATE DEFAULT NULL, ADD updated_by VARCHAR(25) DEFAULT NULL, ADD update_date DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE art_type_entity ADD created_by VARCHAR(25) DEFAULT NULL, ADD create_date DATE DEFAULT NULL, ADD updated_by VARCHAR(25) DEFAULT NULL, ADD update_date DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE painting_entity DROP FOREIGN KEY FK_CFA9597E71088DEF');
        $this->addSql('DROP INDEX IDX_CFA9597E71088DEF ON painting_entity');
        $this->addSql('ALTER TABLE painting_entity ADD gallery_id INT DEFAULT NULL, ADD height NUMERIC(6, 0) NOT NULL, ADD width NUMERIC(6, 2) NOT NULL, ADD active TINYINT(1) DEFAULT NULL, ADD created_by VARCHAR(25) DEFAULT NULL, ADD create_date DATE DEFAULT NULL, ADD updeted_by VARCHAR(25) DEFAULT NULL, ADD update_date DATE DEFAULT NULL, DROP art_type_id, DROP price, DROP adding_date, CHANGE deminsions image VARCHAR(45) NOT NULL');
        $this->addSql('ALTER TABLE painting_entity ADD CONSTRAINT FK_CFA9597E4E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery_entity (id)');
        $this->addSql('CREATE INDEX IDX_CFA9597E4E7AF8F ON painting_entity (gallery_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE painting_transaction');
        $this->addSql('ALTER TABLE art_type_entity DROP created_by, DROP create_date, DROP updated_by, DROP update_date');
        $this->addSql('ALTER TABLE artist_entity DROP created_by, DROP create_date, DROP updated_by, DROP update_date');
        $this->addSql('ALTER TABLE painting_entity DROP FOREIGN KEY FK_CFA9597E4E7AF8F');
        $this->addSql('DROP INDEX IDX_CFA9597E4E7AF8F ON painting_entity');
        $this->addSql('ALTER TABLE painting_entity ADD art_type_id INT NOT NULL, ADD price NUMERIC(10, 0) NOT NULL, ADD adding_date DATETIME NOT NULL, DROP gallery_id, DROP height, DROP width, DROP active, DROP created_by, DROP create_date, DROP updeted_by, DROP update_date, CHANGE image deminsions VARCHAR(45) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE painting_entity ADD CONSTRAINT FK_CFA9597E71088DEF FOREIGN KEY (art_type_id) REFERENCES art_type_entity (id)');
        $this->addSql('CREATE INDEX IDX_CFA9597E71088DEF ON painting_entity (art_type_id)');
    }
}
