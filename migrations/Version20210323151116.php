<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210323151116 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fiche_peda (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, num_etu VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, adresse_postal VARCHAR(255) NOT NULL, num_tel VARCHAR(255) NOT NULL, num_portable VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, rse TINYINT(1) NOT NULL, type_control_terminal_rse TINYINT(1) DEFAULT NULL, redoublant_ajac TINYINT(1) NOT NULL, sem_deja_obtenu INT DEFAULT NULL, tier_temps TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_peda_ue (fiche_peda_id INT NOT NULL, ue_id INT NOT NULL, INDEX IDX_D664FA64471497AF (fiche_peda_id), INDEX IDX_D664FA6462E883B1 (ue_id), PRIMARY KEY(fiche_peda_id, ue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ue (id INT AUTO_INCREMENT NOT NULL, code_apogee VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, inscription TINYINT(1) NOT NULL, valide_note INT DEFAULT NULL, ects INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fiche_peda_ue ADD CONSTRAINT FK_D664FA64471497AF FOREIGN KEY (fiche_peda_id) REFERENCES fiche_peda (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_peda_ue ADD CONSTRAINT FK_D664FA6462E883B1 FOREIGN KEY (ue_id) REFERENCES ue (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_peda_ue DROP FOREIGN KEY FK_D664FA64471497AF');
        $this->addSql('ALTER TABLE fiche_peda_ue DROP FOREIGN KEY FK_D664FA6462E883B1');
        $this->addSql('DROP TABLE fiche_peda');
        $this->addSql('DROP TABLE fiche_peda_ue');
        $this->addSql('DROP TABLE ue');
        $this->addSql('DROP TABLE users');
    }
}
