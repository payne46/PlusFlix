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

        // Fight Club
        $fightClub = new Movie();
        $fightClub->setTitle('Fight Club');
        $fightClub->setDescription('An insomniac office worker forms an underground fight club that evolves into something much more destructive.');
        $fightClub->setReleaseDate(new \DateTime('1999-10-15'));
        $fightClub->setDirector('David Fincher');
        $fightClub->setScreenwriter('Jim Uhls; Chuck Palahniuk');
        $fightClub->setGenre('Drama');
        $fightClub->setLength(139);
        $fightClub->setCountry('USA');
        $setRatingData($fightClub);
        $manager->persist($fightClub);

        // Inception
        $inception = new Movie();
        $inception->setTitle('Inception');
        $inception->setDescription('A thief who steals corporate secrets through dream-sharing technology is given the inverse task of planting an idea.');
        $inception->setReleaseDate(new \DateTime('2010-07-16'));
        $inception->setDirector('Christopher Nolan');
        $inception->setScreenwriter('Christopher Nolan');
        $inception->setGenre('Sci-Fi');
        $inception->setLength(148);
        $inception->setCountry('USA');
        $setRatingData($inception);
        $manager->persist($inception);

        // The Lord of the Rings: The Fellowship of the Ring
        $lotrFellowship = new Movie();
        $lotrFellowship->setTitle('The Lord of the Rings: The Fellowship of the Ring');
        $lotrFellowship->setDescription('A meek Hobbit and eight companions set out on a journey to destroy the One Ring and save Middle-earth.');
        $lotrFellowship->setReleaseDate(new \DateTime('2001-12-19'));
        $lotrFellowship->setDirector('Peter Jackson');
        $lotrFellowship->setScreenwriter('Fran Walsh; Philippa Boyens; Peter Jackson; J.R.R. Tolkien');
        $lotrFellowship->setGenre('Fantasy');
        $lotrFellowship->setLength(178);
        $lotrFellowship->setCountry('New Zealand');
        $setRatingData($lotrFellowship);
        $manager->persist($lotrFellowship);

        // Star Wars: Episode V - The Empire Strikes Back
        $empireStrikesBack = new Movie();
        $empireStrikesBack->setTitle('Star Wars: Episode V - The Empire Strikes Back');
        $empireStrikesBack->setDescription('After the Rebels are brutally overpowered by the Empire, Luke Skywalker begins Jedi training with Yoda.');
        $empireStrikesBack->setReleaseDate(new \DateTime('1980-05-21'));
        $empireStrikesBack->setDirector('Irvin Kershner');
        $empireStrikesBack->setScreenwriter('Leigh Brackett; Lawrence Kasdan; George Lucas');
        $empireStrikesBack->setGenre('Sci-Fi');
        $empireStrikesBack->setLength(124);
        $empireStrikesBack->setCountry('USA');
        $setRatingData($empireStrikesBack);
        $manager->persist($empireStrikesBack);

        // Interstellar
        $interstellar = new Movie();
        $interstellar->setTitle('Interstellar');
        $interstellar->setDescription('A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.');
        $interstellar->setReleaseDate(new \DateTime('2014-11-07'));
        $interstellar->setDirector('Christopher Nolan');
        $interstellar->setScreenwriter('Jonathan Nolan; Christopher Nolan');
        $interstellar->setGenre('Sci-Fi');
        $interstellar->setLength(169);
        $interstellar->setCountry('USA');
        $setRatingData($interstellar);
        $manager->persist($interstellar);

        // Parasite
        $parasite = new Movie();
        $parasite->setTitle('Parasite');
        $parasite->setDescription('Greed and class discrimination threaten the newly formed symbiotic relationship between the wealthy Park family and the destitute Kim clan.');
        $parasite->setReleaseDate(new \DateTime('2019-05-30'));
        $parasite->setDirector('Bong Joon Ho');
        $parasite->setScreenwriter('Bong Joon Ho; Han Jin-won');
        $parasite->setGenre('Thriller');
        $parasite->setLength(132);
        $parasite->setCountry('South Korea');
        $setRatingData($parasite);
        $manager->persist($parasite);

        // The Wolf of Wall Street
        $wolfWallStreet = new Movie();
        $wolfWallStreet->setTitle('The Wolf of Wall Street');
        $wolfWallStreet->setDescription('Based on the true story of Jordan Belfort, from his rise to a wealthy stock-broker to his fall involving crime and corruption.');
        $wolfWallStreet->setReleaseDate(new \DateTime('2013-12-25'));
        $wolfWallStreet->setDirector('Martin Scorsese');
        $wolfWallStreet->setScreenwriter('Terence Winter; Jordan Belfort');
        $wolfWallStreet->setGenre('Biography');
        $wolfWallStreet->setLength(180);
        $wolfWallStreet->setCountry('USA');
        $setRatingData($wolfWallStreet);
        $manager->persist($wolfWallStreet);

        // Goodfellas
        $goodfellas = new Movie();
        $goodfellas->setTitle('Goodfellas');
        $goodfellas->setDescription('The story of Henry Hill and his life in the mob, covering his relationship with his wife Karen and his mob partners.');
        $goodfellas->setReleaseDate(new \DateTime('1990-09-19'));
        $goodfellas->setDirector('Martin Scorsese');
        $goodfellas->setScreenwriter('Nicholas Pileggi; Martin Scorsese');
        $goodfellas->setGenre('Biography');
        $goodfellas->setLength(146);
        $goodfellas->setCountry('USA');
        $setRatingData($goodfellas);
        $manager->persist($goodfellas);

        // Se7en
        $se7en = new Movie();
        $se7en->setTitle('Se7en');
        $se7en->setDescription('Two detectives, a rookie and a veteran, hunt a serial killer who uses the seven deadly sins as his motives.');
        $se7en->setReleaseDate(new \DateTime('1995-09-22'));
        $se7en->setDirector('David Fincher');
        $se7en->setScreenwriter('Andrew Kevin Walker');
        $se7en->setGenre('Crime');
        $se7en->setLength(127);
        $se7en->setCountry('USA');
        $setRatingData($se7en);
        $manager->persist($se7en);

        // The Prestige
        $prestige = new Movie();
        $prestige->setTitle('The Prestige');
        $prestige->setDescription('After a tragic accident, two stage magicians engage in a battle to create the ultimate illusion while sacrificing everything they have.');
        $prestige->setReleaseDate(new \DateTime('2006-10-20'));
        $prestige->setDirector('Christopher Nolan');
        $prestige->setScreenwriter('Jonathan Nolan; Christopher Nolan; Christopher Priest');
        $prestige->setGenre('Drama');
        $prestige->setLength(130);
        $prestige->setCountry('USA');
        $setRatingData($prestige);
        $manager->persist($prestige);

        // Jurassic Park
        $jurassicPark = new Movie();
        $jurassicPark->setTitle('Jurassic Park');
        $jurassicPark->setDescription('A pragmatic paleontologist visiting an almost complete theme park is tasked with protecting a couple of kids after a power failure causes the park\'s cloned dinosaurs to run loose.');
        $jurassicPark->setReleaseDate(new \DateTime('1993-06-11'));
        $jurassicPark->setDirector('Steven Spielberg');
        $jurassicPark->setScreenwriter('Michael Crichton; David Koepp');
        $jurassicPark->setGenre('Adventure');
        $jurassicPark->setLength(127);
        $jurassicPark->setCountry('USA');
        $setRatingData($jurassicPark);
        $manager->persist($jurassicPark);

        // Back to the Future
        $backToTheFuture = new Movie();
        $backToTheFuture->setTitle('Back to the Future');
        $backToTheFuture->setDescription('Marty McFly, a 17-year-old high school student, is accidentally sent thirty years into the past in a time-traveling DeLorean invented by his close friend, the eccentric scientist Doc Brown.');
        $backToTheFuture->setReleaseDate(new \DateTime('1985-07-03'));
        $backToTheFuture->setDirector('Robert Zemeckis');
        $backToTheFuture->setScreenwriter('Robert Zemeckis; Bob Gale');
        $backToTheFuture->setGenre('Adventure');
        $backToTheFuture->setLength(116);
        $backToTheFuture->setCountry('USA');
        $setRatingData($backToTheFuture);
        $manager->persist($backToTheFuture);

        // The Lion King
        $lionKing = new Movie();
        $lionKing->setTitle('The Lion King');
        $lionKing->setDescription('Lion prince Simba and his father are targeted by his bitter uncle, who wants to ascend the throne himself.');
        $lionKing->setReleaseDate(new \DateTime('1994-06-24'));
        $lionKing->setDirector('Roger Allers; Rob Minkoff');
        $lionKing->setScreenwriter('Irene Mecchi; Jonathan Roberts; Linda Woolverton');
        $lionKing->setGenre('Animation');
        $lionKing->setLength(88);
        $lionKing->setCountry('USA');
        $setRatingData($lionKing);
        $manager->persist($lionKing);

        // Casablanca
        $casablanca = new Movie();
        $casablanca->setTitle('Casablanca');
        $casablanca->setDescription('A cynical expatriate American cafe owner struggles to decide whether or not to help his former lover and her fugitive husband escape the Nazis in French Morocco.');
        $casablanca->setReleaseDate(new \DateTime('1943-01-23'));
        $casablanca->setDirector('Michael Curtiz');
        $casablanca->setScreenwriter('Julius J. Epstein; Philip G. Epstein; Howard Koch');
        $casablanca->setGenre('Drama');
        $casablanca->setLength(102);
        $casablanca->setCountry('USA');
        $setRatingData($casablanca);
        $manager->persist($casablanca);

        // Psycho
        $psycho = new Movie();
        $psycho->setTitle('Psycho');
        $psycho->setDescription('A Phoenix secretary embezzles $40,000 from her employer\'s client, goes on the run, and checks into a remote motel run by a young man under the domination of his mother.');
        $psycho->setReleaseDate(new \DateTime('1960-09-08'));
        $psycho->setDirector('Alfred Hitchcock');
        $psycho->setScreenwriter('Joseph Stefano; Robert Bloch');
        $psycho->setGenre('Horror');
        $psycho->setLength(109);
        $psycho->setCountry('USA');
        $setRatingData($psycho);
        $manager->persist($psycho);

        // La La Land
        $laLaLand = new Movie();
        $laLaLand->setTitle('La La Land');
        $laLaLand->setDescription('While navigating their careers in Los Angeles, a pianist and an actress fall in love while attempting to reconcile their aspirations for the future.');
        $laLaLand->setReleaseDate(new \DateTime('2016-12-09'));
        $laLaLand->setDirector('Damien Chazelle');
        $laLaLand->setScreenwriter('Damien Chazelle');
        $laLaLand->setGenre('Musical');
        $laLaLand->setLength(128);
        $laLaLand->setCountry('USA');
        $setRatingData($laLaLand);
        $manager->persist($laLaLand);

        // The Terminator
        $terminator = new Movie();
        $terminator->setTitle('The Terminator');
        $terminator->setDescription('A human soldier is sent from 2029 to 1984 to stop an almost indestructible cyborg killing machine, sent from the same year, which has been programmed to execute a young woman whose unborn son is the key to humanity\'s future salvation.');
        $terminator->setReleaseDate(new \DateTime('1984-10-26'));
        $terminator->setDirector('James Cameron');
        $terminator->setScreenwriter('James Cameron; Gale Anne Hurd');
        $terminator->setGenre('Sci-Fi');
        $terminator->setLength(107);
        $terminator->setCountry('USA');
        $setRatingData($terminator);
        $manager->persist($terminator);

        // Star Wars: Episode III - Revenge of the Sith
        $revengeSith = new Movie();
        $revengeSith->setTitle('Star Wars: Episode III - Revenge of the Sith');
        $revengeSith->setDescription('The dark side clouds everything as Anakin Skywalker succumbs to his fears and hatred, completing his transformation into Darth Vader.');
        $revengeSith->setReleaseDate(new \DateTime('2005-05-19'));
        $revengeSith->setDirector('George Lucas');
        $revengeSith->setScreenwriter('George Lucas');
        $revengeSith->setGenre('Sci-Fi');
        $revengeSith->setLength(140);
        $revengeSith->setCountry('USA');
        $setRatingData($revengeSith);
        $manager->persist($revengeSith);

        // Transformers (2007)
        $transformers = new Movie();
        $transformers->setTitle('Transformers');
        $transformers->setDescription('A teenager discovers his car is actually an alien robot, sparking an ancient war between Autobots and Decepticons on Earth.');
        $transformers->setReleaseDate(new \DateTime('2007-07-03'));
        $transformers->setDirector('Michael Bay');
        $transformers->setScreenwriter('Roberto Orci; Alex Kurtzman; John Rogers');
        $transformers->setGenre('Action');
        $transformers->setLength(144);
        $transformers->setCountry('USA');
        $setRatingData($transformers);
        $manager->persist($transformers);

        // The Avengers
        $avengers = new Movie();
        $avengers->setTitle('The Avengers');
        $avengers->setDescription('Earth\'s mightiest heroes must come together to stop Loki and his alien army from enslaving humanity.');
        $avengers->setReleaseDate(new \DateTime('2012-05-04'));
        $avengers->setDirector('Joss Whedon');
        $avengers->setScreenwriter('Joss Whedon; Zak Penn');
        $avengers->setGenre('Action');
        $avengers->setLength(143);
        $avengers->setCountry('USA');
        $setRatingData($avengers);
        $manager->persist($avengers);

        // The Social Network
        $socialNetwork = new Movie();
        $socialNetwork->setTitle('The Social Network');
        $socialNetwork->setDescription('The story of how Facebook was created, filled with brilliant coding, betrayal, lawsuits, and changing how the world connects.');
        $socialNetwork->setReleaseDate(new \DateTime('2010-10-01'));
        $socialNetwork->setDirector('David Fincher');
        $socialNetwork->setScreenwriter('Aaron Sorkin; Ben Mezrich');
        $socialNetwork->setGenre('Biography');
        $socialNetwork->setLength(120);
        $socialNetwork->setCountry('USA');
        $setRatingData($socialNetwork);
        $manager->persist($socialNetwork);

        // Dunkirk
        $dunkirk = new Movie();
        $dunkirk->setTitle('Dunkirk');
        $dunkirk->setDescription('Allied soldiers from Belgium, Britain, and France are surrounded by the German army during WWII and must be evacuated in a desperate battle for survival.');
        $dunkirk->setReleaseDate(new \DateTime('2017-07-21'));
        $dunkirk->setDirector('Christopher Nolan');
        $dunkirk->setScreenwriter('Christopher Nolan');
        $dunkirk->setGenre('War');
        $dunkirk->setLength(106);
        $dunkirk->setCountry('UK');
        $setRatingData($dunkirk);
        $manager->persist($dunkirk);

        // Toy Story
        $toyStory = new Movie();
        $toyStory->setTitle('Toy Story');
        $toyStory->setDescription('A cowboy doll is profoundly threatened and jealous when a new spaceman action figure supplants him as top toy in a boy\'s bedroom.');
        $toyStory->setReleaseDate(new \DateTime('1995-11-22'));
        $toyStory->setDirector('John Lasseter');
        $toyStory->setScreenwriter('John Lasseter; Pete Docter; Andrew Stanton; Joe Ranft');
        $toyStory->setGenre('Animation');
        $toyStory->setLength(81);
        $toyStory->setCountry('USA');
        $setRatingData($toyStory);
        $manager->persist($toyStory);

        // The Departed
        $departed = new Movie();
        $departed->setTitle('The Departed');
        $departed->setDescription('An undercover cop and a mole in the police attempt to identify each other while infiltrating an Irish gang in South Boston.');
        $departed->setReleaseDate(new \DateTime('2006-10-06'));
        $departed->setDirector('Martin Scorsese');
        $departed->setScreenwriter('William Monahan; Alan Mak; Felix Chong');
        $departed->setGenre('Crime');
        $departed->setLength(151);
        $departed->setCountry('USA');
        $setRatingData($departed);
        $manager->persist($departed);

        // Whiplash
        $whiplash = new Movie();
        $whiplash->setTitle('Whiplash');
        $whiplash->setDescription('A promising young drummer enrolls at a cutthroat music conservatory where his dreams of greatness are mentored by an instructor who will stop at nothing to realize a student\'s potential.');
        $whiplash->setReleaseDate(new \DateTime('2014-10-15'));
        $whiplash->setDirector('Damien Chazelle');
        $whiplash->setScreenwriter('Damien Chazelle');
        $whiplash->setGenre('Drama');
        $whiplash->setLength(106);
        $whiplash->setCountry('USA');
        $setRatingData($whiplash);
        $manager->persist($whiplash);

        // Get Out
        $getOut = new Movie();
        $getOut->setTitle('Get Out');
        $getOut->setDescription('A young African-American visits his white girlfriend\'s parents for the weekend, where his simmering uneasiness about their reception of him eventually reaches a boiling point.');
        $getOut->setReleaseDate(new \DateTime('2017-02-24'));
        $getOut->setDirector('Jordan Peele');
        $getOut->setScreenwriter('Jordan Peele');
        $getOut->setGenre('Horror');
        $getOut->setLength(104);
        $getOut->setCountry('USA');
        $setRatingData($getOut);
        $manager->persist($getOut);

        // Mad Max: Fury Road
        $madMax = new Movie();
        $madMax->setTitle('Mad Max: Fury Road');
        $madMax->setDescription('In a post-apocalyptic wasteland, a woman rebels against a tyrannical ruler in search of her homeland with the aid of a group of female prisoners, a psychotic worshiper, and a drifter named Max.');
        $madMax->setReleaseDate(new \DateTime('2015-05-15'));
        $madMax->setDirector('George Miller');
        $madMax->setScreenwriter('George Miller; Brendan McCarthy; Nick Lathouris');
        $madMax->setGenre('Action');
        $madMax->setLength(120);
        $madMax->setCountry('Australia');
        $setRatingData($madMax);
        $manager->persist($madMax);

        // Blade Runner 2049
        $bladeRunner2049 = new Movie();
        $bladeRunner2049->setTitle('Blade Runner 2049');
        $bladeRunner2049->setDescription('Young Blade Runner K\'s discovery of a long-buried secret leads him to track down former Blade Runner Rick Deckard, who\'s been missing for thirty years.');
        $bladeRunner2049->setReleaseDate(new \DateTime('2017-10-06'));
        $bladeRunner2049->setDirector('Denis Villeneuve');
        $bladeRunner2049->setScreenwriter('Hampton Fancher; Michael Green; Philip K. Dick');
        $bladeRunner2049->setGenre('Sci-Fi');
        $bladeRunner2049->setLength(164);
        $bladeRunner2049->setCountry('USA');
        $setRatingData($bladeRunner2049);
        $manager->persist($bladeRunner2049);

        // Spider-Man: Into the Spider-Verse
        $spiderVerse = new Movie();
        $spiderVerse->setTitle('Spider-Man: Into the Spider-Verse');
        $spiderVerse->setDescription('Teen Miles Morales becomes the Spider-Man of his universe and must join with five spider-powered individuals from other dimensions to stop a threat to all reality.');
        $spiderVerse->setReleaseDate(new \DateTime('2018-12-14'));
        $spiderVerse->setDirector('Bob Persichetti; Peter Ramsey; Rodney Rothman');
        $spiderVerse->setScreenwriter('Phil Lord; Rodney Rothman');
        $spiderVerse->setGenre('Animation');
        $spiderVerse->setLength(117);
        $spiderVerse->setCountry('USA');
        $setRatingData($spiderVerse);
        $manager->persist($spiderVerse);

        // The Grand Budapest Hotel
        $grandBudapest = new Movie();
        $grandBudapest->setTitle('The Grand Budapest Hotel');
        $grandBudapest->setDescription('A writer encounters the owner of an aging high-class hotel, who tells him of his early years serving as a lobby boy in the hotel\'s glorious years under an exceptional concierge.');
        $grandBudapest->setReleaseDate(new \DateTime('2014-03-28'));
        $grandBudapest->setDirector('Wes Anderson');
        $grandBudapest->setScreenwriter('Wes Anderson; Hugo Guinness');
        $grandBudapest->setGenre('Comedy');
        $grandBudapest->setLength(99);
        $grandBudapest->setCountry('USA');
        $setRatingData($grandBudapest);
        $manager->persist($grandBudapest);

        // Harry Potter and the Philosopher\'s Stone
        $harryPotter = new Movie();
        $harryPotter->setTitle('Harry Potter and the Philosopher\'s Stone');
        $harryPotter->setDescription('An orphaned boy enrolls in a school of wizardry, where he learns the truth about himself, his family and the terrible evil that haunts the magical world.');
        $harryPotter->setReleaseDate(new \DateTime('2001-11-16'));
        $harryPotter->setDirector('Chris Columbus');
        $harryPotter->setScreenwriter('Steve Kloves; J.K. Rowling');
        $harryPotter->setGenre('Fantasy');
        $harryPotter->setLength(152);
        $harryPotter->setCountry('UK');
        $setRatingData($harryPotter);
        $manager->persist($harryPotter);

        // Joker
        $joker = new Movie();
        $joker->setTitle('Joker');
        $joker->setDescription('In Gotham City, mentally troubled comedian Arthur Fleck is disregarded and mistreated by society. He then embarks on a downward spiral of revolution and bloody crime.');
        $joker->setReleaseDate(new \DateTime('2019-10-04'));
        $joker->setDirector('Todd Phillips');
        $joker->setScreenwriter('Todd Phillips; Scott Silver');
        $joker->setGenre('Crime');
        $joker->setLength(122);
        $joker->setCountry('USA');
        $setRatingData($joker);
        $manager->persist($joker);

        // The Big Lebowski
        $bigLebowski = new Movie();
        $bigLebowski->setTitle('The Big Lebowski');
        $bigLebowski->setDescription('Jeff "The Dude" Lebowski, mistaken for a millionaire of the same name, seeks restitution for his ruined rug and enlists his bowling buddies to help get it.');
        $bigLebowski->setReleaseDate(new \DateTime('1998-03-06'));
        $bigLebowski->setDirector('Joel Coen; Ethan Coen');
        $bigLebowski->setScreenwriter('Ethan Coen; Joel Coen');
        $bigLebowski->setGenre('Comedy');
        $bigLebowski->setLength(117);
        $bigLebowski->setCountry('USA');
        $setRatingData($bigLebowski);
        $manager->persist($bigLebowski);

        // Blade Runner
        $bladeRunner = new Movie();
        $bladeRunner->setTitle('Blade Runner');
        $bladeRunner->setDescription('A blade runner must pursue and terminate four replicants who stole a ship in space and have returned to Earth to find their creator.');
        $bladeRunner->setReleaseDate(new \DateTime('1982-06-25'));
        $bladeRunner->setDirector('Ridley Scott');
        $bladeRunner->setScreenwriter('Hampton Fancher; David Peoples; Philip K. Dick');
        $bladeRunner->setGenre('Sci-Fi');
        $bladeRunner->setLength(117);
        $bladeRunner->setCountry('USA');
        $setRatingData($bladeRunner);
        $manager->persist($bladeRunner);

        // Kill Bill: Vol. 1
        $killBill = new Movie();
        $killBill->setTitle('Kill Bill: Vol. 1');
        $killBill->setDescription('After awakening from a four-year coma, a former assassin wreaks vengeance on the team of assassins who betrayed her.');
        $killBill->setReleaseDate(new \DateTime('2003-10-10'));
        $killBill->setDirector('Quentin Tarantino');
        $killBill->setScreenwriter('Quentin Tarantino');
        $killBill->setGenre('Action');
        $killBill->setLength(111);
        $killBill->setCountry('USA');
        $setRatingData($killBill);
        $manager->persist($killBill);

        // 12 Angry Men
        $twelveAngryMen = new Movie();
        $twelveAngryMen->setTitle('12 Angry Men');
        $twelveAngryMen->setDescription('A jury holdout attempts to prevent a miscarriage of justice by forcing his colleagues to reconsider the evidence.');
        $twelveAngryMen->setReleaseDate(new \DateTime('1957-04-10'));
        $twelveAngryMen->setDirector('Sidney Lumet');
        $twelveAngryMen->setScreenwriter('Reginald Rose');
        $twelveAngryMen->setGenre('Drama');
        $twelveAngryMen->setLength(96);
        $twelveAngryMen->setCountry('USA');
        $setRatingData($twelveAngryMen);
        $manager->persist($twelveAngryMen);

        // The Thing
        $theThing = new Movie();
        $theThing->setTitle('The Thing');
        $theThing->setDescription('A research team in Antarctica is hunted by a shape-shifting alien that assumes the appearance of its victims.');
        $theThing->setReleaseDate(new \DateTime('1982-06-25'));
        $theThing->setDirector('John Carpenter');
        $theThing->setScreenwriter('Bill Lancaster; John W. Campbell Jr.');
        $theThing->setGenre('Horror');
        $theThing->setLength(109);
        $theThing->setCountry('USA');
        $setRatingData($theThing);
        $manager->persist($theThing);

        // Mission: Impossible - Fallout
        $missionImpossible = new Movie();
        $missionImpossible->setTitle('Mission: Impossible - Fallout');
        $missionImpossible->setDescription('Ethan Hunt and his IMF team, along with some familiar allies, race against time after a mission gone wrong.');
        $missionImpossible->setReleaseDate(new \DateTime('2018-07-27'));
        $missionImpossible->setDirector('Christopher McQuarrie');
        $missionImpossible->setScreenwriter('Christopher McQuarrie');
        $missionImpossible->setGenre('Action');
        $missionImpossible->setLength(147);
        $missionImpossible->setCountry('USA');
        $setRatingData($missionImpossible);
        $manager->persist($missionImpossible);
    }
}
