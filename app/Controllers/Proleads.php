<?php

namespace App\Controllers;

use App\Models\contractorsFilesModel;
use App\Models\contractorsModel;
use App\Models\contractorsNoticesModel;
use App\Models\countryModel;
use App\Models\districtModel;
use App\Models\eventfilesModel;
use App\Models\llgModel;
use App\Models\prodocsModel;
use App\Models\proeventsModel;
use App\Models\profundModel;
use App\Models\projectsModel;
use App\Models\promilestonesModel;
use App\Models\prophasesModel;
use App\Models\provinceModel;
use App\Models\selectionModel;
use App\Models\settingsModel;
use App\Models\usersModel;

//project leaders and contractors
class Proleads extends BaseController
{
    public $session;
    public $usersModel;

    public $countryModel;
    public $provinceModel;
    public $districtModel;
    public $llgsModel;
    public $settingsModel;
    public $selectModel;
    public $projectsModel;



    public $contractorsModel;
    public $conFilesModel;
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
        $this->llgsModel = new llgModel();
        $this->selectModel = new selectionModel();
        $this->projectsModel = new projectsModel();

        $this->contractorsModel = new contractorsModel();
        $this->conFilesModel = new contractorsFilesModel();
        $this->conNoticeModel = new contractorsNoticesModel();
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

        echo view('projects/projects_list', $data);
    }

    public function contractors_list()
    {
        // Optimized data retrieval
        $data['con_category'] = $this->selectModel->where('box', 'con_cat')->orderBy('item', 'asc')->find();
        
        // Get all provinces
        $data['get_provinces'] = $this->provinceModel->orderBy('name', 'asc')->find();
        
        // Get contractors and notices
        $data['contractors'] = $this->contractorsModel->orderBy('name', 'asc')->find();
        $data['notices'] = $this->conNoticeModel->orderBy('notice_date', 'desc')->find();
        
        $data['title'] = "Contractors List";
        $data['menu'] = "contractors";
        echo view('proleads/contractors_list', $data);
    }

    public function contractors_new()
    {

        $data['con_cat'] = $this->selectModel->where('box', 'con_cat')->orderBy('item', 'asc')->find();
        $data['get_provinces'] = $this->provinceModel->orderBy('name', 'asc')->find();

        $data['title'] = "Register Contractors";
        $data['menu'] = "contractors";
        echo view('proleads/new_contractors', $data);
    }

    //create contractor
    public function create_contractor()
    {

        $concode = '';

        do {
            $concode = $this->request->getPost('province') . rand(1001, 9999);
        } while ($this->contractorsModel->where('concode', $concode)->first());


        $ucode = uniqid() . time();
        $data = [
            'ucode' => $ucode,
            'concode' => $concode,
            'name' => $this->request->getPost('name'),
            'category' => $this->request->getPost('category'),
            'services' => $this->request->getPost('services'),
            'country' => $this->request->getPost('country'),
            'province' => $this->request->getPost('province'),
            'district' => $this->request->getPost('district'),
            'llg' => $this->request->getPost('llg'),
            'status' => "active",
            'create_by' => session('name'),
            'create_org' => session('orgname'),
        ];

        $this->contractorsModel->insert($data);

        

        

        return redirect()->to(base_url() . "open_contractor/" . $ucode)->with('success', '<b>' . $this->request->getPost('name') . '</b> Registered!');
    }


    //create contractor
    public function update_contractor()
    {

        $id = $this->request->getPost('id');
        $data = [
            'name' => $this->request->getPost('name'),
            'category' => $this->request->getPost('category'),
            'services' => $this->request->getPost('services'),

            'country' => $this->request->getPost('country'),
            'province' => $this->request->getPost('province'),
            'district' => $this->request->getPost('district'),
            'llg' => $this->request->getPost('llg'),
            'update_by' => session('name'),
            'update_org' => session('orgname'),
        ];

        $this->contractorsModel->update($id, $data);

        return redirect()->back()->with('success', 'Change Saved!');
    }
    
     //update contractor contacts
     public function update_con_contacts()
     {
 
         $id = $this->request->getPost('id');
         $data = [
             'phones' => $this->request->getPost('phones'),
             'emails' => $this->request->getPost('emails'),
             'address' => $this->request->getPost('address'),
             'weblinks' => $this->request->getPost('weblinks'),
             'update_by' => session('name'),
             'update_org' => session('orgname'),
         ];
 
         $this->contractorsModel->update($id, $data);
 
         return redirect()->back()->with('success', 'Change Saved!');
     }
 

    public function open_contractor($ucode)
    {

        $data['con'] = $this->contractorsModel->where('ucode', $ucode)->first();
        $data['set_country'] = $this->countryModel->where('code', $data['con']['country'])->first();
        $data['get_provinces'] = $this->provinceModel->where('provincecode', $data['con']['province'])->first();
        $data['get_districts'] = $this->districtModel->where('districtcode', $data['con']['district'])->first();
        $data['get_llgs'] = $this->llgsModel->where('llgcode', $data['con']['llg'])->first();

        $data['con_files'] = $this->conFilesModel->where('concode', $data['con']['concode'])->find();
        $data['projects'] = $this->projectsModel->where('contractor_code', $data['con']['concode'])->find();
        $data['notices'] = $this->conNoticeModel->where('concode', $data['con']['concode'])->orderBy('create_at', 'desc')->find();

        $data['title'] = "Contractor: " . $data['con']['concode'];
        $data['menu'] = "contractors";
        echo view('proleads/open_contractors', $data);
    }


    //contractor files
    public function create_con_files()
    {
        $concode = $this->request->getPost('concode');
        $file_name = $this->request->getPost('file_name');
        if (!empty($this->request->getPost('others'))) {
            $file_name = $this->request->getPost('others');
        }

        $ucode = uniqid() . time();
        $data = [
            'ucode' => $ucode,
            'concode' => $concode,
            'file_name' => $file_name,
            'file_number' => $this->request->getPost('file_number'),
            'issued_date' => $this->request->getPost('issued_date'),
            'expiry_date' => $this->request->getPost('expiry_date'),

            'status' => "active",
            'create_by' => session('name'),
            'create_org' => session('orgname'),
        ];

        $this->conFilesModel->insert($data);

        $getid = $this->conFilesModel->where('ucode', $ucode)->orderby('id', 'desc')->first();

        // doc file
        $docfile = $this->request->getFile('doc_file');

        if ($docfile && $docfile->isValid()) {

            // Generate a custom name for the file
            $newName = 'con_file' . $concode . "_" . time() . "." . $docfile->getExtension();

            // Move uploaded file to the public/uploads directory
            $docfile->move(ROOTPATH . 'public/uploads/contractors_files/', $newName);

            // Save file path to database
            $data = [
                'file_path' => 'public/uploads/contractors_files/' . $newName,
            ];

            $this->conFilesModel->update($getid['id'], $data);
        }

        return redirect()->back()->with('success', 'File Saved!');
    }


    //contractor files update
    public function update_con_files()
    {
        $id = $this->request->getPost('id');
        $concode = $this->request->getPost('concode');
        $file_name = $this->request->getPost('file_name');
        if (!empty($this->request->getPost('others'))) {
            $file_name = $this->request->getPost('others');
        }

        $data = [
            'file_name' => $file_name,
            'file_number' => $this->request->getPost('file_number'),
            'issued_date' => $this->request->getPost('issued_date'),
            'expiry_date' => $this->request->getPost('expiry_date'),

            'status' => "active",
            'update_by' => session('name'),
            'update_org' => session('orgname'),
        ];

        $this->conFilesModel->update($id, $data);


        // doc file
        $docfile = $this->request->getFile('doc_file');


        if ($docfile && $docfile->isValid()) {

            // Generate a custom name for the file
            $newName = 'con_file' . $concode . "_" . time() . "." . $docfile->getExtension();

            // Move uploaded file to the public/uploads directory
            $docfile->move(ROOTPATH . 'public/uploads/contractors_files/', $newName);

            // Save file path to database
            $data = [
                'file_path' => 'public/uploads/contractors_files/' . $newName,
            ];

            $this->conFilesModel->update($id, $data);
        }

        return redirect()->back()->with('success', 'Changes Saved!');
    }


    //contractor files delete
    public function delete_con_files()
    {
        $id = $this->request->getPost('id');

        $this->conFilesModel->delete($id);

        return redirect()->back()->with('success', 'File Deleted!');
    }

    //contractor update logo
    public function update_con_logo()
    {
        $id = $this->request->getPost('id');
        $concode = $this->request->getPost('concode');


        // doc file
        $docfile = $this->request->getFile('logo_file');


        if ($docfile && $docfile->isValid()) {

            // Generate a custom name for the file
            $newName = 'con_logo' . $concode . "_" . time() . "." . $docfile->getExtension();
            // Move uploaded file to the public/uploads directory
            $docfile->move(ROOTPATH . 'public/uploads/contractors_files/', $newName);
            // Save file path to database
            $data = [
                'con_logo' => 'public/uploads/contractors_files/' . $newName,
            ];
            $this->contractorsModel->update($id, $data);
        }

        return redirect()->back()->with('success', 'Logo Uploaded!');
    }

    public function edit_contractors($ucode)
    {

        $data['con'] = $this->contractorsModel->where('ucode', $ucode)->first();
        $data['get_province'] = $this->provinceModel->where('provincecode', $data['con']['province'])->first();
        $data['get_district'] = $this->districtModel->where('districtcode', $data['con']['district'])->first();
        $data['get_llg'] = $this->llgsModel->where('llgcode', $data['con']['llg'])->first();

        $data['con_cat'] = $this->selectModel->where('box', 'con_cat')->orderBy('item', 'asc')->find();
        $data['get_provinces'] = $this->provinceModel->orderBy('name', 'asc')->find();


        $data['title'] = "Contractor: " . $data['con']['concode'];
        $data['menu'] = "contractors";
        echo view('proleads/edit_contractors', $data);
    }
    
     //contractor notices
     public function create_con_notices()
     {
         $id = $this->request->getPost('id');
         $concode = $this->request->getPost('concode');
 
         $getcon = $this->contractorsModel->where('concode', $concode)->first();
         // doc file
         $docfile = $this->request->getFile('notice_file');
 
         if ($docfile && $docfile->isValid()) {
 
             // Generate a custom name for the file
             $newName = 'con_notice' . $concode . "_" . time() . "." . $docfile->getExtension();
             // Move uploaded file to the public/uploads directory
             $docfile->move(ROOTPATH . 'public/uploads/contractors_files/', $newName);
             // Save file path to database
             $data = [
                 'concode' => $concode,
                 'notice_flag' => $this->request->getPost('notice_flag'),
                 'notice_title' => $this->request->getPost('notice_title'),
                 'notice_description' => $this->request->getPost('notice_description'),
                 'notice_date' => $this->request->getPost('notice_date'),
                 'file_path' => 'public/uploads/contractors_files/' . $newName,
                 'create_by'=> session('name'),
                 'create_org'=> session('orgname'),
             ];
             $this->conNoticeModel->insert($data);
             
             $condata = [
                'notice_flag' => $this->request->getPost('notice_flag'),
                'update_by'=> session('name'),
                'update_org'=> session('orgname'),
            ];
            $this->contractorsModel->update($getcon['id'], $condata);
         }
 
         return redirect()->back()->with('success', 'Notice Posted!');
     }
 
}
