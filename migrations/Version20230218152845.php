<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230218152845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF78708EB23357 FOREIGN KEY (types_id) REFERENCES type (id)');
        //$this->addSql('ALTER TABLE publication CHANGE commentaire commentaire LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE sandwich ADD price DOUBLE PRECISION DEFAULT NULL, ADD is_original TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sandwich ADD client INT DEFAULT NULL, DROP price, DROP is_original');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF78708EB23357');
        $this->addSql('ALTER TABLE publication CHANGE commentaire commentaire LONGTEXT DEFAULT NULL');
    }
}
