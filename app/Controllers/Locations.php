<?php

namespace App\Controllers;

use App\Models\countryModel;
use App\Models\provinceModel;
use App\Models\districtModel;
use App\Models\llgModel;

class Locations extends BaseController
{
    public $session;
    public $countryModel;
    public $provinceModel;
    public $districtModel;
    public $llgModel;

    public function __construct()
    {
        helper(['form', 'url', 'info']);
        $this->session = session();
        $this->countryModel = new countryModel();
        $this->provinceModel = new provinceModel();
        $this->districtModel = new districtModel();
        $this->llgModel = new llgModel();
    }

    // ============================================
    // COUNTRIES CRUD
    // ============================================

    public function countries()
    {
        $data['title'] = "Countries List";
        $data['menu'] = "countries";
        $data['countries'] = $this->countryModel->findAll();

        echo view('locations/countries_list', $data);
    }

    public function countries_create()
    {
        $data['title'] = "Create Country";
        $data['menu'] = "countries";

        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required',
            'code' => 'required|is_unique[adx_country.code]'
        ])) {
            $data_insert = [
                'name' => $this->request->getVar('name'),
                'code' => $this->request->getVar('code'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->countryModel->insert($data_insert);

            return redirect()->to('countries')->with('success', 'Country created successfully!');
        }

        echo view('locations/countries_create', $data);
    }

    public function countries_edit($id)
    {
        $data['title'] = "Edit Country";
        $data['menu'] = "countries";
        $data['country'] = $this->countryModel->find($id);

        if (empty($data['country'])) {
            return redirect()->to('countries')->with('error', 'Country not found!');
        }

        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required'
        ])) {
            $data_update = [
                'name' => $this->request->getVar('name')
            ];

            $this->countryModel->update($id, $data_update);

            return redirect()->to('countries')->with('success', 'Country updated successfully!');
        }

        echo view('locations/countries_edit', $data);
    }

    public function countries_delete()
    {
        $id = $this->request->getPost('id');
        
        if (!empty($id)) {
            $this->countryModel->delete($id);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Country deleted successfully!']);
        }
        
        return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid request!']);
    }

    // ============================================
    // PROVINCES CRUD
    // ============================================

    public function provinces()
    {
        $data['title'] = "Provinces List";
        $data['menu'] = "provinces";
        
        $builder = $this->provinceModel->db->table('adx_province');
        $builder->select('adx_province.*, adx_country.name as country_name');
        $builder->join('adx_country', 'adx_country.id = adx_province.country_id', 'left');
        $builder->orderBy('adx_province.name', 'ASC');
        $data['provinces'] = $builder->get()->getResultArray();

        echo view('locations/provinces_list', $data);
    }

    public function provinces_create()
    {
        $data['title'] = "Create Province";
        $data['menu'] = "provinces";
        $data['countries'] = $this->countryModel->findAll();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required',
            'provincecode' => 'required|is_unique[adx_province.provincecode]',
            'country_id' => 'required'
        ])) {
            $data_insert = [
                'name' => $this->request->getVar('name'),
                'provincecode' => $this->request->getVar('provincecode'),
                'country_id' => $this->request->getVar('country_id')
            ];

            $this->provinceModel->insert($data_insert);

            return redirect()->to('provinces')->with('success', 'Province created successfully!');
        }

        echo view('locations/provinces_create', $data);
    }

    public function provinces_edit($id)
    {
        $data['title'] = "Edit Province";
        $data['menu'] = "provinces";
        $data['province'] = $this->provinceModel->find($id);
        $data['countries'] = $this->countryModel->findAll();

        if (empty($data['province'])) {
            return redirect()->to('provinces')->with('error', 'Province not found!');
        }

        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required',
            'country_id' => 'required'
        ])) {
            $data_update = [
                'name' => $this->request->getVar('name'),
                'country_id' => $this->request->getVar('country_id')
            ];

            $this->provinceModel->update($id, $data_update);

            return redirect()->to('provinces')->with('success', 'Province updated successfully!');
        }

        echo view('locations/provinces_edit', $data);
    }

    public function provinces_delete()
    {
        $id = $this->request->getPost('id');
        
        if (!empty($id)) {
            $this->provinceModel->delete($id);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Province deleted successfully!']);
        }
        
        return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid request!']);
    }

    // ============================================
    // DISTRICTS CRUD
    // ============================================

    public function districts()
    {
        $data['title'] = "Districts List";
        $data['menu'] = "districts";
        
        $builder = $this->districtModel->db->table('adx_district');
        $builder->select('adx_district.*, adx_country.name as country_name, adx_province.name as province_name');
        $builder->join('adx_country', 'adx_country.id = adx_district.country_id', 'left');
        $builder->join('adx_province', 'adx_province.id = adx_district.province_id', 'left');
        $builder->orderBy('adx_district.name', 'ASC');
        $data['districts'] = $builder->get()->getResultArray();

        echo view('locations/districts_list', $data);
    }

    public function districts_create()
    {
        $data['title'] = "Create District";
        $data['menu'] = "districts";
        $data['countries'] = $this->countryModel->findAll();
        $data['provinces'] = $this->provinceModel->findAll();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required',
            'districtcode' => 'required|is_unique[adx_district.districtcode]',
            'country_id' => 'required',
            'province_id' => 'required'
        ])) {
            $data_insert = [
                'name' => $this->request->getVar('name'),
                'districtcode' => $this->request->getVar('districtcode'),
                'country_id' => $this->request->getVar('country_id'),
                'province_id' => $this->request->getVar('province_id')
            ];

            $this->districtModel->insert($data_insert);

            return redirect()->to('districts')->with('success', 'District created successfully!');
        }

        echo view('locations/districts_create', $data);
    }

    public function districts_edit($id)
    {
        $data['title'] = "Edit District";
        $data['menu'] = "districts";
        $data['district'] = $this->districtModel->find($id);
        $data['countries'] = $this->countryModel->findAll();
        $data['provinces'] = $this->provinceModel->findAll();

        if (empty($data['district'])) {
            return redirect()->to('districts')->with('error', 'District not found!');
        }

        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required',
            'country_id' => 'required',
            'province_id' => 'required'
        ])) {
            $data_update = [
                'name' => $this->request->getVar('name'),
                'country_id' => $this->request->getVar('country_id'),
                'province_id' => $this->request->getVar('province_id')
            ];

            $this->districtModel->update($id, $data_update);

            return redirect()->to('districts')->with('success', 'District updated successfully!');
        }

        echo view('locations/districts_edit', $data);
    }

    public function districts_delete()
    {
        $id = $this->request->getPost('id');
        
        if (!empty($id)) {
            $this->districtModel->delete($id);
            return $this->response->setJSON(['status' => 'success', 'message' => 'District deleted successfully!']);
        }
        
        return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid request!']);
    }

    // ============================================
    // LLGS CRUD
    // ============================================

    public function llgs()
    {
        $data['title'] = "LLGs List";
        $data['menu'] = "llgs";
        
        $builder = $this->llgModel->db->table('adx_llg');
        $builder->select('adx_llg.*, adx_country.name as country_name, adx_province.name as province_name, adx_district.name as district_name');
        $builder->join('adx_country', 'adx_country.id = adx_llg.country_id', 'left');
        $builder->join('adx_province', 'adx_province.id = adx_llg.province_id', 'left');
        $builder->join('adx_district', 'adx_district.id = adx_llg.district_id', 'left');
        $builder->orderBy('adx_llg.name', 'ASC');
        $data['llgs'] = $builder->get()->getResultArray();

        echo view('locations/llgs_list', $data);
    }

    public function llgs_create()
    {
        $data['title'] = "Create LLG";
        $data['menu'] = "llgs";
        $data['countries'] = $this->countryModel->findAll();
        $data['provinces'] = $this->provinceModel->findAll();
        $data['districts'] = $this->districtModel->findAll();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required',
            'llgcode' => 'required|is_unique[adx_llg.llgcode]',
            'country_id' => 'required',
            'province_id' => 'required',
            'district_id' => 'required'
        ])) {
            $data_insert = [
                'name' => $this->request->getVar('name'),
                'llgcode' => $this->request->getVar('llgcode'),
                'country_id' => $this->request->getVar('country_id'),
                'province_id' => $this->request->getVar('province_id'),
                'district_id' => $this->request->getVar('district_id')
            ];

            $this->llgModel->insert($data_insert);

            return redirect()->to('llgs')->with('success', 'LLG created successfully!');
        }

        echo view('locations/llgs_create', $data);
    }

    public function llgs_edit($id)
    {
        $data['title'] = "Edit LLG";
        $data['menu'] = "llgs";
        $data['llg'] = $this->llgModel->find($id);
        $data['countries'] = $this->countryModel->findAll();
        $data['provinces'] = $this->provinceModel->findAll();
        $data['districts'] = $this->districtModel->findAll();

        if (empty($data['llg'])) {
            return redirect()->to('llgs')->with('error', 'LLG not found!');
        }

        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required',
            'country_id' => 'required',
            'province_id' => 'required',
            'district_id' => 'required'
        ])) {
            $data_update = [
                'name' => $this->request->getVar('name'),
                'country_id' => $this->request->getVar('country_id'),
                'province_id' => $this->request->getVar('province_id'),
                'district_id' => $this->request->getVar('district_id')
            ];

            $this->llgModel->update($id, $data_update);

            return redirect()->to('llgs')->with('success', 'LLG updated successfully!');
        }

        echo view('locations/llgs_edit', $data);
    }

    public function llgs_delete()
    {
        $id = $this->request->getPost('id');
        
        if (!empty($id)) {
            $this->llgModel->delete($id);
            return $this->response->setJSON(['status' => 'success', 'message' => 'LLG deleted successfully!']);
        }
        
        return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid request!']);
    }

    // ============================================
    // AJAX METHODS FOR CASCADING DROPDOWNS
    // ============================================

    public function get_provinces()
    {
        $country_id = $this->request->getPost('country_id');
        
        if (!empty($country_id)) {
            $provinces = $this->provinceModel->where('country_id', $country_id)->findAll();
            return $this->response->setJSON(['status' => 'success', 'data' => $provinces]);
        }
        
        return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid request!']);
    }

    public function get_districts()
    {
        $province_id = $this->request->getPost('province_id');
        
        if (!empty($province_id)) {
            $districts = $this->districtModel->where('province_id', $province_id)->findAll();
            return $this->response->setJSON(['status' => 'success', 'data' => $districts]);
        }
        
        return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid request!']);
    }
}

