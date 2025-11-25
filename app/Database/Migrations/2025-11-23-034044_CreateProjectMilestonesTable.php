<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProjectMilestonesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ucode' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'procode' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'orgcode' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'milestones' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'checked' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'checked_date' => ['type' => 'DATE', 'null' => true],
            'notes' => ['type' => 'TEXT', 'null' => true],
            'datefrom' => ['type' => 'DATE', 'null' => true],
            'dateto' => ['type' => 'DATE', 'null' => true],
            'phase_id' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'create_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'update_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'create_at' => ['type' => 'DATETIME', 'null' => true],
            'update_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('project_milestones');
    }

    public function down()
    {
        $this->forge->dropTable('project_milestones');
    }
}
