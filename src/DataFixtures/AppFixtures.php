<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Movie;
use App\Entity\StreamingPlatform;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Configuration
        $this->loadAdmins($manager);
        
        // Content
        $platforms = $this->loadStreamingPlatforms($manager);
        $this->loadMovies($manager, $platforms);

        $manager->flush();
    }

    private function loadAdmins(ObjectManager $manager): void
    {
        $admin = new Admin();
        $admin->setLogin('Admin');
        $admin->setPassword('Admin');
        $manager->persist($admin);
    }

    private function loadStreamingPlatforms(ObjectManager $manager): array
    {
        $platformsData = [
            [
                'name'       => 'Netflix',
                'banner'     => 'netflix-banner.jpg',
                'websiteUrl' => 'https://www.netflix.com',
            ],
            [
                'name'       => 'Amazon Prime',
                'banner'     => 'amazon-prime-banner.jpg',
                'websiteUrl' => 'https://www.primevideo.com',
            ],
            [
                'name'       => 'AppleTV',
                'banner'     => 'appletv-banner.jpg',
                'websiteUrl' => 'https://tv.apple.com',
            ],
        ];

        $platforms = [];

        foreach ($platformsData as $data) {
            $platform = new StreamingPlatform();
            $platform->setName($data['name']);
            $platform->setBanner($data['banner']);
            $platform->setWebsiteUrl($data['websiteUrl']);
            $manager->persist($platform);

            $platforms[$data['name']] = $platform;
        }

        return $platforms;
    }

    private function loadMovies(ObjectManager $manager, array $platforms): void
    {
        $setRatingData = function (Movie $movie): void {
            $movie->setRating(random_int(1, 5));
            $movie->setRatingsCount(random_int(5, 100));
        };

        // Pulp Fiction
        $pulpFiction = new Movie();
        $pulpFiction->setTitle('Pulp Fiction');
        $pulpFiction->setDescription('Crime film directed by Quentin Tarantino, intertwining multiple storylines in Los Angeles with a lot of talking and even more bullets.');
        $pulpFiction->setReleaseDate(new \DateTime('1994-10-14'));
        $pulpFiction->setDirector('Quentin Tarantino');
        $pulpFiction->setScreenwriter('Quentin Tarantino; Roger Avary');
        $pulpFiction->setGenre('Crime');
        $pulpFiction->setLength(154);
        $pulpFiction->setCountry('USA');
        $setRatingData($pulpFiction);
        $manager->persist($pulpFiction);

        // Reservoir Dogs
        $reservoirDogs = new Movie();
        $reservoirDogs->setTitle('Reservoir Dogs');
        $reservoirDogs->setDescription('Tarantino debut about a botched diamond heist, sharp suits, sharp dialogue and very unsafe ear conditions.');
        $reservoirDogs->setReleaseDate(new \DateTime('1992-10-23'));
        $reservoirDogs->setDirector('Quentin Tarantino');
        $reservoirDogs->setScreenwriter('Quentin Tarantino');
        $reservoirDogs->setGenre('Crime');
        $reservoirDogs->setLength(99);
        $reservoirDogs->setCountry('USA');
        $setRatingData($reservoirDogs);
        $manager->persist($reservoirDogs);

        // The Hateful Eight
        $hatefulEight = new Movie();
        $hatefulEight->setTitle('The Hateful Eight');
        $hatefulEight->setDescription('Western mystery where eight strangers hide from a blizzard and slowly prove that cabin sharing is a terrible idea.');
        $hatefulEight->setReleaseDate(new \DateTime('2015-12-25'));
        $hatefulEight->setDirector('Quentin Tarantino');
        $hatefulEight->setScreenwriter('Quentin Tarantino');
        $hatefulEight->setGenre('Western');
        $hatefulEight->setLength(168);
        $hatefulEight->setCountry('USA');
        $setRatingData($hatefulEight);
        $manager->persist($hatefulEight);

        // The Godfather
        $godfather = new Movie();
        $godfather->setTitle('The Godfather');
        $godfather->setDescription('Classic crime saga about the Corleone family, business offers you really cannot refuse and a suspicious amount of oranges.');
        $godfather->setReleaseDate(new \DateTime('1972-03-24'));
        $godfather->setDirector('Francis Ford Coppola');
        $godfather->setScreenwriter('Mario Puzo; Francis Ford Coppola');
        $godfather->setGenre('Crime');
        $godfather->setLength(175);
        $godfather->setCountry('USA');
        $setRatingData($godfather);
        $manager->persist($godfather);

        // The Green Mile
        $greenMile = new Movie();
        $greenMile->setTitle('The Green Mile');
        $greenMile->setDescription('Prison drama with miracles, a very large inmate, a very small mouse and emotions that should come with a tissue warning.');
        $greenMile->setReleaseDate(new \DateTime('1999-12-10'));
        $greenMile->setDirector('Frank Darabont');
        $greenMile->setScreenwriter('Frank Darabont; Stephen King');
        $greenMile->setGenre('Drama');
        $greenMile->setLength(189);
        $greenMile->setCountry('USA');
        $setRatingData($greenMile);
        $manager->persist($greenMile);

        // The Shawshank Redemption
        $shawshank = new Movie();
        $shawshank->setTitle('The Shawshank Redemption');
        $shawshank->setDescription('Hope, friendship and a lot of rock hammer patience in one of the most beloved prison escape stories ever filmed.');
        $shawshank->setReleaseDate(new \DateTime('1994-09-23'));
        $shawshank->setDirector('Frank Darabont');
        $shawshank->setScreenwriter('Frank Darabont; Stephen King');
        $shawshank->setGenre('Drama');
        $shawshank->setLength(142);
        $shawshank->setCountry('USA');
        $setRatingData($shawshank);
        $manager->persist($shawshank);

        // Forrest Gump
        $forrestGump = new Movie();
        $forrestGump->setTitle('Forrest Gump');
        $forrestGump->setDescription('Life is like a box of chocolates and Forrest somehow runs through half of American history in one go.');
        $forrestGump->setReleaseDate(new \DateTime('1994-07-06'));
        $forrestGump->setDirector('Robert Zemeckis');
        $forrestGump->setScreenwriter('Eric Roth; Winston Groom');
        $forrestGump->setGenre('Drama');
        $forrestGump->setLength(142);
        $forrestGump->setCountry('USA');
        $setRatingData($forrestGump);
        $manager->persist($forrestGump);

        // Requiem for a Dream
        $requiem = new Movie();
        $requiem->setTitle('Requiem for a Dream');
        $requiem->setDescription('Stylish but brutal descent into addiction that will convince you to treat all life choices with a bit more respect.');
        $requiem->setReleaseDate(new \DateTime('2000-10-27'));
        $requiem->setDirector('Darren Aronofsky');
        $requiem->setScreenwriter('Hubert Selby Jr.; Darren Aronofsky');
        $requiem->setGenre('Drama');
        $requiem->setLength(102);
        $requiem->setCountry('USA');
        $setRatingData($requiem);
        $manager->persist($requiem);

        // The Matrix
        $matrix = new Movie();
        $matrix->setTitle('The Matrix');
        $matrix->setDescription('Hacker discovers reality is fake, physics is optional and sunglasses are mandatory even at night.');
        $matrix->setReleaseDate(new \DateTime('1999-03-31'));
        $matrix->setDirector('Lana Wachowski; Lilly Wachowski');
        $matrix->setScreenwriter('Lana Wachowski; Lilly Wachowski');
        $matrix->setGenre('Sci-Fi');
        $matrix->setLength(136);
        $matrix->setCountry('USA');
        $setRatingData($matrix);
        $manager->persist($matrix);

        // The Silence of the Lambs
        $silence = new Movie();
        $silence->setTitle('The Silence of the Lambs');
        $silence->setDescription('A young FBI trainee, a brilliant cannibal and a reminder to never accept dinner invitations from certain doctors.');
        $silence->setReleaseDate(new \DateTime('1991-02-14'));
        $silence->setDirector('Jonathan Demme');
        $silence->setScreenwriter('Ted Tally; Thomas Harris');
        $silence->setGenre('Thriller');
        $silence->setLength(118);
        $silence->setCountry('USA');
        $setRatingData($silence);
        $manager->persist($silence);

        // Avatar
        $avatar = new Movie();
        $avatar->setTitle('Avatar');
        $avatar->setDescription('Marine gets a very blue new body, discovers nature, flying dragons and that corporations are not great neighbors.');
        $avatar->setReleaseDate(new \DateTime('2009-12-18'));
        $avatar->setDirector('James Cameron');
        $avatar->setScreenwriter('James Cameron');
        $avatar->setGenre('Sci-Fi');
        $avatar->setLength(162);
        $avatar->setCountry('USA');
        $setRatingData($avatar);
        $manager->persist($avatar);

        // Gladiator
        $gladiator = new Movie();
        $gladiator->setTitle('Gladiator');
        $gladiator->setDescription('Roman general becomes a gladiator, wins crowds, swings swords and politely asks if everyone is entertained.');
        $gladiator->setReleaseDate(new \DateTime('2000-05-05'));
        $gladiator->setDirector('Ridley Scott');
        $gladiator->setScreenwriter('David Franzoni; John Logan; William Nicholson');
        $gladiator->setGenre('Action');
        $gladiator->setLength(155);
        $gladiator->setCountry('USA');
        $setRatingData($gladiator);
        $manager->persist($gladiator);

        // Shrek
        $shrek = new Movie();
        $shrek->setTitle('Shrek');
        $shrek->setDescription('A grumpy ogre, a talkative donkey and a princess prove that fairy tales can also smell like swamp.');
        $shrek->setReleaseDate(new \DateTime('2001-05-18'));
        $shrek->setDirector('Andrew Adamson; Vicky Jenson');
        $shrek->setScreenwriter('Ted Elliott; Terry Rossio; Joe Stillman; Roger S.H. Schulman');
        $shrek->setGenre('Animation');
        $shrek->setLength(90);
        $shrek->setCountry('USA');
        $setRatingData($shrek);
        $manager->persist($shrek);

        // Titanic
        $titanic = new Movie();
        $titanic->setTitle('Titanic');
        $titanic->setDescription('Epic romance on an unsinkable ship that famously did not read the marketing materials carefully enough.');
        $titanic->setReleaseDate(new \DateTime('1997-12-19'));
        $titanic->setDirector('James Cameron');
        $titanic->setScreenwriter('James Cameron');
        $titanic->setGenre('Romance');
        $titanic->setLength(195);
        $titanic->setCountry('USA');
        $setRatingData($titanic);
        $manager->persist($titanic);

        // Shutter Island
        $shutterIsland = new Movie();
        $shutterIsland->setTitle('Shutter Island');
        $shutterIsland->setDescription('US marshal investigates a missing patient on an isolated island where nothing is quite what it seems.');
        $shutterIsland->setReleaseDate(new \DateTime('2010-02-19'));
        $shutterIsland->setDirector('Martin Scorsese');
        $shutterIsland->setScreenwriter('Laeta Kalogridis; Dennis Lehane');
        $shutterIsland->setGenre('Thriller');
        $shutterIsland->setLength(138);
        $shutterIsland->setCountry('USA');
        $setRatingData($shutterIsland);
        $manager->persist($shutterIsland);

        // Inglourious Basterds
        $basterds = new Movie();
        $basterds->setTitle('Inglourious Basterds');
        $basterds->setDescription('Alternate WWII where cinema, revenge and Tarantino dialogue team up against Nazis in very explosive ways.');
        $basterds->setReleaseDate(new \DateTime('2009-08-21'));
        $basterds->setDirector('Quentin Tarantino');
        $basterds->setScreenwriter('Quentin Tarantino');
        $basterds->setGenre('War');
        $basterds->setLength(153);
        $basterds->setCountry('USA');
        $setRatingData($basterds);
        $manager->persist($basterds);

        // One Flew Over the Cuckoo's Nest
        $cuckoosNest = new Movie();
        $cuckoosNest->setTitle("One Flew Over the Cuckoo's Nest");
        $cuckoosNest->setDescription('Charismatic troublemaker shakes up a mental institution and proves that rebellion can be very expensive.');
        $cuckoosNest->setReleaseDate(new \DateTime('1975-11-19'));
        $cuckoosNest->setDirector('Milos Forman');
        $cuckoosNest->setScreenwriter('Bo Goldman; Lawrence Hauben; Ken Kesey');
        $cuckoosNest->setGenre('Drama');
        $cuckoosNest->setLength(133);
        $cuckoosNest->setCountry('USA');
        $setRatingData($cuckoosNest);
        $manager->persist($cuckoosNest);

        // The Butterfly Effect
        $butterflyEffect = new Movie();
        $butterflyEffect->setTitle('The Butterfly Effect');
        $butterflyEffect->setDescription('Man revisits his past, changes tiny details and learns that debugging timelines is harder than debugging code.');
        $butterflyEffect->setReleaseDate(new \DateTime('2004-01-23'));
        $butterflyEffect->setDirector('Eric Bress; J. Mackye Gruber');
        $butterflyEffect->setScreenwriter('Eric Bress; J. Mackye Gruber');
        $butterflyEffect->setGenre('Sci-Fi');
        $butterflyEffect->setLength(113);
        $butterflyEffect->setCountry('USA');
        $setRatingData($butterflyEffect);
        $manager->persist($butterflyEffect);

        // Gran Torino
        $granTorino = new Movie();
        $granTorino->setTitle('Gran Torino');
        $granTorino->setDescription('Grumpy veteran, noisy neighbors and one classic car in a story that slowly swaps anger for understanding.');
        $granTorino->setReleaseDate(new \DateTime('2009-01-09'));
        $granTorino->setDirector('Clint Eastwood');
        $granTorino->setScreenwriter('Nick Schenk; Dave Johannson');
        $granTorino->setGenre('Drama');
        $granTorino->setLength(116);
        $granTorino->setCountry('USA');
        $setRatingData($granTorino);
        $manager->persist($granTorino);

        // The Dark Knight
        $darkKnight = new Movie();
        $darkKnight->setTitle('The Dark Knight');
        $darkKnight->setDescription('Batman faces the Joker, moral chaos and serious voice filter issues in one of the most praised superhero films.');
        $darkKnight->setReleaseDate(new \DateTime('2008-07-18'));
        $darkKnight->setDirector('Christopher Nolan');
        $darkKnight->setScreenwriter('Jonathan Nolan; Christopher Nolan; David S. Goyer');
        $darkKnight->setGenre('Action');
        $darkKnight->setLength(152);
        $darkKnight->setCountry('USA');
        $setRatingData($darkKnight);
        $manager->persist($darkKnight);
    }
}
