<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190325125433 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE minisite (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, ndd VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD minisite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66EDE16DF7 FOREIGN KEY (minisite_id) REFERENCES minisite (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66EDE16DF7 ON article (minisite_id)');
        $this->addSql('ALTER TABLE categorie ADD minisite_id INT NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634EDE16DF7 FOREIGN KEY (minisite_id) REFERENCES minisite (id)');
        $this->addSql('CREATE INDEX IDX_497DD634EDE16DF7 ON categorie (minisite_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66EDE16DF7');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634EDE16DF7');
        $this->addSql('DROP TABLE minisite');
        $this->addSql('DROP INDEX IDX_23A0E66EDE16DF7 ON article');
        $this->addSql('ALTER TABLE article DROP minisite_id');
        $this->addSql('DROP INDEX IDX_497DD634EDE16DF7 ON categorie');
        $this->addSql('ALTER TABLE categorie DROP minisite_id');
    }
}
