<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230129165928 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `Order` (id INT AUTO_INCREMENT NOT NULL, order_user_id INT NOT NULL, cost NUMERIC(6, 2) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_34E8BC9C51147ADE (order_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `Table` (id INT AUTO_INCREMENT NOT NULL, nb_seat INT NOT NULL, location VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('CREATE TABLE bookmark (id INT AUTO_INCREMENT NOT NULL, bookmark_user_id INT DEFAULT NULL, bookmark_sandwich_id INT NOT NULL, INDEX IDX_DA62921DCAB6B8AE (bookmark_user_id), INDEX IDX_DA62921D541C69D0 (bookmark_sandwich_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, types_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price NUMERIC(6, 2) NOT NULL, photo VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_6BAF78708EB23357 (types_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publication (id INT AUTO_INCREMENT NOT NULL, publi_user_id INT NOT NULL, photo VARCHAR(255) DEFAULT NULL, commentaire LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_AF3C67798CCEDD9B (publi_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, resa_table_id INT NOT NULL, resa_user_id INT DEFAULT NULL, date_time_reservation DATETIME NOT NULL, INDEX IDX_42C8495518FEB67B (resa_table_id), INDEX IDX_42C849557245A583 (resa_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sandwich (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION DEFAULT NULL, is_original TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sandwich_ingredient (sandwich_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_976ACE844D566043 (sandwich_id), INDEX IDX_976ACE84933FE08C (ingredient_id), PRIMARY KEY(sandwich_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, user_name VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', token VARCHAR(255) DEFAULT NULL, is_verified TINYINT(1) NOT NULL, reset_token VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D64924A232CF (user_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `Order` ADD CONSTRAINT FK_34E8BC9C51147ADE FOREIGN KEY (order_user_id) REFERENCES user (id)');
        //$this->addSql('ALTER TABLE bookmark ADD CONSTRAINT FK_DA62921DCAB6B8AE FOREIGN KEY (bookmark_user_id) REFERENCES user (id)');
        //$this->addSql('ALTER TABLE bookmark ADD CONSTRAINT FK_DA62921D541C69D0 FOREIGN KEY (bookmark_sandwich_id) REFERENCES sandwich (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF78708EB23357 FOREIGN KEY (types_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C67798CCEDD9B FOREIGN KEY (publi_user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495518FEB67B FOREIGN KEY (resa_table_id) REFERENCES `Table` (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849557245A583 FOREIGN KEY (resa_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sandwich_ingredient ADD CONSTRAINT FK_976ACE844D566043 FOREIGN KEY (sandwich_id) REFERENCES sandwich (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sandwich_ingredient ADD CONSTRAINT FK_976ACE84933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `Order` DROP FOREIGN KEY FK_34E8BC9C51147ADE');
        $this->addSql('ALTER TABLE bookmark DROP FOREIGN KEY FK_DA62921DCAB6B8AE');
        $this->addSql('ALTER TABLE bookmark DROP FOREIGN KEY FK_DA62921D541C69D0');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF78708EB23357');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C67798CCEDD9B');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495518FEB67B');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849557245A583');
        $this->addSql('ALTER TABLE sandwich_ingredient DROP FOREIGN KEY FK_976ACE844D566043');
        $this->addSql('ALTER TABLE sandwich_ingredient DROP FOREIGN KEY FK_976ACE84933FE08C');
        $this->addSql('DROP TABLE `Order`');
        $this->addSql('DROP TABLE `Table`');
        $this->addSql('DROP TABLE bookmark');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE publication');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE sandwich');
        $this->addSql('DROP TABLE sandwich_ingredient');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
