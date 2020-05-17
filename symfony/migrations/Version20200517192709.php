<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200517192709 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX idx__profile__first_name ON identity_profile');
        $this->addSql('DROP INDEX idx__profile__last_name ON identity_profile');
        $this->addSql('ALTER TABLE identity_profile DROP first_name, CHANGE last_name name VARCHAR(100) NOT NULL');
        $this->addSql('CREATE INDEX idx__profile__name ON identity_profile (name)');
        $this->addSql('ALTER TABLE 
          company_employee_request RENAME INDEX uniq_af16ed6d979b1ad6 TO UNIQ_9520252B979B1AD6');
        $this->addSql('ALTER TABLE company_employee_request RENAME INDEX uniq_af16ed6d3bcef6e TO UNIQ_9520252B3BCEF6E');
        $this->addSql('ALTER TABLE company_employee_request RENAME INDEX uniq_af16ed6d8aac4a9 TO UNIQ_9520252B8AAC4A9');
        $this->addSql('ALTER TABLE company_position RENAME INDEX idx_9b8568cf979b1ad6 TO IDX_5EBBF198979B1AD6');
        $this->addSql('ALTER TABLE company_employee RENAME INDEX uniq_8036f99b9b6b5fba TO UNIQ_450860CC9B6B5FBA');
        $this->addSql('ALTER TABLE company_employee RENAME INDEX idx_8036f99b979b1ad6 TO IDX_450860CC979B1AD6');
        $this->addSql('ALTER TABLE company_employee RENAME INDEX idx_8036f99bffa0c224 TO IDX_450860CCFFA0C224');
        $this->addSql('ALTER TABLE company_employee RENAME INDEX idx_8036f99bae80f5df TO IDX_450860CCAE80F5DF');
        $this->addSql('ALTER TABLE company_employee RENAME INDEX idx_8036f99bdd842e46 TO IDX_450860CCDD842E46');
        $this->addSql('ALTER TABLE company_department RENAME INDEX idx_cba2d51f41a619e TO IDX_7093081CF41A619E');
        $this->addSql('ALTER TABLE company_department RENAME INDEX idx_cba2d51979b1ad6 TO IDX_7093081C979B1AD6');
        $this->addSql('ALTER TABLE company_office RENAME INDEX idx_55666964979b1ad6 TO IDX_49CE0F77979B1AD6');
        $this->addSql('ALTER TABLE company RENAME INDEX uniq_80d5c29cde12ab56 TO UNIQ_4FBF094FDE12AB56');
        $this->addSql('ALTER TABLE company_owner RENAME INDEX idx_4c9635489b6b5fba TO IDX_889144199B6B5FBA');
        $this->addSql('ALTER TABLE company_owner RENAME INDEX idx_4c963548979b1ad6 TO IDX_88914419979B1AD6');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company RENAME INDEX uniq_4fbf094fde12ab56 TO UNIQ_80D5C29CDE12AB56');
        $this->addSql('ALTER TABLE company_department RENAME INDEX idx_7093081c979b1ad6 TO IDX_CBA2D51979B1AD6');
        $this->addSql('ALTER TABLE company_department RENAME INDEX idx_7093081cf41a619e TO IDX_CBA2D51F41A619E');
        $this->addSql('ALTER TABLE company_employee RENAME INDEX idx_450860cc979b1ad6 TO IDX_8036F99B979B1AD6');
        $this->addSql('ALTER TABLE company_employee RENAME INDEX idx_450860ccae80f5df TO IDX_8036F99BAE80F5DF');
        $this->addSql('ALTER TABLE company_employee RENAME INDEX idx_450860ccdd842e46 TO IDX_8036F99BDD842E46');
        $this->addSql('ALTER TABLE company_employee RENAME INDEX idx_450860ccffa0c224 TO IDX_8036F99BFFA0C224');
        $this->addSql('ALTER TABLE company_employee RENAME INDEX uniq_450860cc9b6b5fba TO UNIQ_8036F99B9B6B5FBA');
        $this->addSql('ALTER TABLE company_employee_request RENAME INDEX uniq_9520252b3bcef6e TO UNIQ_AF16ED6D3BCEF6E');
        $this->addSql('ALTER TABLE company_employee_request RENAME INDEX uniq_9520252b8aac4a9 TO UNIQ_AF16ED6D8AAC4A9');
        $this->addSql('ALTER TABLE 
          company_employee_request RENAME INDEX uniq_9520252b979b1ad6 TO UNIQ_AF16ED6D979B1AD6');
        $this->addSql('ALTER TABLE company_office RENAME INDEX idx_49ce0f77979b1ad6 TO IDX_55666964979B1AD6');
        $this->addSql('ALTER TABLE company_owner RENAME INDEX idx_88914419979b1ad6 TO IDX_4C963548979B1AD6');
        $this->addSql('ALTER TABLE company_owner RENAME INDEX idx_889144199b6b5fba TO IDX_4C9635489B6B5FBA');
        $this->addSql('ALTER TABLE company_position RENAME INDEX idx_5ebbf198979b1ad6 TO IDX_9B8568CF979B1AD6');
        $this->addSql('DROP INDEX idx__profile__name ON identity_profile');
        $this->addSql('ALTER TABLE 
          identity_profile 
        ADD 
          first_name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, 
          CHANGE name last_name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE INDEX idx__profile__first_name ON identity_profile (first_name)');
        $this->addSql('CREATE INDEX idx__profile__last_name ON identity_profile (last_name)');
    }
}
