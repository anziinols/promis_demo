<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CentralProvinceSeeder extends Seeder
{
    public function run()
    {
        // ===============================================
        // PROVINCE DATA
        // ===============================================
        
        // Check if Central Province already exists
        $provinceExists = $this->db->table('adx_province')
            ->where('id', 86)
            ->countAllResults();

        if ($provinceExists == 0) {
            // Insert Central Province
            $provinceData = [
                'id' => 86,
                'provincecode' => '03',
                'name' => 'Central Province',
                'country_id' => 1
            ];
            $this->db->table('adx_province')->insert($provinceData);
            echo "Central Province has been seeded successfully!\n";
        } else {
            echo "Central Province already exists, skipping...\n";
        }

        // ===============================================
        // DISTRICT DATA FOR CENTRAL PROVINCE
        // ===============================================
        
        $districts = [
            [
                'id' => 1,
                'districtcode' => '0301',
                'name' => 'Abau',
                'country_id' => 1,
                'province_id' => 86
            ],
            [
                'id' => 2,
                'districtcode' => '0302',
                'name' => 'Goilala',
                'country_id' => 1,
                'province_id' => 86
            ],
            [
                'id' => 3,
                'districtcode' => '0303',
                'name' => 'Kairuku-Hiri',
                'country_id' => 1,
                'province_id' => 86
            ],
            [
                'id' => 4,
                'districtcode' => '0304',
                'name' => 'Rigo',
                'country_id' => 1,
                'province_id' => 86
            ]
        ];

        foreach ($districts as $district) {
            $districtExists = $this->db->table('adx_district')
                ->where('id', $district['id'])
                ->countAllResults();

            if ($districtExists == 0) {
                $this->db->table('adx_district')->insert($district);
                echo "District '{$district['name']}' has been seeded successfully!\n";
            } else {
                echo "District '{$district['name']}' already exists, skipping...\n";
            }
        }

        // ===============================================
        // LLG (COUNTY) DATA FOR CENTRAL PROVINCE
        // ===============================================
        
        $llgs = [
            // ABAU DISTRICT LLGs
            [
                'id' => 1,
                'llgcode' => 'PG030101',
                'name' => 'Abau Urban',
                'country_id' => 1,
                'province_id' => 86,
                'district_id' => 1
            ],
            [
                'id' => 2,
                'llgcode' => 'PG030102',
                'name' => 'Amazon Bay Rural',
                'country_id' => 1,
                'province_id' => 86,
                'district_id' => 1
            ],
            [
                'id' => 3,
                'llgcode' => 'PG030103',
                'name' => 'Aroma Rural',
                'country_id' => 1,
                'province_id' => 86,
                'district_id' => 1
            ],
            [
                'id' => 4,
                'llgcode' => 'PG030104',
                'name' => 'Cloudy Bay Rural',
                'country_id' => 1,
                'province_id' => 86,
                'district_id' => 1
            ],
            
            // GOILALA DISTRICT LLGs
            [
                'id' => 5,
                'llgcode' => 'PG030201',
                'name' => 'Guari Rural',
                'country_id' => 1,
                'province_id' => 86,
                'district_id' => 2
            ],
            [
                'id' => 6,
                'llgcode' => 'PG030202',
                'name' => 'Tapini Rural',
                'country_id' => 1,
                'province_id' => 86,
                'district_id' => 2
            ],
            [
                'id' => 7,
                'llgcode' => 'PG030203',
                'name' => 'Woitape Rural',
                'country_id' => 1,
                'province_id' => 86,
                'district_id' => 2
            ],
            
            // KAIRUKU-HIRI DISTRICT LLGs
            [
                'id' => 8,
                'llgcode' => 'PG030301',
                'name' => 'Hiri Rural',
                'country_id' => 1,
                'province_id' => 86,
                'district_id' => 3
            ],
            [
                'id' => 9,
                'llgcode' => 'PG030302',
                'name' => 'Koiari Rural',
                'country_id' => 1,
                'province_id' => 86,
                'district_id' => 3
            ],
            [
                'id' => 10,
                'llgcode' => 'PG030303',
                'name' => 'Koita Rural',
                'country_id' => 1,
                'province_id' => 86,
                'district_id' => 3
            ],
            [
                'id' => 11,
                'llgcode' => 'PG030304',
                'name' => 'Mekeo Kuni Rural',
                'country_id' => 1,
                'province_id' => 86,
                'district_id' => 3
            ],
            [
                'id' => 12,
                'llgcode' => 'PG030305',
                'name' => 'Roro Rural',
                'country_id' => 1,
                'province_id' => 86,
                'district_id' => 3
            ],
            
            // RIGO DISTRICT LLGs
            [
                'id' => 13,
                'llgcode' => 'PG030401',
                'name' => 'Rigo Rural',
                'country_id' => 1,
                'province_id' => 86,
                'district_id' => 4
            ],
            [
                'id' => 14,
                'llgcode' => 'PG030402',
                'name' => 'Yule Island Rural',
                'country_id' => 1,
                'province_id' => 86,
                'district_id' => 4
            ]
        ];

        foreach ($llgs as $llg) {
            $llgExists = $this->db->table('adx_llg')
                ->where('id', $llg['id'])
                ->countAllResults();

            if ($llgExists == 0) {
                $this->db->table('adx_llg')->insert($llg);
                echo "LLG '{$llg['name']}' has been seeded successfully!\n";
            } else {
                echo "LLG '{$llg['name']}' already exists, skipping...\n";
            }
        }

        echo "\n==============================================\n";
        echo "Central Province seeding completed!\n";
        echo "==============================================\n";
        echo "Summary:\n";
        echo "- Province: Central Province (ID: 86)\n";
        echo "- Districts: 4 (Abau, Goilala, Kairuku-Hiri, Rigo)\n";
        echo "- LLGs (Counties): 14 Local Level Governments\n";
        echo "==============================================\n";
    }
}

