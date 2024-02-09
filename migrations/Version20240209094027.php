<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240209094027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reference_artiste (reference_id BINARY(16) NOT NULL, artiste_id BINARY(16) NOT NULL, INDEX IDX_9B7790E71645DEA9 (reference_id), INDEX IDX_9B7790E721D25844 (artiste_id), PRIMARY KEY(reference_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE reference_format (reference_id BINARY(16) NOT NULL, format_id BINARY(16) NOT NULL, INDEX IDX_C3DBC3DB1645DEA9 (reference_id), INDEX IDX_C3DBC3DBD629F605 (format_id), PRIMARY KEY(reference_id, format_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reference_artiste ADD CONSTRAINT FK_9B7790E71645DEA9 FOREIGN KEY (reference_id) REFERENCES reference (id)');
        $this->addSql('ALTER TABLE reference_artiste ADD CONSTRAINT FK_9B7790E721D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE reference_format ADD CONSTRAINT FK_C3DBC3DB1645DEA9 FOREIGN KEY (reference_id) REFERENCES reference (id)');
        $this->addSql('ALTER TABLE reference_format ADD CONSTRAINT FK_C3DBC3DBD629F605 FOREIGN KEY (format_id) REFERENCES format (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reference_artiste DROP FOREIGN KEY FK_9B7790E71645DEA9');
        $this->addSql('ALTER TABLE reference_artiste DROP FOREIGN KEY FK_9B7790E721D25844');
        $this->addSql('ALTER TABLE reference_format DROP FOREIGN KEY FK_C3DBC3DB1645DEA9');
        $this->addSql('ALTER TABLE reference_format DROP FOREIGN KEY FK_C3DBC3DBD629F605');
        $this->addSql('DROP TABLE reference_artiste');
        $this->addSql('DROP TABLE reference_format');
    }
}
