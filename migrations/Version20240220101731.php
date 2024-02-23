<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220101731 extends AbstractMigration
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
        $this->addSql('CREATE TABLE artiste_fruit (artiste_id BINARY(16) NOT NULL, fruit_id BINARY(16) NOT NULL, INDEX IDX_D422C86921D25844 (artiste_id), INDEX IDX_D422C869BAC115F0 (fruit_id), PRIMARY KEY(artiste_id, fruit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user_album (user_id INT NOT NULL, album_id BINARY(16) NOT NULL, INDEX IDX_DB5A951BA76ED395 (user_id), INDEX IDX_DB5A951B1137ABCF (album_id), PRIMARY KEY(user_id, album_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user_artiste (user_id INT NOT NULL, artiste_id BINARY(16) NOT NULL, INDEX IDX_C40A2B45A76ED395 (user_id), INDEX IDX_C40A2B4521D25844 (artiste_id), PRIMARY KEY(user_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
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
        $this->addSql('ALTER TABLE user_album ADD CONSTRAINT FK_DB5A951BA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_album ADD CONSTRAINT FK_DB5A951B1137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('ALTER TABLE user_artiste ADD CONSTRAINT FK_C40A2B45A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_artiste ADD CONSTRAINT FK_C40A2B4521D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE reference DROP FOREIGN KEY FK_AEA349136362C3AC');
        $this->addSql('ALTER TABLE reference_artiste DROP FOREIGN KEY FK_9B7790E721D25844');
        $this->addSql('ALTER TABLE reference_artiste DROP FOREIGN KEY FK_9B7790E71645DEA9');
        $this->addSql('ALTER TABLE reference_format DROP FOREIGN KEY FK_C3DBC3DB1645DEA9');
        $this->addSql('ALTER TABLE reference_format DROP FOREIGN KEY FK_C3DBC3DBD629F605');
        $this->addSql('ALTER TABLE reference_fruit DROP FOREIGN KEY FK_76AAB2871645DEA9');
        $this->addSql('ALTER TABLE reference_fruit DROP FOREIGN KEY FK_76AAB287BAC115F0');
        $this->addSql('ALTER TABLE reference_genre DROP FOREIGN KEY FK_55F153E81645DEA9');
        $this->addSql('ALTER TABLE reference_genre DROP FOREIGN KEY FK_55F153E84296D31F');
        $this->addSql('DROP TABLE reference');
        $this->addSql('DROP TABLE reference_artiste');
        $this->addSql('DROP TABLE reference_format');
        $this->addSql('DROP TABLE reference_fruit');
        $this->addSql('DROP TABLE reference_genre');
        $this->addSql('ALTER TABLE artiste ADD discogs_id VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reference (id BINARY(16) NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, year INT NOT NULL, id_label_id BINARY(16) DEFAULT NULL, INDEX IDX_AEA349136362C3AC (id_label_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reference_artiste (reference_id BINARY(16) NOT NULL, artiste_id BINARY(16) NOT NULL, INDEX IDX_9B7790E71645DEA9 (reference_id), INDEX IDX_9B7790E721D25844 (artiste_id), PRIMARY KEY(reference_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reference_format (reference_id BINARY(16) NOT NULL, format_id BINARY(16) NOT NULL, INDEX IDX_C3DBC3DB1645DEA9 (reference_id), INDEX IDX_C3DBC3DBD629F605 (format_id), PRIMARY KEY(reference_id, format_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reference_fruit (reference_id BINARY(16) NOT NULL, fruit_id BINARY(16) NOT NULL, INDEX IDX_76AAB2871645DEA9 (reference_id), INDEX IDX_76AAB287BAC115F0 (fruit_id), PRIMARY KEY(reference_id, fruit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reference_genre (reference_id BINARY(16) NOT NULL, genre_id BINARY(16) NOT NULL, INDEX IDX_55F153E84296D31F (genre_id), INDEX IDX_55F153E81645DEA9 (reference_id), PRIMARY KEY(reference_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reference ADD CONSTRAINT FK_AEA349136362C3AC FOREIGN KEY (id_label_id) REFERENCES label (id)');
        $this->addSql('ALTER TABLE reference_artiste ADD CONSTRAINT FK_9B7790E721D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE reference_artiste ADD CONSTRAINT FK_9B7790E71645DEA9 FOREIGN KEY (reference_id) REFERENCES reference (id)');
        $this->addSql('ALTER TABLE reference_format ADD CONSTRAINT FK_C3DBC3DB1645DEA9 FOREIGN KEY (reference_id) REFERENCES reference (id)');
        $this->addSql('ALTER TABLE reference_format ADD CONSTRAINT FK_C3DBC3DBD629F605 FOREIGN KEY (format_id) REFERENCES format (id)');
        $this->addSql('ALTER TABLE reference_fruit ADD CONSTRAINT FK_76AAB2871645DEA9 FOREIGN KEY (reference_id) REFERENCES reference (id)');
        $this->addSql('ALTER TABLE reference_fruit ADD CONSTRAINT FK_76AAB287BAC115F0 FOREIGN KEY (fruit_id) REFERENCES fruit (id)');
        $this->addSql('ALTER TABLE reference_genre ADD CONSTRAINT FK_55F153E81645DEA9 FOREIGN KEY (reference_id) REFERENCES reference (id)');
        $this->addSql('ALTER TABLE reference_genre ADD CONSTRAINT FK_55F153E84296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
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
        $this->addSql('ALTER TABLE user_album DROP FOREIGN KEY FK_DB5A951BA76ED395');
        $this->addSql('ALTER TABLE user_album DROP FOREIGN KEY FK_DB5A951B1137ABCF');
        $this->addSql('ALTER TABLE user_artiste DROP FOREIGN KEY FK_C40A2B45A76ED395');
        $this->addSql('ALTER TABLE user_artiste DROP FOREIGN KEY FK_C40A2B4521D25844');
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE album_format');
        $this->addSql('DROP TABLE album_fruit');
        $this->addSql('DROP TABLE album_genre');
        $this->addSql('DROP TABLE album_label');
        $this->addSql('DROP TABLE artiste_fruit');
        $this->addSql('DROP TABLE user_album');
        $this->addSql('DROP TABLE user_artiste');
        $this->addSql('ALTER TABLE artiste DROP discogs_id');
    }
}
