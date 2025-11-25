<?php

namespace App\Controllers;

use App\Models\usersModel;

Class Events extends BaseController{
    
    public $userModel;
        public function __construct() {
            $this->userModel = new usersModel();
             
        }
    
        public function index()
        {
             
            //echo Home::read();
        }
        public function read()
        {
            $users = $this->userModel->findAll();
            $data = array('data' =>$users,);
            return view('crud',$data);
        }
        public function create()
        {
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $cedula = $_POST["cedula"];
            $data = [
                'nombre' => $nombre,
                'apellido'    => $apellido ,
                'cedula'    =>  $cedula ,
            ];
            
            $this->userModel->insert($data);
            return redirect()->to(base_url().'/');
        }
    
        public function delete()
        {
            $id = $_GET["id"];  
            $this->userModel->delete($id);
            return redirect()->to(base_url().'/');
        }
    
        public function update()
        {   
            $id = $_POST["id"];    
             $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $cedula = $_POST["cedula"];
            $data = [
                'nombre' => $nombre,
                'apellido'    => $apellido ,
                'cedula'    =>  $cedula ,
            ];
            
            $this->userModel->update($id, $data);
            return redirect()->to(base_url().'/');
        }
    
        public function edit()
        {
            $id = $_GET["id"];  
            $users = $this->userModel->find($id);
            $data = array('data' =>$users,);
            return view('editar',$data);
       
        }
}