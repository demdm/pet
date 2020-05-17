<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200506174449 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE company_employee_request (
          id VARCHAR(255) NOT NULL, 
          company_id VARCHAR(255) NOT NULL, 
          employee_account_id VARCHAR(255) NOT NULL, 
          resolver_account_id VARCHAR(255) DEFAULT NULL, 
          resolved_status VARCHAR(255) NOT NULL, 
          created_at DATETIME NOT NULL, 
          resolved_at DATETIME DEFAULT NULL, 
          UNIQUE INDEX UNIQ_AF16ED6D979B1AD6 (company_id), 
          UNIQUE INDEX UNIQ_AF16ED6D3BCEF6E (employee_account_id), 
          UNIQUE INDEX UNIQ_AF16ED6D8AAC4A9 (resolver_account_id), 
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE 
          company_employee_request 
        ADD 
          CONSTRAINT FK_AF16ED6D979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE 
          company_employee_request 
        ADD 
          CONSTRAINT FK_AF16ED6D3BCEF6E FOREIGN KEY (employee_account_id) REFERENCES identity_account (id)');
        $this->addSql('ALTER TABLE 
          company_employee_request 
        ADD 
          CONSTRAINT FK_AF16ED6D8AAC4A9 FOREIGN KEY (resolver_account_id) REFERENCES identity_account (id)');
        $this->addSql('ALTER TABLE identity_account CHANGE password_hash password_hash VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE 
          identity_profile CHANGE photo_path photo_path VARCHAR(255) DEFAULT NULL, 
          CHANGE address address VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE company CHANGE logo_path logo_path VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE company_employee_request');
        $this->addSql('ALTER TABLE 
          company CHANGE logo_path logo_path VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE 
          identity_account CHANGE password_hash password_hash VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE 
          identity_profile CHANGE photo_path photo_path VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, 
          CHANGE address address VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
