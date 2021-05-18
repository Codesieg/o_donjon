<?php

namespace App\DataFixtures;

use App\Entity\Character;
use App\Entity\Race;
use App\Entity\CharacterClass;
use App\Entity\Caracteristic;
use App\Entity\Statistics;
use App\Entity\Spell;
use App\Entity\SavingThrow;
use App\Entity\Skill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture

{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        
        /*******************************************************TABLES WITH DATA*******************************************/

        /*****CHARACTER TABLE****************/

        $characterNames = [
            'Pikachu',
            'Salameche',
            'Bullbizar',
            'Miaous',
            'JojoLapin',
            'Albator',
            'CapitaineFlam',
            'NainPortekoi',
            'Merlin',
            'Chevalier Arthur',
        ];

        $characterEyes = [
            'brown',
            'blue',
            'grey',
            'green',
            'black',
            'green-blue',
        ];

        $characterSkins = [
            'white',
            'black',
            'red',
            'yellow',
            'blue',
        ];

        $characterHairs = [
            'brown',
            'blond',
            'white',
            'black',
            'red',
        ];

        $appearance = [
            'beautiful',
            'muscular',
            'attractive',
            'handsome',
            'ugly',
        ];

        $personnalityTraits = [
            'polite',
            'friendly',
            'honest',
            'generous',
            'rude',
            'lazy',
            'angry',
        ];

        $ideals = [
            'Master of the world',
            'Peace life',
            'Freedom',
            'Justice',
            'Creativity',
            'Tradition',
            'Honor',
        ];

        $flaws = [
            'greedy',
            'stupid',
            'jealous',
            'gourmet',
            'narcissic',

        ];

        $alliesAndOrganizations = [
            'Schtroumpfs',
            'Zigomatics',
            'Vikings',
            'Persians',

        ];

        $treasure = [
            'aromatics',
            'gold powder',
            'silver plates',
            'crown',
            'magic wand',
            'gemstones',
        ];

        $background = [
            'thief',
            'king',
            'monster',
            'blacksmith',
            'bard',
            'fishmonger',
            'prince',
            'woodcarver',
            'wizard',
            'farmer',
        ];

        $alignement = [
            'lawful good',
            'neutral good',
            'chaotic good',
            'lawful neutral',
            'chaotic neutral',
            'lawful evil',
            'chaotic evil',
        ];

        $equipment = [
            'sword',
            'padded armor',
            'candle',
            'torch',
            'rope',
            'shield',
            'leather armor',
            'studded armor',
            'ring mail armor',
            'breastplate armor',
            'javelin',
            'dagger'

        ];

        $words = [
            'Lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipisicing', 'elit', 'Cumque', 'itaque', 'maiores', 'voluptatum', 'ducimus', 'molestias', 'eveniet', 'rerum', 'atque', 'illo', 'minima', 'odit', 'officiis', 'voluptatem', 'eos', 'Distinctio', 'consequuntur', 'repudiandae', 'Amet', 'laboriosam','illo', 'aliquid',  'Tenetur', 'nihil', 'harum', 'est', 'autem', 'dolorum', 'ipsam', 'esse', 'recusandae', 'aspernatur', 'voluptatum', 'eveniet', 'libero', 'aliquam', 'officia', 'ullam', 'facere', 'quidem', 'doloribus', 'mollitia', 'adipisci', 'fuga', 'Molestiae', 'nobis', 'illo', 'Similique', 'soluta', 'officia', 'maiores', 'assumenda', 'temporibus', 'nostrum', 'adipisci', 'voluptatum', 'inventore', 'cum', 'quos', 'natus', 'dolorem', 'sapiente', 'sit', 'saepe', 'est', 'non'
        ];


        /******************RACE TABLE****************/

        $raceNames = [
            'human',
            'dwarves',
            'elves',
            'halflings',
            'dragonborn',
            'gnome',
            'half-elfe',
            'half-orc',
            'tiefling',
            'aarakocra',
        ];


        /******************CLASS TABLE****************/

        $classNames = [
            'barbarian',
            'bard',
            'cleric',
            'druid',
            'fighter',
            'monk',
            'paladin',
            'ranger',
            'rogue',
            'sorcerer',
            'warlock',
            'wizard',
        ];


        /******************SPELL TABLE*************************/

        $spellCastingClasses = [
            'barbarian',
            'bard',
            'cleric',
            'druid',
            'fighter',
            'monk',
            'paladin',
            'ranger',
            'rogue',
            'sorcerer',
            'warlock',
            'wizard',
        ];

        $spellsList = [
            'animal friendship',
            'acid splash',
            'blink',
            'calm emotions',
            'detect poison and disease',
            'greater invisibility',
            'hypnotic pattern',
            'guidance',
            'poison spray',
            'teleport',
        ];

        
        /****************************************************CHARACTER CREATION***************************************************/

               
        $characters = [];
        $races = [];
        $classes = [];
        $caracteristics = [];
        $statistics = [];
        $spells = [];
        $savingThrows = [];
        $skills = [];

        foreach ($characterNames as $characterName) {
            
            $character = new Character();
            
            $character->setName($characterName);
            
            $character->setAvatarPath($characterName . '.png');
            
            $character->setAge(random_int(0, 300));
            
            $character->setHeight(random_int(50, 300));
            
            $character->setWeight(random_int(10, 200));
            
            shuffle($characterEyes);
            $character->setEyes($characterEyes[0]);
            
            shuffle($characterSkins);
            $character->setSkin($characterSkins[1]);
            
            shuffle($characterHairs);
            $character->setHair($characterHairs[1]);
            
            shuffle($appearance);
            $character->setAppearance($appearance[1]);
            
            shuffle($personnalityTraits);
            $character->setPersonalityTraits($personnalityTraits[1]);
            
            shuffle($ideals);
            $character->setIdeals($ideals[1]);

            shuffle($words);
            $bonds = '';
            for ($i=0; $i < rand(5, 15); $i++) { 
                $bonds = $bonds . " " . $words[$i];
            };
            $character->setBonds($bonds);
            
            shuffle($flaws);
            $character->setFlaws($flaws[1]);

            shuffle($alliesAndOrganizations);
            $character->setAlliesAndOrganizations($alliesAndOrganizations[1]);

            shuffle($words);
            $backstory = '';
            for ($i = 0; $i < rand(30, 50); $i++) { 
                $backstory = $backstory . " " . $words[$i];
            };
            $character->setBackstory($backstory);

            shuffle($treasure);
            $character->setTreasure($treasure[1]);

            shuffle($background);
            $character->setBackground($background[1]);

            $race = new Race();
            $character->setRace($race);
            $races[] = $race;

            $class = new CharacterClass();
            $character->setClass($class);
            $classes[] = $class;

            $caracteristic = new Caracteristic();
            $character->setCaracteristics($caracteristic);
            $caracteristics[] = $caracteristic;

            $statistic = new Statistics();
            $character->setStatistics($statistic);
            $statistics[] = $statistic;

            $spell = new Spell();
            $character->setSpell($spell);
            $spells[] = $spell;

            $savingThrow = new SavingThrow();
            $character->setSavingThrowspell($savingThrow);
            $savingThrows[] = $savingThrow;

            $skill = new Skill();
            $character->setSkill($skill);
            $skills[] = $skill;
            
            $manager->persist($character);
            
            $characters[] = $character;
        }

        /****************************************************RACE CREATION***************************************************/

        foreach ($races as $race) {
            
            shuffle($raceNames);
            $race->setName($raceNames[1]);
            
            shuffle($words);
            $informations = '';
            for ($i = 0; $i < rand(1, 5); $i++) { 
                $informations = $informations . " " . $words[$i];
            };
            $race->setInformations($informations);
            
        }

        /****************************************************CLASS CREATION***************************************************/

        foreach ($classes as $class) {
            
            shuffle($classNames);
            $class->setName($classNames[1]);
            
            shuffle($words);
            $informations = '';
            for ($i = 0; $i < rand(1, 5); $i++) { 
                $informations = $informations . " " . $words[$i];
            };
            $class->setInformations($informations);
            
        }

        /****************************************************CARACTERISTIC CREATION***************************************************/

        foreach ($caracteristics as $caracteristic) {
            
            $caracteristic->setLevel(random_int(1, 20));
            $caracteristic->setExperience(random_int(1, 100));
            $caracteristic->setInspiration((bool)random_int(0, 1));
            $caracteristic->setArmorClass(random_int(1, 10));
            $caracteristic->setSpeed(random_int(1, 30));
            $caracteristic->setCurrentHP(random_int(1, 100));
            $caracteristic->setTotalHP(random_int(1, 100));
            $caracteristic->setHitDice(random_int(1, 20));
            $caracteristic->setDeathSavesSuccess(random_int(1, 10));
            $caracteristic->setDeathSavesFailures(random_int(1, 10));
      
            
        }

        /****************************************************STATISTIC CREATION***************************************************/

        foreach ($statistics as $statistic) {
            
            $statistic->setStrength(random_int(1, 10));
            $statistic->setDexterity(random_int(1, 10));
            $statistic->setConstitution(random_int(1, 10));
            $statistic->setIntelligence(random_int(1, 10));
            $statistic->setWisdom(random_int(1, 10));
            $statistic->setCharisma(random_int(1, 10));
            $statistic->setPassiveWisdom(random_int(1, 10));
            $statistic->setProficiencyBonus(random_int(1, 10));
                        
        }

        /****************************************************SPELL CREATION***************************************************/

        foreach ($spells as $spell) {
            
            shuffle($spellCastingClasses);
            $spell->setSpellcastingClass($spellCastingClasses[1]);

            $spell->setSpellAttackBonus(random_int(1, 10));
            
            $spell->setSpellcastingAbility(random_int(1, 10));

            $spell->setSpellSaveDc(random_int(1, 10));

            shuffle($spellsList);
            $characterSpells = '';
            for ($i = 0; $i < rand(1, 5); $i++) { 
                $characterSpells = $characterSpells . " " . $spellsList[$i];
            };
            $spell->setSpellsList($characterSpells);              
        }

        /****************************************************SAVING THROW CREATION***************************************************/

        foreach ($savingThrows as $savingThrow) {
 
            $savingThrow->setStrength((bool)random_int(0, 1));
            $savingThrow->setDexterity((bool)random_int(0, 1));
            $savingThrow->setConstitution((bool)random_int(0, 1));
            $savingThrow->setIntelligence((bool)random_int(0, 1));
            $savingThrow->setWisdom((bool)random_int(0, 1));
            $savingThrow->setCharisma((bool)random_int(0, 1));           
        }

        /****************************************************SKILL CREATION***************************************************/

        foreach ($skills as $skill) {
 
            $skill->setAcrobatics((bool)random_int(0, 1));
            $skill->setAnimalHandling((bool)random_int(0, 1));
            $skill->setArcana((bool)random_int(0, 1));
            $skill->setAthletics((bool)random_int(0, 1));
            $skill->setDeception((bool)random_int(0, 1));
            $skill->setHistory((bool)random_int(0, 1));
            $skill->setInsight((bool)random_int(0, 1));
            $skill->setIntimidation((bool)random_int(0, 1));
            $skill->setInvestigation((bool)random_int(0, 1));
            $skill->setMedecine((bool)random_int(0, 1));
            $skill->setNature((bool)random_int(0, 1));
            $skill->setPerception((bool)random_int(0, 1));
            $skill->setPerformance((bool)random_int(0, 1));
            $skill->setPersuasion((bool)random_int(0, 1));
            $skill->setReligion((bool)random_int(0, 1));
            $skill->setSleightOfHand((bool)random_int(0, 1));
            $skill->setStealth((bool)random_int(0, 1));
            $skill->setSurvival((bool)random_int(0, 1));
          
        }



        /******************************************************************************************************************************/
        /****************************************************SENDING TO THE DB*********************************************************/
        /******************************************************************************************************************************/

        $manager->flush();

    }
}
