<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230508231252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, id_logement_id INT NOT NULL, id_locataire_id INT NOT NULL, id_proprietaire_id INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, INDEX IDX_42C8495540B934A2 (id_logement_id), INDEX IDX_42C84955FB62F4EB (id_locataire_id), INDEX IDX_42C849559F9BCDC2 (id_proprietaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495540B934A2 FOREIGN KEY (id_logement_id) REFERENCES logement (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955FB62F4EB FOREIGN KEY (id_locataire_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559F9BCDC2 FOREIGN KEY (id_proprietaire_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE réservation DROP FOREIGN KEY FK_666D6ED140B934A2');
        $this->addSql('ALTER TABLE réservation DROP FOREIGN KEY FK_666D6ED19F9BCDC2');
        $this->addSql('ALTER TABLE réservation DROP FOREIGN KEY FK_666D6ED1FB62F4EB');
        $this->addSql('DROP TABLE réservation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE réservation (id INT AUTO_INCREMENT NOT NULL, id_logement_id INT NOT NULL, id_locataire_id INT NOT NULL, id_proprietaire_id INT NOT NULL, date_début DATE NOT NULL, date_fin DATE NOT NULL, INDEX IDX_666D6ED1FB62F4EB (id_locataire_id), INDEX IDX_666D6ED19F9BCDC2 (id_proprietaire_id), INDEX IDX_666D6ED140B934A2 (id_logement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE réservation ADD CONSTRAINT FK_666D6ED140B934A2 FOREIGN KEY (id_logement_id) REFERENCES logement (id)');
        $this->addSql('ALTER TABLE réservation ADD CONSTRAINT FK_666D6ED19F9BCDC2 FOREIGN KEY (id_proprietaire_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE réservation ADD CONSTRAINT FK_666D6ED1FB62F4EB FOREIGN KEY (id_locataire_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495540B934A2');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955FB62F4EB');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559F9BCDC2');
        $this->addSql('DROP TABLE reservation');
    }
}
