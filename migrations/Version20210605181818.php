<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210605181818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book_kind (book_id INT NOT NULL, kind_id INT NOT NULL, INDEX IDX_2259F7D116A2B381 (book_id), INDEX IDX_2259F7D130602CA9 (kind_id), PRIMARY KEY(book_id, kind_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kind_book (kind_id INT NOT NULL, book_id INT NOT NULL, INDEX IDX_EF95EE8430602CA9 (kind_id), INDEX IDX_EF95EE8416A2B381 (book_id), PRIMARY KEY(kind_id, book_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book_kind ADD CONSTRAINT FK_2259F7D116A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_kind ADD CONSTRAINT FK_2259F7D130602CA9 FOREIGN KEY (kind_id) REFERENCES kind (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kind_book ADD CONSTRAINT FK_EF95EE8430602CA9 FOREIGN KEY (kind_id) REFERENCES kind (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kind_book ADD CONSTRAINT FK_EF95EE8416A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331F675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A331F675F31B ON book (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE book_kind');
        $this->addSql('DROP TABLE kind_book');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331F675F31B');
        $this->addSql('DROP INDEX IDX_CBE5A331F675F31B ON book');
        $this->addSql('ALTER TABLE book DROP author_id');
    }
}
