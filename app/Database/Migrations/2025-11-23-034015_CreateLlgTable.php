<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLlgTable extends Migration
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
            'llgcode' => [
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
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('adx_llg');
    }

    public function down()
    {
        $this->forge->dropTable('adx_llg');
    }
}
