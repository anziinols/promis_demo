<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProjectMilefilesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ucode' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'procode' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'orgcode' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'milestones_id' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'milestones_ucode' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'filepath' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'caption' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'phase_id' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'create_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'update_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'create_at' => ['type' => 'DATETIME', 'null' => true],
            'update_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('project_milefiles');
    }

    public function down()
    {
        $this->forge->dropTable('project_milefiles');
    }
}
