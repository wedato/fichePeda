<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210322184654 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fiche_peda (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, num_etu VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, adresse_postal VARCHAR(255) NOT NULL, num_tel VARCHAR(255) NOT NULL, num_portable VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, rse TINYINT(1) NOT NULL, type_control_terminal_rse TINYINT(1) DEFAULT NULL, redoublant_ajac TINYINT(1) NOT NULL, sem_deja_obtenu INT DEFAULT NULL, tier_temps TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE fiche_peda');
    }
}
