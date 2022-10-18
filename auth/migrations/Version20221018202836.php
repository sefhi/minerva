<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221018202836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE auth_token (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', 
            client_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', 
            expiry DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', 
            user VARCHAR(36) DEFAULT NULL, 
            scopes JSON DEFAULT NULL, 
            revoked TINYINT(1) NOT NULL, 
            INDEX IDX_9315F04E19EB6921 (client_id), 
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'ALTER TABLE auth_token ADD CONSTRAINT FK_9315F04E19EB6921 
                    FOREIGN KEY (client_id) REFERENCES auth_client (id)'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auth_token DROP FOREIGN KEY FK_9315F04E19EB6921');
        $this->addSql('DROP TABLE auth_token');
        $this->addSql('ALTER TABLE auth_client CHANGE grants grants TEXT DEFAULT NULL COMMENT \'(DC2Type:oauth2_grant)\', CHANGE redirect_uris redirect_uris TEXT DEFAULT NULL COMMENT \'(DC2Type:oauth2_redirect_uri)\', CHANGE scopes scopes TEXT DEFAULT NULL COMMENT \'(DC2Type:oauth2_scope)\'');
    }
}
