<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260308130000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add conference slug, backfill existing rows, enforce not null and unique';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE conference ADD slug VARCHAR(255)');
        $this->addSql("UPDATE conference SET slug = CONCAT(LOWER(city), '-', year)");
        $this->addSql('ALTER TABLE conference ALTER COLUMN slug SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE conference DROP slug');
    }
}
