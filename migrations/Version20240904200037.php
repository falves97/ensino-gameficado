<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240904200037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE tests_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tests (id INT NOT NULL, module_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1260FC5EAFC2B591 ON tests (module_id)');
        $this->addSql('ALTER TABLE tests ADD CONSTRAINT FK_1260FC5EAFC2B591 FOREIGN KEY (module_id) REFERENCES modules (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE tests_id_seq CASCADE');
        $this->addSql('ALTER TABLE tests DROP CONSTRAINT FK_1260FC5EAFC2B591');
        $this->addSql('DROP TABLE tests');
    }
}
