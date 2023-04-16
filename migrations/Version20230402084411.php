<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230402084411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE reservation DROP date, DROP time, DROP date_time_reservation');
        //$this->addSql('ALTER TABLE reservation ADD DATETIME date_time_reservation NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE reservation ADD time TIME NOT NULL, CHANGE resa_user_id resa_user_id INT NOT NULL, CHANGE date_time_reservation date DATE NOT NULL');
    }
}
