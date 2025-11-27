<?php

namespace App\Controllers;

use App\Models\notificationsModel;
use App\Models\project_officersModel;
class Notifications extends BaseController
{
    public $session;
    public $notificationsModel;
    public $project_officersModel;

    public function __construct()
    {
        helper(['form', 'url', 'info']);
        $this->session = session();
        $this->notificationsModel = new notificationsModel();
        $this->project_officersModel = new project_officersModel();
    }

    public function index()
    {
        $data['title'] = "Notifications";
        $data['menu'] = "notifications";

        $data['notifications'] = $this->notificationsModel
            ->where('orgcode', session('orgcode'))
            ->orderBy('create_at', 'desc')
            ->find();

        // Get all active project officers for modals
        $data['project_officers'] = $this->project_officersModel
            ->where('orgcode', session('orgcode'))
            ->where('status', 'active')
            ->orderBy('name', 'asc')
            ->find();

        echo view('notifications/notifications', $data);
    }

    public function add_notification()
    {
        $recipientType = $this->request->getVar('recipient_type');
        $recipientPoId = $this->request->getVar('recipient_po_id');
        $recipientPoName = null;

        if ($recipientType == 'specific' && $recipientPoId) {
            $officer = $this->project_officersModel->where('id', $recipientPoId)->first();
            if ($officer) {
                $recipientPoName = $officer['name'];
            }
        }

        $data = [
            'ucode' => uniqid() . time(),
            'orgcode' => session('orgcode'),
            'title' => $this->request->getVar('title'),
            'message' => $this->request->getVar('message'),
            'recipient_type' => $recipientType,
            'recipient_po_id' => $recipientPoId,
            'recipient_po_name' => $recipientPoName,
            'priority' => $this->request->getVar('priority'),
            'status' => 'active',
            'create_by' => session('name'),
            'create_at' => date('Y-m-d H:i:s'),
        ];

        $this->notificationsModel->insert($data);

        return redirect()->to(base_url('notifications'))->with('success', 'Notification created successfully');
    }

    public function update_notification()
    {
        $id = $this->request->getVar('id');

        $recipientType = $this->request->getVar('recipient_type');
        $recipientPoId = $this->request->getVar('recipient_po_id');
        $recipientPoName = null;

        if ($recipientType == 'specific' && $recipientPoId) {
            $officer = $this->project_officersModel->where('id', $recipientPoId)->first();
            if ($officer) {
                $recipientPoName = $officer['name'];
            }
        }

        $data = [
            'title' => $this->request->getVar('title'),
            'message' => $this->request->getVar('message'),
            'recipient_type' => $recipientType,
            'recipient_po_id' => $recipientPoId,
            'recipient_po_name' => $recipientPoName,
            'priority' => $this->request->getVar('priority'),
            'status' => $this->request->getVar('status'),
            'update_by' => session('name'),
            'update_at' => date('Y-m-d H:i:s'),
        ];

        $this->notificationsModel->update($id, $data);

        return redirect()->to(base_url('notifications'))->with('success', 'Notification updated successfully');
    }

    public function delete_notification($id)
    {
        $this->notificationsModel->delete($id);
        return redirect()->to(base_url('notifications'))->with('success', 'Notification deleted successfully');
    }
}

