<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250829050906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pokemon_pokemon (pokemon_source INT NOT NULL, pokemon_target INT NOT NULL, INDEX IDX_EB6EC6233630327 (pokemon_source), INDEX IDX_EB6EC622A8653A8 (pokemon_target), PRIMARY KEY(pokemon_source, pokemon_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pokemon_pokemon ADD CONSTRAINT FK_EB6EC6233630327 FOREIGN KEY (pokemon_source) REFERENCES pokemon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pokemon_pokemon ADD CONSTRAINT FK_EB6EC622A8653A8 FOREIGN KEY (pokemon_target) REFERENCES pokemon (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pokemon_pokemon DROP FOREIGN KEY FK_EB6EC6233630327');
        $this->addSql('ALTER TABLE pokemon_pokemon DROP FOREIGN KEY FK_EB6EC622A8653A8');
        $this->addSql('DROP TABLE pokemon_pokemon');
    }
}
