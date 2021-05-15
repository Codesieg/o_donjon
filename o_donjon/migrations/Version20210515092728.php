<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210515092728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campaign CHANGE description description LONGTEXT DEFAULT NULL, CHANGE is_archived is_archived TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE caracteristic CHANGE hit_dice hit_dice VARCHAR(64) DEFAULT NULL');
        $this->addSql('ALTER TABLE npc CHANGE is_ally is_ally VARCHAR(64) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campaign CHANGE description description JSON DEFAULT NULL, CHANGE is_archived is_archived TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE caracteristic CHANGE hit_dice hit_dice LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE npc CHANGE is_ally is_ally INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }
}
