<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200420152912 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE hrm_company_owner (
          account_id VARCHAR(255) NOT NULL, 
          company_id VARCHAR(255) NOT NULL, 
          INDEX IDX_4C9635489B6B5FBA (account_id), 
          INDEX IDX_4C963548979B1AD6 (company_id), 
          PRIMARY KEY(account_id, company_id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE 
          hrm_company_owner 
        ADD 
          CONSTRAINT FK_4C9635489B6B5FBA FOREIGN KEY (account_id) REFERENCES hrm_company (id)');
        $this->addSql('ALTER TABLE 
          hrm_company_owner 
        ADD 
          CONSTRAINT FK_4C963548979B1AD6 FOREIGN KEY (company_id) REFERENCES hrm_identity_account (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE hrm_company_owner');
    }
}
