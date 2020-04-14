<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200414204247 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE profile (
          id VARCHAR(255) NOT NULL, 
          first_name VARCHAR(50) NOT NULL, 
          last_name VARCHAR(100) NOT NULL, 
          middle_name VARCHAR(100) DEFAULT NULL, 
          photo_path VARCHAR(256) DEFAULT NULL, 
          address VARCHAR(256) DEFAULT NULL, 
          birth_date DATETIME DEFAULT NULL, 
          INDEX idx_profile_first_name (first_name), 
          INDEX idx_profile_last_name (last_name), 
          INDEX idx_profile_birth_date (birth_date), 
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile_contact (
          id VARCHAR(255) NOT NULL, 
          profile_id VARCHAR(255) DEFAULT NULL, 
          type VARCHAR(255) NOT NULL, 
          value VARCHAR(255) NOT NULL, 
          description VARCHAR(255) DEFAULT NULL, 
          is_public TINYINT(1) DEFAULT \'0\' NOT NULL, 
          INDEX IDX_9FDC38A4CCFA12B8 (profile_id), 
          INDEX idx_profile_type (type), 
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE account (
          id VARCHAR(255) NOT NULL, 
          profile_id VARCHAR(255) NOT NULL, 
          email VARCHAR(180) NOT NULL, 
          password_hash VARCHAR(256) NOT NULL, 
          roles VARCHAR(255) NOT NULL, 
          created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', 
          UNIQUE INDEX UNIQ_7D3656A4CCFA12B8 (profile_id), 
          UNIQUE INDEX uk_account_email (email), 
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE 
          profile_contact 
        ADD 
          CONSTRAINT FK_9FDC38A4CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE 
          account 
        ADD 
          CONSTRAINT FK_7D3656A4CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE profile_contact DROP FOREIGN KEY FK_9FDC38A4CCFA12B8');
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A4CCFA12B8');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE profile_contact');
        $this->addSql('DROP TABLE account');
    }
}
