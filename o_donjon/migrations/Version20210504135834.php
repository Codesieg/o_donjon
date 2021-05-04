<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504135834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campaign (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, name VARCHAR(64) DEFAULT NULL, description LONGTEXT DEFAULT NULL, memo LONGTEXT DEFAULT NULL, is_archived TINYINT(1) DEFAULT NULL, invitation_code VARCHAR(64) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_1F1512DD7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caracteristic (id INT AUTO_INCREMENT NOT NULL, level INT DEFAULT NULL, experience INT DEFAULT NULL, inspiration TINYINT(1) DEFAULT NULL, armor_class INT DEFAULT NULL, speed INT DEFAULT NULL, current_hp INT DEFAULT NULL, total_hp INT DEFAULT NULL, hit_dice LONGTEXT DEFAULT NULL, death_saves_success INT DEFAULT NULL, death_saves_failures INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, campaign_id INT DEFAULT NULL, race_id INT DEFAULT NULL, class_id INT DEFAULT NULL, caracteristics_id INT DEFAULT NULL, statistics_id INT DEFAULT NULL, spell_id INT DEFAULT NULL, saving_throwspell_id INT DEFAULT NULL, skill_id INT DEFAULT NULL, name VARCHAR(64) DEFAULT NULL, avatar_path VARCHAR(255) DEFAULT NULL, age INT DEFAULT NULL, initiative INT DEFAULT NULL, height INT DEFAULT NULL, weight INT DEFAULT NULL, eyes VARCHAR(64) DEFAULT NULL, skin VARCHAR(64) DEFAULT NULL, hair VARCHAR(64) DEFAULT NULL, appearance LONGTEXT DEFAULT NULL, personality_traits LONGTEXT DEFAULT NULL, ideals LONGTEXT DEFAULT NULL, bonds LONGTEXT DEFAULT NULL, flaws LONGTEXT DEFAULT NULL, allies_and_organizations LONGTEXT DEFAULT NULL, backstory LONGTEXT DEFAULT NULL, treasure LONGTEXT DEFAULT NULL, background VARCHAR(64) DEFAULT NULL, alignement VARCHAR(64) DEFAULT NULL, attacks_and_spellcasting LONGTEXT DEFAULT NULL, equipment LONGTEXT DEFAULT NULL, other_proficiencies_and_languages LONGTEXT DEFAULT NULL, features_and_traits LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_937AB034A76ED395 (user_id), INDEX IDX_937AB034F639F774 (campaign_id), UNIQUE INDEX UNIQ_937AB0346E59D40D (race_id), UNIQUE INDEX UNIQ_937AB034EA000B10 (class_id), UNIQUE INDEX UNIQ_937AB0345D20926C (caracteristics_id), UNIQUE INDEX UNIQ_937AB0349A2595B2 (statistics_id), UNIQUE INDEX UNIQ_937AB034479EC90D (spell_id), UNIQUE INDEX UNIQ_937AB034D33B22E8 (saving_throwspell_id), UNIQUE INDEX UNIQ_937AB0345585C142 (skill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_class (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) DEFAULT NULL, informations LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE map (id INT AUTO_INCREMENT NOT NULL, campaign_id INT DEFAULT NULL, file_path VARCHAR(255) DEFAULT NULL, name VARCHAR(64) DEFAULT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_93ADAABBF639F774 (campaign_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE npc (id INT AUTO_INCREMENT NOT NULL, campaign_id INT DEFAULT NULL, name VARCHAR(64) DEFAULT NULL, type VARCHAR(64) DEFAULT NULL, description LONGTEXT DEFAULT NULL, is_ally INT DEFAULT NULL, INDEX IDX_468C762CF639F774 (campaign_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) DEFAULT NULL, informations LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saving_throw (id INT AUTO_INCREMENT NOT NULL, strength TINYINT(1) DEFAULT NULL, dexterity TINYINT(1) DEFAULT NULL, constitution TINYINT(1) DEFAULT NULL, intelligence TINYINT(1) DEFAULT NULL, wisdom TINYINT(1) DEFAULT NULL, charisma TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, acrobatics TINYINT(1) NOT NULL, animal_handling TINYINT(1) DEFAULT NULL, arcana TINYINT(1) DEFAULT NULL, athletics TINYINT(1) DEFAULT NULL, deception TINYINT(1) DEFAULT NULL, history TINYINT(1) DEFAULT NULL, insight TINYINT(1) DEFAULT NULL, intimidation TINYINT(1) DEFAULT NULL, investigation TINYINT(1) DEFAULT NULL, medecine TINYINT(1) DEFAULT NULL, nature TINYINT(1) DEFAULT NULL, perception TINYINT(1) DEFAULT NULL, performance TINYINT(1) DEFAULT NULL, persuasion TINYINT(1) DEFAULT NULL, religion TINYINT(1) DEFAULT NULL, sleight_of_hand TINYINT(1) DEFAULT NULL, stealth TINYINT(1) DEFAULT NULL, survival TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spell (id INT AUTO_INCREMENT NOT NULL, spellcasting_class VARCHAR(64) DEFAULT NULL, spell_attack_bonus INT DEFAULT NULL, spellcasting_ability INT DEFAULT NULL, spell_save_dc INT DEFAULT NULL, spells_list LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistics (id INT AUTO_INCREMENT NOT NULL, strength INT DEFAULT NULL, dexterity INT DEFAULT NULL, constitution INT DEFAULT NULL, intelligence INT DEFAULT NULL, wisdom INT DEFAULT NULL, charisma INT DEFAULT NULL, passive_wisdom INT DEFAULT NULL, proficiency_bonus INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE story (id INT AUTO_INCREMENT NOT NULL, campaign_id INT DEFAULT NULL, name VARCHAR(64) DEFAULT NULL, description LONGTEXT DEFAULT NULL, is_done TINYINT(1) DEFAULT NULL, report LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_EB560438F639F774 (campaign_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(64) DEFAULT NULL, avatar_path VARCHAR(255) DEFAULT NULL, status SMALLINT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_campaign (user_id INT NOT NULL, campaign_id INT NOT NULL, INDEX IDX_FF98F6DDA76ED395 (user_id), INDEX IDX_FF98F6DDF639F774 (campaign_id), PRIMARY KEY(user_id, campaign_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE campaign ADD CONSTRAINT FK_1F1512DD7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034F639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0346E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034EA000B10 FOREIGN KEY (class_id) REFERENCES character_class (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0345D20926C FOREIGN KEY (caracteristics_id) REFERENCES caracteristic (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0349A2595B2 FOREIGN KEY (statistics_id) REFERENCES statistics (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034479EC90D FOREIGN KEY (spell_id) REFERENCES spell (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034D33B22E8 FOREIGN KEY (saving_throwspell_id) REFERENCES saving_throw (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0345585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE map ADD CONSTRAINT FK_93ADAABBF639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id)');
        $this->addSql('ALTER TABLE npc ADD CONSTRAINT FK_468C762CF639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id)');
        $this->addSql('ALTER TABLE story ADD CONSTRAINT FK_EB560438F639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id)');
        $this->addSql('ALTER TABLE user_campaign ADD CONSTRAINT FK_FF98F6DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_campaign ADD CONSTRAINT FK_FF98F6DDF639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034F639F774');
        $this->addSql('ALTER TABLE map DROP FOREIGN KEY FK_93ADAABBF639F774');
        $this->addSql('ALTER TABLE npc DROP FOREIGN KEY FK_468C762CF639F774');
        $this->addSql('ALTER TABLE story DROP FOREIGN KEY FK_EB560438F639F774');
        $this->addSql('ALTER TABLE user_campaign DROP FOREIGN KEY FK_FF98F6DDF639F774');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB0345D20926C');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034EA000B10');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB0346E59D40D');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034D33B22E8');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB0345585C142');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034479EC90D');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB0349A2595B2');
        $this->addSql('ALTER TABLE campaign DROP FOREIGN KEY FK_1F1512DD7E3C61F9');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034A76ED395');
        $this->addSql('ALTER TABLE user_campaign DROP FOREIGN KEY FK_FF98F6DDA76ED395');
        $this->addSql('DROP TABLE campaign');
        $this->addSql('DROP TABLE caracteristic');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE character_class');
        $this->addSql('DROP TABLE map');
        $this->addSql('DROP TABLE npc');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE saving_throw');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE spell');
        $this->addSql('DROP TABLE statistics');
        $this->addSql('DROP TABLE story');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_campaign');
    }
}
