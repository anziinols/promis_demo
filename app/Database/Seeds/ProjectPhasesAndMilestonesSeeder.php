<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProjectPhasesAndMilestonesSeeder extends Seeder
{
    public function run()
    {
        // Get the 5 seeded projects
        $projects = [
            'pm03PSIP2025-01',
            'pm03DSIP2025-02',
            'pm03PRAP2025-03',
            'pm03PSIP2025-04',
            'pm03GoPNG2025-05',
        ];
        
        $orgcode = '3301';
        
        foreach ($projects as $procode) {
            // Check if project exists
            $project = $this->db->table('projects')->where('procode', $procode)->get()->getRowArray();
            
            if (!$project) {
                echo "Project {$procode} not found, skipping...\n";
                continue;
            }
            
            // Define phases for each project
            $phases = [
                [
                    'name' => 'Planning and Design Phase',
                ],
                [
                    'name' => 'Procurement and Mobilization Phase',
                ],
                [
                    'name' => 'Implementation Phase',
                ],
                [
                    'name' => 'Monitoring and Evaluation Phase',
                ],
            ];
            
            $phaseIds = [];
            
            // Insert phases
            foreach ($phases as $index => $phaseData) {
                $phaseUcode = uniqid() . time() . rand(100, 999);
                
                // Check if phase already exists
                $existingPhase = $this->db->table('project_phases')
                    ->where('procode', $procode)
                    ->where('phases', $phaseData['name'])
                    ->countAllResults();
                
                if ($existingPhase == 0) {
                    $data = [
                        'ucode' => $phaseUcode,
                        'procode' => $procode,
                        'orgcode' => $orgcode,
                        'phases' => $phaseData['name'],
                        'create_by' => 'System Seeder',
                        'create_at' => date('Y-m-d H:i:s'),
                        'update_at' => date('Y-m-d H:i:s'),
                    ];
                    
                    $this->db->table('project_phases')->insert($data);
                    $phaseIds[$index] = $this->db->insertID();
                    echo "Phase '{$phaseData['name']}' added to project {$procode}\n";
                } else {
                    // Get existing phase ID
                    $existingPhaseData = $this->db->table('project_phases')
                        ->where('procode', $procode)
                        ->where('phases', $phaseData['name'])
                        ->get()
                        ->getRowArray();
                    $phaseIds[$index] = $existingPhaseData['id'];
                    echo "Phase '{$phaseData['name']}' already exists for project {$procode}, skipping...\n";
                }
            }
            
            // Define milestones for each phase
            $milestonesData = [
                // Phase 1: Planning and Design
                [
                    'phase_index' => 0,
                    'milestones' => [
                        ['name' => 'Site Assessment and Survey', 'datefrom' => '2025-01-15', 'dateto' => '2025-02-15'],
                        ['name' => 'Engineering Design Completion', 'datefrom' => '2025-02-16', 'dateto' => '2025-03-30'],
                        ['name' => 'Budget and Cost Estimation', 'datefrom' => '2025-03-01', 'dateto' => '2025-03-20'],
                    ],
                ],
                // Phase 2: Procurement and Mobilization
                [
                    'phase_index' => 1,
                    'milestones' => [
                        ['name' => 'Contractor Selection', 'datefrom' => '2025-04-01', 'dateto' => '2025-04-30'],
                        ['name' => 'Contract Signing', 'datefrom' => '2025-05-01', 'dateto' => '2025-05-15'],
                        ['name' => 'Site Mobilization', 'datefrom' => '2025-05-16', 'dateto' => '2025-06-15'],
                    ],
                ],
                // Phase 3: Implementation
                [
                    'phase_index' => 2,
                    'milestones' => [
                        ['name' => 'Foundation Works', 'datefrom' => '2025-06-16', 'dateto' => '2025-08-30'],
                        ['name' => 'Main Construction Works', 'datefrom' => '2025-09-01', 'dateto' => '2025-12-31'],
                        ['name' => 'Finishing and Quality Check', 'datefrom' => '2026-01-01', 'dateto' => '2026-02-28'],
                    ],
                ],
                // Phase 4: Monitoring and Evaluation
                [
                    'phase_index' => 3,
                    'milestones' => [
                        ['name' => 'Project Handover', 'datefrom' => '2026-03-01', 'dateto' => '2026-03-15'],
                        ['name' => 'Final Evaluation Report', 'datefrom' => '2026-03-16', 'dateto' => '2026-03-31'],
                        ['name' => 'Project Closure', 'datefrom' => '2026-04-01', 'dateto' => '2026-04-15'],
                    ],
                ],
            ];
            
            // Insert milestones
            foreach ($milestonesData as $phaseGroup) {
                $phaseIndex = $phaseGroup['phase_index'];
                $phaseId = $phaseIds[$phaseIndex] ?? null;
                
                if (!$phaseId) {
                    continue;
                }
                
                foreach ($phaseGroup['milestones'] as $milestone) {
                    $milestoneUcode = uniqid() . time() . rand(100, 999);
                    
                    // Check if milestone already exists
                    $existingMilestone = $this->db->table('project_milestones')
                        ->where('procode', $procode)
                        ->where('milestones', $milestone['name'])
                        ->where('phase_id', $phaseId)
                        ->countAllResults();
                    
                    if ($existingMilestone == 0) {
                        $data = [
                            'ucode' => $milestoneUcode,
                            'procode' => $procode,
                            'orgcode' => $orgcode,
                            'milestones' => $milestone['name'],
                            'phase_id' => $phaseId,
                            'datefrom' => $milestone['datefrom'],
                            'dateto' => $milestone['dateto'],
                            'checked' => 0,
                            'notes' => '',
                            'create_by' => 'System Seeder',
                            'create_at' => date('Y-m-d H:i:s'),
                            'update_at' => date('Y-m-d H:i:s'),
                        ];
                        
                        $this->db->table('project_milestones')->insert($data);
                        echo "  - Milestone '{$milestone['name']}' added\n";
                    } else {
                        echo "  - Milestone '{$milestone['name']}' already exists, skipping...\n";
                    }
                }
            }
            
            echo "Completed phases and milestones for project {$procode}\n\n";
        }
        
        echo "All phases and milestones seeded successfully!\n";
    }
}

