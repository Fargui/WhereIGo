<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430094921 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, answer VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse_place (reponse_id INT NOT NULL, place_id INT NOT NULL, INDEX IDX_9BF428AECF18BB82 (reponse_id), INDEX IDX_9BF428AEDA6A219 (place_id), PRIMARY KEY(reponse_id, place_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, ask VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_reponse (question_id INT NOT NULL, reponse_id INT NOT NULL, INDEX IDX_516A0BDA1E27F6BF (question_id), INDEX IDX_516A0BDACF18BB82 (reponse_id), PRIMARY KEY(question_id, reponse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reponse_place ADD CONSTRAINT FK_9BF428AECF18BB82 FOREIGN KEY (reponse_id) REFERENCES reponse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse_place ADD CONSTRAINT FK_9BF428AEDA6A219 FOREIGN KEY (place_id) REFERENCES place (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_reponse ADD CONSTRAINT FK_516A0BDA1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_reponse ADD CONSTRAINT FK_516A0BDACF18BB82 FOREIGN KEY (reponse_id) REFERENCES reponse (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reponse_place DROP FOREIGN KEY FK_9BF428AECF18BB82');
        $this->addSql('ALTER TABLE question_reponse DROP FOREIGN KEY FK_516A0BDACF18BB82');
        $this->addSql('ALTER TABLE question_reponse DROP FOREIGN KEY FK_516A0BDA1E27F6BF');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE reponse_place');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_reponse');
    }
}
