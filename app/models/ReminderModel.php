<?php
class ReminderModel {
    public function getByUser($user_id) {
        $db = db_connect();
        $stmt = $db->prepare("SELECT * FROM reminders WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add completed default param
    public function create($user_id, $subject, $completed = 0) {
        $db = db_connect();
        $stmt = $db->prepare("INSERT INTO reminders (user_id, subject, completed) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $subject, $completed]);
    }

    public function delete($id, $user_id) {
        $db = db_connect();
        $stmt = $db->prepare("DELETE FROM reminders WHERE id = ? AND user_id = ?");
        $stmt->execute([$id, $user_id]);
    }

    // Add completed param
    public function update($id, $subject, $completed, $user_id) {
        $db = db_connect();
        $stmt = $db->prepare("UPDATE reminders SET subject = ?, completed = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([$subject, $completed, $id, $user_id]);

    }

    public function getById($id, $user_id) {
        $db = db_connect();
        $stmt = $db->prepare("SELECT * FROM reminders WHERE id = ? AND user_id = ?");
        $stmt->execute([$id, $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
