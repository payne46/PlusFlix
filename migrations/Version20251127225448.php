<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251127225448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, login VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, banner VARCHAR(255) DEFAULT NULL, release_date DATE DEFAULT NULL, director VARCHAR(255) DEFAULT NULL, screenwriter VARCHAR(255) DEFAULT NULL, genre VARCHAR(100) DEFAULT NULL, length INTEGER DEFAULT NULL, country VARCHAR(100) DEFAULT NULL, rating NUMERIC(2, 5) DEFAULT NULL, ratings_count INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE movie_streaming_platform (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, movie INTEGER NOT NULL, streaming_platform INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE streaming_platform (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(150) NOT NULL, banner VARCHAR(255) DEFAULT NULL, website_url VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE movie_streaming_platform');
        $this->addSql('DROP TABLE streaming_platform');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
