<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240223074208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album (id BINARY(16) NOT NULL, title VARCHAR(255) NOT NULL, year INT NOT NULL, discogs_id VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE album_format (album_id BINARY(16) NOT NULL, format_id BINARY(16) NOT NULL, INDEX IDX_CC14F681137ABCF (album_id), INDEX IDX_CC14F68D629F605 (format_id), PRIMARY KEY(album_id, format_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE album_fruit (album_id BINARY(16) NOT NULL, fruit_id BINARY(16) NOT NULL, INDEX IDX_D6B398B11137ABCF (album_id), INDEX IDX_D6B398B1BAC115F0 (fruit_id), PRIMARY KEY(album_id, fruit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE album_genre (album_id BINARY(16) NOT NULL, genre_id BINARY(16) NOT NULL, INDEX IDX_F5E879DE1137ABCF (album_id), INDEX IDX_F5E879DE4296D31F (genre_id), PRIMARY KEY(album_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE album_label (album_id BINARY(16) NOT NULL, label_id BINARY(16) NOT NULL, INDEX IDX_781F1ACE1137ABCF (album_id), INDEX IDX_781F1ACE33B92F39 (label_id), PRIMARY KEY(album_id, label_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE artiste (id BINARY(16) NOT NULL, name VARCHAR(255) NOT NULL, discogs_id VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE artiste_fruit (artiste_id BINARY(16) NOT NULL, fruit_id BINARY(16) NOT NULL, INDEX IDX_D422C86921D25844 (artiste_id), INDEX IDX_D422C869BAC115F0 (fruit_id), PRIMARY KEY(artiste_id, fruit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE format (id BINARY(16) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE fruit (id BINARY(16) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE genre (id BINARY(16) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE label (id BINARY(16) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE recherche_fruit (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, year INT DEFAULT NULL, fruit_id BINARY(16) DEFAULT NULL, genre_id BINARY(16) DEFAULT NULL, artiste_id BINARY(16) DEFAULT NULL, format_id BINARY(16) DEFAULT NULL, INDEX IDX_1BB0B0A2BAC115F0 (fruit_id), INDEX IDX_1BB0B0A24296D31F (genre_id), INDEX IDX_1BB0B0A221D25844 (artiste_id), INDEX IDX_1BB0B0A2D629F605 (format_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user_album (user_id INT NOT NULL, album_id BINARY(16) NOT NULL, INDEX IDX_DB5A951BA76ED395 (user_id), INDEX IDX_DB5A951B1137ABCF (album_id), PRIMARY KEY(user_id, album_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user_artiste (user_id INT NOT NULL, artiste_id BINARY(16) NOT NULL, INDEX IDX_C40A2B45A76ED395 (user_id), INDEX IDX_C40A2B4521D25844 (artiste_id), PRIMARY KEY(user_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE album_format ADD CONSTRAINT FK_CC14F681137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('ALTER TABLE album_format ADD CONSTRAINT FK_CC14F68D629F605 FOREIGN KEY (format_id) REFERENCES format (id)');
        $this->addSql('ALTER TABLE album_fruit ADD CONSTRAINT FK_D6B398B11137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('ALTER TABLE album_fruit ADD CONSTRAINT FK_D6B398B1BAC115F0 FOREIGN KEY (fruit_id) REFERENCES fruit (id)');
        $this->addSql('ALTER TABLE album_genre ADD CONSTRAINT FK_F5E879DE1137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('ALTER TABLE album_genre ADD CONSTRAINT FK_F5E879DE4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE album_label ADD CONSTRAINT FK_781F1ACE1137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('ALTER TABLE album_label ADD CONSTRAINT FK_781F1ACE33B92F39 FOREIGN KEY (label_id) REFERENCES label (id)');
        $this->addSql('ALTER TABLE artiste_fruit ADD CONSTRAINT FK_D422C86921D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE artiste_fruit ADD CONSTRAINT FK_D422C869BAC115F0 FOREIGN KEY (fruit_id) REFERENCES fruit (id)');
        $this->addSql('ALTER TABLE recherche_fruit ADD CONSTRAINT FK_1BB0B0A2BAC115F0 FOREIGN KEY (fruit_id) REFERENCES fruit (id)');
        $this->addSql('ALTER TABLE recherche_fruit ADD CONSTRAINT FK_1BB0B0A24296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('ALTER TABLE recherche_fruit ADD CONSTRAINT FK_1BB0B0A221D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE recherche_fruit ADD CONSTRAINT FK_1BB0B0A2D629F605 FOREIGN KEY (format_id) REFERENCES format (id)');
        $this->addSql('ALTER TABLE user_album ADD CONSTRAINT FK_DB5A951BA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_album ADD CONSTRAINT FK_DB5A951B1137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('ALTER TABLE user_artiste ADD CONSTRAINT FK_C40A2B45A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_artiste ADD CONSTRAINT FK_C40A2B4521D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album_format DROP FOREIGN KEY FK_CC14F681137ABCF');
        $this->addSql('ALTER TABLE album_format DROP FOREIGN KEY FK_CC14F68D629F605');
        $this->addSql('ALTER TABLE album_fruit DROP FOREIGN KEY FK_D6B398B11137ABCF');
        $this->addSql('ALTER TABLE album_fruit DROP FOREIGN KEY FK_D6B398B1BAC115F0');
        $this->addSql('ALTER TABLE album_genre DROP FOREIGN KEY FK_F5E879DE1137ABCF');
        $this->addSql('ALTER TABLE album_genre DROP FOREIGN KEY FK_F5E879DE4296D31F');
        $this->addSql('ALTER TABLE album_label DROP FOREIGN KEY FK_781F1ACE1137ABCF');
        $this->addSql('ALTER TABLE album_label DROP FOREIGN KEY FK_781F1ACE33B92F39');
        $this->addSql('ALTER TABLE artiste_fruit DROP FOREIGN KEY FK_D422C86921D25844');
        $this->addSql('ALTER TABLE artiste_fruit DROP FOREIGN KEY FK_D422C869BAC115F0');
        $this->addSql('ALTER TABLE recherche_fruit DROP FOREIGN KEY FK_1BB0B0A2BAC115F0');
        $this->addSql('ALTER TABLE recherche_fruit DROP FOREIGN KEY FK_1BB0B0A24296D31F');
        $this->addSql('ALTER TABLE recherche_fruit DROP FOREIGN KEY FK_1BB0B0A221D25844');
        $this->addSql('ALTER TABLE recherche_fruit DROP FOREIGN KEY FK_1BB0B0A2D629F605');
        $this->addSql('ALTER TABLE user_album DROP FOREIGN KEY FK_DB5A951BA76ED395');
        $this->addSql('ALTER TABLE user_album DROP FOREIGN KEY FK_DB5A951B1137ABCF');
        $this->addSql('ALTER TABLE user_artiste DROP FOREIGN KEY FK_C40A2B45A76ED395');
        $this->addSql('ALTER TABLE user_artiste DROP FOREIGN KEY FK_C40A2B4521D25844');
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE album_format');
        $this->addSql('DROP TABLE album_fruit');
        $this->addSql('DROP TABLE album_genre');
        $this->addSql('DROP TABLE album_label');
        $this->addSql('DROP TABLE artiste');
        $this->addSql('DROP TABLE artiste_fruit');
        $this->addSql('DROP TABLE format');
        $this->addSql('DROP TABLE fruit');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE label');
        $this->addSql('DROP TABLE recherche_fruit');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_album');
        $this->addSql('DROP TABLE user_artiste');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
