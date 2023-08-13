<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230813093540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messages ADD main_message_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E966B82674A FOREIGN KEY (main_message_id) REFERENCES messages (id)');
        $this->addSql('CREATE INDEX IDX_DB021E966B82674A ON messages (main_message_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E966B82674A');
        $this->addSql('DROP INDEX IDX_DB021E966B82674A ON messages');
        $this->addSql('ALTER TABLE messages DROP main_message_id');
    }
}
