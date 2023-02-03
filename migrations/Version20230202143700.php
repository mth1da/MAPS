<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230202143700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admin` (id INT AUTO_INCREMENT NOT NULL, administrateur VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D7632EB52E8 (administrateur), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ingredient ADD types_id INT NOT NULL');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF78708EB23357 FOREIGN KEY (types_id) REFERENCES type (id)');
        $this->addSql('CREATE INDEX IDX_6BAF78708EB23357 ON ingredient (types_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF78708EB23357');
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP INDEX IDX_6BAF78708EB23357 ON ingredient');
        $this->addSql('ALTER TABLE ingredient DROP types_id');
    }
}
