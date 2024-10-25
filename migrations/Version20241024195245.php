<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241024195245 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cagnotte (id VARCHAR(36) NOT NULL, user_id VARCHAR(36) DEFAULT NULL, solde NUMERIC(10, 2) NOT NULL, is_actif TINYINT(1) DEFAULT NULL, INDEX IDX_6342C752A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id VARCHAR(36) NOT NULL, cagnotte_id VARCHAR(36) DEFAULT NULL, type VARCHAR(8) NOT NULL, montant NUMERIC(10, 2) NOT NULL, date DATETIME NOT NULL, is_actif TINYINT(1) DEFAULT NULL, INDEX IDX_723705D115105EB8 (cagnotte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cagnotte ADD CONSTRAINT FK_6342C752A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D115105EB8 FOREIGN KEY (cagnotte_id) REFERENCES cagnotte (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cagnotte DROP FOREIGN KEY FK_6342C752A76ED395');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D115105EB8');
        $this->addSql('DROP TABLE cagnotte');
        $this->addSql('DROP TABLE transaction');
    }
}
