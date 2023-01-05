<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230105165505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ustensile_recette (id INT AUTO_INCREMENT NOT NULL, ustensile_id INT DEFAULT NULL, recette_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_22A3DAE4B78A4282 (ustensile_id), INDEX IDX_22A3DAE489312FE9 (recette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ustensile_recette ADD CONSTRAINT FK_22A3DAE4B78A4282 FOREIGN KEY (ustensile_id) REFERENCES ustensile (id)');
        $this->addSql('ALTER TABLE ustensile_recette ADD CONSTRAINT FK_22A3DAE489312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ustensile_recette DROP FOREIGN KEY FK_22A3DAE4B78A4282');
        $this->addSql('ALTER TABLE ustensile_recette DROP FOREIGN KEY FK_22A3DAE489312FE9');
        $this->addSql('DROP TABLE ustensile_recette');
    }
}
