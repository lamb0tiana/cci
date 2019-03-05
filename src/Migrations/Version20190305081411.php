<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190305081411 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E666FB990BC');
        $this->addSql('DROP INDEX IDX_23A0E666FB990BC ON article');
        $this->addSql('ALTER TABLE article DROP article_categorie_id');
        $this->addSql('ALTER TABLE article_categorie ADD articles_id INT DEFAULT NULL, ADD categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article_categorie ADD CONSTRAINT FK_934886101EBAF6CC FOREIGN KEY (articles_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_categorie ADD CONSTRAINT FK_93488610A21214B7 FOREIGN KEY (categories_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_934886101EBAF6CC ON article_categorie (articles_id)');
        $this->addSql('CREATE INDEX IDX_93488610A21214B7 ON article_categorie (categories_id)');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634EC5D4C30');
        $this->addSql('DROP INDEX IDX_497DD634EC5D4C30 ON categorie');
        $this->addSql('ALTER TABLE categorie DROP categorie_article_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article ADD article_categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E666FB990BC FOREIGN KEY (article_categorie_id) REFERENCES article_categorie (id)');
        $this->addSql('CREATE INDEX IDX_23A0E666FB990BC ON article (article_categorie_id)');
        $this->addSql('ALTER TABLE article_categorie DROP FOREIGN KEY FK_934886101EBAF6CC');
        $this->addSql('ALTER TABLE article_categorie DROP FOREIGN KEY FK_93488610A21214B7');
        $this->addSql('DROP INDEX IDX_934886101EBAF6CC ON article_categorie');
        $this->addSql('DROP INDEX IDX_93488610A21214B7 ON article_categorie');
        $this->addSql('ALTER TABLE article_categorie DROP articles_id, DROP categories_id');
        $this->addSql('ALTER TABLE categorie ADD categorie_article_id INT NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634EC5D4C30 FOREIGN KEY (categorie_article_id) REFERENCES article_categorie (id)');
        $this->addSql('CREATE INDEX IDX_497DD634EC5D4C30 ON categorie (categorie_article_id)');
    }
}
