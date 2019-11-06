<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191106002547 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE auction_client_entity DROP FOREIGN KEY FK_7C75A80A19EB6921');
        $this->addSql('ALTER TABLE auction_painting_entity DROP FOREIGN KEY FK_1F38BC9019EB6921');
        $this->addSql('CREATE TABLE client_entity (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) DEFAULT NULL, password VARCHAR(500) NOT NULL, is_active TINYINT(1) NOT NULL, email VARCHAR(190) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', created_by VARCHAR(255) DEFAULT NULL, create_date DATETIME DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, update_date DATETIME DEFAULT NULL, birth_date DATE DEFAULT NULL, UNIQUE INDEX UNIQ_5B8E0FDBE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE cliententity');
        $this->addSql('ALTER TABLE auction_client_entity DROP FOREIGN KEY FK_7C75A80A19EB6921');
        $this->addSql('ALTER TABLE auction_client_entity ADD CONSTRAINT FK_7C75A80A19EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE auction_painting_entity DROP FOREIGN KEY FK_1F38BC9019EB6921');
        $this->addSql('ALTER TABLE auction_painting_entity ADD CONSTRAINT FK_1F38BC9019EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE clap_entity ADD CONSTRAINT FK_E455DDC919EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE comment_entity CHANGE last_edit last_edit DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE comment_entity ADD CONSTRAINT FK_C43B1C7A19EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE entity_interaction_entity ADD CONSTRAINT FK_636E1C2919EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE favorite_entity ADD CONSTRAINT FK_329D289219EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE painting_transaction_entity ADD CONSTRAINT FK_586982CC19EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE auction_client_entity DROP FOREIGN KEY FK_7C75A80A19EB6921');
        $this->addSql('ALTER TABLE auction_painting_entity DROP FOREIGN KEY FK_1F38BC9019EB6921');
        $this->addSql('ALTER TABLE clap_entity DROP FOREIGN KEY FK_E455DDC919EB6921');
        $this->addSql('ALTER TABLE comment_entity DROP FOREIGN KEY FK_C43B1C7A19EB6921');
        $this->addSql('ALTER TABLE entity_interaction_entity DROP FOREIGN KEY FK_636E1C2919EB6921');
        $this->addSql('ALTER TABLE favorite_entity DROP FOREIGN KEY FK_329D289219EB6921');
        $this->addSql('ALTER TABLE painting_transaction_entity DROP FOREIGN KEY FK_586982CC19EB6921');
        $this->addSql('CREATE TABLE cliententity (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, password VARCHAR(500) NOT NULL COLLATE utf8mb4_unicode_ci, is_active TINYINT(1) NOT NULL, email VARCHAR(190) NOT NULL COLLATE utf8mb4_unicode_ci, first_name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, last_name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, phone VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, roles LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:json)\', created_by VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, create_date DATETIME DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, update_date DATETIME DEFAULT NULL, birth_date DATE DEFAULT NULL, UNIQUE INDEX UNIQ_38E0EA8DE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE client_entity');
        $this->addSql('ALTER TABLE auction_client_entity DROP FOREIGN KEY FK_7C75A80A19EB6921');
        $this->addSql('ALTER TABLE auction_client_entity ADD CONSTRAINT FK_7C75A80A19EB6921 FOREIGN KEY (client_id) REFERENCES cliententity (id)');
        $this->addSql('ALTER TABLE auction_painting_entity DROP FOREIGN KEY FK_1F38BC9019EB6921');
        $this->addSql('ALTER TABLE auction_painting_entity ADD CONSTRAINT FK_1F38BC9019EB6921 FOREIGN KEY (client_id) REFERENCES cliententity (id)');
        $this->addSql('ALTER TABLE comment_entity CHANGE last_edit last_edit DATETIME DEFAULT CURRENT_TIMESTAMP');
    }
}
