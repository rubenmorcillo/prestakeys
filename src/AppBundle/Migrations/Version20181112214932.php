<?php

namespace AppBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181112214932 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE dependencia (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE llave (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, descripcion VARCHAR(255) NOT NULL, codigo VARCHAR(255) NOT NULL, fecha_prestamo DATE, UNIQUE INDEX UNIQ_E6B8CF5A20332D99 (codigo), INDEX IDX_E6B8CF5ADB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, ordenanza TINYINT(1) NOT NULL, secretario TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE llave ADD CONSTRAINT FK_E6B8CF5ADB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE llave DROP FOREIGN KEY FK_E6B8CF5ADB38439E');
        $this->addSql('DROP TABLE dependencia');
        $this->addSql('DROP TABLE llave');
        $this->addSql('DROP TABLE usuario');
    }
}
