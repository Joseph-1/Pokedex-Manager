<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250815002200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon CHANGE pokedex_id pokedex_id INT NOT NULL, CHANGE size size DOUBLE PRECISION NOT NULL, CHANGE weight weight DOUBLE PRECISION NOT NULL, CHANGE sex sex VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon CHANGE pokedex_id pokedex_id INT DEFAULT NULL, CHANGE size size DOUBLE PRECISION DEFAULT NULL, CHANGE weight weight DOUBLE PRECISION DEFAULT NULL, CHANGE sex sex VARCHAR(255) DEFAULT NULL');
    }
}
