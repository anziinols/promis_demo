<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ContractorCategoriesSeeder extends Seeder
{
    public function run()
    {
        // First, delete existing contractor categories to avoid duplicates
        $this->db->table('selection')->where('box', 'con_cat')->delete();

        // Define contractor categories
        $categories = [
            [
                'box'   => 'con_cat',
                'value' => 'building_construction',
                'item'  => 'Building Construction'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'road_construction',
                'item'  => 'Road Construction'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'bridge_construction',
                'item'  => 'Bridge Construction'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'electrical_works',
                'item'  => 'Electrical Works'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'plumbing_works',
                'item'  => 'Plumbing Works'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'mechanical_works',
                'item'  => 'Mechanical Works'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'civil_engineering',
                'item'  => 'Civil Engineering'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'landscaping',
                'item'  => 'Landscaping & Gardening'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'painting_decorating',
                'item'  => 'Painting & Decorating'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'roofing',
                'item'  => 'Roofing Works'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'waterworks',
                'item'  => 'Water Supply & Drainage'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'demolition',
                'item'  => 'Demolition Works'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'surveying',
                'item'  => 'Surveying Services'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'architectural',
                'item'  => 'Architectural Services'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'project_management',
                'item'  => 'Project Management'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'heavy_equipment',
                'item'  => 'Heavy Equipment Services'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'steel_fabrication',
                'item'  => 'Steel Fabrication'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'concrete_works',
                'item'  => 'Concrete Works'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'excavation',
                'item'  => 'Excavation & Earthworks'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'piling',
                'item'  => 'Piling Works'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'carpentry',
                'item'  => 'Carpentry & Joinery'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'masonry',
                'item'  => 'Masonry Works'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'hvac',
                'item'  => 'HVAC (Heating, Ventilation & Air Conditioning)'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'fire_protection',
                'item'  => 'Fire Protection Systems'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'telecommunications',
                'item'  => 'Telecommunications & IT Infrastructure'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'security_systems',
                'item'  => 'Security Systems'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'environmental',
                'item'  => 'Environmental Services'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'waste_management',
                'item'  => 'Waste Management'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'marine_works',
                'item'  => 'Marine & Coastal Works'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'airport_construction',
                'item'  => 'Airport Construction'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'renewable_energy',
                'item'  => 'Renewable Energy Projects'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'maintenance',
                'item'  => 'Maintenance & Repair Services'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'consultancy',
                'item'  => 'Engineering Consultancy'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'general_contractor',
                'item'  => 'General Contractor (Multi-Discipline)'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'specialist',
                'item'  => 'Specialist Contractor'
            ],
            [
                'box'   => 'con_cat',
                'value' => 'other',
                'item'  => 'Other Services'
            ]
        ];

        // Insert categories into the database
        foreach ($categories as $category) {
            $this->db->table('selection')->insert($category);
        }

        echo "Contractor categories have been seeded successfully!\n";
        echo "Total categories added: " . count($categories) . "\n";
    }
}

