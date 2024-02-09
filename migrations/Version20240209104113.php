<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240209104113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artiste (id BINARY(16) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE format (id BINARY(16) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE fruit (id BINARY(16) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE genre (id BINARY(16) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE label (id BINARY(16) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE reference (id BINARY(16) NOT NULL, title VARCHAR(255) NOT NULL, year INT NOT NULL, id_label_id BINARY(16) DEFAULT NULL, INDEX IDX_AEA349136362C3AC (id_label_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE reference_artiste (reference_id BINARY(16) NOT NULL, artiste_id BINARY(16) NOT NULL, INDEX IDX_9B7790E71645DEA9 (reference_id), INDEX IDX_9B7790E721D25844 (artiste_id), PRIMARY KEY(reference_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE reference_format (reference_id BINARY(16) NOT NULL, format_id BINARY(16) NOT NULL, INDEX IDX_C3DBC3DB1645DEA9 (reference_id), INDEX IDX_C3DBC3DBD629F605 (format_id), PRIMARY KEY(reference_id, format_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE reference_fruit (reference_id BINARY(16) NOT NULL, fruit_id BINARY(16) NOT NULL, INDEX IDX_76AAB2871645DEA9 (reference_id), INDEX IDX_76AAB287BAC115F0 (fruit_id), PRIMARY KEY(reference_id, fruit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE reference_genre (reference_id BINARY(16) NOT NULL, genre_id BINARY(16) NOT NULL, INDEX IDX_55F153E81645DEA9 (reference_id), INDEX IDX_55F153E84296D31F (genre_id), PRIMARY KEY(reference_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reference ADD CONSTRAINT FK_AEA349136362C3AC FOREIGN KEY (id_label_id) REFERENCES label (id)');
        $this->addSql('ALTER TABLE reference_artiste ADD CONSTRAINT FK_9B7790E71645DEA9 FOREIGN KEY (reference_id) REFERENCES reference (id)');
        $this->addSql('ALTER TABLE reference_artiste ADD CONSTRAINT FK_9B7790E721D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE reference_format ADD CONSTRAINT FK_C3DBC3DB1645DEA9 FOREIGN KEY (reference_id) REFERENCES reference (id)');
        $this->addSql('ALTER TABLE reference_format ADD CONSTRAINT FK_C3DBC3DBD629F605 FOREIGN KEY (format_id) REFERENCES format (id)');
        $this->addSql('ALTER TABLE reference_fruit ADD CONSTRAINT FK_76AAB2871645DEA9 FOREIGN KEY (reference_id) REFERENCES reference (id)');
        $this->addSql('ALTER TABLE reference_fruit ADD CONSTRAINT FK_76AAB287BAC115F0 FOREIGN KEY (fruit_id) REFERENCES fruit (id)');
        $this->addSql('ALTER TABLE reference_genre ADD CONSTRAINT FK_55F153E81645DEA9 FOREIGN KEY (reference_id) REFERENCES reference (id)');
        $this->addSql('ALTER TABLE reference_genre ADD CONSTRAINT FK_55F153E84296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reference DROP FOREIGN KEY FK_AEA349136362C3AC');
        $this->addSql('ALTER TABLE reference_artiste DROP FOREIGN KEY FK_9B7790E71645DEA9');
        $this->addSql('ALTER TABLE reference_artiste DROP FOREIGN KEY FK_9B7790E721D25844');
        $this->addSql('ALTER TABLE reference_format DROP FOREIGN KEY FK_C3DBC3DB1645DEA9');
        $this->addSql('ALTER TABLE reference_format DROP FOREIGN KEY FK_C3DBC3DBD629F605');
        $this->addSql('ALTER TABLE reference_fruit DROP FOREIGN KEY FK_76AAB2871645DEA9');
        $this->addSql('ALTER TABLE reference_fruit DROP FOREIGN KEY FK_76AAB287BAC115F0');
        $this->addSql('ALTER TABLE reference_genre DROP FOREIGN KEY FK_55F153E81645DEA9');
        $this->addSql('ALTER TABLE reference_genre DROP FOREIGN KEY FK_55F153E84296D31F');
        $this->addSql('DROP TABLE artiste');
        $this->addSql('DROP TABLE format');
        $this->addSql('DROP TABLE fruit');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE label');
        $this->addSql('DROP TABLE reference');
        $this->addSql('DROP TABLE reference_artiste');
        $this->addSql('DROP TABLE reference_format');
        $this->addSql('DROP TABLE reference_fruit');
        $this->addSql('DROP TABLE reference_genre');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
