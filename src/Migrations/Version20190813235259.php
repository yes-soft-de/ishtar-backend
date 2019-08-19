<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190813235259 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE artist_art_type_entity (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, art_type_id INT NOT NULL, UNIQUE INDEX UNIQ_F5C603E4B7970CF8 (artist_id), UNIQUE INDEX UNIQ_F5C603E471088DEF (art_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auction_entity (id INT AUTO_INCREMENT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auction_painting_entity (id INT AUTO_INCREMENT NOT NULL, painting_id INT NOT NULL, auction_id INT NOT NULL, start_price NUMERIC(10, 0) NOT NULL, final_price NUMERIC(10, 0) NOT NULL, UNIQUE INDEX UNIQ_1F38BC90B00EB939 (painting_id), UNIQUE INDEX UNIQ_1F38BC9057B8F0DE (auction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist_art_type_entity ADD CONSTRAINT FK_F5C603E4B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist_entity (id)');
        $this->addSql('ALTER TABLE artist_art_type_entity ADD CONSTRAINT FK_F5C603E471088DEF FOREIGN KEY (art_type_id) REFERENCES art_type_entity (id)');
        $this->addSql('ALTER TABLE auction_painting_entity ADD CONSTRAINT FK_1F38BC90B00EB939 FOREIGN KEY (painting_id) REFERENCES painting_entity (id)');
        $this->addSql('ALTER TABLE auction_painting_entity ADD CONSTRAINT FK_1F38BC9057B8F0DE FOREIGN KEY (auction_id) REFERENCES auction_entity (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE auction_painting_entity DROP FOREIGN KEY FK_1F38BC9057B8F0DE');
        $this->addSql('DROP TABLE artist_art_type_entity');
        $this->addSql('DROP TABLE auction_entity');
        $this->addSql('DROP TABLE auction_painting_entity');
    }
}
