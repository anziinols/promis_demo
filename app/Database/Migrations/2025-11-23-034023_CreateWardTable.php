<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWardTable extends Migration
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
            'wardcode' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'country_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'province_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'district_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'llg_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('adx_ward');
    }

    public function down()
    {
        $this->forge->dropTable('adx_ward');
    }
}
