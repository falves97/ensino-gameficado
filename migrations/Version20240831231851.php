<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240831231851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE subject_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE subjects_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE subjects (id INT NOT NULL, professor_id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AB2599177D2D84D5 ON subjects (professor_id)');
        $this->addSql('CREATE TABLE subject_student (subject_id INT NOT NULL, student_id INT NOT NULL, PRIMARY KEY(subject_id, student_id))');
        $this->addSql('CREATE INDEX IDX_12A1039123EDC87 ON subject_student (subject_id)');
        $this->addSql('CREATE INDEX IDX_12A10391CB944F1A ON subject_student (student_id)');
        $this->addSql('ALTER TABLE subjects ADD CONSTRAINT FK_AB2599177D2D84D5 FOREIGN KEY (professor_id) REFERENCES professors (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subject_student ADD CONSTRAINT FK_12A1039123EDC87 FOREIGN KEY (subject_id) REFERENCES subjects (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subject_student ADD CONSTRAINT FK_12A10391CB944F1A FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE subject');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE subjects_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE subject_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE subject (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE subjects DROP CONSTRAINT FK_AB2599177D2D84D5');
        $this->addSql('ALTER TABLE subject_student DROP CONSTRAINT FK_12A1039123EDC87');
        $this->addSql('ALTER TABLE subject_student DROP CONSTRAINT FK_12A10391CB944F1A');
        $this->addSql('DROP TABLE subjects');
        $this->addSql('DROP TABLE subject_student');
    }
}
