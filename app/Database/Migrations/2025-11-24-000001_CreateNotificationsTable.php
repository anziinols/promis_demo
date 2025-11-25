<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ucode' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'orgcode' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'title' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'message' => ['type' => 'TEXT', 'null' => true],
            'recipient_type' => ['type' => 'ENUM', 'constraint' => ['all', 'specific'], 'default' => 'all'],
            'recipient_po_id' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'recipient_po_name' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['active', 'inactive'], 'default' => 'active'],
            'is_read' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'priority' => ['type' => 'ENUM', 'constraint' => ['low', 'normal', 'high', 'urgent'], 'default' => 'normal'],
            'create_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'update_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'create_at' => ['type' => 'DATETIME', 'null' => true],
            'update_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('orgcode');
        $this->forge->addKey('recipient_po_id');
        $this->forge->addKey('status');
        $this->forge->createTable('notifications');
    }

    public function down()
    {
        $this->forge->dropTable('notifications');
    }
}

