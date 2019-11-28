<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191127223309 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artist_entity CHANGE facebook facebook VARCHAR(255) DEFAULT NULL, CHANGE twitter twitter VARCHAR(255) DEFAULT NULL, CHANGE linkedin linkedin VARCHAR(255) DEFAULT NULL, CHANGE instagram instagram VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE auction_client_entity ADD CONSTRAINT FK_7C75A80A19EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE auction_painting_entity ADD CONSTRAINT FK_1F38BC9019EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE clap_entity CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE clap_entity ADD CONSTRAINT FK_E455DDC919EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE comment_entity CHANGE date date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE last_edit last_edit DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE comment_entity ADD CONSTRAINT FK_C43B1C7A19EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE entity_interaction_entity CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE entity_interaction_entity ADD CONSTRAINT FK_636E1C2919EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE favorite_entity ADD CONSTRAINT FK_329D289219EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
        $this->addSql('ALTER TABLE painting_entity ADD signed VARCHAR(65) DEFAULT NULL');
        $this->addSql('ALTER TABLE painting_transaction_entity ADD CONSTRAINT FK_586982CC19EB6921 FOREIGN KEY (client_id) REFERENCES client_entity (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artist_entity CHANGE facebook facebook VARCHAR(25) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE twitter twitter VARCHAR(25) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE linkedin linkedin VARCHAR(25) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE instagram instagram VARCHAR(25) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE auction_client_entity DROP FOREIGN KEY FK_7C75A80A19EB6921');
        $this->addSql('ALTER TABLE auction_painting_entity DROP FOREIGN KEY FK_1F38BC9019EB6921');
        $this->addSql('ALTER TABLE clap_entity DROP FOREIGN KEY FK_E455DDC919EB6921');
        $this->addSql('ALTER TABLE clap_entity CHANGE date date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE comment_entity DROP FOREIGN KEY FK_C43B1C7A19EB6921');
        $this->addSql('ALTER TABLE comment_entity CHANGE date date DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE last_edit last_edit DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE entity_interaction_entity DROP FOREIGN KEY FK_636E1C2919EB6921');
        $this->addSql('ALTER TABLE entity_interaction_entity CHANGE date date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE favorite_entity DROP FOREIGN KEY FK_329D289219EB6921');
        $this->addSql('ALTER TABLE painting_entity DROP signed');
        $this->addSql('ALTER TABLE painting_transaction_entity DROP FOREIGN KEY FK_586982CC19EB6921');
    }
}
