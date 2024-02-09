<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240209090901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reference (id BINARY(16) NOT NULL, title VARCHAR(255) NOT NULL, year INT NOT NULL, id_label_id BINARY(16) DEFAULT NULL, INDEX IDX_AEA349136362C3AC (id_label_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE reference_fruit (reference_id BINARY(16) NOT NULL, fruit_id BINARY(16) NOT NULL, INDEX IDX_76AAB2871645DEA9 (reference_id), INDEX IDX_76AAB287BAC115F0 (fruit_id), PRIMARY KEY(reference_id, fruit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE reference_genre (reference_id BINARY(16) NOT NULL, genre_id BINARY(16) NOT NULL, INDEX IDX_55F153E81645DEA9 (reference_id), INDEX IDX_55F153E84296D31F (genre_id), PRIMARY KEY(reference_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reference ADD CONSTRAINT FK_AEA349136362C3AC FOREIGN KEY (id_label_id) REFERENCES label (id)');
        $this->addSql('ALTER TABLE reference_fruit ADD CONSTRAINT FK_76AAB2871645DEA9 FOREIGN KEY (reference_id) REFERENCES reference (id)');
        $this->addSql('ALTER TABLE reference_fruit ADD CONSTRAINT FK_76AAB287BAC115F0 FOREIGN KEY (fruit_id) REFERENCES fruit (id)');
        $this->addSql('ALTER TABLE reference_genre ADD CONSTRAINT FK_55F153E81645DEA9 FOREIGN KEY (reference_id) REFERENCES reference (id)');
        $this->addSql('ALTER TABLE reference_genre ADD CONSTRAINT FK_55F153E84296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reference DROP FOREIGN KEY FK_AEA349136362C3AC');
        $this->addSql('ALTER TABLE reference_fruit DROP FOREIGN KEY FK_76AAB2871645DEA9');
        $this->addSql('ALTER TABLE reference_fruit DROP FOREIGN KEY FK_76AAB287BAC115F0');
        $this->addSql('ALTER TABLE reference_genre DROP FOREIGN KEY FK_55F153E81645DEA9');
        $this->addSql('ALTER TABLE reference_genre DROP FOREIGN KEY FK_55F153E84296D31F');
        $this->addSql('DROP TABLE reference');
        $this->addSql('DROP TABLE reference_fruit');
        $this->addSql('DROP TABLE reference_genre');
    }
}
