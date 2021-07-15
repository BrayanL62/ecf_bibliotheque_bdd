<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210715194315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E589711CE312B');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E589711CE312B FOREIGN KEY (borrower_id) REFERENCES borrower (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E589711CE312B');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E589711CE312B FOREIGN KEY (borrower_id) REFERENCES borrower (id)');
    }
}
