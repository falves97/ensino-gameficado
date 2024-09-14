<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240904213624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE alternatives_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE alternatives (id INT NOT NULL, question_id INT NOT NULL, description TEXT NOT NULL, is_correct BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_46682B541E27F6BF ON alternatives (question_id)');
        $this->addSql('ALTER TABLE alternatives ADD CONSTRAINT FK_46682B541E27F6BF FOREIGN KEY (question_id) REFERENCES questions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE alternatives_id_seq CASCADE');
        $this->addSql('ALTER TABLE alternatives DROP CONSTRAINT FK_46682B541E27F6BF');
        $this->addSql('DROP TABLE alternatives');
    }
}
