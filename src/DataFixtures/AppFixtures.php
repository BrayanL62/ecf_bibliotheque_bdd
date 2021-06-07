<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Borrower;
use App\Entity\Kind;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    private $faker;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        $this->faker = FakerFactory::create('fr_FR');
    }

    public static function getGroups(): array
    {
        // Cette fixture fait partie du groupe "test".
        // Cela permet de cibler seulement certains fixtures
        // quand on exécute la commande doctrine:fixtures:load.
        // Pour que la méthode statique getGroups() soit prise
        // en compte, il faut que la classe implémente
        // l'interface FixtureGroupInterface.
        return ['test'];
    }

    public function load(ObjectManager $manager)
    {
        // Création des tableaux pour les données constantes des Authors
        $authorLastname = ['auteur inconnu', 'Cartier', 'Lambert', 'Moitessier'];
        $authorFirstname = ['', 'Hugues', 'Armand', 'Thomas'];

        // Création du tableau de Kind
        $kindArray = ['poésie', 'nouvelle', 'roman historique', 'roman d\'amour', 'roman d\'aventure', 'science-fiction', 'fantasy', 'biographie', 'conte', 'témoignage', 'théâtre', 'essai', 'journal intime'];

        // Création des tableaux pour les données constantes des Borrowers


        //On définit le nombre d'objets qu'il va falloir créer
        $booksCount = 1000;

        // On appelle les fonctions qui vont créer les objets dans la BDD
        $this->loadAdmin($manager);
        $authors = $this->loadAuthors($manager, $authorLastname, $authorFirstname, 500);
        $borrowers = $this->loadBorrowers($manager, 100);
        $kinds = $this->loadKinds($manager, $kindArray);
        // $books = $this->loadBooks($manager, $booksCount);

        $manager->flush();
    }

    // Fonction qui va servir à charger les données ADMIN.

    public function loadAdmin(ObjectManager $manager)
    {
        // création d'un user avec des données constantes
        // ici il s'agit du compte admin
        $user = new User();
        $user->setEmail('admin@example.com');
        // hashage du mot de passe
        $password = $this->encoder->encodePassword($user, '123');
        $user->setPassword($password);
        $user->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);
    }

    // Fonction qui va servir à charger les données AUTHORS.

    public function loadAuthors(ObjectManager $manager, array $authorLastname, $authorFirstname, int $count)
    {
        // Création des authors avec des données constantes via une boucle foreach


        foreach (array_combine($authorLastname, $authorFirstname) as $lastname => $firstname) {
            // print $code . 'is your Id code and '  . $name . 'is your name';

            $authors = [];

            $author = new Author();
            $author->setLastname($lastname);
            $author->setFirstname($firstname);
            $manager->persist($author);

            $authors[] = $author;
        }
  

        // Création de authors avec des données aléatoires
        for($i = 0; $i <$count; $i++){
            $author = new Author();
            $author->setLastname($this->faker->lastname());
            $author->setFirstname($this->faker->firstname());

            $manager->persist($author);
            $authors[] = $author;
        }
    }

    // Fonction qui va servir à charger les données BORROWERS.


    public function loadBorrowers(ObjectManager $manager, int $count)
    {
        $borrowers = [];
        // Génération du premier Borrower
        $user = new User();
        $user->setEmail('foo.foo@example.com');
        // hashage du mot de passe
        $password = $this->encoder->encodePassword($user, '123');
        $user->setPassword($password);
        $user->setRoles(['ROLE_BORROWER']);

        $manager->persist($user);

        // Création d'un borrower avec des données constantes
        $borrower = new Borrower();
        $borrower->setLastname('foo');
        $borrower->setFirstname('foo');
        $borrower->setPhoneNumber('123456789');
        $borrower->setActive(true);
        $borrower->setCreationDate(\DateTime::createFromFormat('Y-m-d H:i:s', '2020-01-01 10:00:00'));
        $borrower->setUser($user);

        $manager->persist($borrower);

        $borrowers[] = $borrower;

        // Création d'un deuxième Borrower
        $user = new User();
        $user->setEmail('bar.bar@example.com');
        // hashage du mot de passe
        $password = $this->encoder->encodePassword($user, '123');
        $user->setPassword($password);
        $user->setRoles(['ROLE_BORROWER']);

        $manager->persist($user);

        // Création d'un borrower avec des données constantes
        $borrower = new Borrower();
        $borrower->setLastname('bar');
        $borrower->setFirstname('bar');
        $borrower->setPhoneNumber('123456789');
        $borrower->setActive(false);
        $borrower->setCreationDate(\DateTime::createFromFormat('Y-m-d H:i:s', '2020-01-01 11:00:00'));

        $creationDate = $borrower->getCreationDate();
        $modificationDate = \DateTime::createFromFormat('Y-m-d H:i:s', $creationDate->format('Y-m-d H:i:s'));
        $modificationDate->add(new \DateInterval('P3M'));
        $modificationDate->add(new \DateInterval('PT1H'));

        $borrower->setModificationDate($modificationDate);
        $borrower->setUser($user);

        $manager->persist($borrower);

        $borrowers[] = $borrower;

        // Création d'un troisième Borrower
        $user = new User();
        $user->setEmail('baz.baz@example.com');
        // hashage du mot de passe
        $password = $this->encoder->encodePassword($user, '123');
        $user->setPassword($password);
        $user->setRoles(['ROLE_BORROWER']);

        $manager->persist($user);

        // Création d'un borrower avec des données constantes
        $borrower = new Borrower();
        $borrower->setLastname('baz');
        $borrower->setFirstname('baz');
        $borrower->setPhoneNumber('123456789');
        $borrower->setActive(true);
        $borrower->setCreationDate(\DateTime::createFromFormat('Y-m-d H:i:s', '2020-01-01 12:00:00'));
        $borrower->setUser($user);

        $manager->persist($borrower);

        $borrowers[] = $borrower;

        for($i = 0; $i < $count; $i++){
            $user = new User();
            $user->setEmail($this->faker->email());
            // hashage du mot de passe
            $password = $this->encoder->encodePassword($user, '123');
            $user->setPassword($password);
            $user->setRoles(['ROLE_BORROWER']);

            $borrower = new Borrower();
            $borrower->setLastname($this->faker->lastname());
            $borrower->setFirstname($this->faker->firstname());
            $borrower->setPhoneNumber($this->faker->phoneNumber());
            $borrower->setActive($this->faker->boolean());
            $borrower->setCreationDate($this->faker->dateTime());
            $borrower->setUser($user);

            $creationDate = $borrower->getCreationDate();
            $modificationDate = \DateTime::createFromFormat('Y-m-d H:i:s',  $creationDate->format('Y-m-d H:i:s'));
            $modificationDate->add(new \DateInterval('P3M'));
            $modificationDate->add(new \DateInterval('PT1H'));

            $borrower->setModificationDate($modificationDate);

            $manager->persist($borrower);

            $borrowers[] = $borrower;
        }

    }

    // Fonction qui va servir à charger les données KINDS.

    public function loadKinds(ObjectManager $manager, array $kindArray)
    {
        // On déclare un tableau qui servira à stocker les différents kinds 
        
        foreach($kindArray as $i){
            $kinds = [];

            $kind = new Kind();
            $kind->setName($i);
            $manager->persist($kind);

            $kinds[] = $kind;
        }
    }

    // public function loadBooks(ObjectManager $manager, int $count)
    // {
    //     // Création d'un tableau qui contiendra les books qu'on va créer.
    //     // La fonction va pouvoir renvoyer ce tableau pour que d'autres fonctions
    //     // de création d'objets puissent utiliser les books.
    //     $books = [];

    //     // Création d'un book avec des données constantes.
    //     $book = new Book();
    //     $book->setTitle('Lorem Ipsum Dolor Sit Amet');
    //     $book->setPublicationYear(2010);
    //     $book->setNumberPages(100);
    //     $book->setIsbnCode('9785786930024');
    //     $book->setAuthor();

    //     $manager->persist($book);

    //     // On ajoute le premier book que l'on vient de créer
    //     $books[] = $book;


    // }

}
