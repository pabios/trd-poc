<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241025121448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rencontre (id VARCHAR(36) NOT NULL, equipe1 VARCHAR(100) NOT NULL, equipe2 VARCHAR(100) NOT NULL, cote_victoire1 DOUBLE PRECISION NOT NULL, cote_victoire2 DOUBLE PRECISION NOT NULL, cote_egalite DOUBLE PRECISION NOT NULL, is_actif TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE rencontre');
    }
}
