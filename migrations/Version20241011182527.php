<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241011182527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dining_table ADD table_number INT NOT NULL');
        $this->addSql('ALTER TABLE dining_table ALTER number_of_seats DROP DEFAULT');
        $this->addSql('ALTER TABLE dining_table ALTER type DROP DEFAULT');
        $this->addSql('ALTER TABLE dining_table ALTER location DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE dining_table DROP table_number');
        $this->addSql('ALTER TABLE dining_table ALTER number_of_seats SET DEFAULT 0');
        $this->addSql('ALTER TABLE dining_table ALTER type SET DEFAULT \'normal\'');
        $this->addSql('ALTER TABLE dining_table ALTER location SET DEFAULT \'interieur\'');
    }
}
