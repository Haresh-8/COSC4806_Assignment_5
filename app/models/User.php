<?php

class User {

    // Authenticate user (login process)
    public function authenticate($username, $password) {
        $db = db_connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Brute-force lockout (60 seconds after 3 failed attempts)
        if (isset($_SESSION['lastFailed']) && isset($_SESSION['failedAuth']) &&
            time() - $_SESSION['lastFailed'] < 60 && $_SESSION['failedAuth'] >= 3) {
            $_SESSION['error'] = "Too many failed attempts. Try again after 60 seconds.";
            header("Location: /login");
            exit;
        }

        // Validate user credentials
        if ($user && password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['auth'] = 1;
            $_SESSION['username'] = ucwords($username);
            $_SESSION['user_id'] = $user['id'];

            // Role-based access (admin or user)
            $_SESSION['role'] = isset($user['role']) ? $user['role'] : 'user';
            //  Ensure your `users` table has a `role` column (`admin` or `user`)

            // Reset failed attempts
            $_SESSION['failedAuth'] = 0;
            unset($_SESSION['lastFailed']);

            // Log successful login
            $this->logAttempt($username, "good");

            header("Location: /home");
            exit;
        } else {
            //  Failed login
            $_SESSION['failedAuth'] = ($_SESSION['failedAuth'] ?? 0) + 1;
            $_SESSION['lastFailed'] = time();
            $_SESSION['error'] = "Invalid login.";

            $this->logAttempt($username, "bad");
            header("Location: /login");
            exit;
        }
    }

    // Log every login attempt (good or bad)
    public function logAttempt($username, $attempt) {
        $db = db_connect();
        $stmt = $db->prepare("INSERT INTO login_log (username, attempt) VALUES (?, ?)");
        $stmt->execute([$username, $attempt]);
    }

    // Admin report: Total logins per user
    public function getTotalLogins() {
        $db = db_connect();
        $stmt = $db->query("
            SELECT username, COUNT(*) AS total_logins
            FROM login_log
            WHERE attempt = 'good'
            GROUP BY username
            ORDER BY total_logins DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function test() {
        return "Test method exists.";
    }
}
