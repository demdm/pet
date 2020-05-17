<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200420193538 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE company_position (
          id VARCHAR(255) NOT NULL, 
          company_id VARCHAR(255) NOT NULL, 
          name VARCHAR(255) NOT NULL, 
          employee_count INT DEFAULT 0 NOT NULL, 
          INDEX IDX_9B8568CF979B1AD6 (company_id), 
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_employee (
          id VARCHAR(255) NOT NULL, 
          account_id VARCHAR(255) NOT NULL, 
          company_id VARCHAR(255) NOT NULL, 
          office_id VARCHAR(255) NOT NULL, 
          department_id VARCHAR(255) NOT NULL, 
          position_id VARCHAR(255) NOT NULL, 
          is_working_remotely TINYINT(1) DEFAULT \'0\' NOT NULL, 
          is_pending TINYINT(1) DEFAULT \'0\' NOT NULL, 
          is_active TINYINT(1) DEFAULT \'0\' NOT NULL, 
          is_hired TINYINT(1) DEFAULT \'0\' NOT NULL, 
          is_fired TINYINT(1) DEFAULT \'0\' NOT NULL, 
          hired_at DATETIME DEFAULT NULL, 
          fired_at DATETIME DEFAULT NULL, 
          UNIQUE INDEX UNIQ_8036F99B9B6B5FBA (account_id), 
          UNIQUE INDEX UNIQ_8036F99B979B1AD6 (company_id), 
          UNIQUE INDEX UNIQ_8036F99BFFA0C224 (office_id), 
          UNIQUE INDEX UNIQ_8036F99BAE80F5DF (department_id), 
          UNIQUE INDEX UNIQ_8036F99BDD842E46 (position_id), 
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_department (
          id VARCHAR(255) NOT NULL, 
          head_id VARCHAR(255) NOT NULL, 
          company_id VARCHAR(255) NOT NULL, 
          name VARCHAR(255) NOT NULL, 
          employee_count INT DEFAULT 0 NOT NULL, 
          description VARCHAR(255) DEFAULT NULL, 
          INDEX IDX_CBA2D51F41A619E (head_id), 
          INDEX IDX_CBA2D51979B1AD6 (company_id), 
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE 
          company_position 
        ADD 
          CONSTRAINT FK_9B8568CF979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE 
          company_employee 
        ADD 
          CONSTRAINT FK_8036F99B9B6B5FBA FOREIGN KEY (account_id) REFERENCES identity_account (id)');
        $this->addSql('ALTER TABLE 
          company_employee 
        ADD 
          CONSTRAINT FK_8036F99B979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE 
          company_employee 
        ADD 
          CONSTRAINT FK_8036F99BFFA0C224 FOREIGN KEY (office_id) REFERENCES company_office (id)');
        $this->addSql('ALTER TABLE 
          company_employee 
        ADD 
          CONSTRAINT FK_8036F99BAE80F5DF FOREIGN KEY (department_id) REFERENCES company_department (id)');
        $this->addSql('ALTER TABLE 
          company_employee 
        ADD 
          CONSTRAINT FK_8036F99BDD842E46 FOREIGN KEY (position_id) REFERENCES company_position (id)');
        $this->addSql('ALTER TABLE 
          company_department 
        ADD 
          CONSTRAINT FK_CBA2D51F41A619E FOREIGN KEY (head_id) REFERENCES company_employee (id)');
        $this->addSql('ALTER TABLE 
          company_department 
        ADD 
          CONSTRAINT FK_CBA2D51979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company_employee DROP FOREIGN KEY FK_8036F99BDD842E46');
        $this->addSql('ALTER TABLE company_department DROP FOREIGN KEY FK_CBA2D51F41A619E');
        $this->addSql('ALTER TABLE company_employee DROP FOREIGN KEY FK_8036F99BAE80F5DF');
        $this->addSql('DROP TABLE company_position');
        $this->addSql('DROP TABLE company_employee');
        $this->addSql('DROP TABLE company_department');
    }
}
