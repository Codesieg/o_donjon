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
use App\Entity\Campaign;
use App\Entity\Map;
use App\Entity\Story;
use App\Entity\NPC;
use App\Entity\User;
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
        /******************************************************************************************************************/
        /*******************************************************TABLES WITH DATA*******************************************/
        /******************************************************************************************************************/


        /***WORDS TO CREATE RANDOM TEXT****/
        
        $words = [
            'Lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipisicing', 'elit', 'Cumque', 'itaque', 'maiores', 'voluptatum', 'ducimus', 'molestias', 'eveniet', 'rerum', 'atque', 'illo', 'minima', 'odit', 'officiis', 'voluptatem', 'eos', 'Distinctio', 'consequuntur', 'repudiandae', 'Amet', 'laboriosam','illo', 'aliquid',  'Tenetur', 'nihil', 'harum', 'est', 'autem', 'dolorum', 'ipsam', 'esse', 'recusandae', 'aspernatur', 'voluptatum', 'eveniet', 'libero', 'aliquam', 'officia', 'ullam', 'facere', 'quidem', 'doloribus', 'mollitia', 'adipisci', 'fuga', 'Molestiae', 'nobis', 'illo', 'Similique', 'soluta', 'officia', 'maiores', 'assumenda', 'temporibus', 'nostrum', 'adipisci', 'voluptatum', 'inventore', 'cum', 'quos', 'natus', 'dolorem', 'sapiente', 'sit', 'saepe', 'est', 'non'
        ];


        /**********USER DATA****************/

        $userEmails = [
            'nicolas@odonjon.com',
            'nael@odonjon.com',
            'amelie@odonjon.com',
            'mathieu@odonjon.com',
            'mickael@odonjon.com',
            'cecile@odonjon.com',
        ];

        /*****CAMPAIGN DATA****************/

        $campaignNames = [
            'Lanilet Abyss',
            'The Expanse of Ammar',
            'Bordfait Bay',
            'Krǫptugrgarðr ',
            'The Flat Fields',
            'The Tranquil Havens',
            'The Arrival Territory',
            'The Mad Rift',
            'The Guardian Domain',
            'The Quag of Blythehampton',
            'Elegant Woodland',
            'Little Kingfisher Grove',
            'Danvista Timberland',
            'Small Wonders Meadow',
            'Nightowl Gardens',
            'Windy Willows Grange',
            'Rattlesnake Fields',           
        ];

        /*****MAP DATA****************/

        $mapNames = [
            'The Eternity Amphitheater',
            'The Bloodbath Stadium',
            'The Anthrax Arena',
            'Lirk Vale',
            'Strab Market',
            'Briostrint East',
            'Lower Leerlal',
            'Tottiact Point',
            'Upper South Shrepim',
            'Plapap Wood',
            'Downtown Cheaheb',
            'Hepislet Garden',
            'Grigimrag',
            'Boulder Mountain Penitentiary',
            'Ashmount Asylum',
            'Doveport Prison',
        ];

        /*****STORY DATA****************/

        $storyNames = [
            'Super powers in paradise gardens',
            'Deserted in your parents in law\'s house',
            'Personification of the local restaurant',
            'Bravery in the kitchen',
            'Body swap in the swamp',
            'Creature of your parents in law\'s house',
            'Heroism in the sport stadium',
            'Job in your new house',
            'Insomnia in another dimension',
            'Mysterious door in the swamp',
            'Ruling the world with a centaur',
            'Double life of your best friend',
            'Boardgames with an arsonist',
            'Pillow fight with a mutant',
            'Changing history with a deaf person',
            'Spending time in nature with a psychic',
            'Making history with a creepy stranger',
            'Courage of your girlfriend',
            'Virtual reality with a dragon',
            'Training animals with a hunter',
        ];

        /*****NPC DATA****************/

        $NpcNames = [
            'Putrid Spellcaster',
            'Demonic Warlord',
            'Mad Enchanter',
            'Chaos Bard',
            'Fallen Vampire',
            'Fallen Hellreaver',
            'Toxic Trapsmith',
            'Venom Trickster',
            'Fallen Samurai',
            'Armored Tempest',
            'Corrupted Paladin',
            'Wasteland Mage',
            'Battle Seer',
            'Cataclysmic Vampire',
            'Venom Runecaster',
            'Cataclysmic Skymage',
            'Elemental Adept',
            'Pyro Arcanist',
            'Demonic Sorcerer',
            'Demonic Crusader',
            'Recaller',
            'Cannibal',
            'Joker',
            'Scratcher',
            'Cleaver',
            'Spitter',
            'Smart Zombie',
            'Feral Zombie',
            'Putrid Warrior',
            'Venom Agent',
            'Septic Mystic',
            'Corrupted Archmage',
            'Shadow Warpriest',
            'Elemental Archer',
            'Blood Binder',
            'Tainted Champion',
            'Necromantic Warmage',
            'Cataclysmic Healer',

        ];
        
        /*****CHARACTER DATA****************/

        $characterNames = [
            'Wolferal',
            'Madept',
            'Indighost',
            'Sailord',
            'SilverStarfish',
            'GrassStalker',
            'LightStitches',
            'ImpossiblePanda',
            'ChainGull',
            'OddRascal',
            'Thisse',
            'Cim',
            'Oci',
            'Bradrot',
            'Brundrirs',
            'Methongos',
            'Resh',
            'Niclisol',
            'Man',
            'Thas',
            'Rangerman',
            'BumblingBee',
            'Pillagerman',
            'Woodpecs',
            'MemoryMantis',
            'EcstaticWarlock',
            'CrownFoal',
            'ChargeProwler',
            'LunchPegasus',
            'FlawlessEagle',
        ];

        $eyes = [
            'brown',
            'blue',
            'grey',
            'green',
            'black',
            'green-blue',
        ];

        $skins = [
            'white',
            'black',
            'red',
            'yellow',
            'blue',
        ];

        $hairs = [
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
            'Rick of the Winter',
            'Enguerran the Wild',
            'Rotbert of the Light',
            'Lambequin the Poet',
            'Hal the Poet',
            'Peares the Slayer',
            'Richart the Handsome',
            'Henricus of the Snow',
            'Herry the Timid',
            'Dawkin the Chaotic',
            'Macée the Worthy',
            'Gennevote of the Snow',
            'Braya the Warm',
            'Notekyn the Swift',
            'Rothais the Reliable',
            'Libet the Amazing',
            'Thyphainne the Warden',
            'Libet the Tiny',
            'Joyse the Trusted',
            'Hosannah the Magnificent',

        ];

        $treasure = [
            'aromatics',
            'gold powder',
            'silver plates',
            'crown',
            'magic wand',
            'gemstones',
            'Amethyst Nitzilianite',
            'Acaganeite',
            'Meisiterite',
            'Ferontienite',
            'Leadkerite',
            'Orange Zaccnstedtite',
            'Black Kolaltite',
            'Achroxylapatite',
            'Krannghengite',
            'Turquoise Hemannite',
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

        $attacksAndSpellCasting = [
            'Sunfire Blitz',
            'Starfire Hail',
            'Molten Assault',
            'Reanimate Corpse',
            'Wave of Destruction',
            'Rune of Misery',
            'Dishonor of Immortality',
            'Evocation of Sealing',
            'Flame Burst',
            'Tranquility',
            'Alteration of Senses',
            'Mind Control',
            'Soulsteal',
            'Hallucination',
            'Orb of Divine Intervention',
            'Decadence of Intellect',
            'Sorrow',

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

        $otherProficiencyAndLanguages = [
            'Fafati',
            'Eesic',
            'Imumeno',
            'Akesh',
            'Iveoygabi',
            'Yesdazesh',
            'Slaarran',
            'Lelfic',
            'Edmiaman',
            'Ifmuotean',
            'Iannarin',
            'Iexponi',

        ];

        $featuresAndTraits = [
            'Homo Candidulus',
            'Homo Potens',
            'Homo Melior',
            'Homo Inopinatus',
            'Homo Celer',
            'Homo Silvester',
            'Homo Falsus',
            'Homo Tenuis',
            'Homo Dives',
            'Homo Caecigenus',
            'Homo Parvulus',
            'Homo Altus',
            'Homo Nivosus',
            'Homo Divinus',
            'Homo Diligens',
            'Homo Macer',
            'Homo Sucinus',
            'Homo Avarus',
            'Homo Fortunatus',
        ];


        /******************RACE DATA****************/

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


        /******************CLASS DATA****************/

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


        /******************SPELL DATA*************************/

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

        
        /******************************************************************************************************************/
        /******************************************************* ENTITIES FILLING IN **************************************/
        /******************************************************************************************************************/

        /****************************************************USER ENTITIES***************************************************/

        $user = [];

        foreach ($userEmails as $userEmail) {

            $user = new User();
            
            $user->setEmail($userEmail);
            
            $emailExplode = explode("@", $userEmail);
            $name = $emailExplode[0];
            
            $encryptedPassword = $this->encoder->encodePassword($user, $name);
            $user->setPassword($encryptedPassword);
            
            $user->setName($name);

            $user->setAvatarPath(null);
            
            $user->setStatus(random_int(1, 2));

            $manager->persist($user);
            
            $users[] = $user;

        }


        /****************************************************CAMPAIGN AND DEPENDENCIES ENTITIES***************************************************/

        $campaigns = [];
        $NPCs = [];
        $stories = [];
        $maps = [];

        foreach ($mapNames as $mapName) {

            $map = new Map();

            $map->setName($mapName);

            shuffle($words);
            $description = '';
            for ($i = 0; $i < rand(10, 30); $i++) { 
                $description = $description . " " . $words[$i];
            };
            $map->setDescription($description);

            $map->setFilePath(null);

            $manager->persist($map);

            $maps[] = $map;
        }

        foreach ($storyNames as $storyName) {

            $story = new Story();

            $story->setName($storyName);

            shuffle($words);
            $description = '';
            for ($i = 0; $i < rand(10, 30); $i++) { 
                $description = $description . " " . $words[$i];
            };
            $story->setDescription($description);

            $story->setIsDone((bool)random_int(0, 1));

            shuffle($words);
            $report = '';
            for ($i = 0; $i < rand(10, 30); $i++) { 
                $report = $report . " " . $words[$i];
            };
            $story->setReport($report);

            $manager->persist($story);

            $stories[] = $story;
        }

        foreach ($NpcNames as $NpcName) {

            $Npc = new NPC();

            $Npc->setName($NpcName);

            shuffle($words);
            $type = '';
            for ($i = 0; $i < rand(1, 5); $i++) { 
                $type = $type . " " . $words[$i];
            };
            $Npc->setType($type);

            shuffle($words);
            $isAlly = '';
            for ($i = 0; $i < rand(1, 5); $i++) { 
                $isAlly = $isAlly . " " . $words[$i];
            };
            $Npc->setIsAlly($isAlly);

            shuffle($words);
            $description = '';
            for ($i = 0; $i < rand(10, 30); $i++) { 
                $description = $description . " " . $words[$i];
            };
            $Npc->setDescription($description);

            $manager->persist($Npc);

            $NPCs[] = $Npc;
        }

        foreach ($campaignNames as $campaignName) {
            
            $campaign = new Campaign();
            
            $campaign->setName($campaignName);

            shuffle($users);
            $campaign->setOwner($users[1]);
            for ($index = 0; $index < rand(1,2); $index++) { 
                $campaign->addUser($users[$index]);
            }

            shuffle($words);
            $description = '';
            for ($i = 0; $i < rand(10, 30); $i++) { 
                $description = $description . " " . $words[$i];
            };
            $campaign->setDescription($description);

            shuffle($words);
            $memo = '';
            for ($i = 0; $i < rand(5, 15); $i++) { 
                $memo = $memo . " " . $words[$i];
            };
            $campaign->setMemo($memo);
            
            $campaign->setIsArchived((bool)random_int(0, 1));

            shuffle($maps);
            for ($index = 0; $index < rand(1,5); $index++) { 
                $campaign->addMap($maps[$index]);
            }

            shuffle($stories);
            for ($index = 0; $index < rand(1,10); $index++) { 
                $campaign->addStory($stories[$index]);
            }

            shuffle($NPCs);
            for ($index = 0; $index < rand(1,8); $index++) { 
                $campaign->addNPC($NPCs[$index]);
            }

            $manager->persist($campaign);
            
            $campaigns[] = $campaign;
        }


        /********************************************CHARACTER AND DEPENDENCIES ENTITIES**************************************/

               
        $characters = [];
        $races = [];
        $classes = [];
        $caracteristics = [];
        $statistics = [];
        $spells = [];
        $savingThrows = [];
        $skills = [];

        /****************************************************CHARACTER ENTITY***************************************************/

        foreach ($characterNames as $characterName) {
            
            $character = new Character();

            /****************PROPERTIES********************/

            $character->setName($characterName);
            
            $character->setAvatarPath(null);
            
            $character->setAge(random_int(0, 300));
            
            $character->setHeight(random_int(50, 300));
            
            $character->setWeight(random_int(10, 200));
            
            shuffle($eyes);
            $character->setEyes($eyes[1]);
            
            shuffle($skins);
            $character->setSkin($skins[1]);
            
            shuffle($hairs);
            $character->setHair($hairs[1]);
            
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

            shuffle($alignement);
            $character->setAlignement($alignement[1]);

            shuffle($attacksAndSpellCasting);
            $character->setAttacksAndSpellcasting($attacksAndSpellCasting[1]);

            shuffle($equipment);
            $character->setEquipment($equipment[1]);

            shuffle($otherProficiencyAndLanguages);
            $character->setOtherProficienciesAndLanguages($otherProficiencyAndLanguages[1]);

            shuffle($featuresAndTraits);
            $character->setFeaturesAndTraits($featuresAndTraits[1]);


            /****************RELATIONS********************/


            shuffle($users);
            $character->setUser($users[1]);
            
            $character->setCampaign(null);

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

        /****************************************************RACE ENTITY***************************************************/

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

        /****************************************************CLASS ENTITY***************************************************/

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

        /****************************************************CARACTERISTIC ENTITY***************************************************/

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

        /****************************************************STATISTIC ENTITY***************************************************/

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

        /****************************************************SPELL ENTITY***************************************************/

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

        /****************************************************SAVING THROW ENTITY***************************************************/

        foreach ($savingThrows as $savingThrow) {
 
            $savingThrow->setStrength((bool)random_int(0, 1));
            $savingThrow->setDexterity((bool)random_int(0, 1));
            $savingThrow->setConstitution((bool)random_int(0, 1));
            $savingThrow->setIntelligence((bool)random_int(0, 1));
            $savingThrow->setWisdom((bool)random_int(0, 1));
            $savingThrow->setCharisma((bool)random_int(0, 1));           
        }

        /****************************************************SKILL ENTITY***************************************************/

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
