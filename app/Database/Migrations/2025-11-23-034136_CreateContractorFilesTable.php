<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContractorFilesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ucode' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'concode' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_name' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_number' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'issued_date' => ['type' => 'DATE', 'null' => true],
            'expiry_date' => ['type' => 'DATE', 'null' => true],
            'file_path' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'create_at' => ['type' => 'DATETIME', 'null' => true],
            'create_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'update_at' => ['type' => 'DATETIME', 'null' => true],
            'update_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'create_org' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'update_org' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'statusnotes' => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('contractor_files');
    }

    public function down()
    {
        $this->forge->dropTable('contractor_files');
    }
}
