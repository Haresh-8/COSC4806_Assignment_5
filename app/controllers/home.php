<?php

class Home extends Controller {

    public function index() {
        // 
        $user = $this->model('User');
      

        //NEW: Add reminders stats (without removing old $data)
        require_once "app/models/ReminderModel.php";
        $reminderModel = new ReminderModel();

        $data['totalReminders'] = count($reminderModel->getByUser($_SESSION['user_id']));
        $data['completedReminders'] = $reminderModel->countCompleted($_SESSION['user_id']);

        // Pass $data to view (now it includes user test + stats)
        $this->view('home/index', $data);
        die;
    }

}
