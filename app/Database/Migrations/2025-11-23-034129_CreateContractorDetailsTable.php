<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContractorDetailsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ucode' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'concode' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'con_logo' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'category' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'services' => ['type' => 'TEXT', 'null' => true],
            'ipanumber' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'ipadate' => ['type' => 'DATE', 'null' => true],
            'ipafile' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'ircnumber' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'ircfile' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'cocnumber' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'cocfile' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'profiledate' => ['type' => 'DATE', 'null' => true],
            'file_profile' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'country' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'province' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'district' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'llg' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'phones' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'emails' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'address' => ['type' => 'TEXT', 'null' => true],
            'weblinks' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'statusnotes' => ['type' => 'TEXT', 'null' => true],
            'gps' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'lat' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'lon' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'create_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'create_org' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'update_by' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'update_org' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'notice_flag' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'create_at' => ['type' => 'DATETIME', 'null' => true],
            'update_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('contractor_details');
    }

    public function down()
    {
        $this->forge->dropTable('contractor_details');
    }
}
