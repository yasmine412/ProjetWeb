<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230509155726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire CHANGE id_user id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC79F37AE5 ON commentaire (id_user_id)');
        $this->addSql('ALTER TABLE images_logement ADD CONSTRAINT FK_53DE393D40B934A2 FOREIGN KEY (id_logement_id) REFERENCES logement (id)');
        $this->addSql('ALTER TABLE logement CHANGE idUser id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE logement ADD CONSTRAINT FK_F0FD445779F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F0FD445779F37AE5 ON logement (id_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC79F37AE5');
        $this->addSql('DROP INDEX IDX_67F068BC79F37AE5 ON commentaire');
        $this->addSql('ALTER TABLE commentaire CHANGE id_user_id id_user INT NOT NULL');
        $this->addSql('ALTER TABLE images_logement DROP FOREIGN KEY FK_53DE393D40B934A2');
        $this->addSql('ALTER TABLE logement DROP FOREIGN KEY FK_F0FD445779F37AE5');
        $this->addSql('DROP INDEX IDX_F0FD445779F37AE5 ON logement');
        $this->addSql('ALTER TABLE logement CHANGE id_user_id idUser INT NOT NULL');
    }
}
