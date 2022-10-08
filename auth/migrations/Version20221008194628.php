<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221008194628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE auth_client 
            (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', 
            identifier VARCHAR(32) NOT NULL, 
            name VARCHAR(128) NOT NULL, 
            secret VARCHAR(128) NOT NULL, 
            redirect_uris LONGTEXT DEFAULT NULL, 
            grants LONGTEXT DEFAULT NULL, 
            scopes LONGTEXT DEFAULT NULL, 
            active TINYINT(1) NOT NULL, 
            UNIQUE INDEX UNIQ_E7E7A3B7772E836A (identifier), 
            UNIQUE INDEX UNIQ_E7E7A3B75CA2E8E5 (secret), 
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE auth_client');
    }
}
