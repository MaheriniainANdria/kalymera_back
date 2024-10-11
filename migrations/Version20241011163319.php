<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241011163319 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
{
    $this->addSql('ALTER TABLE dining_table ADD number_of_seats INT NOT NULL DEFAULT 0');
    $this->addSql('ALTER TABLE dining_table ADD type VARCHAR(255) NOT NULL DEFAULT \'normal\'');
    $this->addSql('ALTER TABLE dining_table ADD location VARCHAR(255) NOT NULL DEFAULT \'interieur\'');
}



    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE dining_table DROP number_of_seats');
        $this->addSql('ALTER TABLE dining_table DROP type');
        $this->addSql('ALTER TABLE dining_table DROP location');
    }
}
