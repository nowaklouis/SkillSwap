<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230807185920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE registered (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, swaps_id INT DEFAULT NULL, INDEX IDX_4BFEE16067B3B43D (users_id), INDEX IDX_4BFEE160B4C288DF (swaps_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE swap (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, subject VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', date DATE NOT NULL, duration TIME NOT NULL, INDEX IDX_25938561F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE registered ADD CONSTRAINT FK_4BFEE16067B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE registered ADD CONSTRAINT FK_4BFEE160B4C288DF FOREIGN KEY (swaps_id) REFERENCES swap (id)');
        $this->addSql('ALTER TABLE swap ADD CONSTRAINT FK_25938561F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE registered DROP FOREIGN KEY FK_4BFEE16067B3B43D');
        $this->addSql('ALTER TABLE registered DROP FOREIGN KEY FK_4BFEE160B4C288DF');
        $this->addSql('ALTER TABLE swap DROP FOREIGN KEY FK_25938561F675F31B');
        $this->addSql('DROP TABLE registered');
        $this->addSql('DROP TABLE swap');
    }
}
