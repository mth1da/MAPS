<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230417093228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939851147ADE');
        //$this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_34E8BC9C51147ADE FOREIGN KEY (order_user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE publication ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP updated_at');
        //$this->addSql('ALTER TABLE sandwich CHANGE name name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE publication DROP updated_at');
    }
}
