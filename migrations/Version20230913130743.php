<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230913130743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post_rubrique (post_id INT UNSIGNED NOT NULL, rubrique_id INT UNSIGNED NOT NULL, INDEX IDX_304980DD4B89032C (post_id), INDEX IDX_304980DD3BD38833 (rubrique_id), PRIMARY KEY(post_id, rubrique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post_rubrique ADD CONSTRAINT FK_304980DD4B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_rubrique ADD CONSTRAINT FK_304980DD3BD38833 FOREIGN KEY (rubrique_id) REFERENCES rubrique (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post_rubrique DROP FOREIGN KEY FK_304980DD4B89032C');
        $this->addSql('ALTER TABLE post_rubrique DROP FOREIGN KEY FK_304980DD3BD38833');
        $this->addSql('DROP TABLE post_rubrique');
    }
}
