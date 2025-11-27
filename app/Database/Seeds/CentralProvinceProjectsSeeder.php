<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CentralProvinceProjectsSeeder extends Seeder
{
    public function run()
    {
        // Central Province data
        $provinceCode = '03';
        $country = '1'; // Papua New Guinea
        $province = '03'; // Central Province
        
        // Districts in Central Province
        $districts = [
            '0301', // Abau
            '0302', // Goilala
            '0303', // Kairuku-Hiri
            '0304', // Rigo
        ];
        
        // Fund types (you can adjust these based on your selection model)
        $fundTypes = ['PSIP', 'DSIP', 'LLG', 'PRAP', 'GoPNG'];
        
        // Sample project data
        $projects = [
            [
                'name' => 'Central Province Road Rehabilitation Project',
                'description' => 'Rehabilitation and upgrading of main roads connecting major towns in Central Province to improve accessibility and promote economic development.',
                'district' => '0301', // Abau
                'budget' => 250000.00,
                'fund' => 'PSIP',
            ],
            [
                'name' => 'Goilala District Water Supply Infrastructure',
                'description' => 'Construction of water supply systems and installation of water tanks in rural communities to provide clean and safe drinking water.',
                'district' => '0302', // Goilala
                'budget' => 180000.00,
                'fund' => 'DSIP',
            ],
            [
                'name' => 'Kairuku-Hiri Health Facility Upgrade',
                'description' => 'Renovation and expansion of health centers including equipment procurement to improve healthcare services delivery in the district.',
                'district' => '0303', // Kairuku-Hiri
                'budget' => 320000.00,
                'fund' => 'PRAP',
            ],
            [
                'name' => 'Rigo District Education Infrastructure Development',
                'description' => 'Construction of new classrooms and teacher housing facilities to support quality education delivery in rural schools.',
                'district' => '0304', // Rigo
                'budget' => 275000.00,
                'fund' => 'PSIP',
            ],
            [
                'name' => 'Central Province Bridge Construction Project',
                'description' => 'Construction of concrete bridges to replace aging timber bridges and improve transportation connectivity across rivers.',
                'district' => '0301', // Abau
                'budget' => 450000.00,
                'fund' => 'GoPNG',
            ],
        ];
        
        $currentYear = date('Y');
        
        foreach ($projects as $index => $projectData) {
            // Generate unique code based on fund and year (similar to controller logic)
            $ydate = $projectData['fund'] . $currentYear;
            $prov = $projectData['district'];
            
            // Generate project code - format: pm{prov}{fund}{year}-{number}
            $procode = 'pm' . $province . $ydate . '-' . sprintf('%02d', $index + 1);
            
            // Generate unique ucode
            $ucode = uniqid() . time() . $index;
            
            // Check if project already exists
            $existingProject = $this->db->table('projects')
                ->where('procode', $procode)
                ->countAllResults();
            
            if ($existingProject == 0) {
                $data = [
                    'ucode' => $ucode,
                    'procode' => $procode,
                    'orgcode' => '3301', // Central Province org code
                    'name' => $projectData['name'],
                    'description' => $projectData['description'],
                    'budget' => $projectData['budget'],
                    'fund' => $projectData['fund'],
                    'country' => $country,
                    'province' => $province,
                    'district' => $projectData['district'],
                    'status' => 'active',
                    'create_by' => 'System Seeder',
                    'create_at' => date('Y-m-d H:i:s'),
                    'update_at' => date('Y-m-d H:i:s'),
                ];
                
                $this->db->table('projects')->insert($data);
                echo "Project '{$projectData['name']}' (Code: {$procode}) has been seeded successfully!\n";
            } else {
                echo "Project with code '{$procode}' already exists, skipping...\n";
            }
        }
        
        echo "\nTotal: 5 dummy projects for Central Province seeded successfully!\n";
    }
}

