<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200420194202 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE 
          company_employee 
        DROP 
          INDEX UNIQ_8036F99B979B1AD6, 
        ADD 
          INDEX IDX_8036F99B979B1AD6 (company_id)');
        $this->addSql('ALTER TABLE 
          company_employee 
        DROP 
          INDEX UNIQ_8036F99BAE80F5DF, 
        ADD 
          INDEX IDX_8036F99BAE80F5DF (department_id)');
        $this->addSql('ALTER TABLE 
          company_employee 
        DROP 
          INDEX UNIQ_8036F99BDD842E46, 
        ADD 
          INDEX IDX_8036F99BDD842E46 (position_id)');
        $this->addSql('ALTER TABLE 
          company_employee 
        DROP 
          INDEX UNIQ_8036F99BFFA0C224, 
        ADD 
          INDEX IDX_8036F99BFFA0C224 (office_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE 
          company_employee 
        DROP 
          INDEX IDX_8036F99B979B1AD6, 
        ADD 
          UNIQUE INDEX UNIQ_8036F99B979B1AD6 (company_id)');
        $this->addSql('ALTER TABLE 
          company_employee 
        DROP 
          INDEX IDX_8036F99BFFA0C224, 
        ADD 
          UNIQUE INDEX UNIQ_8036F99BFFA0C224 (office_id)');
        $this->addSql('ALTER TABLE 
          company_employee 
        DROP 
          INDEX IDX_8036F99BAE80F5DF, 
        ADD 
          UNIQUE INDEX UNIQ_8036F99BAE80F5DF (department_id)');
        $this->addSql('ALTER TABLE 
          company_employee 
        DROP 
          INDEX IDX_8036F99BDD842E46, 
        ADD 
          UNIQUE INDEX UNIQ_8036F99BDD842E46 (position_id)');
    }
}
