<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200610133641 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE notebook_skill (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notebook_subject (id INT AUTO_INCREMENT NOT NULL, task_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_10EA33978DB60186 (task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, pseudo VARCHAR(255) DEFAULT NULL, date_of_birth DATE DEFAULT NULL, days JSON NOT NULL, google VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notebook_task (id INT AUTO_INCREMENT NOT NULL, subject_id INT DEFAULT NULL, user_id INT DEFAULT NULL, datetime_start DATETIME NOT NULL, datetime_end DATETIME NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_757809D323EDC87 (subject_id), INDEX IDX_757809D3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notebook_goal (id INT AUTO_INCREMENT NOT NULL, task_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_DBDA39D88DB60186 (task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timetable (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, time_start TIME NOT NULL, time_end TIME NOT NULL, INDEX IDX_6B1F670A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timetable_task (id INT AUTO_INCREMENT NOT NULL, timetable_id INT DEFAULT NULL, subject_id INT DEFAULT NULL, day SMALLINT NOT NULL, time_start TIME NOT NULL, time_end TIME NOT NULL, note LONGTEXT DEFAULT NULL, INDEX IDX_C742312BCC306847 (timetable_id), INDEX IDX_C742312B23EDC87 (subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notebook_material (id INT AUTO_INCREMENT NOT NULL, task_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_A2EECF5D8DB60186 (task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE notebook_subject ADD CONSTRAINT FK_10EA33978DB60186 FOREIGN KEY (task_id) REFERENCES notebook_task (id)');
        $this->addSql('ALTER TABLE notebook_task ADD CONSTRAINT FK_757809D323EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE notebook_task ADD CONSTRAINT FK_757809D3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE notebook_goal ADD CONSTRAINT FK_DBDA39D88DB60186 FOREIGN KEY (task_id) REFERENCES notebook_task (id)');
        $this->addSql('ALTER TABLE timetable ADD CONSTRAINT FK_6B1F670A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE timetable_task ADD CONSTRAINT FK_C742312BCC306847 FOREIGN KEY (timetable_id) REFERENCES timetable (id)');
        $this->addSql('ALTER TABLE timetable_task ADD CONSTRAINT FK_C742312B23EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE notebook_material ADD CONSTRAINT FK_A2EECF5D8DB60186 FOREIGN KEY (task_id) REFERENCES notebook_task (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE notebook_task DROP FOREIGN KEY FK_757809D3A76ED395');
        $this->addSql('ALTER TABLE timetable DROP FOREIGN KEY FK_6B1F670A76ED395');
        $this->addSql('ALTER TABLE notebook_subject DROP FOREIGN KEY FK_10EA33978DB60186');
        $this->addSql('ALTER TABLE notebook_goal DROP FOREIGN KEY FK_DBDA39D88DB60186');
        $this->addSql('ALTER TABLE notebook_material DROP FOREIGN KEY FK_A2EECF5D8DB60186');
        $this->addSql('ALTER TABLE timetable_task DROP FOREIGN KEY FK_C742312BCC306847');
        $this->addSql('ALTER TABLE notebook_task DROP FOREIGN KEY FK_757809D323EDC87');
        $this->addSql('ALTER TABLE timetable_task DROP FOREIGN KEY FK_C742312B23EDC87');
        $this->addSql('DROP TABLE notebook_skill');
        $this->addSql('DROP TABLE notebook_subject');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE notebook_task');
        $this->addSql('DROP TABLE notebook_goal');
        $this->addSql('DROP TABLE timetable');
        $this->addSql('DROP TABLE timetable_task');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE notebook_material');
    }
}
