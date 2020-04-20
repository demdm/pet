<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200420131003 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE hrm_identity_profile (
          id VARCHAR(255) NOT NULL, 
          account_id VARCHAR(255) NOT NULL, 
          first_name VARCHAR(50) NOT NULL, 
          last_name VARCHAR(100) NOT NULL, 
          middle_name VARCHAR(100) DEFAULT NULL, 
          photo_path VARCHAR(256) DEFAULT NULL, 
          address VARCHAR(256) DEFAULT NULL, 
          birth_date DATETIME DEFAULT NULL, 
          INDEX idx__profile__first_name (first_name), 
          INDEX idx__profile__last_name (last_name), 
          INDEX idx__profile__birth_date (birth_date), 
          UNIQUE INDEX uk__profile__account_id (account_id), 
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hrm_identity_profile_contact (
          id VARCHAR(255) NOT NULL, 
          profile_id VARCHAR(255) NOT NULL, 
          type VARCHAR(255) NOT NULL, 
          value VARCHAR(255) NOT NULL, 
          description VARCHAR(255) DEFAULT NULL, 
          is_public TINYINT(1) DEFAULT \'0\' NOT NULL, 
          INDEX idx__profile__profile_id (profile_id), 
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hrm_identity_account (
          id VARCHAR(255) NOT NULL, 
          email VARCHAR(180) NOT NULL, 
          password_hash VARCHAR(256) NOT NULL, 
          roles LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', 
          created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', 
          UNIQUE INDEX uk__account__email (email), 
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE 
          hrm_identity_profile 
        ADD 
          CONSTRAINT FK_C6DC90309B6B5FBA FOREIGN KEY (account_id) REFERENCES hrm_identity_account (id)');
        $this->addSql('ALTER TABLE 
          hrm_identity_profile_contact 
        ADD 
          CONSTRAINT FK_5186E32BCCFA12B8 FOREIGN KEY (profile_id) REFERENCES hrm_identity_profile (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hrm_identity_profile_contact DROP FOREIGN KEY FK_5186E32BCCFA12B8');
        $this->addSql('ALTER TABLE hrm_identity_profile DROP FOREIGN KEY FK_C6DC90309B6B5FBA');
        $this->addSql('DROP TABLE hrm_identity_profile');
        $this->addSql('DROP TABLE hrm_identity_profile_contact');
        $this->addSql('DROP TABLE hrm_identity_account');
    }
}
