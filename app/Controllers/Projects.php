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
use App\Models\promilefilesModel;
use App\Models\promilestonesModel;
use App\Models\prophasesModel;
use App\Models\provinceModel;
use App\Models\selectionModel;
use App\Models\settingsModel;
use App\Models\usersModel;


class Projects extends BaseController
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
    public $conNoticeModel;
    public $milestoneFilesModel;


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
        $this->conNoticeModel = new contractorsNoticesModel();
        $this->milestoneFilesModel = new promilefilesModel();
    }

    /* 
    * index
    * create_road
    */

    public function index()
    {
        $data['title'] = "Projects List";
        $data['menu'] = "projects";

        // Optimized query: Get projects with calculated totals
        $data['projects'] = $this->projectsModel
            ->where('orgcode', session('orgcode'))
            ->orderBy('create_at', 'DESC')
            ->find();

        // Get funding data grouped by project code for efficient lookup
        $fundData = $this->profundModel
            ->select('procode, SUM(amount) as total_paid, COUNT(id) as payment_count')
            ->where('orgcode', session('orgcode'))
            ->groupBy('procode')
            ->find();

        // Create associative array for quick lookup
        $data['fundLookup'] = [];
        foreach ($fundData as $fund) {
            $data['fundLookup'][$fund['procode']] = [
                'total_paid' => $fund['total_paid'],
                'payment_count' => $fund['payment_count']
            ];
        }

        // Calculate statistics for dashboard cards
        $data['stats'] = [
            'total_projects' => count($data['projects']),
            'total_budget' => array_sum(array_column($data['projects'], 'budget')),
            'total_paid' => array_sum(array_column($fundData, 'total_paid')),
            'active_count' => count(array_filter($data['projects'], function ($p) {
                return $p['status'] === 'active';
            })),
            'completed_count' => count(array_filter($data['projects'], function ($p) {
                return $p['status'] === 'completed';
            })),
            'hold_count' => count(array_filter($data['projects'], function ($p) {
                return in_array($p['status'], ['hold', 'canceled']);
            }))
        ];

        echo view('projects/projects_list', $data);
    }

    public function create_projects()
    {
        $data['title'] = "New Projects";
        $data['menu'] = "addprojects";

        //form submit
        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required|min_length[3]|max_length[255]',
            'province' => 'required',
            'district' => 'required',
            'llg' => 'required',
        ])) {

            $llg = $this->request->getVar('llg');
            $orgcode = session('orgcode');
            
            // Validate LLG
            if (empty($llg)) {
                return redirect()->back()->withInput()->with('error', 'Please select an LLG');
            }

            // Generate unique project code efficiently
            $existingProjects = $this->projectsModel
                ->select('procode')
                ->like('procode', $llg . '-' . $orgcode . '-%', 'after')
                ->orderBy('id', 'desc')
                ->findAll(1);

            $projectNumber = 1;
            if (!empty($existingProjects)) {
                // Extract number from last project code
                $lastCode = $existingProjects[0]['procode'];
                $parts = explode('-', $lastCode);
                $lastNumber = (int)end($parts);
                $projectNumber = $lastNumber + 1;
            }

            $procode = $llg . "-" . $orgcode . "-" . $projectNumber;
            
            // Double-check uniqueness
            $codeExists = $this->projectsModel
                ->where('procode', $procode)
                ->countAllResults();
                
            if ($codeExists > 0) {
                return redirect()->back()->withInput()->with('error', 'Project code conflict. Please try again.');
            }

            // Generate unique code
            $ucode = uniqid() . time();
            $currentDateTime = date('Y-m-d H:i:s');
            $userName = session('name');

            // Prepare data for insertion
            $insertData = [
                'ucode' => $ucode,
                'procode' => $procode,
                'orgcode' => $orgcode,
                'name' => trim($this->request->getVar('name')),
                'pro_date' => $this->request->getVar('pro_date') ?: null,
                'description' => trim($this->request->getVar('description')) ?: null,
                'budget' => $this->request->getVar('budget') ?: 0,
                'fund' => $this->request->getVar('fund') ?: null,
                'country' => $this->request->getVar('country'),
                'province' => $this->request->getVar('province'),
                'district' => $this->request->getVar('district'),
                'llg' => $llg,
                'status' => 'active',
                'create_by' => $userName,
                'create_org' => session('orgname'),
                'pro_update_at' => $currentDateTime,
                'pro_update_by' => $userName,
                'update_by' => $userName,
            ];

            // Insert project
            if ($this->projectsModel->insert($insertData)) {
                return redirect()->to('open_projects/' . $ucode)
                    ->with('success', 'Project registered successfully!');
            } else {
                return redirect()->back()->withInput()
                    ->with('error', 'Failed to register project. Please try again.');
            }
        }
        
        // Default load - optimized queries
        try {
            // Get all provinces
            $data['get_provinces'] = $this->provinceModel
                ->select('id, provincecode, name')
                ->orderBy('name', 'asc')
                ->findAll();
            
            // Get funding sources
            $data['select'] = $this->selectModel
                ->select('id, item')
                ->where('box', 'fund')
                ->orderBy('item', 'asc')
                ->findAll();
            
        } catch (\Exception $e) {
            log_message('error', 'Error loading create projects page: ' . $e->getMessage());
            return redirect()->to('dashboard')
                ->with('error', 'Error loading page. Please try again.');
        }

        return view('projects/create_projects', $data);
    }

    public function edit_projects($procode)
    {

        //form submit
        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required',

        ])) {

            $data = [
                'name' => $this->request->getVar('name'),
                'pro_date' => $this->request->getVar('pro_date'),
                'pro_site' => $this->request->getVar('pro_site'),
                'description' => $this->request->getVar('description'),
                'country' => $this->request->getVar('country'),
                'province' => $this->request->getVar('province'),
                'district' => $this->request->getVar('district'),
                'llg' => $this->request->getVar('llg'),
                'pro_update_at' => date('Y-m-d H:i:s'),
                'pro_update_by' => session('name'),
                'update_by' => session('name'),
            ];

            $id = $this->request->getVar('proid');
            $this->projectsModel->update($id, $data);

            return redirect()->to(current_url())->with('success', 'Changes Saved');
        }

        //default load
        $data['pro'] = $this->projectsModel->where('procode', $procode)->first();
        $data['select'] = $this->selectModel->where('box', 'fund')->orderBy('item', 'asc')->find();
        $data['get_provinces'] = $this->provinceModel->orderBy('name', 'asc')->find();
        $data['fund'] = $this->profundModel->where('procode', $procode)->where('orgcode', session('orgcode'))->find();

        $data['get_district'] = $this->districtModel->where('districtcode', $data['pro']['district'])->first();
        $data['get_llg'] = $this->llgModel->where('llgcode', $data['pro']['llg'])->first();

        $data['title'] = "Edit: " . $data['pro']['procode'];
        $data['menu'] = "projects";
        echo view('projects/edit_projects', $data);
    }


    public function edit_projects_status($procode)
    {

        //default load
        $data['pro'] = $this->projectsModel->where('procode', $procode)->first();

        $data['title'] = "Edit: " . $data['pro']['procode'];
        $data['menu'] = "projects";

        echo view('projects/edit_projects_status', $data);
    }

    public function update_projects_status()
    {

        $id = $this->request->getVar('proid');
        $procode = $this->request->getVar('procode');
        $status = $this->request->getVar('status');

        //if status is set to completed!
        if ($status == 'completed') {

            //check milestones
            $pro = $this->projectsModel->where('id', $id)->first();
            $mstones = $this->promilestonesModel->where('procode', $procode)->find();
            $payments = $this->profundModel->where('procode', $procode)->find();

            foreach ($mstones as $ms) {
                // Check both status and checked fields for backward compatibility
                if (($ms['status'] ?? $ms['checked']) != 'completed') {
                    return redirect()->back()->with('error', 'Error. Some Milestones are yet to be completed!');
                }
            }

            $get_pay = array();
            foreach ($payments as $pay) {
                $get_pay[] = $pay['amount'];
            }

            //check payments
            if (($pro['payment_total']) != $pro['budget']) {
                return redirect()->back()->with('error', 'Error. Payments does not match the budgeted amount!');
            }
        } else {
            $data = [
                'status' => $this->request->getVar('status'),
                'statusnotes' => $this->request->getVar('statusnotes'),
                'update_by' => session('name'),
                'status_by' => session('name'),
                'status_at' => date('Y-m-d H:i:s'),
            ];

            $this->projectsModel->update($id, $data);
        }




        return redirect()->to('edit_projects_status/' . $procode)->with('success', 'Changes Saved');
    }


    public function edit_projects_contractors($procode)
    {

        //default load
        $data['pro'] = $this->projectsModel->where('procode', $procode)->first();
        $data['contractors'] = $this->contractorsModel
            ->where('province', session('orgprov'))
            ->whereIn('notice_flag', ['', 'good', 'excellent', 'warning'])
            ->orderBy('id', 'desc')->find();

        $data['title'] = "Edit: " . $data['pro']['procode'];
        $data['menu'] = "projects";
        echo view('projects/edit_projects_contractors', $data);
    }

    public function update_projects_contractors()
    {
        $ucode = $this->request->getVar('pro_ucode');
        $id = $this->request->getVar('pro_id');
        $procode = $this->request->getVar('procode');
        $file = $this->request->getFile('contract_file');

        $getcontractor = $this->contractorsModel->where('id', $this->request->getVar('contractor'))->first();
        $getconNotice = $this->conNoticeModel->where('concode', $getcontractor['concode'])->orderBy('id', 'desc')->first();
        if (empty($getcontractor)) {
            return redirect()->back()->with('error', 'This contractor does not exist');
        }
        if (!empty($getconNotice['notice_flag']) && ($getconNotice['notice_flag'] == 'banned')) {
            return redirect()->back()->with('error', '<b>' . $getcontractor['name'] . '</b>' . 'This contractor is <b> BANNED!</b>');
        }
        if (!empty($getconNotice['notice_flag']) && ($getconNotice['notice_flag'] == 'blacklist')) {
            return redirect()->back()->with('error', 'This contractor is <b> BLACKLISTED! </b>');
        }

        $data = [
            'contractor_id' => $this->request->getVar('contractor'),
            'contractor_code' => $getcontractor['concode'],
            'contractor_name' => $getcontractor['name'],
            'contractor_at' => date('Y-m-d H:i:s'),
            'contractor_by' => session('name'),
            'update_by' => session('name'),
        ];


        $this->projectsModel->update($id, $data);

        if ($file && $file->isValid()) {

            // Generate a custom name for the file
            $newName = 'confile_' . $procode . "_" . time() . "." . $file->getExtension();

            // Move uploaded file to the public/uploads directory
            $file->move(ROOTPATH . 'public/uploads/contract_files/', $newName);

            // Save file path to database
            $data = [
                'contract_file' => 'public/uploads/contract_files/' . $newName,
            ];

            $this->projectsModel->update($id, $data);
        }


        return redirect()->to('edit_projects_contractors/' . $procode)->with('success', 'Contractor Set!');
    }


    public function edit_projects_officers($ucode)
    {

        //default load
        $data['pro'] = $this->projectsModel->where('ucode', $ucode)->first();
        $data['pro_officers'] = $this->project_officersModel->where('orgcode', session('orgcode'))->orderBy('name', 'asc')->find();
        $data['title'] = "Edit: " . $data['pro']['procode'];
        $data['menu'] = "projects";
        echo view('projects/edit_projects_officers', $data);
    }

    public function update_projects_officers()
    {
        $ucode = $this->request->getVar('pro_ucode');
        $id = $this->request->getVar('pro_id');

        $getofficer = $this->project_officersModel->where('id', $this->request->getVar('project_officers'),)->first();
        if (empty($getofficer)) {
            return redirect()->back()->with('error', 'This Officer does not exist');
        }

        $data = [

            'pro_officer_id' => $this->request->getVar('project_officers'),
            'pro_officer_name' => $getofficer['name'],
            'pro_officer_scope' => $this->request->getVar('work_scope'),
            'pro_officer_at' => date('Y-m-d H:i:s'),
            'pro_officer_by' => session('name'),
            'update_by' => session('name'),
        ];

        $this->projectsModel->update($id, $data);

        return redirect()->to("edit_projects_officers/" . $ucode)->with('success', 'Project Officer Set');
        //return redirect()->back()->with('success', 'Project Officer Set');
    }

    public function project_phases($procode)
    {
        //default load
        $data['pro'] = $this->projectsModel->where('procode', $procode)->first();
        $data['select'] = $this->selectModel->where('box', 'fund')->orderBy('item', 'asc')->find();
        $data['get_provinces'] = $this->provinceModel->orderBy('name', 'asc')->find();
        $data['fund'] = $this->profundModel->where('procode', $procode)->where('orgcode', session('orgcode'))->find();
        $data['get_district'] = $this->districtModel->where('districtcode', $data['pro']['district'])->first();
        $data['phases'] = $this->prophaseModel->where('procode', $procode)->find();
        $data['milestones'] = $this->promilestonesModel->where('orgcode', session('orgcode'))->where('procode', $procode)->orderBy('id', 'desc')->find();


        $data['title'] = "Tasks: " . $data['pro']['procode'];
        $data['menu'] = "projects";
        echo view('projects/project_phases', $data);
    }

    public function pro_milestones($procode)
    {
        //default load
        $data['pro'] = $this->projectsModel->where('procode', $procode)->first();
        $data['select'] = $this->selectModel->where('box', 'fund')->orderBy('item', 'asc')->find();
        $data['get_provinces'] = $this->provinceModel->orderBy('name', 'asc')->find();
        $data['fund'] = $this->profundModel->where('procode', $procode)->where('orgcode', session('orgcode'))->find();
        $data['get_district'] = $this->districtModel->where('districtcode', $data['pro']['district'])->first();
        $data['phases'] = $this->prophaseModel->where('procode', $procode)->find();
        $data['milestones'] = $this->promilestonesModel->where('orgcode', session('orgcode'))->where('procode', $procode)->orderBy('id', 'desc')->find();


        $data['title'] = "Tasks: " . $data['pro']['procode'];
        $data['menu'] = "projects";
        echo view('projects/project_milestones', $data);
    }

    public function add_phases()
    {

        $data = [
            'ucode' => uniqid() . time(),
            'procode' => $this->request->getVar('procode'),
            'orgcode' => session('orgcode'),
            'phases' => $this->request->getVar('phases'),
            'create_by' => session('name'),
        ];

        $this->prophaseModel->insert($data);

        // return redirect()->back()->with('success', 'Phase Created');
        $response = ['status' => 'success', 'message' => 'Phase Created!'];
        return $this->response->setJSON($response);
    }

    public function edit_phases()
    {
        $id = $this->request->getPost('phid');

        $data = [

            'phases' => $this->request->getVar('phases'),
            'update_by' => session('name'),
        ];

        $this->prophaseModel->update($id, $data);

        //return redirect()->back()->with('error', 'Phase Updated');
        $response = ['status' => 'success', 'message' => 'Phase Updated!'];
        return $this->response->setJSON($response);
        //return ;
    }

    public function delete_phases()
    {
        $id = $this->request->getPost('phid');

        $milestones = $this->promilestonesModel->where('phase_id', $id)->find();

        if (!empty($milestones)) {
            $response = ['status' => 'error', 'message' => 'Phase has Milestones!. Cannot Delete'];
            return $this->response->setJSON($response);
        }

        $this->prophaseModel->where('id', $id)->delete();

        //return redirect()->back()->with('success', 'Phase Updated');
        $response = ['status' => 'success', 'message' => ' Phase Deleted!'];
        return $this->response->setJSON($response);
    }



    public function open_projects($ucode)
    {

        $data['pro'] = $this->projectsModel->where('ucode', $ucode)->first();
        $procode = $data['pro']['procode'];
        $data['select'] = $this->selectModel->where('box', 'fund')->orderBy('item', 'asc')->find();

        $data['get_provinces'] = $this->provinceModel->where('provincecode', $data['pro']['province'])->first();
        $data['get_districts'] = $this->districtModel->where('districtcode', $data['pro']['district'])->first();
        $data['get_llgs'] = $this->llgModel->where('llgcode', $data['pro']['llg'])->first();

        $data['fund'] = $this->profundModel->where('procode', $procode)->where('orgcode', session('orgcode'))->find();
        $data['prodocs'] = $this->prodocsModel->where('procode', $procode)->where('orgcode', session('orgcode'))->orderBy('id', 'desc')->find();
        $data['phases'] = $this->prophaseModel->where('procode', $procode)->find();
        $data['milestones'] = $this->promilestonesModel->where('orgcode', session('orgcode'))->where('procode', $procode)->orderBy('id', 'desc')->find();
        $data['events'] = $this->proeventsModel->where('orgcode', session('orgcode'))->where('procode', $procode)->orderBy('eventdate', 'desc')->find();
        $data['eventfiles'] = $this->eventfilesModel->where('orgcode', session('orgcode'))->where('procode', $procode)->orderBy('id', 'desc')->find();
        $data['contractors'] = $this->contractorsModel->where('province', session('orgprov'))->orderBy('id', 'desc')->find();
        $data['pro_officers'] = $this->project_officersModel->where('orgcode', session('orgcode'))->orderBy('name', 'asc')->find();
        $data['kmlfiles'] = $this->kmlfilesModel->where('orgcode', session('orgcode'))->where('proucode', $ucode)->orderBy('id', 'desc')->find();


        $data['title'] = $data['pro']['procode'];
        $data['menu'] = "projects";
        echo view('projects/open_projects', $data);
    }

    public function open_prophases($ucode)
    {

        $data['phases'] = $this->prophaseModel->where('ucode', $ucode)->first();
        $data['pro'] = $this->projectsModel->where('procode', $data['phases']['procode'])->first();
        $data['milestones'] = $this->promilestonesModel->where('orgcode', session('orgcode'))->where('phase_id', $data['phases']['id'])->orderBy('id', 'desc')->find();

        $data['title'] = "Milestones";
        $data['menu'] = "projects";
        echo view('projects/open_prophases', $data);
    }

    public function add_milestones()
    {

        $data = [
            'ucode' => uniqid() . time(),
            'procode' => $this->request->getVar('procode'),
            'orgcode' => session('orgcode'),
            'milestones' => $this->request->getVar('milestones'),
            'phase_id' => $this->request->getVar('phid'),
            'datefrom' => $this->request->getVar('datefrom'),
            'dateto' => $this->request->getVar('dateto'),
            'status' => 'pending',
            'checked' => 'pending',
            'create_by' => session('name'),
        ];

        $this->promilestonesModel->insert($data);

        //return redirect()->back()->with('success', 'Milestone Created');
        $response = ['status' => 'success', 'message' => 'Milestone Created!'];
        return $this->response->setJSON($response);
    }

    public function edit_milestones()
    {

        $data = [
            'milestones' => $this->request->getVar('milestones'),
            'datefrom' => $this->request->getVar('datefrom'),
            'dateto' => $this->request->getVar('dateto'),
            'update_by' => session('name'),
        ];

        $id = $this->request->getVar('mlid');
        $this->promilestonesModel->update($id, $data);

        //return redirect()->back()->with('success', 'Milestone Saved');
        $response = ['status' => 'success', 'message' => 'Milestone Saved!'];
        return $this->response->setJSON($response);
    }

    public function delete_milestones()
    {

        $id = $this->request->getVar('mlid');


        $msFiles = $this->milestoneFilesModel->where('milestones_id', $id)->find();

        if (!empty($msFiles)) {
            $response = ['status' => 'error', 'message' => 'This Milestone has Projects Files!. Cannot Delete!'];
            return $this->response->setJSON($response);
        }

        $this->promilestonesModel->where('id', $id)->delete();

        //return redirect()->back()->with('success', 'Milestone Saved');
        $response = ['status' => 'success', 'message' => 'Milestone Deleted!'];
        return $this->response->setJSON($response);
    }



    public function edit_project_budget()
    {
        $id = $this->request->getPost('pro_id');

        $data = [

            'fund' => $this->request->getPost('fund_source'),
            'budget' => $this->request->getPost('budget'),
            'budget_at' => date('Y-m-d H:i:s'),
            'budget_by' => session('name'),
        ];

        $this->projectsModel->update($id, $data);

        //return redirect()->to(previous_url())->with('success', 'Budget Updated');


        if ($this->request->getMethod() == 'POST') {
            return redirect()->to(previous_url())->with('success', 'Budget Updated');
        } else {

            // Send a response back to the AJAX request
            $response = ['status' => 'success', 'message' => 'Project budget updated successfully.'];
            //$response = ['success' => 'success'];
            return $this->response->setJSON($response);
        }
    }







    //set gps coordinates kml upload
    public function gps_set()
    {
        $file = $this->request->getFile('file_basekml');
        $proucode = $this->request->getPost('proucode');
        $procode = $this->request->getPost('procode');
        $proid = $this->request->getPost('proid');
        $lat = $this->request->getPost('lat');
        $lon = $this->request->getPost('lon');
        $gps = $this->request->getPost('lat') . "," . $this->request->getPost('lon');

        $data = [
            'gps' => $gps,
            'lat' => $lat,
            'lon' => $lon,
            'gps_at' => date('Y-m-d H:i:s'),
            'gps_by' => session('name'),
            'update_by' => session('name'),
        ];

        $this->projectsModel->update($proid, $data);
        // Check if file is uploaded
        //$file = $this->request->getFile('file_payment');
        if ($file && $file->isValid()) {

            // Generate a custom name for the file
            $newName = $procode . "_" . time() . "." . $file->getExtension();

            // Move uploaded file to the public/uploads directory
            $file->move(ROOTPATH . 'public/uploads/gps_files/', $newName);

            // Save file path to database
            $data = [
                'kmlfile' => 'public/uploads/gps_files/' . $newName,
            ];

            // Save file path to database
            $kmldata = [
                'filepath' => 'public/uploads/gps_files/' . $newName,
                'orgcode' => session('orgcode'),
                'procode' => $procode,
                'proucode' => $proucode,
                'create_by' => session('name'),
            ];

            $this->projectsModel->update($proid, $data);
            $this->kmlfilesModel->insert($kmldata);
        }

        //return redirect()->back()->with('success', 'GPS Info Saved.');
        $response = ['status' => 'success', 'message' => 'GPS Info Saved.'];
        return $this->response->setJSON($response);
    }


    //upload project documents
    public function prodocs_upload()
    {
        $file = $this->request->getFile('prodocs');
        $procode = $this->request->getPost('procode');
        $proid = $this->request->getPost('proid');
        $name = $this->request->getPost('name');

        // Validate inputs
        if (empty($name)) {
            $response = ['status' => 'error', 'message' => 'File title is required.'];
            return $this->response->setJSON($response);
        }

        if (empty($file)) {
            $response = ['status' => 'error', 'message' => 'No file selected.'];
            return $this->response->setJSON($response);
        }

        // Validate the file
        if (!$file->isValid()) {
            $response = ['status' => 'error', 'message' => 'Invalid file: ' . $file->getErrorString()];
            return $this->response->setJSON($response);
        }

        // Check if file has errors
        if ($file->hasMoved()) {
            $response = ['status' => 'error', 'message' => 'File has already been moved.'];
            return $this->response->setJSON($response);
        }

        try {
            // Generate a custom name for the file
            $newName = "prodocs_" . $procode . "_" . time() . "." . $file->getExtension();

            // Move the uploaded file to the uploads folder with the new name
            $file->move(ROOTPATH . 'public/uploads/prodocs_files/', $newName);

            // Insert the file path into the database
            $data = [
                'ucode' => uniqid() . time(),
                'orgcode' => session('orgcode'),
                'procode' => $procode,
                'name' => $name,
                'filepath' => 'public/uploads/prodocs_files/' . $newName,
                'create_by' => session('name'),
                'status' => 1,
            ];
            $this->prodocsModel->insert($data);

            $response = ['status' => 'success', 'message' => 'File uploaded successfully.'];
            return $this->response->setJSON($response);

        } catch (\Exception $e) {
            $response = ['status' => 'error', 'message' => 'Error uploading file: ' . $e->getMessage()];
            return $this->response->setJSON($response);
        }
    }

    //upload project documents
    public function prodocs_edit()
    {
        $file = $this->request->getFile('prodocs');
        $procode = $this->request->getPost('procode');
        $id = $this->request->getPost('pdid');
        $name = $this->request->getPost('name');

        // Insert the file path into the database
        $data = [
            'name' => $name,
            'update_by' => session('name'),
        ];
        $this->prodocsModel->update($id, $data);


        if ($file && $file->isValid()) {

            // Generate a custom name for the file
            $newName = 'prodocs_' . $procode . "_" . time() . "." . $file->getExtension();

            // Move the uploaded file to the uploads folder with the new name
            $file->move(ROOTPATH . 'public/uploads/prodocs_files/', $newName);

            // Insert the file path into the database
            $data = [
                'filepath' => 'public/uploads/prodocs_files/' . $newName,
            ];
            $this->prodocsModel->update($id, $data);
        }

        //return redirect()->back()->with('success', 'Document Uploaded');

        $response = ['status' => 'success', 'message' => 'File Updated!.'];
        //$response = ['success' => 'success'];
        return $this->response->setJSON($response);
    }


    //upload project documents
    public function prodocs_delete()
    {
        $file = $this->request->getFile('prodocs');
        $procode = $this->request->getPost('procode');
        $id = $this->request->getPost('pdid');
        $name = $this->request->getPost('pdname');

        $this->prodocsModel->where('id', $id)->delete();



        //return redirect()->back()->with('success', 'Document Uploaded');

        $response = ['status' => 'success', 'message' => $name . ' - File Deleted!.'];
        //$response = ['success' => 'success'];
        return $this->response->setJSON($response);
    }





    //get district addresses
    public function getaddress()
    {

        //$prov = new provinceModel();
        //$district = new districtModel();
        $country_id = $this->request->getPost('country_id');
        $prov_code = $this->request->getPost('province_code');
        $dist_code = $this->request->getPost('district_code');

        //get province
        if (isset($country_id)) {
            $data['province'] = $this->provinceModel->where('country_id', $country_id)->orderBy('name', 'asc')->find();
        }

        //get district
        if (isset($prov_code)) {
            $prov_id = $this->provinceModel->where('provincecode', $prov_code)->first();
            $data['district'] = $this->districtModel->where('province_id', $prov_id['id'])->orderBy('name', 'asc')->find();
        }

        //get llgs
        if (isset($dist_code)) {
            $dist_id = $this->districtModel->where('districtcode', $dist_code)->first();
            $data['llgs'] = $this->llgModel->where('district_id', $dist_id['id'])->orderBy('name', 'asc')->find();
        }

        return json_encode($data);
    }

    public function addpayments()
    {

        $procode = $this->request->getPost('procode');

        $data = [
            'ucode' => uniqid() . time(),
            'procode' => $this->request->getPost('procode'),
            'orgcode' => session('orgcode'),
            'amount' => $this->request->getPost('amount'),
            'description' => $this->request->getPost('description'),
            'paymentdate' => $this->request->getPost('paymentdate'),
            'create_by' => session('name'),
        ];

        // Check if file is uploaded
        $file = $this->request->getFile('file_payment');
        if ($file && $file->isValid()) {

            // Generate a custom name for the file
            $newName = 'paydocs_' . $procode . "_" . time() . "." . $file->getExtension();

            // Move uploaded file to the public/uploads directory
            $file->move(ROOTPATH . 'public/uploads/payment_files/', $newName);

            // Save file path to database
            $data += [
                'filepath' => 'public/uploads/payment_files/' . $newName,
            ];
        }

        $this->profundModel->insert($data);

        //get total payments
        $pro = $this->projectsModel->where('procode', $procode)->first();
        $payment = $this->profundModel
            ->selectSum('amount')
            ->where('procode', $procode)->find();

        $data = [
            'payment_total' => $payment[0]['amount'],
            'payment_at' => date('Y-m-d H:i:s'),
            'payment_by' => session('name'),
            'update_by' => session('name'),
        ];


        $this->projectsModel->update($pro['id'], $data);
        //  endif;

        //return redirect()->back()->with('success', 'Payment Added');

        $response = ['status' => 'success', 'message' => 'Payment Added!.'];
        return $this->response->setJSON($response);
    }

    public function editpayments()
    {
        $procode = $this->request->getPost('procode');
        $id = $this->request->getPost('payid');

        $data = [

            'amount' => $this->request->getPost('amount'),
            'description' => $this->request->getPost('description'),
            'paymentdate' => $this->request->getPost('paymentdate'),
            'update_by' => session('name'),
        ];

        // Check if file is uploaded
        $file = $this->request->getFile('file_payment');
        if ($file && $file->isValid()) {

            // Generate a custom name for the file
            $newName = 'paydocs_' . $procode . "_" . time() . "." . $file->getExtension();

            // Move uploaded file to the public/uploads directory
            $file->move(ROOTPATH . 'public/uploads/payment_files/', $newName);

            // Save file path to database
            $data += [
                'filepath' => 'public/uploads/payment_files/' . $newName,
            ];
        }

        $this->profundModel->update($id, $data);

        //get total payments
        $pro = $this->projectsModel->where('procode', $procode)->first();
        $payment = $this->profundModel
            ->selectSum('amount')
            ->where('procode', $procode)->find();

        $data = [
            'payment_total' => $payment[0]['amount'],
            'payment_at' => date('Y-m-d H:i:s'),
            'payment_by' => session('name'),
            'update_by' => session('name'),
        ];

        $this->projectsModel->update($pro['id'], $data);

        //return redirect()->back()->with('success', 'Payment Updated');

        $response = ['status' => 'success', 'message' => 'Payment Information Updated!.'];
        //$response = ['success' => 'success'];
        return $this->response->setJSON($response);
    }

    public function open_proevents($procode)
    {

        $data['pro'] = $this->projectsModel->where('procode', $procode)->first();
        $data['events'] = $this->proeventsModel->where('orgcode', session('orgcode'))->where('procode', $procode)->orderBy('eventdate', 'desc')->find();
        $data['eventfiles'] = $this->eventfilesModel->where('orgcode', session('orgcode'))->where('procode', $procode)->orderBy('id', 'desc')->find();

        $data['title'] = "Events";
        $data['menu'] = "projects";
        echo view('projects/open_proevents', $data);
    }


    //add events
    public function add_proevents()
    {

        $procode = $this->request->getPost('procode');
        $ucode = uniqid() . time();
        $data = [
            'ucode' => $ucode,
            'procode' => $this->request->getPost('procode'),
            'orgcode' => session('orgcode'),
            'event' => $this->request->getPost('event'),
            'eventdate' => $this->request->getPost('eventdate'),
            'create_by' => session('name'),
        ];


        $this->proeventsModel->insert($data);

        $getid = $this->proeventsModel->where('ucode', $ucode)->orderby('id', 'desc')->first();

        // Check if file is uploaded
        $files = $this->request->getFileMultiple('eventfiles');

        //echo ($getid['id']);
        //if (!empty($files)) :
        $x = 1;
        foreach ($files as $file) {
            if ($file && $file->isValid()) {

                // Generate a custom name for the file
                $newName = 'ev_' . $procode . "_" . time() . "-" . $x++ . "." . $file->getExtension();

                // Move uploaded file to the public/uploads directory
                $file->move(ROOTPATH . 'public/uploads/event_files/', $newName);

                // Save file path to database
                $data = [
                    'ucode' => uniqid() . time(),
                    'procode' => $this->request->getPost('procode'),
                    'orgcode' => session('orgcode'),
                    'event_id' => $getid['id'],
                    'filepath' => 'public/uploads/event_files/' . $newName,
                    'create_by' => session('name'),

                ];

                $this->eventfilesModel->insert($data);
            }
        }
        // endif;

        return redirect()->back()->with('success', 'Event Added');
    }


    //add events
    public function edit_proevents()
    {

        $id = $this->request->getPost('evid');

        $data = [
            'event' => $this->request->getPost('event'),
            'eventdate' => $this->request->getPost('eventdate'),
            'update_by' => session('name'),
        ];


        $this->proeventsModel->update($id, $data);

        /*  $getid = $this->proeventsModel->where('ucode', $ucode)->orderby('id', 'desc')->first();
 
         // Check if file is uploaded
         $files = $this->request->getFileMultiple('eventfiles');
         
         //echo ($getid['id']);
         //if (!empty($files)) :
             $x=1;
              foreach ($files as $file) {
                 if ($file && $file->isValid()) {
 
                     // Generate a custom name for the file
                     $newName = 'ev_' . $procode . "_" . time() ."-".$x++. "." . $file->getExtension();
 
                     // Move uploaded file to the public/uploads directory
                     $file->move(ROOTPATH . 'public/uploads/event_files/', $newName);
 
                     // Save file path to database
                     $data = [
                         'ucode' => uniqid() . time(),
                         'procode' => $this->request->getPost('procode'),
                         'orgcode' => session('orgcode'),
                         'event_id' => $getid['id'],
                         'filepath' => 'public/uploads/event_files/' . $newName,
                         'create_by' => session('name'),
 
                     ];
 
                     $this->eventfilesModel->insert($data);
                 }
             } 
        // endif;
 */
        return redirect()->back()->with('success', 'Event Changes Saved');
    }

    // AJAX method to get CSRF token
    public function get_csrf_token()
    {
        return $this->response->setJSON([
            'token' => csrf_token(),
            'hash' => csrf_hash()
        ]);
    }
}
