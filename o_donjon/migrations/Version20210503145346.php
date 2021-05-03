<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503145346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campaign (id INT AUTO_INCREMENT NOT NULL, dm_id INT DEFAULT NULL, name VARCHAR(64) NOT NULL, description LONGTEXT NOT NULL, memo LONGTEXT NOT NULL, is_archived TINYINT(1) NOT NULL, invitation_code VARCHAR(64) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_1F1512DDBA14FCCC (invitation_code), INDEX IDX_1F1512DDFADC156C (dm_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campaign_user (campaign_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_8C74EDABF639F774 (campaign_id), INDEX IDX_8C74EDABA76ED395 (user_id), PRIMARY KEY(campaign_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caracteristic (id INT AUTO_INCREMENT NOT NULL, character_id INT DEFAULT NULL, level INT DEFAULT 1 NOT NULL, experience INT DEFAULT 0 NOT NULL, inspiration TINYINT(1) DEFAULT \'0\' NOT NULL, armor_class INT DEFAULT 0 NOT NULL, speed INT NOT NULL, current_hp INT DEFAULT 0 NOT NULL, total_hp INT DEFAULT 0 NOT NULL, hit_dice VARCHAR(64) DEFAULT NULL, death_saves_success INT DEFAULT 0 NOT NULL, death_saves_failures INT DEFAULT 0 NOT NULL, UNIQUE INDEX UNIQ_9B9583441136BE75 (character_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, character_user_id INT NOT NULL, campaign_id INT DEFAULT NULL, class_id INT NOT NULL, stats_id INT DEFAULT NULL, saving_throws_id INT DEFAULT NULL, skill_id INT DEFAULT NULL, race_id INT DEFAULT NULL, name VARCHAR(64) DEFAULT NULL, avatar_path VARCHAR(255) DEFAULT NULL, age INT DEFAULT NULL, initiative INT DEFAULT NULL, height INT DEFAULT NULL, weight INT DEFAULT NULL, eyes VARCHAR(64) DEFAULT NULL, skin VARCHAR(64) DEFAULT NULL, hair VARCHAR(64) DEFAULT NULL, appearance LONGTEXT DEFAULT NULL, personnality_traits VARCHAR(255) NOT NULL, ideals LONGTEXT DEFAULT NULL, bonds LONGTEXT DEFAULT NULL, flaws VARCHAR(64) DEFAULT NULL, allies_and_organizations LONGTEXT DEFAULT NULL, backstory LONGTEXT DEFAULT NULL, treasure VARCHAR(255) DEFAULT NULL, background VARCHAR(64) DEFAULT NULL, alignement VARCHAR(64) DEFAULT NULL, attacks_and_spellcasting LONGTEXT DEFAULT NULL, equipment LONGTEXT DEFAULT NULL, other_proficiencies_and_languages LONGTEXT DEFAULT NULL, features_and_traits LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_937AB034CECB53A8 (character_user_id), INDEX IDX_937AB034F639F774 (campaign_id), UNIQUE INDEX UNIQ_937AB034EA000B10 (class_id), UNIQUE INDEX UNIQ_937AB03470AA3482 (stats_id), UNIQUE INDEX UNIQ_937AB034DE4614D (saving_throws_id), UNIQUE INDEX UNIQ_937AB0345585C142 (skill_id), UNIQUE INDEX UNIQ_937AB0346E59D40D (race_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_class (id INT AUTO_INCREMENT NOT NULL, character_id INT DEFAULT NULL, name VARCHAR(64) NOT NULL, informations LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_1388FEFD1136BE75 (character_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE map (id INT AUTO_INCREMENT NOT NULL, campaign_id INT DEFAULT NULL, file_path VARCHAR(255) DEFAULT NULL, name VARCHAR(64) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_93ADAABBF639F774 (campaign_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE npc (id INT AUTO_INCREMENT NOT NULL, campaign_id INT DEFAULT NULL, name VARCHAR(64) NOT NULL, type VARCHAR(64) DEFAULT NULL, is_ally VARCHAR(64) DEFAULT \'NEUTRAL\' NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_468C762CF639F774 (campaign_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE npc_story (npc_id INT NOT NULL, story_id INT NOT NULL, INDEX IDX_B40AC077CA7D6B89 (npc_id), INDEX IDX_B40AC077AA5D4036 (story_id), PRIMARY KEY(npc_id, story_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, character_id INT DEFAULT NULL, name VARCHAR(64) NOT NULL, informations LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_DA6FBBAF1136BE75 (character_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saving_throw (id INT AUTO_INCREMENT NOT NULL, character_id INT DEFAULT NULL, strength TINYINT(1) DEFAULT \'0\' NOT NULL, dexterity TINYINT(1) DEFAULT \'0\' NOT NULL, constitution TINYINT(1) DEFAULT \'0\' NOT NULL, intelligence TINYINT(1) DEFAULT \'0\' NOT NULL, wisdom TINYINT(1) DEFAULT \'0\' NOT NULL, charisma TINYINT(1) DEFAULT \'0\' NOT NULL, UNIQUE INDEX UNIQ_4DD5D2591136BE75 (character_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, character_id INT DEFAULT NULL, acrobatics TINYINT(1) DEFAULT \'0\' NOT NULL, animal_handling TINYINT(1) DEFAULT \'0\' NOT NULL, arcana TINYINT(1) DEFAULT \'0\' NOT NULL, athletics TINYINT(1) DEFAULT \'0\' NOT NULL, deception TINYINT(1) DEFAULT \'0\' NOT NULL, history TINYINT(1) DEFAULT \'0\' NOT NULL, insight TINYINT(1) DEFAULT \'0\' NOT NULL, intimidation TINYINT(1) DEFAULT \'0\' NOT NULL, medecine TINYINT(1) DEFAULT \'0\' NOT NULL, nature TINYINT(1) DEFAULT \'0\' NOT NULL, perception TINYINT(1) DEFAULT \'0\' NOT NULL, performance TINYINT(1) DEFAULT \'0\' NOT NULL, persuasion TINYINT(1) DEFAULT \'0\' NOT NULL, religion TINYINT(1) DEFAULT \'0\' NOT NULL, sleight_of_hand TINYINT(1) DEFAULT \'0\' NOT NULL, stealth TINYINT(1) DEFAULT \'0\' NOT NULL, survival TINYINT(1) DEFAULT \'0\' NOT NULL, UNIQUE INDEX UNIQ_5E3DE4771136BE75 (character_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spell (id INT AUTO_INCREMENT NOT NULL, character_id INT DEFAULT NULL, spellcasting_class VARCHAR(64) DEFAULT NULL, spell_attack_bonus INT DEFAULT 0 NOT NULL, spellcasting_ability INT DEFAULT 0 NOT NULL, spell_save_dc INT DEFAULT 0 NOT NULL, spells_list LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_D03FCD8D1136BE75 (character_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistics (id INT AUTO_INCREMENT NOT NULL, character_id INT DEFAULT NULL, strength INT DEFAULT 0 NOT NULL, dexterity INT DEFAULT 0 NOT NULL, constitution INT DEFAULT 0 NOT NULL, intelligence INT DEFAULT 0 NOT NULL, wisdom INT DEFAULT 0 NOT NULL, charisma INT DEFAULT 0 NOT NULL, passive_wisdom INT DEFAULT 0 NOT NULL, proficiency_bonus INT DEFAULT 0 NOT NULL, UNIQUE INDEX UNIQ_E2D38B221136BE75 (character_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE story (id INT AUTO_INCREMENT NOT NULL, campaign_id INT DEFAULT NULL, name VARCHAR(64) NOT NULL, description LONGTEXT DEFAULT NULL, is_done TINYINT(1) NOT NULL, report LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_EB560438F639F774 (campaign_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(64) NOT NULL, password VARCHAR(64) NOT NULL, pseudo VARCHAR(64) NOT NULL, avatar_path VARCHAR(255) DEFAULT NULL, status SMALLINT DEFAULT 0 NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE campaign ADD CONSTRAINT FK_1F1512DDFADC156C FOREIGN KEY (dm_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE campaign_user ADD CONSTRAINT FK_8C74EDABF639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campaign_user ADD CONSTRAINT FK_8C74EDABA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caracteristic ADD CONSTRAINT FK_9B9583441136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034CECB53A8 FOREIGN KEY (character_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034F639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034EA000B10 FOREIGN KEY (class_id) REFERENCES character_class (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB03470AA3482 FOREIGN KEY (stats_id) REFERENCES statistics (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034DE4614D FOREIGN KEY (saving_throws_id) REFERENCES saving_throw (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0345585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0346E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('ALTER TABLE character_class ADD CONSTRAINT FK_1388FEFD1136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE map ADD CONSTRAINT FK_93ADAABBF639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id)');
        $this->addSql('ALTER TABLE npc ADD CONSTRAINT FK_468C762CF639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id)');
        $this->addSql('ALTER TABLE npc_story ADD CONSTRAINT FK_B40AC077CA7D6B89 FOREIGN KEY (npc_id) REFERENCES npc (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE npc_story ADD CONSTRAINT FK_B40AC077AA5D4036 FOREIGN KEY (story_id) REFERENCES story (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE race ADD CONSTRAINT FK_DA6FBBAF1136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE saving_throw ADD CONSTRAINT FK_4DD5D2591136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE4771136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE spell ADD CONSTRAINT FK_D03FCD8D1136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE statistics ADD CONSTRAINT FK_E2D38B221136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id)');
        $this->addSql('ALTER TABLE story ADD CONSTRAINT FK_EB560438F639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campaign_user DROP FOREIGN KEY FK_8C74EDABF639F774');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034F639F774');
        $this->addSql('ALTER TABLE map DROP FOREIGN KEY FK_93ADAABBF639F774');
        $this->addSql('ALTER TABLE npc DROP FOREIGN KEY FK_468C762CF639F774');
        $this->addSql('ALTER TABLE story DROP FOREIGN KEY FK_EB560438F639F774');
        $this->addSql('ALTER TABLE caracteristic DROP FOREIGN KEY FK_9B9583441136BE75');
        $this->addSql('ALTER TABLE character_class DROP FOREIGN KEY FK_1388FEFD1136BE75');
        $this->addSql('ALTER TABLE race DROP FOREIGN KEY FK_DA6FBBAF1136BE75');
        $this->addSql('ALTER TABLE saving_throw DROP FOREIGN KEY FK_4DD5D2591136BE75');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE4771136BE75');
        $this->addSql('ALTER TABLE spell DROP FOREIGN KEY FK_D03FCD8D1136BE75');
        $this->addSql('ALTER TABLE statistics DROP FOREIGN KEY FK_E2D38B221136BE75');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034EA000B10');
        $this->addSql('ALTER TABLE npc_story DROP FOREIGN KEY FK_B40AC077CA7D6B89');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB0346E59D40D');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034DE4614D');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB0345585C142');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB03470AA3482');
        $this->addSql('ALTER TABLE npc_story DROP FOREIGN KEY FK_B40AC077AA5D4036');
        $this->addSql('ALTER TABLE campaign DROP FOREIGN KEY FK_1F1512DDFADC156C');
        $this->addSql('ALTER TABLE campaign_user DROP FOREIGN KEY FK_8C74EDABA76ED395');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034CECB53A8');
        $this->addSql('DROP TABLE campaign');
        $this->addSql('DROP TABLE campaign_user');
        $this->addSql('DROP TABLE caracteristic');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE character_class');
        $this->addSql('DROP TABLE map');
        $this->addSql('DROP TABLE npc');
        $this->addSql('DROP TABLE npc_story');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE saving_throw');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE spell');
        $this->addSql('DROP TABLE statistics');
        $this->addSql('DROP TABLE story');
        $this->addSql('DROP TABLE user');
    }
}
