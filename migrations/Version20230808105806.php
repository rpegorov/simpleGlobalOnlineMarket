<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230808105806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE refresh_tokens_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE accessories (uuid UUID NOT NULL, date_created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_deleted TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(uuid))');
        $this->addSql('COMMENT ON COLUMN accessories.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE coupons (uuid UUID NOT NULL, code VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, PRIMARY KEY(uuid))');
        $this->addSql('COMMENT ON COLUMN coupons.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE headphones (uuid UUID NOT NULL, date_created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_deleted TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(uuid))');
        $this->addSql('COMMENT ON COLUMN headphones.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE phones (uuid UUID NOT NULL, date_created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_deleted TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(uuid))');
        $this->addSql('COMMENT ON COLUMN phones.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE product_structure (uuid UUID NOT NULL, lvl INT DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, date_created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_deleted TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(uuid))');
        $this->addSql('COMMENT ON COLUMN product_structure.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE refresh_tokens (id INT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9BACE7E1C74F2195 ON refresh_tokens (refresh_token)');
        $this->addSql('CREATE TABLE tax_rate (uuid UUID NOT NULL, country_name VARCHAR(255) NOT NULL, tax_rate INT NOT NULL, date_created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_deleted TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(uuid))');
        $this->addSql('COMMENT ON COLUMN tax_rate.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "user" (uuid UUID NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, date_created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_deleted TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(uuid))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('COMMENT ON COLUMN "user".uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE refresh_tokens_id_seq CASCADE');
        $this->addSql('DROP TABLE accessories');
        $this->addSql('DROP TABLE coupons');
        $this->addSql('DROP TABLE headphones');
        $this->addSql('DROP TABLE phones');
        $this->addSql('DROP TABLE product_structure');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP TABLE tax_rate');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
