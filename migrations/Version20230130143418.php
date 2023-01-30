<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230130143418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE IF NOT EXISTS `order` (id INT AUTO_INCREMENT NOT NULL, order_user_id INT NOT NULL, cost NUMERIC(6, 2) NOT NULL, discount INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7F148F7E51147ADE (order_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_7F148F7E51147ADE FOREIGN KEY (order_user_id) REFERENCES user (id)');
        //$this->addSql('ALTER TABLE user ADD token VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP TABLE IF EXISTS `o+
        rder`');
        //$this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64924A232CF ON user (user_name)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

        $this->addSql('ALTER TABLE `o+
        rder` DROP FOREIGN KEY FK_7F148F7E51147ADE');
        $this->addSql('DROP TABLE IF EXISTS `o+
        rder`');
        $this->addSql('DROP INDEX UNIQ_8D93D64924A232CF ON user');
    }
}
