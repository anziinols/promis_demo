<?php

namespace App\Controllers;

use App\Models\countryModel;
use App\Models\dakoiiUsersModel;
use App\Models\districtModel;
use App\Models\llgModel;
use App\Models\orgModel;
use App\Models\provinceModel;
use App\Models\usersModel;

class Dakoii extends BaseController
{
    public $session;
    public $dusersModel;
    public $usersModel;
    public $orgModel;
    public $countryModel;
    public $provinceModel;
    public $districtModel;
    public $llgModel;


    public function __construct()
    {
        helper(['form', 'url', 'info']);
        $this->session = session();
        $this->dusersModel = new dakoiiUsersModel();
        $this->usersModel = new usersModel();
        $this->orgModel = new orgModel();
        $this->countryModel = new countryModel();
        $this->provinceModel = new provinceModel();
        $this->districtModel = new districtModel();
        $this->llgModel = new llgModel();
    }

    public function index()
    {
        $data['title'] = "Dakoii Admin";
        $data['menu'] = "dlogin";



        echo view('dakoii/login', $data);
    }

    public function login()
    {
        // Only process POST requests
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('dakoii');
        }

        // Validate form data
        $rules = [
            'username' => 'required|alpha_numeric_space|min_length[3]',
            'password' => 'required|min_length[4]'
        ];
        
        if (!$this->validate($rules)) {
            $this->session->setTempdata('error', 'Please enter valid username and password', 2);
            return redirect()->to('dakoii');
        }

        // Retrieve form data (sanitized)
        $username = trim($this->request->getVar('username'));
        $password = $this->request->getVar('password');

        // Single optimized query to get user by username
        $user = $this->dusersModel
            ->select('id, username, password, name, role, is_active')
            ->where('username', $username)
            ->first();

        // Check if user exists and password is correct in one step
        if (!$user || !password_verify($password, $user['password'])) {
            $this->session->setTempdata('error', 'Invalid username or password', 2);
            return redirect()->to('dakoii');
        }

        // Check if user account is active
        if ($user['is_active'] != '1') {
            $this->session->setTempdata('error', 'Your account is inactive. Please contact the administrator', 2);
            return redirect()->to('dakoii');
        }

        // Store only necessary user data in session
        $sessionData = [
            'id' => $user['id'],
            'username' => $user['username'],
            'name' => $user['name'],
            'role' => $user['role']
        ];
        
        $this->session->set('dname', $sessionData);
        $this->session->set('name', $sessionData);
        $this->session->set('duname', $sessionData);
        $this->session->set('drole', $sessionData);

        // Redirect to dashboard
        $this->session->setTempdata('success', 'Login Successful', 2);
        return redirect()->to('ddash');
    }

    public function ddash()
    {
        $data['title'] = "DDash";
        $data['menu'] = "ddash";

        $data['dusers'] = $this->dusersModel->findAll();
        $data['admins'] = $this->usersModel->findAll();
        $data['org'] = $this->orgModel->findAll();

        echo view('dakoii/ddash', $data);
    }


    //add dakoii admin
    public function adduser()
    {

        //$orgcode = $this->request->getPost('orgcode');
        //form submit
        if ($this->request->getMethod() === 'post' && $this->validate([

            'username' => 'required|is_unique[dakoii_users.username]',
            'password' => 'required'
        ])) {

            $is_active = "0";
            if (!empty($this->request->getVar('is_active'))) {
                $is_active = $this->request->getVar('is_active');
            }



            $data = [
                'name' => $this->request->getVar('name'),
                'username' => $this->request->getVar('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getVar('role'),
                'is_active' => $is_active,
            ];

            $this->dusersModel->insert($data);

            $this->session->setTempdata('success', 'Admin Created', 2);
            return redirect()->to('ddash');
        } else {
            $this->session->setTempdata('error', 'Username already exist', 2);
            return redirect()->to('ddash');
        }
    }

    //create org
    public function addorg()
    {

        //form submit
        if ($this->request->getMethod() === 'post' && $this->validate([

            'name' => 'required'
        ])) {

            $getorg = $this->orgModel->find();

            $orgcode = "3301";
            if (!empty($getorg)) {
                $orgcode = "33" . (count($getorg) + 1);
            }

            //======================== FILE UPLOAD=========================

            $logoFile = $this->request->getFile('org_logo');
            $file_path = "";

            if ($logoFile->isValid() && $logoFile->getSize() > 0) {

                $newName = $orgcode . "_" . time() . '.' . $logoFile->getExtension();

                $logoFile->move(ROOTPATH . 'public/uploads/org_logo/', $newName);

                $data['orglogo'] = 'public/uploads/org_logo/' . $newName;

            } elseif (empty($logoFile)) {
                $this->session->setTempdata('error', 'Invalid Logo File', 2);
            }

            $data = [
                'orgcode' => $orgcode,
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
                'orglogo'=> $file_path,
                'is_active' => 1,
            ];

            $this->orgModel->insert($data);



            $this->session->setTempdata('success', 'Organization Created', 2);
            return redirect()->to(base_url('dopen_org/' . $orgcode));
        } else {
            $this->session->setTempdata('success', 'Enter valid Data', 2);
            return redirect()->to('ddash');
        }
    }

    //view org
    public function open_org($orgcode)
    {
        $data['title'] = "Open Org";
        $data['menu'] = "openorg";

        $data['admins'] = $this->usersModel->where('orgcode', $orgcode)->find();
        $data['org'] = $this->orgModel->where('orgcode', $orgcode)->first();

        // Get all countries for dropdowns
        $data['countries'] = $this->countryModel->orderBy('name', 'asc')->findAll();

        // Get all provinces
        $data['get_provinces'] = $this->provinceModel->orderBy('name', 'asc')->find();

        // Get current country if set
        $data['set_country'] = null;
        if (!empty($data['org']['country_code'])) {
            $data['set_country'] = $this->countryModel->where('code', $data['org']['country_code'])->first();
        }

        echo view('dakoii/open_org', $data);
    }


    //update org
    public function editorg()
    {

        //form submit
        if ($this->request->getMethod() === 'post' && $this->validate([

            'name' => 'required'
        ])) {

            $id = $this->request->getVar('id');
            $orgcode = $this->request->getVar('orgcode');

            $addprov = "";
            if (!empty($this->request->getVar('country'))) {
                $addprov = $this->request->getVar('province');
            }


            $data = [
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
                'is_active' => $this->request->getVar('status'),
            ];

            $this->orgModel->update($id, $data);

            $this->session->setTempdata('success', 'Changes Saved', 2);
            return redirect()->to(base_url('dopen_org/' . $orgcode));
        } else {
            $this->session->setTempdata('success', 'Enter valid Data', 2);
            return redirect()->to('ddash');
        }
    }

    public function dakoii_update_org_logo()
    {
        //======================== FILE UPLOAD=========================

        $logoFile = $this->request->getFile('org_logo');
        $org_id = $this->request->getVar('org_id');
        $org_code = $this->request->getVar('org_code');

        if ($logoFile->isValid() && $logoFile->getSize() > 0) {

            $newName = $org_code . "_" . time() . '.' . $logoFile->getExtension();

            $logoFile->move(ROOTPATH . 'public/uploads/org_logo/', $newName);

            $data['orglogo'] = 'public/uploads/org_logo/' . $newName;

            $getid = $this->orgModel->where('orgcode', $org_code)->first();
            $this->orgModel->update($org_id, $data);
        } elseif (empty($logoFile)) {
            $this->session->setTempdata('error', 'Invalid Logo File', 2);
        }

        $this->session->setTempdata('success', 'Logo Updated!', 2);
        return redirect()->to('dopen_org/' . $org_code);
    }

    public function dakoii_update_org_address()
    {

        $org_id = $this->request->getVar('org_id');
        $org_code = $this->request->getVar('org_code');
        $country_code = $this->request->getVar('country_code');
        $province_code = $this->request->getVar('province_code');
        $district_code = $this->request->getVar('district_code');
        $llg_code = $this->request->getVar('llg_code');

        //get country
        $getcountry = $this->countryModel->where('code', $country_code)->orderBy('name', 'asc')->first();
        //get province
        $getprovince = $this->provinceModel->where('provincecode', $province_code)->orderBy('name', 'asc')->first();
        //get district
        $getdistrict = $this->districtModel->where('districtcode', $district_code)->orderBy('name', 'asc')->first();
        //get llgs
        $getllg = $this->llgModel->where('llgcode', $llg_code)->orderBy('name', 'asc')->first();

        $data = [
            'address' => $this->request->getVar('address'),
            'phones' => $this->request->getVar('phones'),
            'emails' => $this->request->getVar('emails'),
            'country_code' => $country_code,
            'province_code' => $province_code,
            'district_code' => $district_code,
            'llg_code' => $llg_code,
            'country_name' => $getcountry['name'],
            'province_name' => $getprovince['name'],
            'district_name' => $getdistrict['name'],
            'llg_name' => $getllg['name'],
        ];

        $this->orgModel->update($org_id, $data);

        $this->session->setTempdata('success', 'Address & Contacts Updated!', 2);
        return redirect()->to('dopen_org/' . $org_code);
    }


    public function dakoii_update_org_location_lock()
    {

        $org_id = $this->request->getVar('org_id');
        $org_code = $this->request->getVar('org_code');
        $country_code = $this->request->getVar('country_code');
        $province_code = $this->request->getVar('province_code');
        $district_code = $this->request->getVar('district_code');
        $llg_code = $this->request->getVar('llg_code');

        $lock_level = $lock_code = $lock_name = "";
        //get organization
        $getorg = $this->orgModel->where('orgcode', $org_code)->orderBy('name', 'asc')->first();

        // Check if organization address is set
        if (empty($getorg['country_code'])) {
            $this->session->setTempdata('error', 'Please set Organization Address first before setting Location Lock', 2);
            return redirect()->to('dopen_org/' . $org_code);
        }

        if (!empty($llg_code)) {
            $lock_code = $llg_code;
            $lock_level = "llg";
            $lock_name = $getorg['llg_name'];
            $district_code = $province_code = $country_code = "";
        } elseif (!empty($district_code)) {
            $lock_code = $district_code;
            $lock_level = "district";
            $lock_name = $getorg['district_name'];
            $province_code = $country_code = "";
        } elseif (!empty($province_code)) {
            $lock_code = $province_code;
            $lock_level = "province";
            $lock_name = $getorg['province_name'];
            $country_code = "";
        } elseif (!empty($country_code)) {
            $lock_code = $country_code;
            $lock_level = "country";
            $lock_name = $getorg['country_name'];
        } else {
            $this->session->setTempdata('error', 'Please select a Location to Lock', 2);
            return redirect()->to('dopen_org/' . $org_code);
        }

        //if location match address location
        if ($lock_level == "country" && $lock_code != $getorg['country_code']) {
            $this->session->setTempdata('error', 'Country Location does not Match the Address. Please select: ' . $getorg['country_name'], 2);
            return redirect()->to('dopen_org/' . $org_code);
        }

        if ($lock_level == "province" && $lock_code != $getorg['province_code']) {
            $this->session->setTempdata('error', 'Province Location does not Match the Address. Please select: ' . $getorg['province_name'], 2);
            return redirect()->to('dopen_org/' . $org_code);
        }
        if ($lock_level == "district" && $lock_code != $getorg['district_code']) {
            $this->session->setTempdata('error', 'District Location does not Match the Address. Please select: ' . $getorg['district_name'], 2);
            return redirect()->to('dopen_org/' . $org_code);
        }

        if ($lock_level == "llg" && $lock_code != $getorg['llg_code']) {
            $this->session->setTempdata('error', 'LLG Location does not Match the Address. Please select: ' . $getorg['llg_name'], 2);
            return redirect()->to('dopen_org/' . $org_code);
        }

        $data = [
            'loc_level_locked' => $lock_level,
            'loc_code_locked' => $lock_code,
            'loc_name_locked' => $lock_name,
            'is_locationlocked' => "1",
        ];

        $this->orgModel->update($org_id, $data);

        $this->session->setTempdata('success', 'Location Locked!', 2);
        return redirect()->to('dopen_org/' . $org_code);
    }


    public function dakoii_remove_org_location_lock()
    {

        $org_id = $this->request->getVar('org_id');
        $org_code = $this->request->getVar('org_code');


        $data = [
            'loc_level_locked' => "",
            'loc_code_locked' => "",
            'loc_name_locked' => "",
            'is_locationlocked' => "",
        ];

        $this->orgModel->update($org_id, $data);

        $this->session->setTempdata('success', 'Location Lock Removed!', 2);
        return redirect()->to('dopen_org/' . $org_code);
    }



    // --- Create Organization Admin
    public function create_admin()
    {

        $orgcode = $this->request->getVar('orgcode');
        //form submit
        if ($this->request->getMethod() === 'post' && $this->validate([

            'username' => 'required|is_unique[users.username]',
            'password' => 'required'

        ])) {

            $is_active = "0";
            if (!empty($this->request->getVar('is_active'))) {
                $is_active = $this->request->getVar('is_active');
            }

            $data = [
                'orgcode' => $this->request->getVar('orgcode'),
                'name' => $this->request->getVar('name'),
                'username' => $this->request->getVar('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getVar('role'),
                'is_active' => $is_active,
            ];

            $this->usersModel->insert($data);
            $this->session->setTempdata('success', 'Organization Admin Created', 2);
            return redirect()->to('dopen_org/' . $orgcode);
        } else {
            $this->session->setTempdata('error', 'Username already taken', 2);
            return redirect()->to('dopen_org/' . $orgcode);
        }
    }




    public function logout()
    {
        // Destroy the user's session
        $session = session();
        $session->destroy();

        // Redirect to the login page
        return redirect()->to(base_url());
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

    // AJAX method to get CSRF token
    public function get_csrf_token()
    {
        return $this->response->setJSON([
            'token' => csrf_token(),
            'hash' => csrf_hash()
        ]);
    }
}
