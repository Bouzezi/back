<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200415211543 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cadre_ins (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(15) NOT NULL, prenom VARCHAR(15) NOT NULL, grade VARCHAR(20) NOT NULL, fonction VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE direction_centrale (id INT AUTO_INCREMENT NOT NULL, libelle_direction VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays_destination (id INT AUTO_INCREMENT NOT NULL, libelle_pays VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE programme_cooperation (id INT AUTO_INCREMENT NOT NULL, libelle_prog VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville_destination (id INT AUTO_INCREMENT NOT NULL, pays_destination_id INT NOT NULL, libelle_ville VARCHAR(50) NOT NULL, INDEX IDX_47C4DAEAD3356485 (pays_destination_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ville_destination ADD CONSTRAINT FK_47C4DAEAD3356485 FOREIGN KEY (pays_destination_id) REFERENCES pays_destination (id)');
        $this->addSql('ALTER TABLE dossier_visite ADD CONSTRAINT FK_58EDD892D3356485 FOREIGN KEY (pays_destination_id) REFERENCES pays_destination (id)');
        $this->addSql('CREATE INDEX IDX_58EDD892D3356485 ON dossier_visite (pays_destination_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dossier_visite DROP FOREIGN KEY FK_58EDD892D3356485');
        $this->addSql('ALTER TABLE ville_destination DROP FOREIGN KEY FK_47C4DAEAD3356485');
        $this->addSql('DROP TABLE cadre_ins');
        $this->addSql('DROP TABLE direction_centrale');
        $this->addSql('DROP TABLE pays_destination');
        $this->addSql('DROP TABLE programme_cooperation');
        $this->addSql('DROP TABLE ville_destination');
        $this->addSql('DROP INDEX IDX_58EDD892D3356485 ON dossier_visite');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
