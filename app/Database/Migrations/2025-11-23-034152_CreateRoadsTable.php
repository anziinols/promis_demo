<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoadsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'roaducode' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'roadcode' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'description' => ['type' => 'TEXT', 'null' => true],
            'country' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'province' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'district' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'length' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'llg' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'ward' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'num_lanes' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'class' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'surface_type' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('roads');
    }

    public function down()
    {
        $this->forge->dropTable('roads');
    }
}
