<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240707130223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, employee_id VARCHAR(50) NOT NULL, user_name VARCHAR(100) NOT NULL, name_prefix VARCHAR(10) DEFAULT NULL, first_name VARCHAR(50) NOT NULL, middle_initial VARCHAR(1) DEFAULT NULL, last_name VARCHAR(50) NOT NULL, gender VARCHAR(10) NOT NULL, email VARCHAR(100) NOT NULL, date_of_birth DATE NOT NULL, time_of_birth TIME NOT NULL, age_in_yrs INT NOT NULL, date_of_joining DATE NOT NULL, age_in_company INT NOT NULL, phone_no VARCHAR(20) NOT NULL, place_name VARCHAR(100) NOT NULL, county VARCHAR(100) NOT NULL, city VARCHAR(100) NOT NULL, zip VARCHAR(20) NOT NULL, region VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_5D9F75A18C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE employee');
    }
}
