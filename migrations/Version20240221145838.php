<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221145838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recherche_fruit ADD artiste_id BINARY(16) DEFAULT NULL');
        $this->addSql('ALTER TABLE recherche_fruit ADD CONSTRAINT FK_1BB0B0A221D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('CREATE INDEX IDX_1BB0B0A221D25844 ON recherche_fruit (artiste_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recherche_fruit DROP FOREIGN KEY FK_1BB0B0A221D25844');
        $this->addSql('DROP INDEX IDX_1BB0B0A221D25844 ON recherche_fruit');
        $this->addSql('ALTER TABLE recherche_fruit DROP artiste_id');
    }
}
