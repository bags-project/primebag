<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181219133909 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shipping_method ADD carrier_id INT NOT NULL');
        $this->addSql('ALTER TABLE shipping_method ADD CONSTRAINT FK_7503FF2F21DFC797 FOREIGN KEY (carrier_id) REFERENCES carrier (id)');
        $this->addSql('CREATE INDEX IDX_7503FF2F21DFC797 ON shipping_method (carrier_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shipping_method DROP FOREIGN KEY FK_7503FF2F21DFC797');
        $this->addSql('DROP INDEX IDX_7503FF2F21DFC797 ON shipping_method');
        $this->addSql('ALTER TABLE shipping_method DROP carrier_id');
    }
}
