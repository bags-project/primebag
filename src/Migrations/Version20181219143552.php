<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181219143552 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_content DROP FOREIGN KEY FK_8BF99E2E238517C');
        $this->addSql('CREATE TABLE customer_order (id INT AUTO_INCREMENT NOT NULL, payment_method_id INT NOT NULL, user_id INT NOT NULL, order_status_id INT NOT NULL, carrier_id INT DEFAULT NULL, created_at DATETIME NOT NULL, order_number VARCHAR(20) NOT NULL, payment_date DATETIME DEFAULT NULL, payment_reference VARCHAR(20) DEFAULT NULL, sent_at DATETIME DEFAULT NULL, shipping_cost DOUBLE PRECISION DEFAULT NULL, tracking_number VARCHAR(20) DEFAULT NULL, INDEX IDX_3B1CE6A35AA1164F (payment_method_id), INDEX IDX_3B1CE6A3A76ED395 (user_id), INDEX IDX_3B1CE6A3D7707B45 (order_status_id), INDEX IDX_3B1CE6A321DFC797 (carrier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customer_order ADD CONSTRAINT FK_3B1CE6A35AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id)');
        $this->addSql('ALTER TABLE customer_order ADD CONSTRAINT FK_3B1CE6A3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE customer_order ADD CONSTRAINT FK_3B1CE6A3D7707B45 FOREIGN KEY (order_status_id) REFERENCES order_status (id)');
        $this->addSql('ALTER TABLE customer_order ADD CONSTRAINT FK_3B1CE6A321DFC797 FOREIGN KEY (carrier_id) REFERENCES carrier (id)');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('ALTER TABLE order_content DROP FOREIGN KEY FK_8BF99E2E238517C');
        $this->addSql('ALTER TABLE order_content ADD CONSTRAINT FK_8BF99E2E238517C FOREIGN KEY (order_ref_id) REFERENCES customer_order (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_content DROP FOREIGN KEY FK_8BF99E2E238517C');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, payment_method_id INT NOT NULL, user_id INT NOT NULL, order_status_id INT NOT NULL, carrier_id INT DEFAULT NULL, created_at DATETIME NOT NULL, order_number VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, payment_date DATETIME DEFAULT NULL, payment_reference VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci, sent_at DATETIME DEFAULT NULL, shipping_cost DOUBLE PRECISION DEFAULT NULL, tracking_number VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_F5299398D7707B45 (order_status_id), INDEX IDX_F52993985AA1164F (payment_method_id), INDEX IDX_F529939821DFC797 (carrier_id), INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939821DFC797 FOREIGN KEY (carrier_id) REFERENCES carrier (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993985AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398D7707B45 FOREIGN KEY (order_status_id) REFERENCES order_status (id)');
        $this->addSql('DROP TABLE customer_order');
        $this->addSql('ALTER TABLE order_content DROP FOREIGN KEY FK_8BF99E2E238517C');
        $this->addSql('ALTER TABLE order_content ADD CONSTRAINT FK_8BF99E2E238517C FOREIGN KEY (order_ref_id) REFERENCES `order` (id)');
    }
}
