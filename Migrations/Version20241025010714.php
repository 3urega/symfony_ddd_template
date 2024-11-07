<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241025010714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingrediente (id CHAR(36) NOT NULL COMMENT \'(DC2Type:vo_id)\', nombre VARCHAR(255) NOT NULL COMMENT \'(DC2Type:vo_nombre)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producto_backoffice (id CHAR(36) NOT NULL COMMENT \'(DC2Type:vo_id)\', nombre VARCHAR(255) NOT NULL COMMENT \'(DC2Type:vo_nombre_producto_backoffice)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producto_backoffice_ingrediente (producto_backoffice_id CHAR(36) NOT NULL COMMENT \'(DC2Type:vo_id)\', ingrediente_model_id CHAR(36) NOT NULL COMMENT \'(DC2Type:vo_id)\', INDEX IDX_FB6F66981B2A4F17 (producto_backoffice_id), INDEX IDX_FB6F669822164801 (ingrediente_model_id), PRIMARY KEY(producto_backoffice_id, ingrediente_model_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producto_shoppinglist (id CHAR(36) NOT NULL COMMENT \'(DC2Type:vo_id)\', nombre VARCHAR(255) NOT NULL COMMENT \'(DC2Type:vo_nombre)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producto_shoppinglist_ingrediente (producto_shopping_list_id CHAR(36) NOT NULL COMMENT \'(DC2Type:vo_id)\', ingrediente_model_id CHAR(36) NOT NULL COMMENT \'(DC2Type:vo_id)\', INDEX IDX_C705FB7F4D85F836 (producto_shopping_list_id), INDEX IDX_C705FB7F22164801 (ingrediente_model_id), PRIMARY KEY(producto_shopping_list_id, ingrediente_model_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id CHAR(36) NOT NULL COMMENT \'(DC2Type:vo_id)\', nombre VARCHAR(255) DEFAULT NULL COMMENT \'(DC2Type:vo_nombre)\', direccion_email VARCHAR(255) NOT NULL COMMENT \'(DC2Type:vo_email_address)\', password VARCHAR(255) NOT NULL COMMENT \'(DC2Type:vo_password_hash)\', discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_administrador (id CHAR(36) NOT NULL COMMENT \'(DC2Type:vo_id)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_invitado (id CHAR(36) NOT NULL COMMENT \'(DC2Type:vo_id)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_particular (id CHAR(36) NOT NULL COMMENT \'(DC2Type:vo_id)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_superadmin (id CHAR(36) NOT NULL COMMENT \'(DC2Type:vo_id)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE producto_backoffice_ingrediente ADD CONSTRAINT FK_FB6F66981B2A4F17 FOREIGN KEY (producto_backoffice_id) REFERENCES producto_backoffice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE producto_backoffice_ingrediente ADD CONSTRAINT FK_FB6F669822164801 FOREIGN KEY (ingrediente_model_id) REFERENCES ingrediente (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE producto_shoppinglist_ingrediente ADD CONSTRAINT FK_C705FB7F4D85F836 FOREIGN KEY (producto_shopping_list_id) REFERENCES producto_shoppinglist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE producto_shoppinglist_ingrediente ADD CONSTRAINT FK_C705FB7F22164801 FOREIGN KEY (ingrediente_model_id) REFERENCES ingrediente (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario_administrador ADD CONSTRAINT FK_B24ABBFFBF396750 FOREIGN KEY (id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario_invitado ADD CONSTRAINT FK_A1431E8EBF396750 FOREIGN KEY (id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario_particular ADD CONSTRAINT FK_75112B6DBF396750 FOREIGN KEY (id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE usuario_superadmin ADD CONSTRAINT FK_CAE83EA6BF396750 FOREIGN KEY (id) REFERENCES usuario (id) ON DELETE CASCADE');
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE backoffice_events (id CHAR(36) NOT NULL, body  JSON NOT NULL, aggregate_id CHAR(36) NOT NULL, name VARCHAR(255) NOT NULL, occurred_on TIMESTAMP NOT NULL, PRIMARY KEY (`id`)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE shoppingList_events (id CHAR(36) NOT NULL, body  JSON NOT NULL, aggregate_id CHAR(36) NOT NULL, name VARCHAR(255) NOT NULL, occurred_on TIMESTAMP NOT NULL, PRIMARY KEY (`id`)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE receipts_events (id CHAR(36) NOT NULL, body  JSON NOT NULL, aggregate_id CHAR(36) NOT NULL, name VARCHAR(255) NOT NULL, occurred_on TIMESTAMP NOT NULL, PRIMARY KEY (`id`)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE producto_backoffice_ingrediente DROP FOREIGN KEY FK_FB6F66981B2A4F17');
        $this->addSql('ALTER TABLE producto_backoffice_ingrediente DROP FOREIGN KEY FK_FB6F669822164801');
        $this->addSql('ALTER TABLE producto_shoppinglist_ingrediente DROP FOREIGN KEY FK_C705FB7F4D85F836');
        $this->addSql('ALTER TABLE producto_shoppinglist_ingrediente DROP FOREIGN KEY FK_C705FB7F22164801');
        $this->addSql('ALTER TABLE usuario_administrador DROP FOREIGN KEY FK_B24ABBFFBF396750');
        $this->addSql('ALTER TABLE usuario_invitado DROP FOREIGN KEY FK_A1431E8EBF396750');
        $this->addSql('ALTER TABLE usuario_particular DROP FOREIGN KEY FK_75112B6DBF396750');
        $this->addSql('ALTER TABLE usuario_superadmin DROP FOREIGN KEY FK_CAE83EA6BF396750');
        $this->addSql('DROP TABLE ingrediente');
        $this->addSql('DROP TABLE producto_backoffice');
        $this->addSql('DROP TABLE producto_backoffice_ingrediente');
        $this->addSql('DROP TABLE producto_shoppinglist');
        $this->addSql('DROP TABLE producto_shoppinglist_ingrediente');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE usuario_administrador');
        $this->addSql('DROP TABLE usuario_invitado');
        $this->addSql('DROP TABLE usuario_particular');
        $this->addSql('DROP TABLE usuario_superadmin');
    }
}
