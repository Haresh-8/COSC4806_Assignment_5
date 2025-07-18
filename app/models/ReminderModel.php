<?php

class ReminderModel {

    // Get all reminders for a specific user
    public function getByUser($user_id) {
        $db = db_connect();
        $stmt = $db->prepare("SELECT * FROM reminders WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create a new reminder (completed default = 0)
    public function create($user_id, $subject, $completed = 0) {
        $db = db_connect();
        $stmt = $db->prepare("INSERT INTO reminders (user_id, subject, completed, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$user_id, $subject, $completed]);
    }

    // Delete a reminder
    public function delete($id, $user_id) {
        $db = db_connect();
        $stmt = $db->prepare("DELETE FROM reminders WHERE id = ? AND user_id = ?");
        $stmt->execute([$id, $user_id]);
    }

    // Update a reminder (mark completed or edit subject)
    public function update($id, $subject, $completed, $user_id) {
        $db = db_connect();
        $stmt = $db->prepare("UPDATE reminders SET subject = ?, completed = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([$subject, $completed, $id, $user_id]);
    }

    // Get reminder by ID
    public function getById($id, $user_id) {
        $db = db_connect();
        $stmt = $db->prepare("SELECT * FROM reminders WHERE id = ? AND user_id = ?");
        $stmt->execute([$id, $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     // ADMIN: Get all reminders (for reports)
        public function getAllReminders() {
            $db = db_connect();
            $stmt = $db->query("
                SELECT reminders.id, reminders.subject, reminders.completed, reminders.created_at,
                       users.username
                FROM reminders
                JOIN users ON reminders.user_id = users.id
                ORDER BY reminders.created_at DESC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // ADMIN: Find which user has the most reminders
        public function getUserWithMostReminders() {
            $db = db_connect();
            $stmt = $db->query("
                SELECT users.username, COUNT(reminders.id) AS total_reminders
                FROM reminders
                JOIN users ON reminders.user_id = users.id
                GROUP BY users.username
                ORDER BY total_reminders DESC
                LIMIT 1
            ");
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

    // Count completed reminders for a specific user
        public function countCompleted($user_id) {
            $db = db_connect();
            $stmt = $db->prepare("SELECT COUNT(*) FROM reminders WHERE user_id = ? AND completed = 1");
            $stmt->execute([$user_id]);
            return $stmt->fetchColumn();
        }
}
