<?php

namespace App\Controllers;

use App\Models\countryModel;
use App\Models\districtModel;
use App\Models\eventfilesModel;
use App\Models\eventsModel;
use App\Models\kmlfilesModel;
use App\Models\llgModel;
use App\Models\notificationsModel;
use App\Models\prodocsModel;
use App\Models\proeventsModel;
use App\Models\profundModel;
use App\Models\project_officersModel;
use App\Models\projectsModel;
use App\Models\promilefilesModel;
use App\Models\promilestonesModel;
use App\Models\prophasesModel;
use App\Models\provinceModel;
use App\Models\usersModel;

class POfficers extends BaseController
{
    public $session;
    public $usersModel;
    public $pro_officersModel;
    public $projectsModel;
    public $prophasesModel;
    public $promilestonesModel;
    public $promilefilesModel;
    public $countryModel;
    public $provinceModel;
    public $districtModel;
    public $llgModel;
    public $prodocsModel;
    public $profundModel;
    public $proeventsModel;
    public $proeventFilesModel;
    public $kmlfilesModel;
    public $notificationsModel;

    public function __construct()
    {
        helper(['form', 'url', 'info']);
        $this->session = session();

        $this->usersModel = new usersModel();
        $this->pro_officersModel = new project_officersModel();
        $this->projectsModel = new projectsModel();
        $this->prophasesModel = new prophasesModel();
        $this->promilestonesModel = new promilestonesModel();
        $this->promilefilesModel = new promilefilesModel();
        $this->countryModel = new countryModel();
        $this->provinceModel = new provinceModel();
        $this->districtModel = new districtModel();
        $this->llgModel = new llgModel();
        $this->prodocsModel = new prodocsModel();
        $this->profundModel = new profundModel();
        $this->proeventsModel = new proeventsModel();
        $this->proeventFilesModel = new eventfilesModel();
        $this->kmlfilesModel = new kmlfilesModel();
        $this->notificationsModel = new notificationsModel();
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['menu'] = "dashboard";

        // Cache session values to avoid repeated calls
        $userid = session('userid');
        $orgcode = session('orgcode');

        // Fetch projects with only needed fields
        $data['projects'] = $this->projectsModel
            ->select('procode, name, ucode, status, budget, payment_total')
            ->where('pro_officer_id', $userid)
            ->where('orgcode', $orgcode)
            ->orderBy('name', 'asc')
            ->find();

        // Fetch milestones with only needed fields
        $data['milestones'] = $this->promilestonesModel
            ->select('procode, milestones, status, checked, checked_date')
            ->where('orgcode', $orgcode)
            ->orderBy('milestones', 'asc')
            ->find();

        // Fetch unread notifications for this project officer
        $data['notifications'] = $this->notificationsModel
            ->groupStart()
                ->where('recipient_type', 'all')
                ->orWhere('recipient_po_id', $userid)
            ->groupEnd()
            ->where('orgcode', $orgcode)
            ->where('status', 'active')
            ->where('is_read', 0)
            ->orderBy('create_at', 'desc')
            ->limit(5)
            ->find();

        echo view('pofficers/dash', $data);
    }

    public function po_open_project($ucode)
    {


        $data['pro'] = $this->projectsModel->where('ucode', $ucode)->first();

        // Get all milestones for this project
        $data['milestones'] = $this->promilestonesModel->where('procode', $data['pro']['procode'])->find();

        // Calculate completed milestones
        $totalMilestones = count($data['milestones']);
        $completedMilestones = 0;
        foreach ($data['milestones'] as $milestone) {
            if (strtolower($milestone['status']) == 'completed' || $milestone['checked'] == 'completed') {
                $completedMilestones++;
            }
        }
        $data['totalMilestones'] = $totalMilestones;
        $data['completedMilestones'] = $completedMilestones;

        // Get total files count
        $data['totalFiles'] = $this->prodocsModel->where('procode', $data['pro']['procode'])->countAllResults();

        // Get payment data
        $payments = $this->profundModel->where('procode', $data['pro']['procode'])->where('orgcode', session('orgcode'))->find();
        $totalPaid = 0;
        foreach ($payments as $payment) {
            $totalPaid += $payment['amount'];
        }
        $data['totalPaid'] = $totalPaid;
        $data['totalBudget'] = $data['pro']['budget'];
        $data['variance'] = $data['totalBudget'] - $totalPaid;

        // Get total events count
        $data['totalEvents'] = $this->proeventsModel->where('procode', $data['pro']['procode'])->where('orgcode', session('orgcode'))->countAllResults();

        $data['title'] = $data['pro']['procode'];
        $data['menu'] = "dashboard";
        echo view('pofficers/po_open_project', $data);
    }

    public function po_details($ucode)
    {

        $data['pro'] = $this->projectsModel->where('ucode', $ucode)->first();
        $data['country'] = $this->countryModel->where('code', $data['pro']['country'])->first();
        $data['province'] = $this->provinceModel->where('provincecode', $data['pro']['province'])->first();
        $data['dist'] = $this->districtModel->where('districtcode', $data['pro']['district'])->first();
        $data['kmls'] = $this->kmlfilesModel->where('proucode', $ucode)->find();


        //edit load - direct province retrieval without country dependency
        $data['get_provinces'] = $this->provinceModel->orderBy('name', 'asc')->find();
        $data['get_district'] = $this->districtModel->where('districtcode', $data['pro']['district'])->first();


        $data['title'] = "dt" . $data['pro']['procode'];
        $data['menu'] = "dashboard";
        echo view('pofficers/po_details', $data);
    }

    public function po_details_info_edit($ucode)
    {

        $data['pro'] = $this->projectsModel->where('ucode', $ucode)->first();
        $data['country'] = $this->countryModel->where('code', $data['pro']['country'])->first();
        $data['province'] = $this->provinceModel->where('provincecode', $data['pro']['province'])->first();
        $data['dist'] = $this->districtModel->where('districtcode', $data['pro']['district'])->first();
        $data['kmls'] = $this->kmlfilesModel->where('proucode', $ucode)->find();


        //edit load - direct province retrieval without country dependency
        $data['get_provinces'] = $this->provinceModel->orderBy('name', 'asc')->find();

        $data['title'] = "edit" . $data['pro']['procode'];
        $data['menu'] = "dashboard";
        echo view('pofficers/po_details_info_edit', $data);
    }



    public function getdistricts()
    {
        $prov = $this->request->getPost('provinceid');
        $districts = $this->districtModel->where('province_id', $prov)->find();

        return $this->response->setJSON($districts);
    }

    public function po_phases($ucode)
    {

        $data['pro'] = $this->projectsModel->where('ucode', $ucode)->first();
        $data['phases'] = $this->prophasesModel->where('procode', $data['pro']['procode'])->find();
        $data['milestones'] = $this->promilestonesModel->where('procode', $data['pro']['procode'])->find();

        $data['title'] = "ph" . $data['pro']['procode'];
        $data['menu'] = "dashboard";
        echo view('pofficers/po_phases', $data);
    }

    public function po_milestones($ucode)
    {

        $data['milestones'] = $this->promilestonesModel->where('ucode', $ucode)->first();
        $data['pro'] = $this->projectsModel->where('procode', $data['milestones']['procode'])->first();
        $data['phases'] = $this->prophasesModel->where('id', $data['milestones']['phase_id'])->first();
        $data['milefiles'] = $this->promilefilesModel->where('milestones_id', $data['milestones']['id'])->find();

        $data['title'] = "ms" . $data['pro']['procode'];
        $data['menu'] = "dashboard";
        echo view('pofficers/po_milestones', $data);
    }

    public function milestone_notes()
    {
        $id = $this->request->getVar('ms_id');
        $status = $this->request->getVar('status');

        // Validate that we have an ID
        if (empty($id)) {
            return redirect()->back()->with('error', 'Milestone ID is missing');
        }

        // Validate status value
        $validStatuses = ['pending', 'completed', 'hold', 'canceled'];
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Invalid status value');
        }

        $data = [
            'notes' => $this->request->getVar('milenotes'),
            'status' => $status,
            'checked' => $status, // Keep checked field in sync - store status string value
            'checked_date' => $this->request->getVar('milesdate'),
            'update_by' => session('name'),
        ];

        // Perform the update and check if it was successful
        $result = $this->promilestonesModel->update($id, $data);

        if ($result === false) {
            // Get validation errors if any
            $errors = $this->promilestonesModel->errors();
            $errorMessage = !empty($errors) ? implode(', ', $errors) : 'Failed to update milestone status';
            return redirect()->back()->with('error', $errorMessage);
        }

        return redirect()->back()->with('success', 'Milestone Status Updated Successfully');
    }

    public function milestone_files()
    {

        $files = $this->request->getFileMultiple('milefiles');
        $procode = $this->request->getVar('procode');
        $ph_id = $this->request->getVar('ph_id');
        $ms_id = $this->request->getVar('ms_id');

        // echo "<pre>";
        //  print_r($files);

        $x = 1;

        foreach ($files as $file) {
            if ($file->isValid()) {

                // Generate a custom name for the file with counter to ensure uniqueness
                $newName = "mf_" . $procode . "_" . time() . "_" . $x . "." . $file->getExtension();

                // echo $newName;

                // Move the uploaded file to the uploads folder with the new name
                $file->move(ROOTPATH . 'public/uploads/milestone_files/', $newName);

                // Increment counter
                $x++;


                // Insert the file path into the database
                $data = [
                    'ucode' => uniqid() . time(),
                    'orgcode' => session('orgcode'),
                    'procode' => $procode,
                    'milestones_id' => $ms_id,
                    'phase_id' => $ph_id,
                    'filepath' => 'public/uploads/milestone_files/' . $newName,
                    'create_by' => session('name'),
                    'status' => 1,
                ];
                $this->promilefilesModel->insert($data);
            }
        }
        return redirect()->back()->with('success', 'Files Uploaded');
    }

    public function delete_milestone_file()
    {
        $id = $this->request->getPost('file_id');

        // Get the file record to delete the physical file
        $file = $this->promilefilesModel->find($id);

        if ($file) {
            // Delete the physical file if it exists
            $filepath = ROOTPATH . $file['filepath'];
            if (file_exists($filepath)) {
                unlink($filepath);
            }

            // Delete the database record
            $this->promilefilesModel->delete($id);

            return redirect()->back()->with('success', 'File Deleted Successfully');
        }

        return redirect()->back()->with('error', 'File not found');
    }

    public function po_files_open($ucode)
    {

        $data['pro'] = $this->projectsModel->where('ucode', $ucode)->first();
        $data['prodocs'] = $this->prodocsModel->where('procode', $data['pro']['procode'])->find();

        $data['title'] = "fl" . $data['pro']['procode'];
        $data['menu'] = "dashboard";
        echo view('pofficers/po_files_open', $data);
    }


    public function po_funding_open($ucode)
    {

        $data['pro'] = $this->projectsModel->where('ucode', $ucode)->first();
        $data['fund'] = $this->profundModel->where('procode', $data['pro']['procode'])->where('orgcode', session('orgcode'))->orderBy('paymentdate', 'desc')->find();

        $data['title'] = "fd" . $data['pro']['procode'];
        $data['menu'] = "dashboard";
        echo view('pofficers/po_funding_open', $data);
    }


    public function po_events_open($ucode)
    {

        $data['pro'] = $this->projectsModel->where('ucode', $ucode)->first();
        $data['proevents'] = $this->proeventsModel->where('procode', $data['pro']['procode'])->where('orgcode', session('orgcode'))->orderBy('eventdate', 'desc')->find();
        $data['evfiles'] = $this->proeventFilesModel->where('procode', $data['pro']['procode'])->where('orgcode', session('orgcode'))->find();

        $data['title'] = "ev" . $data['pro']['procode'];
        $data['menu'] = "dashboard";
        echo view('pofficers/po_events_open', $data);
    }

    public function po_reports_open($ucode)
    {

        $data['pro'] = $this->projectsModel->where('ucode', $ucode)->first();
        $data['events'] = $this->proeventsModel->where('procode', $data['pro']['procode'])->where('orgcode', session('orgcode'))->orderBy('eventdate', 'asc')->find();
        $data['evfiles'] = $this->proeventFilesModel->where('procode', $data['pro']['procode'])->where('orgcode', session('orgcode'))->find();
        $data['payments'] = $this->profundModel->where('procode', $data['pro']['procode'])->where('orgcode', session('orgcode'))->orderBy('paymentdate', 'asc')->find();

        $data['prodocs'] = $this->prodocsModel->where('procode', $data['pro']['procode'])->find();
        $data['phases'] = $this->prophasesModel->where('procode', $data['pro']['procode'])->find();
        // Add orgcode filter to milestone retrieval to match other controllers
        $data['milestones'] = $this->promilestonesModel
            ->where('procode', $data['pro']['procode'])
            ->where('orgcode', session('orgcode'))
            ->orderBy('id', 'asc')
            ->find();
        //address
        $data['country'] = $this->countryModel->where('code', $data['pro']['country'])->first();
        $data['province'] = $this->provinceModel->where('provincecode', $data['pro']['province'])->first();
        $data['dist'] = $this->districtModel->where('districtcode', $data['pro']['district'])->first();
        $data['llg'] = $this->llgModel->where('llgcode', $data['pro']['llg'])->first();


        $data['pro_ms_pending'] = $data['pro_ms_completed'] = $data['pro_ms_hold'] = $data['pro_ms_canceled'] = 0;

        //calculations - count milestones by status
        foreach ($data['milestones'] as $ms) {
            // Normalize the status value (trim whitespace and convert to lowercase)
            $status = strtolower(trim($ms['checked'] ?? 'pending'));

            // Default empty status to pending
            if (empty($status)) {
                $status = 'pending';
            }

            switch ($status) {
                case 'pending':
                    $data['pro_ms_pending'] += 1;
                    break;
                case 'completed':
                    $data['pro_ms_completed'] += 1;
                    break;
                case 'hold':
                    $data['pro_ms_hold'] += 1;
                    break;
                case 'canceled':
                    $data['pro_ms_canceled'] += 1;
                    break;
                default:
                    // Any unknown status defaults to pending
                    $data['pro_ms_pending'] += 1;
                    break;
            }
        }

        // Calculate percentages with division by zero protection
        $totalMilestones = count($data['milestones']);
        if ($totalMilestones > 0) {
            $data['ms_completed_percent'] = ($data['pro_ms_completed'] / $totalMilestones) * 100;
            $data['ms_pending_percent'] = ($data['pro_ms_pending'] / $totalMilestones) * 100;
            $data['ms_hold_percent'] = ($data['pro_ms_hold'] / $totalMilestones) * 100;
            $data['ms_canceled_percent'] = ($data['pro_ms_canceled'] / $totalMilestones) * 100;
        } else {
            // No milestones, set all percentages to 0
            $data['ms_completed_percent'] = 0;
            $data['ms_pending_percent'] = 0;
            $data['ms_hold_percent'] = 0;
            $data['ms_canceled_percent'] = 0;
        }
        




        $data['title'] = "rep" . $data['pro']['procode'];
        $data['menu'] = "dashboard";
        echo view('pofficers/po_reports_open', $data);
    }

    public function mark_notification_read($id)
    {
        $notification = $this->notificationsModel->find($id);

        if (!$notification) {
            return redirect()->back()->with('error', 'Notification not found');
        }

        // Update notification as read
        $data = [
            'is_read' => 1,
            'update_by' => session('name'),
            'update_at' => date('Y-m-d H:i:s')
        ];

        $this->notificationsModel->update($id, $data);

        return redirect()->to('po_dash')->with('success', 'Notification marked as read');
    }

    public function notifications_archive()
    {
        $data['title'] = "Notifications Archive";
        $data['menu'] = "notifications";

        // Cache session values
        $userid = session('userid');
        $orgcode = session('orgcode');

        // Fetch read notifications for this project officer
        $data['notifications'] = $this->notificationsModel
            ->groupStart()
                ->where('recipient_type', 'all')
                ->orWhere('recipient_po_id', $userid)
            ->groupEnd()
            ->where('orgcode', $orgcode)
            ->where('is_read', 1)
            ->orderBy('update_at', 'desc')
            ->find();

        echo view('pofficers/notifications_archive', $data);
    }
}
