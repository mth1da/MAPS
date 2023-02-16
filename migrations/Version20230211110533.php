<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230211110533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE `order` RENAME INDEX idx_f529939851147ade TO IDX_34E8BC9C51147ADE');
        $this->addSql('ALTER TABLE bookmark CHANGE bookmark_user_id bookmark_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C67798CCEDD9B');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C67798CCEDD9B FOREIGN KEY (publi_user_id) REFERENCES user (id) ON DELETE CASCADE');

        //$this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64924A232CF ON user (user_name)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bookmark CHANGE bookmark_user_id bookmark_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE `Order` RENAME INDEX idx_34e8bc9c51147ade TO IDX_F529939851147ADE');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C67798CCEDD9B');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C67798CCEDD9B FOREIGN KEY (publi_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP INDEX UNIQ_8D93D64924A232CF ON user');
        $this->addSql('ALTER TABLE user DROP is_verified');
    }
}
