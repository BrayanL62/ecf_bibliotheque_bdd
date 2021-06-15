<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Borrower;
use App\Entity\Borrowing;
use App\Entity\Kind;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProdFixtures extends Fixture implements FixtureGroupInterface
{
    private $encoder;
    private $faker;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public static function getGroups(): array
    {
        // Cette fixture fait partie du groupe "prod".
        // Cela permet de cibler seulement certains fixtures
        // quand on exécute la commande doctrine:fixtures:load.
        // Pour que la méthode statique getGroups() soit prise
        // en compte, il faut que la classe implémente
        // l'interface FixtureGroupInterface.
        return ['prod'];
    }

    public function load(ObjectManager $manager)
    {
        // On déclare un tableau qui servira à stocker les différents kinds 
        $kindArray = ['poésie', 'nouvelle', 'roman historique', 'roman d\'amour', 'roman d\'aventure', 'science-fiction', 'fantasy', 'biographie', 'conte', 'témoignage', 'théâtre', 'essai', 'journal intime'];

        $this->loadAdmin($manager);
        $kinds = $this->loadKinds($manager, $kindArray);
        $authors = $this->loadAuthors($manager);
        $books = $this->loadBooks($manager, $authors, $kinds);
        $borrowers = $this->loadBorrowers($manager);
        $borrowings = $this->loadBorrowings($manager, $borrowers, $books);

        $manager->flush();
    }

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

    public function loadAuthors(ObjectManager $manager)
    {
        $authorLastname = ['auteur inconnu', 'Cartier', 'Lambert', 'Moitessier'];
        $authorFirstname = ['', 'Hugues', 'Armand', 'Thomas'];
        $authors = [];
        
        foreach (array_combine($authorLastname, $authorFirstname) as $lastname => $firstname) {
            $author = new Author();
            $author->setLastname($lastname);
            $author->setFirstname($firstname);
            $manager->persist($author);
            
            $authors[] = $author;
        }

        // // On retourne le tableau Authors afin de pouvoir l'utiliser dans d'autres fonctions.
        return $authors;

    }

    // Fonction qui va servir à charger les données BOOKS
    public function loadBooks(ObjectManager $manager, array $authors, $kinds)
    {
        $books = [];

        // Création d'un premier Book avec des données constantes.
        $book = new Book();
        
        $book->setTitle('Lorem ipsum dolor sit amet');
        $book->setPublicationYear(2010);
        $book->setNumberPages(100);
        $book->setIsbnCode('9785786930024');
        $book->setAuthor($authors[0]);
        $book->addKind($kinds[0]);

        $manager->persist($book);

        $books[] = $book;

        $book = new Book();
        
        $book->setTitle("Consectetur adipiscing elit");
        $book->setPublicationYear(2011);
        $book->setNumberPages(150);
        $book->setIsbnCode('9783817260935');    
        $book->setAuthor($authors[1]);
        $book->addKind($kinds[1]);


        $manager->persist($book);
        
        $books[] = $book;

        $book = new Book();

        $book->setTitle('Mihi quidem Antiochum');
        $book->setPublicationYear(2012);
        $book->setNumberPages(200);
        $book->setIsbnCode('9782020493727');
        $book->setAuthor($authors[2]);

        $manager->persist($book);

        $books[] = $book;

        $book = new Book();

        $book->setTitle('Quem audis satis belle');
        $book->setPublicationYear(2013);
        $book->setNumberPages(250);
        $book->setIsbnCode('9794059561353');
        $book->setAuthor($authors[3]);

        $manager->persist($book);

        $books[] = $book;

        
        return $books;

    }

    public function loadBorrowers(ObjectManager $manager)
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

        return $borrowers;

    }

    // Fonction qui va servir à charger les données BORROWING
    public function loadBorrowings(ObjectManager $manager, array $borrowers, $books) {

        $borrowings = [];
    
        $borrowing = new Borrowing();
        $borrowing->setBorrowingDate(\DateTime::createFromFormat('Y-m-d H:i:s', '2020-02-01 10:00:00'));
        $borrowingDate = $borrowing->getBorrowingDate();
        $modificationDate = \DateTime::createFromFormat('Y-m-d H:i:s',  $borrowingDate->format('Y-m-d H:i:s'));
        $modificationDate->add(new \DateInterval('P1M'));
        $borrowing->setReturnDate($modificationDate);
        $borrowing->setBorrower($borrowers[0]);
        $borrowing->setBook($books[0]);
    
        $manager->persist($borrowing);
    
        $borrowings[] = $borrowing;

    }

    public function loadKinds(ObjectManager $manager, array $kindArray)
    {
        
        $kinds = [];
        
        $kind = new Kind();
        $kind->setName($kindArray[0]);

        $manager->persist($kind);
            
        $kinds[] = $kind;
        
        $kind = new Kind();
        $kind->setName($kindArray[1]);

        $manager->persist($kind);
            
        $kinds[] = $kind;
        
        $kind = new Kind();
        $kind->setName($kindArray[2]);

        $manager->persist($kind);
            
        $kinds[] = $kind;
        
        $kind = new Kind();
        $kind->setName($kindArray[3]);

        $manager->persist($kind);
            
        $kinds[] = $kind;
        
        $kind = new Kind();
        $kind->setName($kindArray[4]);

        $manager->persist($kind);
            
        $kinds[] = $kind;
        
        $kind = new Kind();
        $kind->setName($kindArray[5]);

        $manager->persist($kind);
            
        $kinds[] = $kind;
        
        $kind = new Kind();
        $kind->setName($kindArray[6]);

        $manager->persist($kind);
            
        $kinds[] = $kind;
        
        $kind = new Kind();
        $kind->setName($kindArray[7]);

        $manager->persist($kind);
            
        $kinds[] = $kind;
        
        $kind = new Kind();
        $kind->setName($kindArray[8]);

        $manager->persist($kind);
            
        $kinds[] = $kind;
        
        $kind = new Kind();
        $kind->setName($kindArray[9]);

        $manager->persist($kind);
            
        $kinds[] = $kind;
        
        $kind = new Kind();
        $kind->setName($kindArray[11]);

        $manager->persist($kind);
            
        $kinds[] = $kind;
        
        $kind = new Kind();
        $kind->setName($kindArray[12]);

        $manager->persist($kind);
            
        $kinds[] = $kind;
        
        $kind = new Kind();
        $kind->setName($kindArray[0]);

        $manager->persist($kind);
            
        $kinds[] = $kind;
        
        return $kinds;
    }
}
