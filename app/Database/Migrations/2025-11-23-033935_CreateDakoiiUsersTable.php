<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDakoiiUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'orgcode' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
            ],
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'moderator', 'user'],
                'default' => 'user',
            ],
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        
        // Execute raw SQL to set default values for timestamps
        $sql = "CREATE TABLE `dakoii_users` (
            `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `username` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `orgcode` VARCHAR(500) NOT NULL,
            `role` ENUM('admin','moderator','user') NOT NULL DEFAULT 'user',
            `is_active` TINYINT(1) NOT NULL DEFAULT 0,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci";
        
        $this->db->query($sql);
    }

    public function down()
    {
        $this->forge->dropTable('dakoii_users');
    }
}
