<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSelectionTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'box' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'value' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'item' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('selection');
    }

    public function down()
    {
        $this->forge->dropTable('selection');
    }
}
