<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181217111039 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE shipping_method (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE delivery');
        $this->addSql('ALTER TABLE `order` ADD carrier_id INT DEFAULT NULL, ADD sent_at DATETIME DEFAULT NULL, ADD shipping_cost DOUBLE PRECISION DEFAULT NULL, ADD tracking_number VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939821DFC797 FOREIGN KEY (carrier_id) REFERENCES carrier (id)');
        $this->addSql('CREATE INDEX IDX_F529939821DFC797 ON `order` (carrier_id)');
        $this->addSql('ALTER TABLE tag CHANGE name name VARCHAR(20) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE delivery (id INT AUTO_INCREMENT NOT NULL, order_ref_id INT NOT NULL, carrier_id INT NOT NULL, sent_at DATETIME NOT NULL, shipping_cost DOUBLE PRECISION DEFAULT NULL, tracking_number VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_3781EC10E238517C (order_ref_id), INDEX IDX_3781EC1021DFC797 (carrier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC1021DFC797 FOREIGN KEY (carrier_id) REFERENCES carrier (id)');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10E238517C FOREIGN KEY (order_ref_id) REFERENCES `order` (id)');
        $this->addSql('DROP TABLE shipping_method');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939821DFC797');
        $this->addSql('DROP INDEX IDX_F529939821DFC797 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP carrier_id, DROP sent_at, DROP shipping_cost, DROP tracking_number');
    }
}
