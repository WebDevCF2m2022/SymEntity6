<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230913122307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE date_post date_post DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A8A6C8DD347411D ON post (title_slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_5A8A6C8DD347411D ON post');
        $this->addSql('ALTER TABLE post CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE date_post date_post DATETIME DEFAULT NULL');
    }
}
