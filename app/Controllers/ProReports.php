<?php

namespace App\Controllers;

use App\Models\contractorsModel;
use App\Models\contractorsNoticesModel;
use App\Models\countryModel;
use App\Models\districtModel;
use App\Models\eventfilesModel;
use App\Models\kmlfilesModel;
use App\Models\llgModel;
use App\Models\prodocsModel;
use App\Models\proeventsModel;
use App\Models\profundModel;
use App\Models\project_officersModel;
use App\Models\projectsModel;
use App\Models\promilestonesModel;
use App\Models\prophasesModel;
use App\Models\provinceModel;
use App\Models\selectionModel;
use App\Models\settingsModel;
use App\Models\usersModel;


class ProReports extends BaseController
{
    public $session;
    public $usersModel;

    public $countryModel;
    public $provinceModel;
    public $districtModel;
    public $llgModel;
    public $settingsModel;
    public $selectModel;
    public $projectsModel;
    public $profundModel;
    public $prodocsModel;
    public $prophaseModel;
    public $promilestonesModel;
    public $proeventsModel;
    public $eventfilesModel;
    public $contractorsModel;
    public $project_officersModel;
    public $kmlfilesModel;
    public $proFilesModel;
    public $conNoticeModel;


    public function __construct()
    {
        helper(['form', 'url', 'info']);
        $this->session = session();

        $this->usersModel = new usersModel();

        $this->countryModel = new countryModel();
        $this->settingsModel = new settingsModel();
        $this->provinceModel = new provinceModel();
        $this->districtModel = new districtModel();
        $this->llgModel = new llgModel();
        $this->selectModel = new selectionModel();
        $this->projectsModel = new projectsModel();
        $this->profundModel = new profundModel();
        $this->prodocsModel = new prodocsModel();
        $this->prophaseModel = new prophasesModel();
        $this->promilestonesModel = new promilestonesModel();
        $this->proeventsModel = new proeventsModel();
        $this->eventfilesModel = new eventfilesModel();
        $this->contractorsModel = new contractorsModel();
        $this->project_officersModel = new project_officersModel();
        $this->kmlfilesModel = new kmlfilesModel();
        $this->proFilesModel = new prodocsModel();
        $this->conNoticeModel = new contractorsNoticesModel();
    }

    /* 
    * index
    * create_road
    */

    public function index()
    {
        $data['title'] = "Projects Report";
        $data['menu'] = "reports";

        // Cache orgcode to avoid repeated session calls
        $orgcode = session('orgcode');

        // Fetch all projects once with only needed fields
        $data['projects'] = $this->projectsModel
            ->select('procode, name, status, budget, payment_total')
            ->where('orgcode', $orgcode)
            ->find();

        // Initialize calculations
        $data['pro_total_overpaid'] = $data['pro_total_outstanding'] = $data['pro_total_budget'] = $data['pro_total_paid'] = 0;
        $data['pro_ms_pending'] = $data['pro_ms_completed'] = $data['pro_ms_hold'] = $data['pro_payments'] = 0;

        // Filter projects by status in PHP and calculate totals
        $data['pro_active'] = [];
        $data['pro_completed'] = [];
        $data['pro_hold'] = [];
        $projectsID = [];

        foreach ($data['projects'] as $pro) {
            $projectsID[] = $pro['procode'];

            // Filter by status
            switch ($pro['status']) {
                case 'active':
                    $data['pro_active'][] = $pro;
                    break;
                case 'completed':
                    $data['pro_completed'][] = $pro;
                    break;
                case 'hold':
                    $data['pro_hold'][] = $pro;
                    break;
            }

            // Calculate totals while iterating
            $data['pro_total_budget'] += checkZero($pro['budget']);
            $data['pro_total_paid'] += checkZero($pro['payment_total']);
            $data['pro_total_outstanding'] += checkZero($pro['budget']) - checkZero($pro['payment_total']);
            if (checkZero($pro['payment_total']) > checkZero($pro['budget'])) {
                $data['pro_total_overpaid'] += checkZero($pro['payment_total']) - checkZero($pro['budget']);
            }
        }

        // Fetch payments and milestones only if there are projects
        if (!empty($projectsID)) {
            // Fetch payments
            $data['payments'] = $this->profundModel
                ->select('procode, amount, paymentdate')
                ->whereIn('procode', $projectsID)
                ->where('orgcode', $orgcode)
                ->find();

            // Fetch milestones
            $data['milestones'] = $this->promilestonesModel
                ->select('procode, checked')
                ->whereIn('procode', $projectsID)
                ->where('orgcode', $orgcode)
                ->find();
        } else {
            // No projects, set empty arrays
            $data['payments'] = [];
            $data['milestones'] = [];
        }

        // Calculate milestone totals
        foreach ($data['milestones'] as $ms) {
            switch ($ms['checked']) {
                case 'pending':
                    $data['pro_ms_pending'] += 1;
                    break;
                case 'completed':
                    $data['pro_ms_completed'] += 1;
                    break;
                case 'hold':
                    $data['pro_ms_hold'] += 1;
                    break;
            }
        }
 


        echo view('pro_reports/report_projects_dash', $data);
    }


    public function report_projects_status($status)
    {
        // Cache orgcode to avoid repeated session calls
        $orgcode = session('orgcode');

        // Fetch projects with all needed fields using optimized joins
        $query = $this->projectsModel
            ->select('projects.procode, projects.ucode, projects.name, projects.status, projects.budget, 
                     projects.payment_total, projects.pro_date, projects.fund,
                     contractor_details.name as contractor_name, 
                     project_officers.name as pro_officer_name')
            ->join('contractor_details', 'projects.contractor_id = contractor_details.id', 'left')
            ->join('project_officers', 'projects.pro_officer_id = project_officers.id', 'left')
            ->where('projects.orgcode', $orgcode);

        // Apply status filter if not 'all'
        if ($status != 'all') {
            $query->where('projects.status', $status);
        }

        $data['projects'] = $query->orderBy('projects.name', 'asc')->find();

        // Initialize totals
        $data['pro_total_overpaid'] = 0;
        $data['pro_total_outstanding'] = 0;
        $data['pro_total_budget'] = 0;
        $data['pro_total_paid'] = 0;
        $data['pro_ms_pending'] = 0;
        $data['pro_ms_completed'] = 0;
        $data['pro_ms_hold'] = 0;
        $data['pro_ms_canceled'] = 0;

        // Early return if no projects
        if (empty($data['projects'])) {
            $data['milestones'] = [];
            $data['milestone_by_project'] = [];
            $data['status'] = $status;
            $data['title'] = ucwords($status . " Projects Report");
            $data['menu'] = "report_projects_status";
            echo view('pro_reports/report_projects_status', $data);
            return;
        }

        // Extract project IDs using array_column (more efficient than loop)
        $projectsID = array_column($data['projects'], 'procode');

        // Calculate financial totals in a single pass
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
        }

        // Fetch milestones in a single optimized query
        $data['milestones'] = $this->promilestonesModel
            ->select('procode, status, checked')
            ->whereIn('procode', $projectsID)
            ->where('orgcode', $orgcode)
            ->find();

        // Pre-calculate milestone data grouped by project to avoid nested loops in view
        // Initialize milestone_by_project for ALL projects first (including those with no milestones)
        $data['milestone_by_project'] = [];
        foreach ($projectsID as $procode) {
            $data['milestone_by_project'][$procode] = [
                'pending' => 0,
                'completed' => 0,
                'hold' => 0,
                'canceled' => 0,
                'total' => 0
            ];
        }
        
        // Now populate with actual milestone data
        foreach ($data['milestones'] as $ms) {
            $procode = $ms['procode'];

            // Use status field if available, otherwise fall back to checked field
            $milestoneStatus = $ms['status'] ?? $ms['checked'];

            // Count by status
            switch ($milestoneStatus) {
                case 'pending':
                    $data['milestone_by_project'][$procode]['pending']++;
                    $data['pro_ms_pending']++;
                    break;
                case 'completed':
                    $data['milestone_by_project'][$procode]['completed']++;
                    $data['pro_ms_completed']++;
                    break;
                case 'hold':
                    $data['milestone_by_project'][$procode]['hold']++;
                    $data['pro_ms_hold']++;
                    break;
                case 'canceled':
                    $data['milestone_by_project'][$procode]['canceled']++;
                    $data['pro_ms_canceled']++;
                    break;
            }

            $data['milestone_by_project'][$procode]['total']++;
        }

        // Add metadata
        $data['status'] = $status;
        $data['title'] = ucwords($status . " Projects Report");
        $data['menu'] = "report_projects_status";

        echo view('pro_reports/report_projects_status', $data);
    }



    public function report_projects_view($ucode)
    {
        $data['title'] = "Projects Report View";
        $data['menu'] = "reports";


        $data['pro'] = $this->projectsModel->where('orgcode', session('orgcode'))->where('ucode', $ucode)->orderBy('name', 'asc')->first();

        //get address
        $data['get_country'] = $this->countryModel->where('code', $data['pro']['country'])->first();
        $data['get_province'] = $this->provinceModel->where('provincecode', $data['pro']['province'])->first();
        $data['get_district'] = $this->districtModel->where('districtcode', $data['pro']['district'])->first();
        $data['get_llg'] = $this->llgModel->where('llgcode', $data['pro']['llg'])->first();


        //calculations
        $data['pro_total_budget'] = $data['pro_total_paid'] = 0;
        $data['pro_ms_pending'] = $data['pro_ms_completed'] = $data['pro_ms_hold'] = $data['pro_payments'] = array();
        //   foreach ($data['pro'] as $pro) {
        $data['payments'] = $this->profundModel->where('orgcode', session('orgcode'))->where('procode', $data['pro']['procode'])->find();
        $data['milestones'] = $this->promilestonesModel->where('orgcode', session('orgcode'))->where('procode', $data['pro']['procode'])->find();
        $data['milestones_last'] = $this->promilestonesModel->where('orgcode', session('orgcode'))->where('procode', $data['pro']['procode'])->orderBy('update_at', 'desc')->first();
        $data['phases'] = $this->prophaseModel->where('orgcode', session('orgcode'))->where('procode', $data['pro']['procode'])->find();
        $data['pro_files'] = $this->proFilesModel->where('orgcode', session('orgcode'))->where('procode', $data['pro']['procode'])->orderBy('name', 'asc')->find();
        $data['events'] = $this->proeventsModel->where('orgcode', session('orgcode'))->where('procode', $data['pro']['procode'])->find();


        foreach ($data['payments'] as $pay) {
            $data['pro_total_paid'] += $pay['amount'];
            $data['pro_payments'][] = [
                'procode' => $pay['procode'],
                'amount' => $pay['amount'],
            ];
        }

        foreach ($data['milestones'] as $ms) {

            if ($ms['checked'] == 'pending') {
                $data['pro_ms_pending'][] = $ms['checked'];
            }
            if ($ms['checked'] == 'completed') {
                $data['pro_ms_completed'][] = $ms['checked'];
            }
            if ($ms['checked'] == 'hold') {
                $data['pro_ms_hold'][] = $ms['checked'];
            }
        }
        //}

        echo view('pro_reports/report_projects_view', $data);
    }


    public function report_pro_payment_record($id)
    {
        $data['title'] = "Payment Item";
        $data['menu'] = "reports";


        //calculations
        $data['pay'] = $this->profundModel->where('orgcode', session('orgcode'))->where('id', $id)->first();
        //pro
        $data['pro'] = $this->projectsModel->where('orgcode', session('orgcode'))->where('procode', $data['pay']['procode'])->orderBy('name', 'asc')->first();

        echo view('pro_reports/report_pro_payment_record', $data);
    }



    public function report_contractors_dash()
    {
        $data['title'] = "Projects Contractors";
        $data['menu'] = "report_contractors_dash";

        // Cache orgcode to avoid repeated session calls
        $orgcode = session('orgcode');

        // Optimized: Fetch contractors with all needed details including notice_flag and ucode
        $data['contractors'] = $this->projectsModel
            ->select('projects.contractor_id, contractor_details.id, contractor_details.name, contractor_details.concode, contractor_details.notice_flag, contractor_details.ucode')
            ->join('contractor_details', 'projects.contractor_id = contractor_details.id')
            ->where('projects.orgcode', $orgcode)
            ->groupBy('projects.contractor_id')
            ->find();

        // Extract unique contractor IDs
        $contractorID = [];
        foreach ($data['contractors'] as $contractor) {
            $contractorID[] = $contractor['contractor_id'];
        }

        // Fetch projects only if there are contractors with optimized fields
        if (!empty($contractorID)) {
            $data['projects'] = $this->projectsModel
                ->select('contractor_id, status, budget, payment_total')
                ->whereIn('contractor_id', $contractorID)
                ->where('orgcode', $orgcode)
                ->find();

            // Calculate aggregated statistics per contractor
            $contractorStats = [];
            foreach ($data['projects'] as $pro) {
                $cid = $pro['contractor_id'];
                if (!isset($contractorStats[$cid])) {
                    $contractorStats[$cid] = [
                        'count' => 0,
                        'budget' => 0,
                        'payments' => 0,
                        'active' => 0,
                        'hold' => 0,
                        'completed' => 0
                    ];
                }
                $contractorStats[$cid]['count']++;
                $contractorStats[$cid]['budget'] += $pro['budget'];
                $contractorStats[$cid]['payments'] += $pro['payment_total'] ?? 0;
                $contractorStats[$cid][$pro['status']]++;
            }
            $data['contractorStats'] = $contractorStats;

            // Calculate totals for summary cards
            $data['total_contractors'] = count($data['contractors']);
            $data['total_projects'] = count($data['projects']);
            $data['total_budget'] = array_sum(array_column($data['projects'], 'budget'));
            $data['total_payments'] = array_sum(array_map(function($p) { return $p['payment_total'] ?? 0; }, $data['projects']));
        } else {
            $data['projects'] = [];
            $data['contractorStats'] = [];
            $data['total_contractors'] = 0;
            $data['total_projects'] = 0;
            $data['total_budget'] = 0;
            $data['total_payments'] = 0;
        }

        echo view('pro_reports/report_contractors_dash', $data);
    }

    public function report_contractors_view($ucode)
    {
        // Cache orgcode to avoid repeated session calls
        $orgcode = session('orgcode');

        // Fetch contractor details
        $data['con'] = $this->contractorsModel->where('ucode', $ucode)->first();

        if (!$data['con']) {
            return redirect()->to('report_contractors_dash')->with('error', 'Contractor not found');
        }

        // Fetch notices
        $data['mynotices'] = $this->conNoticeModel
            ->select('id, concode, notice_date, notice_type, description')
            ->where('concode', $data['con']['concode'])
            ->where('orgcode', $orgcode)
            ->orderBy('notice_date', 'desc')
            ->find();

        $data['notices'] = $this->conNoticeModel
            ->select('id, concode, notice_date, notice_type, description, orgcode')
            ->where('concode', $data['con']['concode'])
            ->where('orgcode !=', $orgcode)
            ->orderBy('notice_date', 'desc')
            ->find();

        // Fetch projects
        $data['myprojects'] = $this->projectsModel
            ->select('procode, name, contractor_id, status, budget, payment_total')
            ->where('contractor_id', $data['con']['id'])
            ->where('orgcode', $orgcode)
            ->find();

        $data['projects'] = $this->projectsModel
            ->select('procode, name, contractor_id, status, budget, payment_total, orgcode')
            ->where('contractor_id', $data['con']['id'])
            ->where('orgcode !=', $orgcode)
            ->find();

        // Extract project codes (not contractor_id as in original - this looks like a bug fix)
        $projectsID = [];
        foreach ($data['myprojects'] as $pro) {
            $projectsID[] = $pro['procode'];
        }

        // Fetch milestones only if there are projects
        if (!empty($projectsID)) {
            $data['milestones'] = $this->promilestonesModel
                ->select('procode, milestones, checked, checked_date')
                ->whereIn('procode', $projectsID)
                ->where('orgcode', $orgcode)
                ->find();
        } else {
            $data['milestones'] = [];
        }

        $data['title'] = $data['con']['name'];
        $data['menu'] = "reports";
        echo view('pro_reports/report_contractors_view', $data);
    }




    public function report_pro_officers_dash()
    {
        $data['title'] = "Project Officers Dashboard";
        $data['menu'] = "report_pro_officers";

        // Cache orgcode to avoid repeated session calls
        $orgcode = session('orgcode');

        // Optimized: Get all officer stats in a single aggregated query
        $db = \Config\Database::connect();
        $builder = $db->table('projects');
        
        // Build query with aggregations by officer
        $officerStatsQuery = $builder
            ->select('projects.pro_officer_id,
                     project_officers.id,
                     project_officers.name,
                     project_officers.pocode,
                     project_officers.ucode,
                     COUNT(projects.id) as project_count,
                     COALESCE(SUM(projects.budget), 0) as total_budget,
                     COALESCE(SUM(projects.payment_total), 0) as total_payments,
                     SUM(CASE WHEN projects.status = "active" THEN 1 ELSE 0 END) as active_count,
                     SUM(CASE WHEN projects.status = "completed" THEN 1 ELSE 0 END) as completed_count,
                     SUM(CASE WHEN projects.status = "hold" THEN 1 ELSE 0 END) as hold_count')
            ->join('project_officers', 'projects.pro_officer_id = project_officers.id')
            ->where('projects.orgcode', $orgcode)
            ->groupBy('projects.pro_officer_id, project_officers.id, project_officers.name, 
                      project_officers.pocode, project_officers.ucode')
            ->get()
            ->getResultArray();

        // Transform the results for view consumption
        $data['pofficers'] = [];
        $data['officer_stats'] = [];
        $data['total_officers'] = count($officerStatsQuery);
        $data['total_projects'] = 0;
        $data['total_budget'] = 0;
        $data['total_payments'] = 0;
        $data['projects_by_status'] = [
            'active' => 0,
            'completed' => 0,
            'hold' => 0
        ];

        foreach ($officerStatsQuery as $row) {
            // Add officer to the list
            $data['pofficers'][] = [
                'id' => $row['id'],
                'pro_officer_id' => $row['pro_officer_id'],
                'name' => $row['name'],
                'pocode' => $row['pocode'],
                'ucode' => $row['ucode']
            ];

            // Store pre-calculated stats for each officer
            $data['officer_stats'][$row['id']] = [
                'count' => (int)$row['project_count'],
                'budget' => (float)$row['total_budget'],
                'payments' => (float)$row['total_payments'],
                'active' => (int)$row['active_count'],
                'completed' => (int)$row['completed_count'],
                'hold' => (int)$row['hold_count']
            ];

            // Aggregate global totals
            $data['total_projects'] += (int)$row['project_count'];
            $data['total_budget'] += (float)$row['total_budget'];
            $data['total_payments'] += (float)$row['total_payments'];
            $data['projects_by_status']['active'] += (int)$row['active_count'];
            $data['projects_by_status']['completed'] += (int)$row['completed_count'];
            $data['projects_by_status']['hold'] += (int)$row['hold_count'];
        }

        // Calculate outstanding
        $data['total_outstanding'] = $data['total_budget'] - $data['total_payments'];

        // Calculate payment percentage for progress display
        $data['payment_percentage'] = $data['total_budget'] > 0 
            ? round(($data['total_payments'] / $data['total_budget']) * 100, 1) 
            : 0;

        echo view('pro_reports/report_pro_officers_dash', $data);
    }


    public function report_pro_officers_view($ucode)
    {

        $data['off'] = $this->project_officersModel->where('ucode', $ucode)->first();

        $data['myprojects'] = $this->projectsModel->where('pro_officer_id', $data['off']['id'])->where('orgcode', session('orgcode'))->find();
        $data['projects'] = $this->projectsModel->where('pro_officer_id', $data['off']['id'])->where('orgcode !=', session('orgcode'))->find();


        $data['title'] = $data['off']['name'];
        $data['menu'] = "reports";
        echo view('pro_reports/report_pro_officers_view', $data);
    }
}
