<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241115201725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE students_tests_alternatives (student_test_id INT NOT NULL, alternative_id INT NOT NULL, PRIMARY KEY(student_test_id, alternative_id))');
        $this->addSql('CREATE INDEX IDX_7692E282F36BB1A1 ON students_tests_alternatives (student_test_id)');
        $this->addSql('CREATE INDEX IDX_7692E282FC05FFAC ON students_tests_alternatives (alternative_id)');
        $this->addSql('ALTER TABLE students_tests_alternatives ADD CONSTRAINT FK_7692E282F36BB1A1 FOREIGN KEY (student_test_id) REFERENCES students_tests (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE students_tests_alternatives ADD CONSTRAINT FK_7692E282FC05FFAC FOREIGN KEY (alternative_id) REFERENCES alternatives (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE students_tests_alternatives DROP CONSTRAINT FK_7692E282F36BB1A1');
        $this->addSql('ALTER TABLE students_tests_alternatives DROP CONSTRAINT FK_7692E282FC05FFAC');
        $this->addSql('DROP TABLE students_tests_alternatives');
    }
}
