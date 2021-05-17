<?php

namespace App\DataFixtures;

use App\Entity\Character;
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
        $characters = [];

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


        foreach ($characterNames as $characterName) {
            $character = new Character();
            $character->setName($characterName);
            $character->setAvatarPath($characterName . '.png');
            $character->setAge(random_int(0, 300));
            $character->setHeight(random_int(50, 300));
            $character->setWeight(random_int(10, 200));
            shuffle($characterEyes);
            $character->setEyes(shuffle($characterEyes[1]));
            shuffle($characterSkins);
            $character->setSkin(shuffle($characterSkins[1]));
            shuffle($characterHairs);
            $character->setHair(shuffle($characterHairs[1]));
            shuffle($appearance);
            $character->setAppearance(shuffle($appearance[1]));
            shuffle($personnalityTraits);
            $character->setPersonalityTraits(shuffle($personnalityTraits[1]));
            shuffle($ideals);
            $character->setIdeals(shuffle($ideals[1]));

            shuffle($words);
            $bonds = '';
            for ($i=0; $i < rand(5, 15); $i++) { 
                $bonds = $bonds . " " . $words[$i];
            };
            $character->setBonds($bonds);
            
            shuffle($flaws);
            $character->setFlaws(shuffle($flaws[1]));
            shuffle($alliesAndOrganizations);
            $character->setAlliesAndOrganizations(shuffle($alliesAndOrganizations[1]));

            shuffle($words);
            $backstory = '';
            for ($i=0; $i < rand(30, 50); $i++) { 
                $backstory = $backstory . " " . $backstory[$i];
            };
            $character->setBackstory($backstory);

            shuffle($treasure);
            $character->setTreasure(shuffle($treasure[1]));

            shuffle($background);
            $character->setBackground(shuffle($background[1]));

            $manager->persist($character);
            $characters[] = $character;
        }

        


        $manager->flush();
    }
}
