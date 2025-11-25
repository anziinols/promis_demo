<?php

namespace App\Controllers;

use App\Models\countryModel;
use App\Models\districtModel;
use App\Models\kmlfilesModel;
use App\Models\orgModel;
use App\Models\profundModel;
use App\Models\project_officersModel;
use App\Models\projectsModel;
use App\Models\promilestonesModel;
use App\Models\prophasesModel;
use App\Models\provinceModel;
use App\Models\usersModel;

class Home extends BaseController
{
    public $session;
    public $usersModel;
    public $orgModel;
    public $projectsModel;
    public $project_officersModel;
    public $paymentsModel;
    public $milestonesModel;
    public $phasesModel;
    public $countryModel;
    public $provinceModel;
    public $districtModel;
    public $kmlfilesModel;


    public function __construct()
    {
        helper(['form', 'url', 'info']);
        $this->session = session();

        $this->usersModel = new usersModel();
        $this->orgModel = new orgModel();
        $this->projectsModel = new projectsModel();
        $this->project_officersModel = new project_officersModel();
        $this->paymentsModel = new profundModel();
        $this->milestonesModel = new promilestonesModel();
        $this->phasesModel = new prophasesModel();
        $this->districtModel = new districtModel();
        $this->provinceModel = new provinceModel();
        $this->countryModel = new countryModel();
        $this->kmlfilesModel = new kmlfilesModel();
    }

    public function index()
    {
        $data['title'] = "Home";
        $data['menu'] = "home";

        // Optimized: Only fetch necessary fields for map display including status for color coding
        $data['pro'] = $this->projectsModel->select('id, ucode, procode, name, kmlfile, gps, lat, lon, status')->findAll();

        echo view('home/home', $data);
    }

    public function projects_list()
    {
        $data['title'] = "Projects List";
        $data['menu'] = "projects_list";

        // Optimized: Use joins and aggregation to reduce queries
        // Get projects with aggregated payment data
        $db = \Config\Database::connect();

        // Single query with LEFT JOINs to get all project data with aggregated payments and milestones
        $builder = $db->table('projects p');
        $builder->select('p.*,
            COALESCE(SUM(pf.amount), 0) as total_payments,
            COUNT(DISTINCT pm.id) as total_milestones,
            COUNT(DISTINCT CASE WHEN pm.status = "completed" OR pm.checked = "completed" THEN pm.id END) as completed_milestones');
        $builder->join('profund pf', 'pf.procode = p.procode', 'left');
        $builder->join('project_milestones pm', 'pm.procode = p.procode', 'left');
        $builder->groupBy('p.id');
        $builder->orderBy('p.procode', 'ASC');

        $data['projects'] = $builder->get()->getResultArray();

        echo view('home/home_projects_list', $data);
    }

    public function home_project_one_view($ucode)
    {

        $data['pro'] = $this->projectsModel->where('ucode', $ucode)->first();
        $data['milestones'] = $this->milestonesModel->where('procode', $data['pro']['procode'])->find();
        $data['kmlfiles'] = $this->kmlfilesModel->where('proucode', $ucode)->find();

        $data['ms_pending'] = $data['ms_completed'] = $data['ms_hold'] = $data['ms_canceled'] = 0;
        foreach ($data['milestones'] as $ms) {
            // Use status field if available, otherwise fall back to checked field
            $milestoneStatus = $ms['status'] ?? $ms['checked'];

            if ($milestoneStatus == "pending") {
                $data['ms_pending'] += 1;
            }
            if ($milestoneStatus == "completed") {
                $data['ms_completed'] += 1;
            }
            if ($milestoneStatus == "hold") {
                $data['ms_hold'] += 1;
            }
            if ($milestoneStatus == "canceled") {
                $data['ms_canceled'] += 1;
            }
        }

        // ms percentage = (ms_completed/ms_total)*100
        $data['ms_pending_percentage'] = $data['ms_completed_percentage'] = $data['ms_hold_percentage'] = $data['ms_canceled_percentage'] = 0;
        //check divisible by zero
        if (count($data['milestones']) > 0) {
            //check for zero
            if ($data['ms_pending'] > 0) {
                $data['ms_pending_percentage'] = ($data['ms_pending'] / count($data['milestones'])) * 100;
            } else {
                $data['ms_pending_percentage'] = 0;
            }
            if ($data['ms_completed'] > 0) {
                $data['ms_completed_percentage'] = ($data['ms_completed'] / count($data['milestones'])) * 100;
            } else {
                $data['ms_completed_percentage'] = 0;
            }
            if ($data['ms_hold'] > 0) {
                $data['ms_hold_percentage'] = ($data['ms_hold'] / count($data['milestones'])) * 100;
            } else {
                $data['ms_hold_percentage'] = 0;
            }
            if ($data['ms_canceled'] > 0) {
                $data['ms_canceled_percentage'] = ($data['ms_canceled'] / count($data['milestones'])) * 100;
            } else {
                $data['ms_canceled_percentage'] = 0;
            }
        }


        $data['phases'] = $this->phasesModel->where('procode', $data['pro']['procode'])->find();
        //address
        $data['country'] = $this->countryModel->where('code', $data['pro']['country'])->first();
        $data['province'] = $this->provinceModel->where('provincecode', $data['pro']['province'])->first();
        $data['dist'] = $this->districtModel->where('districtcode', $data['pro']['district'])->first();

        $data['title'] = "Project";
        $data['menu'] = "home";

        //echo "<pre>";
        //print_r($data['phases']);

        echo view('home/home_project_one_view', $data);
    }

    public function about()
    {
        $data['title'] = "About Org.Calendar";
        $data['menu'] = "about";
        echo view('home/about', $data);
    }

    public function login()
    {
        // Only process POST requests
        if ($this->request->getMethod() !== 'post') {
            // Display login form
            $data['title'] = "Login";
            $data['menu'] = "login";
            echo view('home/login', $data);
            return;
        }

        // Validate form data
        $rules = [
            'username' => 'required|alpha_numeric_space|min_length[3]',
            'password' => 'required|min_length[4]'
        ];
        
        if (!$this->validate($rules)) {
            $this->session->setTempdata('error', 'Please enter valid username and password', 2);
            return redirect()->to(current_url());
        }

        // Retrieve form data (sanitized)
        $username = trim($this->request->getVar('username'));
        $password = $this->request->getVar('password');

        // Single optimized query to get user with necessary fields
        $user = $this->usersModel
            ->select('id, username, password, name, role, is_active, orgcode')
            ->where('username', $username)
            ->first();

        // Check if user exists and has orgcode
        if (!$user) {
            $this->session->setTempdata('error', 'Invalid username or password', 2);
            return redirect()->to(current_url());
        }

        // Verify orgcode exists
        if (empty($user['orgcode'])) {
            $this->session->setTempdata('error', 'Username is not associated with any organization', 2);
            return redirect()->to(current_url());
        }

        // Verify password
        if (!password_verify($password, $user['password'])) {
            $this->session->setTempdata('error', 'Invalid username or password', 2);
            return redirect()->to(current_url());
        }

        // Get organization details in one query
        $org = $this->orgModel
            ->select('name, orgcode, orglogo, is_active, loc_code_locked, loc_name_locked, loc_level_locked, center_gps_longitude, center_gps_latitude, center_gps_zoom')
            ->where('orgcode', $user['orgcode'])
            ->first();

        // Check if organization exists
        if (!$org) {
            $this->session->setTempdata('error', 'Organization not found. Contact administrator', 2);
            return redirect()->to(current_url());
        }

        // Check organization status: 1 = active, 0 = inactive
        if ($org['is_active'] != '1' && $org['is_active'] != 1) {
            $this->session->setTempdata('error', 'Your Organization is currently inactive (Status: 0). Contact Dakoii Systems to activate your organization', 2);
            return redirect()->to(current_url());
        }

        // Check user account status
        if ($user['is_active'] != '1' && $user['is_active'] != 1) {
            $this->session->setTempdata('error', 'Your account is inactive. Contact your organization administrator', 2);
            return redirect()->to(current_url());
        }

        // Store user data in session
        $this->session->set('username', $user['username']);
        $this->session->set('name', $user['name']);
        $this->session->set('role', $user['role']);
        $this->session->set('status', $user['is_active']);
        $this->session->set('orgname', $org['name']);
        $this->session->set('orglogo', $org['orglogo']);
        $this->session->set('orgcode', $org['orgcode']);
        $this->session->set('org_lock_code', $org['loc_code_locked']);
        $this->session->set('org_lock_name', $org['loc_name_locked']);
        $this->session->set('org_lock_level', $org['loc_level_locked']);
        $this->session->set('org_cgps_lon', $org['center_gps_longitude']);
        $this->session->set('org_cgps_lat', $org['center_gps_latitude']);
        $this->session->set('org_cgps_zoom', $org['center_gps_zoom']);
        $this->session->set('is_logged_in', "yes");

        // Redirect to dashboard
        $this->session->setTempdata('success', 'Login successful! Welcome back', 2);
        return redirect()->to('dashboard');
    }


    public function login_po()
    {
        // Only process POST requests
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('login');
        }

        // Validate form data
        $rules = [
            'username' => 'required|alpha_numeric_space|min_length[3]',
            'password' => 'required|min_length[4]'
        ];
        
        if (!$this->validate($rules)) {
            $this->session->setTempdata('error', 'Please enter valid username and password', 2);
            return redirect()->to('login');
        }

        // Retrieve form data (sanitized)
        $username = trim($this->request->getVar('username'));
        $password = $this->request->getVar('password');

        // Single optimized query to get user with necessary fields
        $user = $this->project_officersModel
            ->select('id, username, password, name, pocode, status, orgcode')
            ->where('username', $username)
            ->first();

        // Check if user exists and has orgcode
        if (!$user) {
            $this->session->setTempdata('error', 'Invalid username or password', 2);
            return redirect()->to('login');
        }

        // Verify orgcode exists
        if (empty($user['orgcode'])) {
            $this->session->setTempdata('error', 'Username is not associated with any organization', 2);
            return redirect()->to('login');
        }

        // Verify password
        if (!password_verify($password, $user['password'])) {
            $this->session->setTempdata('error', 'Invalid username or password', 2);
            return redirect()->to('login');
        }

        // Get organization details in one query
        $org = $this->orgModel
            ->select('name, orgcode, orglogo, is_active, center_gps_longitude, center_gps_latitude, center_gps_zoom')
            ->where('orgcode', $user['orgcode'])
            ->first();

        // Check if organization exists
        if (!$org) {
            $this->session->setTempdata('error', 'Organization not found. Contact administrator', 2);
            return redirect()->to('login');
        }

        // Check organization status: 1 = active, 0 = inactive
        if ($org['is_active'] != '1' && $org['is_active'] != 1) {
            $this->session->setTempdata('error', 'Your Organization has been deactivated (Status: 0). Contact Dakoii Systems', 2);
            return redirect()->to('login');
        }

        // Check user account status
        if ($user['status'] != 'active') {
            $this->session->setTempdata('error', 'Your account is not active. Contact your organization administrator', 2);
            return redirect()->to('login');
        }

        // Store user data in session
        $this->session->set('userid', $user['id']);
        $this->session->set('username', $user['username']);
        $this->session->set('name', $user['name']);
        $this->session->set('pocode', $user['pocode']);
        $this->session->set('status', $user['status']);
        $this->session->set('orgname', $org['name']);
        $this->session->set('orglogo', $org['orglogo']);
        $this->session->set('orgcode', $org['orgcode']);
        $this->session->set('org_cgps_lon', $org['center_gps_longitude']);
        $this->session->set('org_cgps_lat', $org['center_gps_latitude']);
        $this->session->set('org_cgps_zoom', $org['center_gps_zoom']);
        $this->session->set('is_logged_in', "yes");

        // Redirect to dashboard
        $this->session->setTempdata('success', 'Login successful! Welcome back', 2);
        return redirect()->to('po_dash');
    }






    public function logout()
    {
        // Destroy the user's session
        $session = session();
        $session->destroy();

        // Redirect to the login page
        return redirect()->to(base_url());
    }
}
