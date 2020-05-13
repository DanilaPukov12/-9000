<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200513155428 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contact_feedback (id INT AUTO_INCREMENT NOT NULL, status_id INT DEFAULT NULL, nameclient VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, is_confidentiality TINYINT(1) NOT NULL, INDEX IDX_480CD8CF6BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_feedback_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address_from LONGTEXT DEFAULT NULL, address_at LONGTEXT DEFAULT NULL, date DATE DEFAULT NULL, time_from TIME DEFAULT NULL, time_at TIME DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, number INT DEFAULT NULL, created_at DATETIME NOT NULL, is_confidentiality TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact_feedback ADD CONSTRAINT FK_480CD8CF6BF700BD FOREIGN KEY (status_id) REFERENCES contact_feedback_status (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contact_feedback DROP FOREIGN KEY FK_480CD8CF6BF700BD');
        $this->addSql('DROP TABLE contact_feedback');
        $this->addSql('DROP TABLE contact_feedback_status');
        $this->addSql('DROP TABLE `order`');
    }
}
