<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201013025049 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE to_do_entities (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, uuid VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_1DD000E3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE to_do_entities ADD CONSTRAINT FK_1DD000E3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE to_do_categorie ADD CONSTRAINT FK_A0534F654B367900 FOREIGN KEY (to_do_entities_id) REFERENCES to_do_entities (id)');
        $this->addSql('CREATE INDEX IDX_A0534F654B367900 ON to_do_categorie (to_do_entities_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE to_do_categorie DROP FOREIGN KEY FK_A0534F654B367900');
        $this->addSql('DROP TABLE to_do_entities');
        $this->addSql('DROP INDEX IDX_A0534F654B367900 ON to_do_categorie');
    }
}
