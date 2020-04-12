<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200412191020 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (
          id VARCHAR(255) NOT NULL, 
          email VARCHAR(180) NOT NULL, 
          password_hash VARCHAR(256) NOT NULL, 
          roles VARCHAR(255) NOT NULL, 
          is_email_confirmed TINYINT(1) DEFAULT \'0\' NOT NULL, 
          can_logged_in TINYINT(1) DEFAULT \'1\' NOT NULL, 
          created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', 
          logged_in_at DATETIME DEFAULT NULL, 
          UNIQUE INDEX uk_user_email (email), 
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
    }
}
