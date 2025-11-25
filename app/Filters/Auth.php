<?php

namespace App\Filters;

use App\Models\activitiesModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
       
        //get session
        $session = \Config\Services::session();

        if (!$session->has('name')) {
            
            return redirect()->to(base_url())->with('error','LOGIN!');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
