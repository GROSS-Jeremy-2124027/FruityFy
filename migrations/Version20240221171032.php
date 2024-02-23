<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221171032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recherche_fruit ADD format_id BINARY(16) DEFAULT NULL');
        $this->addSql('ALTER TABLE recherche_fruit ADD CONSTRAINT FK_1BB0B0A2D629F605 FOREIGN KEY (format_id) REFERENCES format (id)');
        $this->addSql('CREATE INDEX IDX_1BB0B0A2D629F605 ON recherche_fruit (format_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recherche_fruit DROP FOREIGN KEY FK_1BB0B0A2D629F605');
        $this->addSql('DROP INDEX IDX_1BB0B0A2D629F605 ON recherche_fruit');
        $this->addSql('ALTER TABLE recherche_fruit DROP format_id');
    }
}
