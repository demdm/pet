<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200420150946 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE hrm_company (
          id VARCHAR(255) NOT NULL, 
          created_by VARCHAR(255) NOT NULL, 
          name VARCHAR(255) NOT NULL, 
          logo_path VARCHAR(255) DEFAULT NULL, 
          created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', 
          UNIQUE INDEX UNIQ_80D5C29CDE12AB56 (created_by), 
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hrm_company_office (
          id VARCHAR(255) NOT NULL, 
          company_id VARCHAR(255) DEFAULT NULL, 
          address VARCHAR(255) NOT NULL, 
          created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', 
          INDEX IDX_55666964979B1AD6 (company_id), 
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE 
          hrm_company 
        ADD 
          CONSTRAINT FK_80D5C29CDE12AB56 FOREIGN KEY (created_by) REFERENCES hrm_identity_account (id)');
        $this->addSql('ALTER TABLE 
          hrm_company_office 
        ADD 
          CONSTRAINT FK_55666964979B1AD6 FOREIGN KEY (company_id) REFERENCES hrm_company (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hrm_company_office DROP FOREIGN KEY FK_55666964979B1AD6');
        $this->addSql('DROP TABLE hrm_company');
        $this->addSql('DROP TABLE hrm_company_office');
    }
}
