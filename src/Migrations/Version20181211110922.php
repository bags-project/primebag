<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181211110922 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, article_color_id INT NOT NULL, name VARCHAR(40) NOT NULL, poster VARCHAR(255) DEFAULT NULL, alt_picture1 VARCHAR(255) DEFAULT NULL, alt_picture2 VARCHAR(255) DEFAULT NULL, alt_picture3 VARCHAR(255) DEFAULT NULL, price DOUBLE PRECISION NOT NULL, reference VARCHAR(20) NOT NULL, description LONGTEXT DEFAULT NULL, stock INT NOT NULL, matter VARCHAR(25) NOT NULL, discount DOUBLE PRECISION DEFAULT NULL, INDEX IDX_23A0E6644F5D008 (brand_id), INDEX IDX_23A0E662F32EBDE (article_color_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_category (article_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_53A4EDAA7294869C (article_id), INDEX IDX_53A4EDAA12469DE2 (category_id), PRIMARY KEY(article_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_color (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carrier (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, phone_number VARCHAR(20) DEFAULT NULL, email VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, description LONGTEXT DEFAULT NULL, poster VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery (id INT AUTO_INCREMENT NOT NULL, order_ref_id INT NOT NULL, carrier_id INT NOT NULL, sent_at DATETIME NOT NULL, shipping_cost DOUBLE PRECISION DEFAULT NULL, tracking_number VARCHAR(20) NOT NULL, INDEX IDX_3781EC10E238517C (order_ref_id), INDEX IDX_3781EC1021DFC797 (carrier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, payment_method_id INT NOT NULL, user_id INT NOT NULL, order_status_id INT NOT NULL, created_at DATETIME NOT NULL, order_number VARCHAR(20) NOT NULL, payment_date DATETIME DEFAULT NULL, payment_reference VARCHAR(20) DEFAULT NULL, INDEX IDX_F52993985AA1164F (payment_method_id), INDEX IDX_F5299398A76ED395 (user_id), INDEX IDX_F5299398D7707B45 (order_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_content (order_ref_id INT NOT NULL, article_ref_id INT NOT NULL, quantity INT NOT NULL, exclusive_of_taxes DOUBLE PRECISION NOT NULL, inclusive_of_taxes DOUBLE PRECISION NOT NULL, taxe DOUBLE PRECISION DEFAULT NULL, INDEX IDX_8BF99E2E238517C (order_ref_id), INDEX IDX_8BF99E24B70D629 (article_ref_id), PRIMARY KEY(order_ref_id, article_ref_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, icon VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_method (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, address VARCHAR(255) NOT NULL, secondary_address LONGTEXT DEFAULT NULL, phone_number VARCHAR(20) DEFAULT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, city VARCHAR(100) NOT NULL, zip_code VARCHAR(10) NOT NULL, country_name VARCHAR(50) NOT NULL, country_code VARCHAR(20) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6644F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E662F32EBDE FOREIGN KEY (article_color_id) REFERENCES article_color (id)');
        $this->addSql('ALTER TABLE article_category ADD CONSTRAINT FK_53A4EDAA7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_category ADD CONSTRAINT FK_53A4EDAA12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC10E238517C FOREIGN KEY (order_ref_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE delivery ADD CONSTRAINT FK_3781EC1021DFC797 FOREIGN KEY (carrier_id) REFERENCES carrier (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993985AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398D7707B45 FOREIGN KEY (order_status_id) REFERENCES order_status (id)');
        $this->addSql('ALTER TABLE order_content ADD CONSTRAINT FK_8BF99E2E238517C FOREIGN KEY (order_ref_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_content ADD CONSTRAINT FK_8BF99E24B70D629 FOREIGN KEY (article_ref_id) REFERENCES article (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article_category DROP FOREIGN KEY FK_53A4EDAA7294869C');
        $this->addSql('ALTER TABLE order_content DROP FOREIGN KEY FK_8BF99E24B70D629');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E662F32EBDE');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6644F5D008');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC1021DFC797');
        $this->addSql('ALTER TABLE article_category DROP FOREIGN KEY FK_53A4EDAA12469DE2');
        $this->addSql('ALTER TABLE delivery DROP FOREIGN KEY FK_3781EC10E238517C');
        $this->addSql('ALTER TABLE order_content DROP FOREIGN KEY FK_8BF99E2E238517C');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398D7707B45');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993985AA1164F');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_category');
        $this->addSql('DROP TABLE article_color');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE carrier');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE delivery');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_content');
        $this->addSql('DROP TABLE order_status');
        $this->addSql('DROP TABLE payment_method');
        $this->addSql('DROP TABLE user');
    }
}
