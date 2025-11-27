<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CentralProvinceContractorsSeeder extends Seeder
{
    public function run()
    {
        $contractors = [
            [
                'concode' => 'CP-CON-001',
                'name' => 'Central Infrastructure Builders Ltd',
                'category' => 'CONST_ENG',
                'services' => "Road Construction\nBridge Building\nCivil Engineering\nProject Management",
                'province' => '03', // Central Province
                'district' => '0301', // Abau
                'phones' => '+675 325 4567, +675 7234 5678',
                'emails' => 'info@cibpng.com, projects@cibpng.com',
                'address' => 'Section 45, Lot 23, Abau Town, Central Province, Papua New Guinea',
                'weblinks' => 'www.cibpng.com',
                'status' => 'active',
            ],
            [
                'concode' => 'CP-CON-002',
                'name' => 'Goilala Construction & Development Co.',
                'category' => 'CONST_ENG',
                'services' => "Building Construction\nWater Supply Systems\nCommunity Infrastructure\nRural Development",
                'province' => '03', // Central Province
                'district' => '0302', // Goilala
                'phones' => '+675 325 7890, +675 7098 7654',
                'emails' => 'contact@goilalaconst.pg, admin@goilalaconst.pg',
                'address' => 'Tapini Station, Goilala District, Central Province, Papua New Guinea',
                'weblinks' => 'www.goilalaconst.pg',
                'status' => 'active',
            ],
            [
                'concode' => 'CP-CON-003',
                'name' => 'Pacific Coast Engineering Services',
                'category' => 'CONST_ENG',
                'services' => "Infrastructure Development\nHealth Facility Construction\nEducation Infrastructure\nMaintenance Services",
                'province' => '03', // Central Province
                'district' => '0303', // Kairuku-Hiri
                'phones' => '+675 325 1122, +675 7345 6789',
                'emails' => 'info@pces.pg, engineering@pces.pg',
                'address' => 'Bereina Town, Kairuku-Hiri District, Central Province, Papua New Guinea',
                'weblinks' => 'www.pces.pg',
                'status' => 'active',
            ],
        ];
        
        foreach ($contractors as $contractorData) {
            // Check if contractor already exists
            $existingContractor = $this->db->table('contractor_details')
                ->where('concode', $contractorData['concode'])
                ->countAllResults();
            
            if ($existingContractor == 0) {
                $ucode = uniqid() . time() . rand(100, 999);
                
                $data = [
                    'ucode' => $ucode,
                    'concode' => $contractorData['concode'],
                    'name' => $contractorData['name'],
                    'category' => $contractorData['category'],
                    'services' => $contractorData['services'],
                    'country' => '1', // Papua New Guinea
                    'province' => $contractorData['province'],
                    'district' => $contractorData['district'],
                    'phones' => $contractorData['phones'],
                    'emails' => $contractorData['emails'],
                    'address' => $contractorData['address'],
                    'weblinks' => $contractorData['weblinks'],
                    'status' => $contractorData['status'],
                    'create_by' => 'System Seeder',
                    'create_org' => '3301',
                    'create_at' => date('Y-m-d H:i:s'),
                    'update_at' => date('Y-m-d H:i:s'),
                ];
                
                $this->db->table('contractor_details')->insert($data);
                echo "Contractor '{$contractorData['name']}' (Code: {$contractorData['concode']}) has been seeded successfully!\n";
            } else {
                echo "Contractor with code '{$contractorData['concode']}' already exists, skipping...\n";
            }
        }
        
        echo "\nTotal: 3 contractors for Central Province seeded successfully!\n";
    }
}

