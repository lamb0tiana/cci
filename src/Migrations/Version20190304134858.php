<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190304134858 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE categorie_article');
        $this->addSql('ALTER TABLE article ADD categorie_id INT NOT NULL, ADD created_at DATETIME NOT NULL, CHANGE nom name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66BCF5E72D ON article (categorie_id)');
        $this->addSql('ALTER TABLE categorie CHANGE nom name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie_article (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_5DB9A0C47294869C (article_id), INDEX IDX_5DB9A0C4BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE categorie_article ADD CONSTRAINT FK_5DB9A0C47294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE categorie_article ADD CONSTRAINT FK_5DB9A0C4BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66BCF5E72D');
        $this->addSql('DROP INDEX IDX_23A0E66BCF5E72D ON article');
        $this->addSql('ALTER TABLE article DROP categorie_id, DROP created_at, CHANGE name nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE categorie CHANGE name nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
