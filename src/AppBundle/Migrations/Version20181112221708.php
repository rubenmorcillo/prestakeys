<?php

namespace AppBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181112221708 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE historia (id INT AUTO_INCREMENT NOT NULL, llave_id INT DEFAULT NULL, usuario_id INT DEFAULT NULL, fecha_prestamo DATE NOT NULL, fecha_devolucion DATE NOT NULL, INDEX IDX_435C8E7A8EB29E8F (llave_id), INDEX IDX_435C8E7ADB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE historia ADD CONSTRAINT FK_435C8E7A8EB29E8F FOREIGN KEY (llave_id) REFERENCES llave (id)');
        $this->addSql('ALTER TABLE historia ADD CONSTRAINT FK_435C8E7ADB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE historia');
    }
}
