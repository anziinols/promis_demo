<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UpdateProjectOrgCodeSeeder extends Seeder
{
    public function run()
    {
        // Update orgcode for the 5 dummy projects
        $projects = [
            'pm03PSIP2025-01',
            'pm03DSIP2025-02',
            'pm03PRAP2025-03',
            'pm03PSIP2025-04',
            'pm03GoPNG2025-05',
        ];
        
        $newOrgCode = '3301';
        
        foreach ($projects as $procode) {
            $result = $this->db->table('projects')
                ->where('procode', $procode)
                ->update(['orgcode' => $newOrgCode]);
            
            if ($result) {
                echo "Updated project {$procode} with orgcode: {$newOrgCode}\n";
            } else {
                echo "Project {$procode} not found or already updated\n";
            }
        }
        
        // Also update phases
        foreach ($projects as $procode) {
            $this->db->table('project_phases')
                ->where('procode', $procode)
                ->update(['orgcode' => $newOrgCode]);
            echo "Updated phases for project {$procode}\n";
        }
        
        // Also update milestones
        foreach ($projects as $procode) {
            $this->db->table('project_milestones')
                ->where('procode', $procode)
                ->update(['orgcode' => $newOrgCode]);
            echo "Updated milestones for project {$procode}\n";
        }
        
        // Update contractors orgcode
        $this->db->table('contractor_details')
            ->where('create_org', 'CP001')
            ->update(['create_org' => $newOrgCode]);
        echo "\nUpdated contractors orgcode to {$newOrgCode}\n";
        
        echo "\nAll orgcodes updated successfully to {$newOrgCode}!\n";
    }
}

