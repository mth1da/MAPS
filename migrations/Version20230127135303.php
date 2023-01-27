<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230127135303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, client_name VARCHAR(100) NOT NULL, client_surname VARCHAR(100) NOT NULL, client_username VARCHAR(200) DEFAULT NULL, client_mail VARCHAR(100) NOT NULL, client_pwd VARCHAR(100) NOT NULL, client_bithdate DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoris (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, INDEX IDX_8933C43219EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, ingredient_name VARCHAR(200) NOT NULL, ingredient_price DOUBLE PRECISION NOT NULL, ingredient_quantity INT NOT NULL, ingredient_photo VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sandwich_ingredient (sandwich_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_976ACE844D566043 (sandwich_id), INDEX IDX_976ACE84933FE08C (ingredient_id), PRIMARY KEY(sandwich_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C43219EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE sandwich_ingredient ADD CONSTRAINT FK_976ACE844D566043 FOREIGN KEY (sandwich_id) REFERENCES sandwich (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sandwich_ingredient ADD CONSTRAINT FK_976ACE84933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE ingredients');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredients (id INT AUTO_INCREMENT NOT NULL, ingredient_name VARCHAR(200) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ingredient_price DOUBLE PRECISION NOT NULL, ingredients_quantity INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C43219EB6921');
        $this->addSql('ALTER TABLE sandwich_ingredient DROP FOREIGN KEY FK_976ACE844D566043');
        $this->addSql('ALTER TABLE sandwich_ingredient DROP FOREIGN KEY FK_976ACE84933FE08C');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE sandwich_ingredient');
    }
}
