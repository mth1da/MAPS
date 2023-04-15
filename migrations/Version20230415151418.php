<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230415151418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD date_time_reservation DATETIME NOT NULL, DROP date, DROP time, CHANGE resa_user_id resa_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sandwich ADD is_mapse TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sandwich DROP is_mapse');
        $this->addSql('ALTER TABLE reservation ADD date DATE NOT NULL, ADD time TIME NOT NULL, DROP date_time_reservation, CHANGE resa_user_id resa_user_id INT NOT NULL');
    }
}
