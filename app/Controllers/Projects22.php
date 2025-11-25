<?php

namespace App\Controllers;

use App\Models\contractorsModel;
use App\Models\countryModel;
use App\Models\districtModel;
use App\Models\eventfilesModel;
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

class Projects extends BaseController
{
    public $session;
    public $usersModel;

    public $countryModel;
    public $provinceModel;
    public $districtModel;
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



    public function __construct()
    {
        helper(['form', 'url', 'info']);
        $this->session = session();

        $this->usersModel = new usersModel();

        $this->countryModel = new countryModel();
        $this->settingsModel = new settingsModel();
        $this->provinceModel = new provinceModel();
        $this->districtModel = new districtModel();
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
    }

    /* 
    * index
    * create_road
    */

    public function index()
    {
        $data['title'] = "Projects List";
        $data['menu'] = "projects";

        $data['projects'] = $this->projectsModel->where('orgcode', session('orgcode'))->find();
        $data['fund'] = $this->profundModel->where('orgcode', session('orgcode'))->find();

        echo view('projects/projects_list', $data);
    }

    public function create_projects()
    {
        $data['title'] = "New Projects";
        $data['menu'] = "addprojects";

        //form submit
        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required',

        ])) {

            $ydate = $this->request->getVar('fund') . date('Y');
            $prov = $this->request->getVar('province');

            $findcode = $this->projectsModel->like('procode', $ydate . '%')->orderBy('id', 'desc')->first();

            $getcode = "pm". $prov . $ydate. "-01";

            if (!empty($findcode)) {
                $string = $findcode['procode'];
                $newString = preg_replace_callback('/(\d+)-(\d+)/', function ($matches) {
                    return $matches[1] . '-' . sprintf('%02d', intval($matches[2]) + 1);
                }, $string);

                $getcode = $newString; // Output: 202314-02

            }

            if (!empty($this->projectsModel->where('procode', $getcode)->orderBy('id', 'desc')->first())) {
                return redirect()->back()->with('error', 'Project Code already existed');
            }

            $ucode = uniqid() . time();

            $data = [
                'ucode' => $ucode,
                'procode' => $getcode,
                'orgcode' => session('orgcode'),
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
                /* 'budget' => $this->request->getVar('budget'),
                'fund' => $this->request->getVar('fund'), */
                'country' => $this->request->getVar('country'),
                'province' => $this->request->getVar('province'),
                'district' => $this->request->getVar('district'),
                'status' => "active",
                'create_by' => session('name'),
            ];

            $this->projectsModel->insert($data);

            return redirect()->to('open_projects/' . $ucode)->with('success', 'Project registered successfully!');
        }
        //default load
        $data['select'] = $this->selectModel->where('box', 'fund')->orderBy('item', 'asc')->find();
        //direct province retrieval without country dependency
        $data['get_provinces'] = $this->provinceModel->orderBy('name', 'asc')->find();

        echo view('projects/create_projects', $data);
    }

    
    public function open_projects($ucode)
    {

        
        $data['pro'] = $this->projectsModel->where('ucode', $ucode)->first();
        $procode = $data['pro']['procode'];
        $data['select'] = $this->selectModel->where('box', 'fund')->orderBy('item', 'asc')->find();
        //direct province retrieval without country dependency
        $data['get_provinces'] = $this->provinceModel->orderBy('name', 'asc')->find();
        $data['fund'] = $this->profundModel->where('procode', $procode)->where('orgcode', session('orgcode'))->find();
        $data['prodocs'] = $this->prodocsModel->where('procode', $procode)->where('orgcode', session('orgcode'))->orderBy('id', 'desc')->find();
        $data['phases'] = $this->prophaseModel->where('procode', $procode)->find();
        $data['milestones'] = $this->promilestonesModel->where('orgcode', session('orgcode'))->where('procode', $procode)->orderBy('id', 'desc')->find();
        $data['events'] = $this->proeventsModel->where('orgcode', session('orgcode'))->where('procode', $procode)->orderBy('eventdate', 'desc')->find();
        $data['eventfiles'] = $this->eventfilesModel->where('orgcode', session('orgcode'))->where('procode', $procode)->orderBy('id', 'desc')->find();
        $data['contractors'] = $this->contractorsModel->where('province', session('orgprov'))->orderBy('id', 'desc')->find();
        $data['pro_officers'] = $this->project_officersModel->where('orgcode', session('orgcode'))->orderBy('name', 'asc')->find();
        

        $data['title'] = "Settings: ". $data['pro']['procode'];
        $data['menu'] = "projects";
        echo view('projects/open_projects', $data);
    }


    public function edit_projects($procode)
    {


        //form submit
        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required',

        ])) {

            $data = [
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
                'budget' => $this->request->getVar('budget'),
                'fund' => $this->request->getVar('fund'),
                'country' => $this->request->getVar('country'),
                'province' => $this->request->getVar('province'),
                'district' => $this->request->getVar('district'),
                'update_by' => session('name'),
            ];

            $id = $this->request->getVar('proid');
            $this->projectsModel->update($id, $data);

            return redirect()->back()->with('success', 'Changes Saved');
        }

        //default load
        $data['pro'] = $this->projectsModel->where('procode', $procode)->first();
        $data['select'] = $this->selectModel->where('box', 'fund')->orderBy('item', 'asc')->find();
        //direct province retrieval without country dependency
        $data['get_provinces'] = $this->provinceModel->orderBy('name', 'asc')->find();
        $data['fund'] = $this->profundModel->where('procode', $procode)->where('orgcode', session('orgcode'))->find();
        $data['get_district'] = $this->districtModel->where('districtcode', $data['pro']['district'])->first();


        $data['title'] = "Edit: " . $data['pro']['procode'];
        $data['menu'] = "projects";
        echo view('projects/edit_projects', $data);
    }
    
    
    public function set_project_contractor()
    {
        $id = $this->request->getVar('pro_id');

        $getcontractor = $this->contractorsModel->where('id',$this->request->getVar('contractor'),)->first();
        if(empty($getcontractor)){
            return redirect()->back()->with('error', 'This contractor does not exist');
        }
        
        $data = [

            'contractor_id' => $this->request->getVar('contractor'),
            'contractor_code' => $getcontractor['concode'],
            'contractor_name' => $getcontractor['name'],
            'update_by' => session('name'),
        ];

        $this->projectsModel->update($id, $data);

        return redirect()->back()->with('success', 'Contractor Set!');
    }
    
    public function set_project_officers()
    {
        $id = $this->request->getVar('pro_id');

        $getofficer = $this->project_officersModel->where('id',$this->request->getVar('project_officers'),)->first();
        if(empty($getofficer)){
            return redirect()->back()->with('error', 'This Officer does not exist');
        }
        
        $data = [

            'pro_officer_id' => $this->request->getVar('project_officer'),
            'pro_officer_name' => $getofficer['name'],
            'update_by' => session('name'),
        ];

        $this->projectsModel->update($id, $data);

        return redirect()->back()->with('success', 'Project Officer Set');
    }
    
    public function edit_project_budget()
    {
        $id = $this->request->getVar('pro_id');

        $data = [

            'budget' => $this->request->getVar('budget'),
            'update_by' => session('name'),
        ];

        $this->projectsModel->update($id, $data);

        return redirect()->back()->with('success', 'Budget Updated');
    }


 
    public function pro_status()
    {
        $id = $this->request->getVar('proid');

        $data = [

            'status' => $this->request->getVar('status'),
            'statusnotes' => $this->request->getVar('statusnotes'),
            'update_by' => session('name'),
        ];

        $this->projectsModel->update($id, $data);

        return redirect()->back()->with('success', 'Status Updated');
    }


   
    
    //set gps coordinates kml upload
    public function gps_set()
    {
        $file = $this->request->getFile('file_basekml');
        $procode = $this->request->getPost('procode');
        $proid = $this->request->getPost('proid');
        $lat = $this->request->getPost('lat');
        $lon = $this->request->getPost('lon');
        $gps = $this->request->getPost('lat') . "," . $this->request->getPost('lon');

        $data = [
            'gps' => $gps,
            'lat' => $lat,
            'lon' => $lon,
        ];

        // Check if file is uploaded
        //$file = $this->request->getFile('file_payment');
        if ($file && $file->isValid()) {

            // Generate a custom name for the file
            $newName = $procode . "_" . time() . "." . $file->getExtension();

            // Move uploaded file to the public/uploads directory
            $file->move(ROOTPATH . 'public/uploads/gps_files/', $newName);

            // Save file path to database
            $data += [
                'filepath' => 'public/uploads/gps_files/' . $newName,
            ];
        }

        $this->projectsModel->update($proid, $data);

        return redirect()->back()->with('success', 'GPS Info Saved.');
    }


    //upload project documents
    public function prodocs_upload()
    {
        $file = $this->request->getFile('prodocs');
        $procode = $this->request->getPost('procode');
        $proid = $this->request->getPost('proid');
        $name = $this->request->getPost('name');

        if (!empty($file)) :
            // Validate the file
            if (!$file->isValid()) {
            }

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
            return redirect()->back()->with('success', 'Document Uploaded');

        endif;
    }

    //upload project documents
    public function prodocs_edit()
    {
        $file = $this->request->getFile('prodocs');
        $procode = $this->request->getPost('procode');
        $id = $this->request->getPost('pdid');
        $name = $this->request->getPost('name');

        if (!empty($file)) :
            // Validate the file
            if (!$file->isValid()) {
            }

            // Generate a custom name for the file
            $newName = 'prodocs_' . $procode . "_" . time() . "." . $file->getExtension();

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
            $this->prodocsModel->update($id, $data);

            return redirect()->back()->with('success', 'Document Uploaded');

        endif;
    }

    
    
    //get addresses
    public function getaddress()
    {

        //$prov = new provinceModel();
        //$district = new districtModel();
        $country_id = $this->request->getVar('country_id');
        $prov_code = $this->request->getVar('province_code');
        if (isset($country_id)) {
            $data['province'] = $this->provinceModel->where('country_id', $country_id)->find();
            // $data['math'] = 5 + $country_id;
        }
        if (isset($prov_code)) {
            $prov_id = $this->provinceModel->where('provincecode', $prov_code)->first();
            $data['district'] = $this->districtModel->where('province_id', $prov_id['id'])->find();
            // $data['math'] = 5 + $prov_id;
        }

        return json_encode($data);
    }

    
}
