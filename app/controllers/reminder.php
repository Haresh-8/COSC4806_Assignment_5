<?php

class Reminder extends Controller {
    public function index() {
        if (!isset($_SESSION['auth']) || !isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Unauthorized access.";
            header("Location: /login");
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $model = $this->model('ReminderModel');
        $reminders = $model->getByUser($user_id);

        $this->view('reminder/index', ['reminders' => $reminders]);
    }

    public function create() {
        if (!isset($_SESSION['auth']) || !isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Please login first.";
            header("Location: /login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = trim($_POST['subject'] ?? '');
            $user_id = $_SESSION['user_id'];

            if (empty($subject)) {
                $_SESSION['error'] = "Reminder cannot be empty.";
                header("Location: /reminder/create");
                exit;
            }

            // Set completed default 0 (false)
            $completed = 0;

            $this->model('ReminderModel')->create($user_id, $subject, $completed);
            $_SESSION['message'] = "Reminder created.";
            header("Location: /reminder");
            exit;
        } else {
            $this->view('reminder/create');
        }
    }

    public function edit($id = null) {
        if (!isset($_SESSION['auth']) || !isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Please login first.";
            header("Location: /login");
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $model = $this->model('ReminderModel');

        if (!$id) {
            $_SESSION['error'] = "Invalid reminder ID.";
            header("Location: /reminder");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = trim($_POST['subject'] ?? '');
            $completed = isset($_POST['completed']) ? 1 : 0;

            if (empty($subject)) {
                $_SESSION['error'] = "Reminder cannot be empty.";
                header("Location: /reminder/edit/$id");
                exit;
            }

            $reminder = $model->getById($id, $user_id);
            if (!$reminder) {
                $_SESSION['error'] = "Reminder not found or unauthorized.";
                header("Location: /reminder");
                exit;
            }

            $model->update($id, $subject, $completed, $user_id);
            $_SESSION['message'] = "Reminder updated.";
            header("Location: /reminder");
            exit;
        } else {
            $reminder = $model->getById($id, $user_id);

            if (!$reminder) {
                $_SESSION['error'] = "Reminder not found or unauthorized.";
                header("Location: /reminder");
                exit;
            }

            $this->view('reminder/edit', ['reminder' => $reminder]);
        }
    }

    public function delete($id = null) {
        if (!isset($_SESSION['auth']) || !isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Please login first.";
            header("Location: /login");
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $model = $this->model('ReminderModel');

        if (!$id) {
            $_SESSION['error'] = "Invalid reminder ID.";
            header("Location: /reminder");
            exit;
        }

        $reminder = $model->getById($id, $user_id);
        if (!$reminder) {
            $_SESSION['error'] = "Reminder not found or unauthorized.";
            header("Location: /reminder");
            exit;
        }

        $model->delete($id, $user_id);
        $_SESSION['message'] = "Reminder deleted.";
        header("Location: /reminder");
        exit;
    }

  
    public function complete($id = null) {
        if (!isset($_SESSION['auth']) || !isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Please login first.";
            header("Location: /login");
            exit;
        }

        if (!$id) {
            $_SESSION['error'] = "Invalid reminder ID.";
            header("Location: /reminder");
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $model = $this->model('ReminderModel');

        $reminder = $model->getById($id, $user_id);
        if (!$reminder) {
            $_SESSION['error'] = "Reminder not found or unauthorized.";
            header("Location: /reminder");
            exit;
        }

        $model->update($id, $reminder['subject'], 1, $user_id);

        $_SESSION['message'] = "Reminder marked as completed.";
        header("Location: /reminder");
        exit;
    }
}
