<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230803090851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C63379586');
        $this->addSql('DROP INDEX IDX_9474526C63379586 ON comment');
        $this->addSql('ALTER TABLE comment ADD publication_id INT NOT NULL, DROP comments_id');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C38B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id)');
        $this->addSql('CREATE INDEX IDX_9474526C38B217A7 ON comment (publication_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C38B217A7');
        $this->addSql('DROP INDEX IDX_9474526C38B217A7 ON comment');
        $this->addSql('ALTER TABLE comment ADD comments_id INT DEFAULT NULL, DROP publication_id');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C63379586 FOREIGN KEY (comments_id) REFERENCES publication (id)');
        $this->addSql('CREATE INDEX IDX_9474526C63379586 ON comment (comments_id)');
    }
}
