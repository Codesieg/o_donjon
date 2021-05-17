<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210517094554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caracteristic CHANGE level level INT DEFAULT 0, CHANGE experience experience INT DEFAULT 0, CHANGE inspiration inspiration TINYINT(1) DEFAULT \'0\', CHANGE armor_class armor_class INT DEFAULT 0, CHANGE speed speed INT DEFAULT 0, CHANGE current_hp current_hp INT DEFAULT 0, CHANGE total_hp total_hp INT DEFAULT 0, CHANGE death_saves_success death_saves_success INT DEFAULT 0, CHANGE death_saves_failures death_saves_failures INT DEFAULT 0');
        $this->addSql('ALTER TABLE `character` CHANGE age age INT DEFAULT 0, CHANGE initiative initiative INT DEFAULT 0, CHANGE height height INT DEFAULT 0, CHANGE weight weight INT DEFAULT 0');
        $this->addSql('ALTER TABLE npc CHANGE is_ally is_ally VARCHAR(64) DEFAULT NULL');
        $this->addSql('ALTER TABLE saving_throw CHANGE strength strength TINYINT(1) DEFAULT \'0\', CHANGE dexterity dexterity TINYINT(1) DEFAULT \'0\', CHANGE constitution constitution TINYINT(1) DEFAULT \'0\', CHANGE intelligence intelligence TINYINT(1) DEFAULT \'0\', CHANGE wisdom wisdom TINYINT(1) DEFAULT \'0\', CHANGE charisma charisma TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE skill CHANGE acrobatics acrobatics TINYINT(1) DEFAULT \'0\', CHANGE animal_handling animal_handling TINYINT(1) DEFAULT \'0\', CHANGE arcana arcana TINYINT(1) DEFAULT \'0\', CHANGE athletics athletics TINYINT(1) DEFAULT \'0\', CHANGE deception deception TINYINT(1) DEFAULT \'0\', CHANGE history history TINYINT(1) DEFAULT \'0\', CHANGE insight insight TINYINT(1) DEFAULT \'0\', CHANGE intimidation intimidation TINYINT(1) DEFAULT \'0\', CHANGE investigation investigation TINYINT(1) DEFAULT \'0\', CHANGE medecine medecine TINYINT(1) DEFAULT \'0\', CHANGE nature nature TINYINT(1) DEFAULT \'0\', CHANGE perception perception TINYINT(1) DEFAULT \'0\', CHANGE performance performance TINYINT(1) DEFAULT \'0\', CHANGE persuasion persuasion TINYINT(1) DEFAULT \'0\', CHANGE religion religion TINYINT(1) DEFAULT \'0\', CHANGE sleight_of_hand sleight_of_hand TINYINT(1) DEFAULT \'0\', CHANGE stealth stealth TINYINT(1) DEFAULT \'0\', CHANGE survival survival TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE spell CHANGE spell_attack_bonus spell_attack_bonus INT DEFAULT 0, CHANGE spellcasting_ability spellcasting_ability INT DEFAULT 0, CHANGE spell_save_dc spell_save_dc INT DEFAULT 0');
        $this->addSql('ALTER TABLE statistics CHANGE strength strength INT DEFAULT 0, CHANGE dexterity dexterity INT DEFAULT 0, CHANGE constitution constitution INT DEFAULT 0, CHANGE intelligence intelligence INT DEFAULT 0, CHANGE wisdom wisdom INT DEFAULT 0, CHANGE charisma charisma INT DEFAULT 0, CHANGE passive_wisdom passive_wisdom INT DEFAULT 0, CHANGE proficiency_bonus proficiency_bonus INT DEFAULT 0');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caracteristic CHANGE level level INT DEFAULT NULL, CHANGE experience experience INT DEFAULT NULL, CHANGE inspiration inspiration TINYINT(1) DEFAULT NULL, CHANGE armor_class armor_class INT DEFAULT NULL, CHANGE speed speed INT DEFAULT NULL, CHANGE current_hp current_hp INT DEFAULT NULL, CHANGE total_hp total_hp INT DEFAULT NULL, CHANGE death_saves_success death_saves_success INT DEFAULT NULL, CHANGE death_saves_failures death_saves_failures INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `character` CHANGE age age INT DEFAULT NULL, CHANGE initiative initiative INT DEFAULT NULL, CHANGE height height INT DEFAULT NULL, CHANGE weight weight INT DEFAULT NULL');
        $this->addSql('ALTER TABLE npc CHANGE is_ally is_ally INT DEFAULT NULL');
        $this->addSql('ALTER TABLE saving_throw CHANGE strength strength TINYINT(1) DEFAULT NULL, CHANGE dexterity dexterity TINYINT(1) DEFAULT NULL, CHANGE constitution constitution TINYINT(1) DEFAULT NULL, CHANGE intelligence intelligence TINYINT(1) DEFAULT NULL, CHANGE wisdom wisdom TINYINT(1) DEFAULT NULL, CHANGE charisma charisma TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE skill CHANGE acrobatics acrobatics TINYINT(1) NOT NULL, CHANGE animal_handling animal_handling TINYINT(1) DEFAULT NULL, CHANGE arcana arcana TINYINT(1) DEFAULT NULL, CHANGE athletics athletics TINYINT(1) DEFAULT NULL, CHANGE deception deception TINYINT(1) DEFAULT NULL, CHANGE history history TINYINT(1) DEFAULT NULL, CHANGE insight insight TINYINT(1) DEFAULT NULL, CHANGE intimidation intimidation TINYINT(1) DEFAULT NULL, CHANGE investigation investigation TINYINT(1) DEFAULT NULL, CHANGE medecine medecine TINYINT(1) DEFAULT NULL, CHANGE nature nature TINYINT(1) DEFAULT NULL, CHANGE perception perception TINYINT(1) DEFAULT NULL, CHANGE performance performance TINYINT(1) DEFAULT NULL, CHANGE persuasion persuasion TINYINT(1) DEFAULT NULL, CHANGE religion religion TINYINT(1) DEFAULT NULL, CHANGE sleight_of_hand sleight_of_hand TINYINT(1) DEFAULT NULL, CHANGE stealth stealth TINYINT(1) DEFAULT NULL, CHANGE survival survival TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE spell CHANGE spell_attack_bonus spell_attack_bonus INT DEFAULT NULL, CHANGE spellcasting_ability spellcasting_ability INT DEFAULT NULL, CHANGE spell_save_dc spell_save_dc INT DEFAULT NULL');
        $this->addSql('ALTER TABLE statistics CHANGE strength strength INT DEFAULT NULL, CHANGE dexterity dexterity INT DEFAULT NULL, CHANGE constitution constitution INT DEFAULT NULL, CHANGE intelligence intelligence INT DEFAULT NULL, CHANGE wisdom wisdom INT DEFAULT NULL, CHANGE charisma charisma INT DEFAULT NULL, CHANGE passive_wisdom passive_wisdom INT DEFAULT NULL, CHANGE proficiency_bonus proficiency_bonus INT DEFAULT NULL');
    }
}
