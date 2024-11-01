<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241024183817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE students_tests_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE students_tests (id INT NOT NULL, student_id INT NOT NULL, test_id INT NOT NULL, grade INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1E739BAACB944F1A ON students_tests (student_id)');
        $this->addSql('CREATE INDEX IDX_1E739BAA1E5D0459 ON students_tests (test_id)');
        $this->addSql('ALTER TABLE students_tests ADD CONSTRAINT FK_1E739BAACB944F1A FOREIGN KEY (student_id) REFERENCES students (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE students_tests ADD CONSTRAINT FK_1E739BAA1E5D0459 FOREIGN KEY (test_id) REFERENCES tests (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE students_tests_id_seq CASCADE');
        $this->addSql('ALTER TABLE students_tests DROP CONSTRAINT FK_1E739BAACB944F1A');
        $this->addSql('ALTER TABLE students_tests DROP CONSTRAINT FK_1E739BAA1E5D0459');
        $this->addSql('DROP TABLE students_tests');
    }
}
