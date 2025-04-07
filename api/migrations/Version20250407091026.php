<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250407091026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE sticky_note_tag (sticky_note_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_278198A13B5E3A3 (sticky_note_id), INDEX IDX_278198A1BAD26311 (tag_id), PRIMARY KEY(sticky_note_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_389B7835E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sticky_note_tag ADD CONSTRAINT FK_278198A13B5E3A3 FOREIGN KEY (sticky_note_id) REFERENCES sticky_note (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sticky_note_tag ADD CONSTRAINT FK_278198A1BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE sticky_note_tag DROP FOREIGN KEY FK_278198A13B5E3A3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sticky_note_tag DROP FOREIGN KEY FK_278198A1BAD26311
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE sticky_note_tag
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE tag
        SQL);
    }
}
