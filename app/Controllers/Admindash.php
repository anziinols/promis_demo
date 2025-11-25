<?php

namespace App\Controllers;

use App\Models\countryModel;
use App\Models\districtModel;
use App\Models\eventfilesModel;
use App\Models\eventsModel;
use App\Models\kmlfilesModel;
use App\Models\llgModel;
use App\Models\orgModel;
use App\Models\prodocsModel;
use App\Models\proeventsModel;
use App\Models\profundModel;
use App\Models\project_officersModel;
use App\Models\projectsModel;
use App\Models\promilefilesModel;
use App\Models\promilestonesModel;
use App\Models\prophasesModel;
use App\Models\provinceModel;
use App\Models\usersModel;

class Admindash extends BaseController
{
    public $session;
    public $usersModel;
    public $pro_officersModel;
    public $projectsModel;
    public $prophasesModel;
    public $promilestonesModel;
    public $promilefilesModel;
    public $countryModel;
    public $provinceModel;
    public $districtModel;
    public $llgModel;
    public $prodocsModel;
    public $profundModel;
    public $proeventsModel;
    public $proeventFilesModel;
    public $orgModel;
    public $kmlfilesModel;

    public function __construct()
    {
        helper(['form', 'url', 'info']);
        $this->session = session();

        $this->usersModel = new usersModel();
        $this->pro_officersModel = new project_officersModel();
        $this->projectsModel = new projectsModel();
        $this->prophasesModel = new prophasesModel();
        $this->promilestonesModel = new promilestonesModel();
        $this->promilefilesModel = new promilefilesModel();
        $this->countryModel = new countryModel();
        $this->provinceModel = new provinceModel();
        $this->districtModel = new districtModel();
        $this->llgModel = new llgModel();
        $this->prodocsModel = new prodocsModel();
        $this->profundModel = new profundModel();
        $this->proeventsModel = new proeventsModel();
        $this->proeventFilesModel = new eventfilesModel();
        $this->orgModel = new orgModel();
        $this->kmlfilesModel = new kmlfilesModel();
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['menu'] = "dashboard";

        $data['org'] = $this->orgModel->where('orgcode', session('orgcode'))->first();
        
        // Set default GPS coordinates if not available (Papua New Guinea center)
        if (empty($data['org'])) {
            $data['org'] = [
                'orgcode' => session('orgcode'),
                'center_gps_latitude' => '-6.314993',
                'center_gps_longitude' => '143.95555',
                'center_gps_zoom' => 6
            ];
        } else {
            // Ensure GPS values are not null
            if (empty($data['org']['center_gps_latitude'])) {
                $data['org']['center_gps_latitude'] = '-6.314993';
            }
            if (empty($data['org']['center_gps_longitude'])) {
                $data['org']['center_gps_longitude'] = '143.95555';
            }
            if (empty($data['org']['center_gps_zoom'])) {
                $data['org']['center_gps_zoom'] = 6;
            }
        }
        
        $data['projects'] = $this->projectsModel->where('orgcode', session('orgcode'))->find();
        $data['payments'] = $this->profundModel->where('orgcode', session('orgcode'))->find();
        $data['milestones'] = $this->promilestonesModel->where('orgcode', session('orgcode'))->find();

        $data['pro_active'] = $this->projectsModel->where('orgcode', session('orgcode'))->where('status', 'active')->find();
        $data['pro_completed'] = $this->projectsModel->where('orgcode', session('orgcode'))->where('status', 'completed')->find();
        $data['pro_hold'] = $this->projectsModel->where('orgcode', session('orgcode'))->where('status', 'hold')->find();
        $data['pro_canceled'] = $this->projectsModel->where('orgcode', session('orgcode'))->where('status', 'canceled')->find();


        //calculations
        $data['pro_total_overpaid'] = $data['pro_total_outstanding'] = $data['pro_total_budget'] = $data['pro_total_paid'] = 0;
        $data['pro_ms_pending'] = $data['pro_ms_completed'] = $data['pro_ms_hold'] = $data['pro_ms_canceled'] = $data['pro_payments'] = 0;


        $projectsID = array();
        foreach ($data['projects'] as $pro) {
            $projectsID[] = $pro['procode'];
        }

        //paymenents
        if (!empty($projectsID)) {
            $data['payments'] = $this->profundModel
                ->whereIn('procode', $projectsID)
                ->where('orgcode', session('orgcode'))->find();
        } else {
            $data['payments'] = array();
        }

        //milestones
        if (!empty($projectsID)) {
            $data['milestones'] = $this->promilestonesModel
                ->whereIn('procode', $projectsID)
                ->where('orgcode', session('orgcode'))->find();
        } else {
            $data['milestones'] = array();
        }

        //payments totals
        foreach ($data['projects'] as $pay) {
            $data['pro_total_budget'] += checkZero($pay['budget']);
            $data['pro_total_paid'] += checkZero($pay['payment_total']);
            $data['pro_total_outstanding'] += checkZero($pay['budget']) - checkZero($pay['payment_total']);
            if (checkZero($pay['payment_total']) > checkZero($pay['budget'])) {
                $data['pro_total_overpaid'] += checkZero($pay['payment_total']) - checkZero($pay['budget']);
            }
        }

        //milestones totals
        foreach ($data['milestones'] as $ms) {
            $status = strtolower(trim($ms['checked'] ?? 'pending'));
            // Default empty status to pending
            if (empty($status)) {
                $status = 'pending';
            }

            switch ($status) {
                case 'pending':
                    $data['pro_ms_pending'] += 1;
                    break;
                case 'completed':
                    $data['pro_ms_completed'] += 1;
                    break;
                case 'hold':
                    $data['pro_ms_hold'] += 1;
                    break;
                case 'canceled':
                    $data['pro_ms_canceled'] += 1;
                    break;
                default:
                    // Any unknown status defaults to pending
                    $data['pro_ms_pending'] += 1;
                    break;
            }
        }

        //payment trends
        $data['paydates'] = array();
        foreach ($data['payments'] as $pay) {
            $dateString = $pay['paymentdate'];
            $month = date("m", strtotime($dateString));
            $data['paydates'][] = $month; // Output: 03

        }
        //print_r($data['paydates']);
        $data['paydates'] = array_count_values($data['paydates']);

        echo view('admindash/dashboard', $data);
    }


    public function my_account()
    {
        $data['title'] = "My Account";
        $data['menu'] = "my_account";

        // Fetch organization account info
        $data['myacc'] = $this->orgModel->where('orgcode', session('orgcode'))->first();
        
        // Get all countries for dropdown
        $data['countries'] = $this->countryModel->orderBy('name', 'asc')->findAll();
        
        // Get all provinces
        $data['get_provinces'] = $this->provinceModel->orderBy('name', 'asc')->find();
        
        // Fetch admins
        $data['admins'] = [];
        if ($data['myacc']) {
            $data['admins'] = $this->usersModel->where('orgcode', $data['myacc']['orgcode'])->find();
        }

        // Safely retrieve location data
        $data['set_country'] = null;
        $data['get_province'] = null;
        $data['get_district'] = null;
        $data['get_llg'] = null;
        
        if ($data['myacc']) {
            // Get country
            if (!empty($data['myacc']['country_code'])) {
                $data['set_country'] = $this->countryModel->where('code', $data['myacc']['country_code'])->first();
            }
            // Get province
            if (!empty($data['myacc']['province_code'])) {
                $data['get_province'] = $this->provinceModel->where('provincecode', $data['myacc']['province_code'])->first();
            }
            // Get district
            if (!empty($data['myacc']['district_code'])) {
                $data['get_district'] = $this->districtModel->where('districtcode', $data['myacc']['district_code'])->first();
            }
            // Get LLG
            if (!empty($data['myacc']['llg_code'])) {
                $data['get_llg'] = $this->llgModel->where('llgcode', $data['myacc']['llg_code'])->first();
            }
        }

        echo view('admindash/my_account', $data);
    }

    public function update_admin_orglogo()
    {
        $id = $this->request->getPost('id');
        $concode = $this->request->getPost('concode');

        // doc file
        $docfile = $this->request->getFile('logo_file');

        if ($docfile && $docfile->isValid()) {

            // Generate a custom name for the file
            $newName = 'org_logo' . $concode . "_" . time() . "." . $docfile->getExtension();
            // Move uploaded file to the public/uploads directory
            $docfile->move(ROOTPATH . 'public/uploads/org_files/', $newName);
            // Save file path to database
            $data = [

                'orglogo' => 'public/uploads/org_files/' . $newName,
                'update_by' => session('name'),
            ];
            $this->orgModel->update($id, $data);
        }

        return redirect()->back()->with('success', 'Logo Updated!');
    }


    public function update_admin_orginfo()
    {
        $id = $this->request->getPost('id');

        $get_country = $this->countryModel->where('code', $this->request->getPost('country'))->first();
        $get_province = $this->provinceModel->where('provincecode', $this->request->getPost('province'))->first();
        $get_district = $this->districtModel->where('districtcode', $this->request->getPost('district'))->first();
        $get_llg = $this->llgModel->where('llgcode', $this->request->getPost('llg'))->first();

        $data = [

            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'country_code' => $this->request->getPost('country'),
            'province_code' => $this->request->getPost('province'),
            'district_code' => $this->request->getPost('district'),
            'llg_code' => $this->request->getPost('llg'),
            'country_name' => $get_country['name'],
            'province_name' => $get_province['name'],
            'district_name' => $get_district['name'],
            'llg_name' => $get_llg['name'],
            'update_by' => session('name'),
        ];
        $this->orgModel->update($id, $data);

        return redirect()->back()->with('success', 'Logo Updated!');
    }


    public function reports_dashboard()
    {
        $data['title'] = "Reports Dashboard";
        $data['menu'] = "reports_dashboard";

        $orgcode = session('orgcode');

        // Get organization info
        $org = $this->orgModel
            ->select('orgcode, center_gps_latitude, center_gps_longitude, center_gps_zoom')
            ->where('orgcode', $orgcode)
            ->first();

        // Set default GPS coordinates (Papua New Guinea center)
        $data['org'] = [
            'orgcode' => $orgcode,
            'center_gps_latitude' => $org['center_gps_latitude'] ?? '-6.314993',
            'center_gps_longitude' => $org['center_gps_longitude'] ?? '143.95555',
            'center_gps_zoom' => $org['center_gps_zoom'] ?? 6
        ];

        // Get all projects for this organization
        $data['projects'] = $this->projectsModel
            ->select('procode, name, fund, budget, payment_total, status, country, province, district, llg, lat, lon, gps, kmlfile')
            ->where('orgcode', $orgcode)
            ->orderBy('name', 'asc')
            ->findAll();

        // Initialize statistics
        $data['pro_total_budget'] = 0;
        $data['pro_total_paid'] = 0;
        $data['pro_total_outstanding'] = 0;
        $data['pro_total_overpaid'] = 0;

        // Initialize status counts
        $data['status_counts'] = [
            'active' => 0,
            'completed' => 0,
            'hold' => 0,
            'canceled' => 0,
            'total' => 0
        ];

        // Initialize milestone statistics
        $data['ms_total'] = 0;
        $data['ms_pending'] = 0;
        $data['ms_completed'] = 0;
        $data['ms_hold'] = 0;
        $data['ms_canceled'] = 0;

        // Initialize phase statistics
        $data['ph_total'] = 0;
        $data['ph_completed'] = 0;

        // Get project codes for related data
        $projectCodes = array_column($data['projects'], 'procode');

        if (!empty($projectCodes)) {
            // Calculate financial totals and status counts in a single pass
            foreach ($data['projects'] as $pro) {
                $budget = checkZero($pro['budget']);
                $paid = checkZero($pro['payment_total']);

                $data['pro_total_budget'] += $budget;
                $data['pro_total_paid'] += $paid;

                // Calculate outstanding and overpaid
                $outstanding = $budget - $paid;
                if ($outstanding > 0) {
                    $data['pro_total_outstanding'] += $outstanding;
                } else if ($outstanding < 0) {
                    $data['pro_total_overpaid'] += abs($outstanding);
                }

                // Count projects by status
                $status = strtolower($pro['status'] ?? '');
                if (isset($data['status_counts'][$status])) {
                    $data['status_counts'][$status]++;
                }
                $data['status_counts']['total']++;
            }

            // Get payments
            $data['payments'] = $this->profundModel
                ->select('procode, amount, paymentdate')
                ->whereIn('procode', $projectCodes)
                ->findAll();

            // Get milestones with status and phase_id
            $data['milestones'] = $this->promilestonesModel
                ->select('procode, checked, phase_id')
                ->whereIn('procode', $projectCodes)
                ->findAll();

            // Calculate milestone statistics
            $totalMilestonesInPhases = 0;
            $completedMilestonesInPhases = 0;

            foreach ($data['milestones'] as $ms) {
                $data['ms_total']++;
                // Use status field if available, otherwise fall back to checked field
                $status = strtolower(trim($ms['status'] ?? $ms['checked'] ?? 'pending'));
                // Default empty status to pending
                if (empty($status)) {
                    $status = 'pending';
                }

                switch ($status) {
                    case 'completed':
                        $data['ms_completed']++;
                        break;
                    case 'hold':
                        $data['ms_hold']++;
                        break;
                    case 'canceled':
                        $data['ms_canceled']++;
                        break;
                    case 'pending':
                    default:
                        // Any unknown status defaults to pending
                        $data['ms_pending']++;
                        break;
                }

                // Count milestones that belong to phases
                if (!empty($ms['phase_id'])) {
                    $totalMilestonesInPhases++;
                    if ($status === 'completed') {
                        $completedMilestonesInPhases++;
                    }
                }
            }

            // Get phases
            $data['phases'] = $this->prophasesModel
                ->select('id, procode, phases')
                ->whereIn('procode', $projectCodes)
                ->findAll();

            // Calculate phase completion percentage based on milestones
            $data['ph_total'] = count($data['phases']);

            // Calculate phase completion percentage
            if ($totalMilestonesInPhases > 0) {
                $data['ph_completion_percentage'] = round(($completedMilestonesInPhases / $totalMilestonesInPhases) * 100, 1);
            } else {
                $data['ph_completion_percentage'] = 0;
            }

            $data['ph_total_milestones'] = $totalMilestonesInPhases;
            $data['ph_completed_milestones'] = $completedMilestonesInPhases;

            // Get KML files for all projects
            $data['kmlfiles'] = $this->kmlfilesModel
                ->select('procode, filepath, create_at, create_by')
                ->whereIn('procode', $projectCodes)
                ->findAll();

            // Get unique location codes
            $countryCodes = array_filter(array_unique(array_column($data['projects'], 'country')));
            $provinceCodes = array_filter(array_unique(array_column($data['projects'], 'province')));
            $districtCodes = array_filter(array_unique(array_column($data['projects'], 'district')));
            $llgCodes = array_filter(array_unique(array_column($data['projects'], 'llg')));

            // Get location data
            $data['country'] = !empty($countryCodes)
                ? $this->countryModel->select('code, name')->whereIn('code', $countryCodes)->findAll()
                : [];

            $data['province'] = !empty($provinceCodes)
                ? $this->provinceModel->select('provincecode, name')->whereIn('provincecode', $provinceCodes)->orderBy('name', 'asc')->findAll()
                : [];

            $data['district'] = !empty($districtCodes)
                ? $this->districtModel->select('districtcode, name')->whereIn('districtcode', $districtCodes)->orderBy('name', 'asc')->findAll()
                : [];

            $data['llg'] = !empty($llgCodes)
                ? $this->llgModel->select('llgcode, name')->whereIn('llgcode', $llgCodes)->orderBy('name', 'asc')->findAll()
                : [];
        } else {
            // No projects found
            $data['payments'] = [];
            $data['milestones'] = [];
            $data['phases'] = [];
            $data['country'] = [];
            $data['province'] = [];
            $data['district'] = [];
            $data['llg'] = [];
        }

        return view('admindash/reports_dashboard', $data);
    }

    // CSRF token refresh for AJAX calls
    public function get_csrf_token()
    {
        return $this->response->setJSON([
            'csrf_token_name' => csrf_token(),
            'csrf_token_value' => csrf_hash()
        ]);
    }

    // AJAX method to get address data (districts and LLGs)
    public function getaddress()
    {
        $province_code = $this->request->getPost('province_code');
        $district_code = $this->request->getPost('district_code');
        
        $data = [];
        
        // If province code is provided, get districts
        if (!empty($province_code)) {
            $province = $this->provinceModel->where('provincecode', $province_code)->first();
            if ($province) {
                $data['district'] = $this->districtModel->where('province_id', $province['id'])->findAll();
            }
        }
        
        // If district code is provided, get LLGs
        if (!empty($district_code)) {
            $district = $this->districtModel->where('districtcode', $district_code)->first();
            if ($district) {
                $data['llgs'] = $this->llgModel->where('district_id', $district['id'])->findAll();
            }
        }
        
        return $this->response->setJSON($data);
    }

    // AJAX method to get provinces by country code
    public function get_provinces_by_country()
    {
        $country_code = $this->request->getPost('country_code');

        $data = [];

        if (!empty($country_code)) {
            $country = $this->countryModel->where('code', $country_code)->first();
            if ($country) {
                $data['provinces'] = $this->provinceModel->where('country_id', $country['id'])->orderBy('name', 'asc')->findAll();
            }
        }

        return $this->response->setJSON($data);
    }
}
