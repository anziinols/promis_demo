<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProjectsTable extends Migration
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
            'ucode' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'procode' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'orgcode' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'pro_date' => ['type' => 'DATE', 'null' => true],
            'country' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'province' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'district' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'llg' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'pro_site' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'description' => ['type' => 'TEXT', 'null' => true],
            'pro_update_at' => ['type' => 'DATETIME', 'null' => true],
            'pro_update_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'statusnotes' => ['type' => 'TEXT', 'null' => true],
            'status_at' => ['type' => 'DATETIME', 'null' => true],
            'status_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'fund' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'budget' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => true],
            'budget_at' => ['type' => 'DATETIME', 'null' => true],
            'budget_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'payment_total' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => true],
            'payment_at' => ['type' => 'DATETIME', 'null' => true],
            'payment_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'mapping' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'kmlfile' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'gps' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'lat' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'lon' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'gps_at' => ['type' => 'DATETIME', 'null' => true],
            'gps_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'pro_officer_id' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'pro_officer_name' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'pro_officer_scope' => ['type' => 'TEXT', 'null' => true],
            'pro_officer_at' => ['type' => 'DATETIME', 'null' => true],
            'pro_officer_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'contractor_id' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'contractor_code' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'contractor_name' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'contract_file' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'contractor_at' => ['type' => 'DATETIME', 'null' => true],
            'contractor_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'create_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'create_org' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'update_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'create_at' => ['type' => 'DATETIME', 'null' => true],
            'update_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('projects');
    }

    public function down()
    {
        $this->forge->dropTable('projects');
    }
}
