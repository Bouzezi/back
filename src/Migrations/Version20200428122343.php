<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200428122343 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dossier_visite CHANGE pays_destination_id pays_destination_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dossier_visite ADD CONSTRAINT FK_58EDD8923E787F14 FOREIGN KEY (organisme_etranger_id) REFERENCES organisme_etranger (id)');
        $this->addSql('ALTER TABLE organisme_programme ADD CONSTRAINT FK_D0C0E30F5DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme_etranger (organismeId)');
        $this->addSql('ALTER TABLE organisme_programme ADD CONSTRAINT FK_D0C0E30F62BB7AEE FOREIGN KEY (programme_id) REFERENCES programme_cooperation (programmeId)');
        $this->addSql('ALTER TABLE ville_destination ADD CONSTRAINT FK_47C4DAEAD3356485 FOREIGN KEY (pays_destination_id) REFERENCES pays_destination (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dossier_visite DROP FOREIGN KEY FK_58EDD8923E787F14');
        $this->addSql('ALTER TABLE dossier_visite CHANGE pays_destination_id pays_destination_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Organisme_Programme DROP FOREIGN KEY FK_D0C0E30F5DDD38F5');
        $this->addSql('ALTER TABLE Organisme_Programme DROP FOREIGN KEY FK_D0C0E30F62BB7AEE');
        $this->addSql('ALTER TABLE ville_destination DROP FOREIGN KEY FK_47C4DAEAD3356485');
    }
}
