<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180323190350 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE produtos_categorias (id_produto INT NOT NULL, id_categoria INT NOT NULL, INDEX IDX_DC71F4A78231E0A7 (id_produto), INDEX IDX_DC71F4A7CE25AE0A (id_categoria), PRIMARY KEY(id_produto, id_categoria)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produtos_caracteristicas (id_produto INT NOT NULL, id_caracteristica INT NOT NULL, INDEX IDX_D673ED1D8231E0A7 (id_produto), INDEX IDX_D673ED1DA4FB134F (id_caracteristica), PRIMARY KEY(id_produto, id_caracteristica)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produtos_categorias ADD CONSTRAINT FK_DC71F4A78231E0A7 FOREIGN KEY (id_produto) REFERENCES produto (id)');
        $this->addSql('ALTER TABLE produtos_categorias ADD CONSTRAINT FK_DC71F4A7CE25AE0A FOREIGN KEY (id_categoria) REFERENCES categoria (id)');
        $this->addSql('ALTER TABLE produtos_caracteristicas ADD CONSTRAINT FK_D673ED1D8231E0A7 FOREIGN KEY (id_produto) REFERENCES produto (id)');
        $this->addSql('ALTER TABLE produtos_caracteristicas ADD CONSTRAINT FK_D673ED1DA4FB134F FOREIGN KEY (id_caracteristica) REFERENCES caracteristica (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE produtos_categorias');
        $this->addSql('DROP TABLE produtos_caracteristicas');
    }
}
