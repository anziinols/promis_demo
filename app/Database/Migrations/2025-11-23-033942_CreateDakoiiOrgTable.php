<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDakoiiOrgTable extends Migration
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
            'orgcode' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'loc_level_locked' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'loc_code_locked' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'loc_name_locked' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'orglogo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'is_locationlocked' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'country_code' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'province_code' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'district_code' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'llg_code' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'country_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'province_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'district_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'llg_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'center_gps_zoom' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'center_gps_longitude' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'center_gps_latitude' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'phones' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'emails' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ],
            'create_by' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'update_by' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'create_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'update_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('dakoii_org');
    }

    public function down()
    {
        $this->forge->dropTable('dakoii_org');
    }
}
