<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230206180816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sandwich ADD client_id_id INT NOT NULL, ADD client INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sandwich ADD CONSTRAINT FK_88270868DC2902E0 FOREIGN KEY (client_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_88270868DC2902E0 ON sandwich (client_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sandwich DROP FOREIGN KEY FK_88270868DC2902E0');
        $this->addSql('DROP INDEX IDX_88270868DC2902E0 ON sandwich');
        $this->addSql('ALTER TABLE sandwich DROP client_id_id, DROP client');
    }
}
