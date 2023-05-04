<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230504204105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, prénom VARCHAR(20) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(30) NOT NULL, telephone VARCHAR(20) NOT NULL, date_naissance DATE NOT NULL, photo LONGBLOB DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images_logement (id INT AUTO_INCREMENT NOT NULL, id_logement_id INT NOT NULL, name VARCHAR(255) NOT NULL, data LONGBLOB NOT NULL, INDEX IDX_53DE393D40B934A2 (id_logement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logement (id INT AUTO_INCREMENT NOT NULL, id_compte_id INT NOT NULL, prix_nuité NUMERIC(10, 3) NOT NULL, type_logement VARCHAR(20) NOT NULL, type_espace VARCHAR(20) NOT NULL, num_logement INT NOT NULL, rue VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, nbr_lits INT NOT NULL, nbr_sdb INT NOT NULL, nbr_chambres INT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, equipements LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_F0FD445772F0DA07 (id_compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE réservation (id INT AUTO_INCREMENT NOT NULL, id_logement_id INT NOT NULL, id_locataire_id INT NOT NULL, id_proprietaire_id INT NOT NULL, date_début DATE NOT NULL, date_fin DATE NOT NULL, INDEX IDX_666D6ED140B934A2 (id_logement_id), INDEX IDX_666D6ED1FB62F4EB (id_locataire_id), INDEX IDX_666D6ED19F9BCDC2 (id_proprietaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE images_logement ADD CONSTRAINT FK_53DE393D40B934A2 FOREIGN KEY (id_logement_id) REFERENCES logement (id)');
        $this->addSql('ALTER TABLE logement ADD CONSTRAINT FK_F0FD445772F0DA07 FOREIGN KEY (id_compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE réservation ADD CONSTRAINT FK_666D6ED140B934A2 FOREIGN KEY (id_logement_id) REFERENCES logement (id)');
        $this->addSql('ALTER TABLE réservation ADD CONSTRAINT FK_666D6ED1FB62F4EB FOREIGN KEY (id_locataire_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE réservation ADD CONSTRAINT FK_666D6ED19F9BCDC2 FOREIGN KEY (id_proprietaire_id) REFERENCES compte (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images_logement DROP FOREIGN KEY FK_53DE393D40B934A2');
        $this->addSql('ALTER TABLE logement DROP FOREIGN KEY FK_F0FD445772F0DA07');
        $this->addSql('ALTER TABLE réservation DROP FOREIGN KEY FK_666D6ED140B934A2');
        $this->addSql('ALTER TABLE réservation DROP FOREIGN KEY FK_666D6ED1FB62F4EB');
        $this->addSql('ALTER TABLE réservation DROP FOREIGN KEY FK_666D6ED19F9BCDC2');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE images_logement');
        $this->addSql('DROP TABLE logement');
        $this->addSql('DROP TABLE réservation');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
