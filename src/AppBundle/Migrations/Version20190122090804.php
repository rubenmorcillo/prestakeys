<?php

namespace AppBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190122090804 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE llave ADD prestatario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE llave ADD CONSTRAINT FK_E6B8CF5AAFA10618 FOREIGN KEY (prestatario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_E6B8CF5AAFA10618 ON llave (prestatario_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE llave DROP FOREIGN KEY FK_E6B8CF5AAFA10618');
        $this->addSql('DROP INDEX IDX_E6B8CF5AAFA10618 ON llave');
        $this->addSql('ALTER TABLE llave DROP prestatario_id');
    }
}
