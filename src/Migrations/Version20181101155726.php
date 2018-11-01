<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181101155726 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE cylinders (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, option VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE strengths (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cylinder_id INTEGER DEFAULT NULL, option VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_93D02C0C9C16D05B ON strengths (cylinder_id)');
        $this->addSql('CREATE TABLE axes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cylinder_id INTEGER DEFAULT NULL, option VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_29BAC9F69C16D05B ON axes (cylinder_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE cylinders');
        $this->addSql('DROP TABLE strengths');
        $this->addSql('DROP TABLE axes');
    }
}
