<?php

namespace App\Controllers;

use App\Models\basefilesModel;
use App\Models\countryModel;
use App\Models\districtModel;
use App\Models\eventsModel;
use App\Models\provinceModel;
use App\Models\roadsModel;
use App\Models\selectionModel;
use App\Models\settingsModel;
use App\Models\usersModel;

class Roads extends BaseController
{
    public $session;
    public $usersModel;
    public $roadsModel;
    public $countryModel;
    public $provinceModel;
    public $districtModel;
    public $settingsModel;
    public $selectModel;
    public $basefileModel;

    public function __construct()
    {
        helper(['form', 'url', 'info']);
        $this->session = session();

        $this->usersModel = new usersModel();
        $this->roadsModel = new roadsModel();
        $this->countryModel = new countryModel();
        $this->settingsModel = new settingsModel();
        $this->provinceModel = new provinceModel();
        $this->districtModel = new districtModel();
        $this->selectModel = new selectionModel();
        $this->basefileModel = new basefilesModel();
    }

    /* 
    * index
    * create_road
    */

    public function index()
    {
        $data['title'] = "Road List";
        $data['menu'] = "roads";

        $data['roads'] = $this->roadsModel->findAll();

        echo view('roads/road_list', $data);
    }

    public function create_road()
    {
        $data['title'] = "New Road";
        $data['menu'] = "addroads";

        //form submit
        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required',
            'description' => 'permit_empty',
            'country' => 'required',
            'province' => 'required',
            'district' => 'permit_empty',
            // 'length' => 'numeric',
            // 'num_lanes' => 'numeric',
            'class' => 'required',
        ])) {

            $class = $this->request->getVar('class');
            $prov = $this->request->getVar('province');
            $district = $this->request->getVar('district');
            $data['getcode'] = "";
            $getcode = "";
            if (($class == "DR" || $class == "PR")) {
                //return redirect()->to(base_url()."roads");
                $getcode = $class . $district;
                $data['getcode'] = $this->roadsModel->like('roadcode', $getcode)->orderBy('created_at', 'desc')->first();
            } else {
                //return redirect()->to(base_url()."roads");
                $getcode = $class . $prov;
                $data['getcode'] = $this->roadsModel->like('roadcode', $getcode)->orderBy('created_at', 'desc')->first();
            }

            $setcode = "";
            if (empty($data['getcode'])) {
                $setcode = $getcode . "-1";
            } else {

                $string = $data['getcode']['roadcode'];
                $parts = explode('-', $string);
                $numbers = $parts[1];
                $setcode = $getcode . "-" . ($numbers + 1);
            }

            $roadcode = $setcode;

            $data = [
                'roaducode' => uniqid() . time(),
                'roadcode' => $roadcode,
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
                'country' => $this->request->getVar('country'),
                'province' => $this->request->getVar('province'),
                'district' => $this->request->getVar('district'),
                'length' => $this->request->getVar('length'),
                'num_lanes' => $this->request->getVar('num_lanes'),
                'class' => $this->request->getVar('class'),
            ];

            $this->roadsModel->insert($data);

            return redirect()->to('roads')->with('success', 'Road registered successfully!');
        }
        //default load
        $data['select'] = $this->selectModel->where('box', 'roadclass')->orderBy('item', 'asc')->find();
        //direct province retrieval without country dependency
        $data['get_provinces'] = $this->provinceModel->orderBy('name', 'asc')->find();

        echo view('roads/create_road', $data);
    }

    public function open_road($ucode)
    {



        //default load
        $data['select'] = $this->selectModel->where('box', 'roadclass')->orderBy('item', 'asc')->find();
        //direct province retrieval without country dependency
        $data['get_provinces'] = $this->provinceModel->orderBy('name', 'asc')->find();

        $data['road'] = $this->roadsModel->where('roaducode', $ucode)->first();
        $data['kml'] = $this->basefileModel->where('road_code',$data['road']['roadcode'])->orderBy('create_at','desc')->first();
        $data['basefileall'] = $this->basefileModel->where('road_code',$data['road']['roadcode'])->orderBy('create_at','desc')->findAll();

         
        //=============== GET BASE MAP ===========================
       
        

        //=============== END GET BASE MAP =======================
        
        $data['title'] = $data['road']['roadcode'];
        $data['menu'] = "roads";
        echo view('roads/open_road', $data);
    }

    public function basefile_upload()
{
    $file = $this->request->getFile('file_basekml');
    $roadcode = $this->request->getPost('roadcode');
    $roadid = $this->request->getPost('roadid');

    // Validate the file
    if (!$file->isValid() || $file->getExtension() != 'kml') {
        return redirect()->back()->with('error', 'Please select a valid KML file.');
    }

    // Generate a custom name for the file
    $newName = $roadcode."_".time().'.kml';

    // Move the uploaded file to the uploads folder with the new name
    $file->move(ROOTPATH . 'public/uploads/base_files/', $newName);

    // Insert the file path into the database
    $data = [
        'name' =>$newName,
        'filepath' => 'public/uploads/base_files/' . $newName,
        'road_code' => $roadcode,
        'road_id' => $roadid,
        'created_at' => date('Y-m-d H:i:s')
    ];
    $this->basefileModel->insert($data);

    return redirect()->back()->with('success', 'File uploaded successfully.');
}







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
