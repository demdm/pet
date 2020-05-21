<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200521202550 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE identity_access_token (
          id INT UNSIGNED AUTO_INCREMENT NOT NULL, 
          account_id VARCHAR(255) NOT NULL, 
          access_token VARCHAR(255) NOT NULL, 
          UNIQUE INDEX UNIQ_8A1E913DB6A2DD68 (access_token), 
          INDEX IDX_8A1E913D9B6B5FBA (account_id), 
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE 
          identity_access_token 
        ADD 
          CONSTRAINT FK_8A1E913D9B6B5FBA FOREIGN KEY (account_id) REFERENCES identity_account (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE identity_access_token');
    }
}
