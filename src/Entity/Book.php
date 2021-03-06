<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=190)
     */
    private $title;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $publication_year;

    /**
     * @ORM\Column(type="integer")
     */
    private $number_pages;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $isbn_code;

    /**
     * @ORM\OneToMany(targetEntity=Borrowing::class, mappedBy="book")
     */
    private $borrowings;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="books")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $author;

    /**
     * @ORM\ManyToMany(targetEntity=Kind::class, inversedBy="books")
     */
    private $Kinds;

    public function __construct()
    {
        $this->Kinds = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPublicationYear(): ?int
    {
        return $this->publication_year;
    }

    public function setPublicationYear(?int $publication_year): self
    {
        $this->publication_year = $publication_year;

        return $this;
    }

    public function getNumberPages(): ?int
    {
        return $this->number_pages;
    }

    public function setNumberPages(int $number_pages): self
    {
        $this->number_pages = $number_pages;

        return $this;
    }

    public function getIsbnCode(): ?string
    {
        return $this->isbn_code;
    }

    public function setIsbnCode(?string $isbn_code): self
    {
        $this->isbn_code = $isbn_code;

        return $this;
    }

    /**
     * @return Collection|Borrowing[]
     */
    public function getBorrowings(): Collection
    {
        return $this->borrowings;
    }

    public function addBorrowing(Borrowing $borrowing): self
    {
        if (!$this->borrowings->contains($borrowing)) {
            $this->borrowings[] = $borrowing;
            $borrowing->setBook($this);
        }

        return $this;
    }

    public function removeBorrowing(Borrowing $borrowing): self
    {
        if ($this->borrowings->removeElement($borrowing)) {
            // set the owning side to null (unless already changed)
            if ($borrowing->getBook() === $this) {
                $borrowing->setBook(null);
            }
        }

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Kind[]
     */
    public function getKinds(): Collection
    {
        return $this->Kinds;
    }

    public function addKind(Kind $kind): self
    {
        if (!$this->Kinds->contains($kind)) {
            $this->Kinds[] = $kind;
        }

        return $this;
    }

    public function removeKind(Kind $kind): self
    {
        $this->Kinds->removeElement($kind);

        return $this;
    }

    public function isAvailable(): bool
    {
        // S'il n'y a pas d'emrpunt, le livre est dispo
        // S'il il a des emrpunts mais qu'ils ont tous ??t?? retourn??s, le livre est dispo

        foreach($this->getBorrowings() as $borrowing){
            if($borrowing->getReturnDate() == null){
                return false;
            }
            
        }
        return true;
    }
}
