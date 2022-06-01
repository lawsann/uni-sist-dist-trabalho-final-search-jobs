<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601230656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE professional (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, dev_type VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professional_skill (professional_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_3F445E9DDB77003 (professional_id), INDEX IDX_3F445E9D5585C142 (skill_id), PRIMARY KEY(professional_id, skill_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacancy (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, wage DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacancy_skill (vacancy_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_87739B15433B78C4 (vacancy_id), INDEX IDX_87739B155585C142 (skill_id), PRIMARY KEY(vacancy_id, skill_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE professional_skill ADD CONSTRAINT FK_3F445E9DDB77003 FOREIGN KEY (professional_id) REFERENCES professional (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professional_skill ADD CONSTRAINT FK_3F445E9D5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vacancy_skill ADD CONSTRAINT FK_87739B15433B78C4 FOREIGN KEY (vacancy_id) REFERENCES vacancy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vacancy_skill ADD CONSTRAINT FK_87739B155585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE professional_skill DROP FOREIGN KEY FK_3F445E9DDB77003');
        $this->addSql('ALTER TABLE professional_skill DROP FOREIGN KEY FK_3F445E9D5585C142');
        $this->addSql('ALTER TABLE vacancy_skill DROP FOREIGN KEY FK_87739B155585C142');
        $this->addSql('ALTER TABLE vacancy_skill DROP FOREIGN KEY FK_87739B15433B78C4');
        $this->addSql('DROP TABLE professional');
        $this->addSql('DROP TABLE professional_skill');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE vacancy');
        $this->addSql('DROP TABLE vacancy_skill');
    }
}
