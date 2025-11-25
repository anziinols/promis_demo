<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\basefilesModel;
use App\Models\countryModel;
use App\Models\districtModel;
use App\Models\eventsModel;
use App\Models\provinceModel;
use App\Models\roadsModel;
use App\Models\usersModel;
use Ol\format\KML;

class Test extends BaseController
{
    public $session;
    public $usersModel;
    public $eventsModel;

    public function __construct()
    {
        helper(['form', 'url', 'info']);
        $this->session = session();

        $this->usersModel = new usersModel();
    }

    public function index()
    {
        $data['title'] = "TestAir";
        $data['menu'] = "home";
        $data['data'] = $this->eventsModel->orderby('start', 'asc')->findAll();
        $data['events'] = array();

        foreach ($data['data'] as $ev) :

            $getstart = strstr($ev['start'], " ", true);

            $getend = strstr($ev['end'], " ", true);

            $start = ltrim(date('Y-m-d', strtotime('-1 month', strtotime($getstart))), "-");
            $end = ltrim(date('Y-m-d', strtotime('-1 month', strtotime($getend))), "-");

            // echo $start . "<br>";

            $data['events'][] = "startDate: new Date(" . str_replace("-", ",", $start) . ")," .
                "endDate: new Date(" . str_replace("-", ",", $end) . ")," .
                "color:'" . $ev['backgroundColor'] . "',";
        endforeach;

        echo view('testair/ajaxtest', $data);
    }

    public function ajaxform()
    {

        $data['title'] = "TestAir";

        $model = new countryModel();
        $data['country'] = $model->findAll();
        echo view('testair/ajaxform', $data);
    }

    public function ajax()
    {

        $prov = new provinceModel();
        $district = new districtModel();
        $country_id = $this->request->getVar('country_id');
        $prov_id = $this->request->getVar('province_id');
        if (isset($country_id)) {
            $data['province'] = $prov->where('country_id', $country_id)->find();
            $data['math'] = 5 + $country_id;
        }
        if (isset($prov_id)) {
            $data['district'] = $district->where('province_id', $prov_id)->find();
            $data['math'] = 5 + $prov_id;
        }




        return json_encode($data);
    }

    public function testmap22()
    {
        $kml = new basefilesModel();
        $data['kml'] = $kml->orderBy('create_at', 'desc')->first();


        // Set the file path of the KML file
        //$kmlFile = FCPATH . 'public/uploads/base_files/DR1404-1_1678661607.kml';
        //$kmlFile ='http://localhost/rims/public/uploads/base_files/DR1404-1_1678661607.kml';
        //echo "'".$data['kml']['filepath']."'";
        $kmlFile = $data['kml']['filepath'];
        // Load the KML file
        //$kmlFile = 'path/to/your/file.kml';
        $kmlString = file_get_contents($kmlFile);

        // Parse the KML file
        $doc = new \DOMDocument();
        $doc->loadXML($kmlString);

        // Get the coordinates from the KML file
        $coordinates = [];
        $kmlCoords = $doc->getElementsByTagName("coordinates")[0]->nodeValue;
        $kmlCoords = explode(" ", trim($kmlCoords));
        foreach ($kmlCoords as $kmlCoord) {
            $lnglat = explode(",", trim($kmlCoord));
            $coordinates[] = [floatval($lnglat[1]), floatval($lnglat[0])];
        }

        // Pass the coordinates to the view
        $data['coordinates'] = $coordinates;

        // Render the map view
        //return view('map', $data);
        $data['title'] = "Test Map";
        echo view('testair/testmap', $data);
    }

    public function testmap21()
    {
        $kml = new basefilesModel();
        $data['kml'] = $kml->orderBy('create_at', 'desc')->first();


        // Set the file path of the KML file
        //$kmlFile = FCPATH . 'public/uploads/base_files/DR1404-1_1678661607.kml';
        //$kmlFile ='http://localhost/rims/public/uploads/base_files/DR1404-1_1678661607.kml';
        $kmlFile = $data['kml']['filepath'];
        //echo "'".$data['kml']['filepath']."'";

        $data['kmlurl'] = $kmlFile;

        $kmlString = file_get_contents($kmlFile);

        // Parse the KML file
        $doc = new \DOMDocument();
        $doc->loadXML($kmlString);

        // Get the coordinates from the KML file
        $coordinates = [];
        $kmlCoords = $doc->getElementsByTagName("coordinates")[0]->nodeValue;
        $kmlCoords = explode(" ", trim($kmlCoords));
        foreach ($kmlCoords as $kmlCoord) {
            $lnglat = explode(",", trim($kmlCoord));
            $coordinates[] = [floatval($lnglat[1]), floatval($lnglat[0])];
        }

        // Pass the coordinates to the view
        $data['coordinates'] = $coordinates;


        // Render the map view
        //return view('map', $data);
        $data['title'] = "Test Map";
        echo view('testair/testmap', $data);
    }


    public function testmap()
    {
        
        
        
        // Load the KML file from the database
        $kml = new basefilesModel();
        $data['kml'] = $kml->orderBy('create_at', 'desc')->first();
        
       // $kmlFile ='http://localhost/rims/public/uploads/base_files/DR1404-1_1678661607.kml';
       
      

        $data['title'] = "Test Map";
        echo view('testair/testmap', $data);
    }
    
    public function test_view()
    {
        
        $data['title'] = "test view title";
        $data['menu'] = "reports";
        echo view('testair/test_viewpdf',$data);
    }
}
