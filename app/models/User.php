<?php 

class User {

    public function authenticate($username, $password) {
        $db = db_connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

       
        if (isset($_SESSION['lastFailed']) && isset($_SESSION['failedAuth']) &&
            time() - $_SESSION['lastFailed'] < 60 && $_SESSION['failedAuth'] >= 3) {
            $_SESSION['error'] = "Too many failed attempts. Try again after 60 seconds.";
            header("Location: /login");
            exit;
        }

        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['auth'] = 1;
            $_SESSION['username'] = ucwords($username);
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['failedAuth'] = 0;
            unset($_SESSION['lastFailed']);

            $this->logAttempt($username, "good");
            header("Location: /home");
            exit;
        } else {
            
            $_SESSION['failedAuth'] = ($_SESSION['failedAuth'] ?? 0) + 1;
            $_SESSION['lastFailed'] = time();
            $_SESSION['error'] = "Invalid login.";

            $this->logAttempt($username, "bad");
            header("Location: /login");
            exit;
        }
    }

    public function logAttempt($username, $attempt) {
        $db = db_connect();
        $stmt = $db->prepare("INSERT INTO login_log (username, attempt) VALUES (?, ?)");
        $stmt->execute([$username, $attempt]);
    }

    public function test() {
        return "Test method exists.";
    }
}
