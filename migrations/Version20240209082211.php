<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240209082211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artiste CHANGE id id BINARY(16) NOT NULL');
        $this->addSql('ALTER TABLE format CHANGE id id BINARY(16) NOT NULL');
        $this->addSql('ALTER TABLE fruit CHANGE id id BINARY(16) NOT NULL');
        $this->addSql('ALTER TABLE genre CHANGE id id BINARY(16) NOT NULL');
        $this->addSql('ALTER TABLE label CHANGE id id BINARY(16) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artiste CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE format CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE fruit CHANGE id id VARCHAR(255) DEFAULT \'uuid()\' NOT NULL');
        $this->addSql('ALTER TABLE genre CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE label CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
