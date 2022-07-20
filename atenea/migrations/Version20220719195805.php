<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220719195805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE author
                  (
                     id       INT auto_increment NOT NULL,
                     name     VARCHAR(50) NOT NULL,
                     username VARCHAR(70) NOT NULL,
                     website  VARCHAR(255) NOT NULL,
                     email    VARCHAR(255) NOT NULL,
                     PRIMARY KEY(id)
                  )
                DEFAULT CHARACTER SET utf8mb4
                COLLATE `utf8mb4_unicode_ci`
                engine = innodb'
        );

        $this->addSql(
            'CREATE TABLE post
                  (
                     id        INT auto_increment NOT NULL,
                     author_id INT NOT NULL,
                     title     VARCHAR(255) NOT NULL,
                     content   VARCHAR(255) NOT NULL,
                     INDEX post_author_id_fk (author_id),
                     PRIMARY KEY(id),
                     FOREIGN KEY (author_id) REFERENCES author(id)
                  )
                DEFAULT CHARACTER SET utf8mb4
                COLLATE `utf8mb4_unicode_ci`
                engine = innodb '
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE post');
    }
}
