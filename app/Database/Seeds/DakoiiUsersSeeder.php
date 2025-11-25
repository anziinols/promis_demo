<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DakoiiUsersSeeder extends Seeder
{
    public function run()
    {
        // Hash the password using password_hash with PASSWORD_DEFAULT
        $hashedPassword = password_hash('dakoii', PASSWORD_DEFAULT);

        $data = [
            'name'       => 'Free Kenny',
            'username'   => 'fkenny',
            'password'   => $hashedPassword,
            'orgcode'    => '',
            'role'       => 'admin',
            'is_active'  => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Insert the data into dakoii_users table
        $this->db->table('dakoii_users')->insert($data);

        echo "User 'fkenny' has been seeded successfully!\n";
    }
}

