<?php

namespace App\Controllers;


use App\Models\project_officersModel;


class Project_officers extends BaseController
{
    public $session;
    public $project_officersModel;


    public function __construct()
    {
        helper(['form', 'url', 'info']);
        $this->session = session();
        $this->project_officersModel = new project_officersModel();
    }

    /* 
    * index
    * create_road
    */

    public function index()
    {
        $data['title'] = "Project Officers";
        $data['menu'] = "project_officers";

        // Optimized retrieval with single query
        $data['pro_officers'] = $this->project_officersModel
            ->select('id, ucode, orgcode, pocode, name, username, status, create_by, create_at')
            ->where('orgcode', session('orgcode'))
            ->orderBy('name', 'asc')
            ->findAll();

        // Calculate statistics
        $data['stats'] = [
            'total_officers' => count($data['pro_officers']),
            'active_count' => count(array_filter($data['pro_officers'], function($officer) {
                return $officer['status'] === 'active';
            })),
            'inactive_count' => count(array_filter($data['pro_officers'], function($officer) {
                return $officer['status'] === 'deactive';
            }))
        ];

        echo view('project_officers/project_officers', $data);
    }

    public function add_project_officers()
    {

        $name = $this->request->getVar('name');
        $username = $this->request->getVar('username');

        $getusername = $this->project_officersModel->where('username', $username)->first();
        if(!empty($getusername)){
            return redirect()->back()->with('error', $username . 'This username is already taken!');
        }

        if (strpos($username, ' ') !== false) {
            return redirect()->back()->with('error', $username . 'Enter Username without spaces!');
        }

        $getpo = $this->project_officersModel->orderBy('id','desc')->first();

        // Generate pocode - start from 1001 if no officers exist, otherwise increment
        $pocode = 1001;
        if (!empty($getpo) && isset($getpo['pocode'])) {
            $pocode = $getpo['pocode'] + 1;
        }

        // Insert the file path into the database
        $data = [
            'ucode' => uniqid() . time(),
            'orgcode' => session('orgcode'),
            'pocode' => $pocode,
            'name' => $name,
            'username' => $username,
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'create_by' => session('name'),
            'status' => "active",
        ];
        $this->project_officersModel->insert($data);

        return redirect()->back()->with('success', $name . ' Project Officer Added');
    }
    
    public function edit_password_project_officers()
    {

        $id = $this->request->getVar('id');
        $name = $this->request->getVar('name');

        // Insert the file path into the database
        $data = [
            
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'update_by' => session('name'),
        ];
        $this->project_officersModel->update($id,$data);

        return redirect()->back()->with('success', $name . ' Password Changed');
    }
    
    public function edit_project_officers()
    {

        $id = $this->request->getVar('id');
        $name = $this->request->getVar('name');

        // Insert the file path into the database
        $data = [
            
            'name' => $name,
            'status' => $this->request->getVar('status'),
            'update_by' => session('name'),
        ];
        $this->project_officersModel->update($id,$data);

        return redirect()->back()->with('success', $name . ' Changes Saved!');
    }
}
