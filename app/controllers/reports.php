<?php

// Make sure to require the models at the top
require_once "app/models/ReminderModel.php";
require_once "app/models/User.php";

class Reports {

    public function index() {
        // ✅ Access Control: Only admin can view reports
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: /home");
            exit;
        }

        // Instantiate models
        $reminderModel = new ReminderModel();
        $userModel = new User();

        // Fetch reports data
        $allReminders = $reminderModel->getAllReminders();
        $topUser = $reminderModel->getUserWithMostReminders();
        $loginCounts = $userModel->getTotalLogins();

        // Pass data array to the view
        $data = [
            "reminders" => $allReminders,
            "mostReminders" => $topUser,
            "totalLogins" => $loginCounts
        ];

        // Load the reports view
        require_once "app/views/reports/index.php";
    }
}
