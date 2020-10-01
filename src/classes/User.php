<?php

require_once "Verification.php";

class User
{

    private PDO $db;
    private string $email;
    private string $password;
    private string $username;

    public function __construct($database)
    {
        $this->db = $database;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        if (strpos($email, '@') > -1) {
            $this->email = htmlspecialchars(strip_tags($email));
        }
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $password = htmlspecialchars(strip_tags($password));
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $username = htmlspecialchars(strip_tags($username));
        $this->username = $username;
    }

    public function userLogin() : void
    {
        $params = [':username' => $this->username];

        $stmt = $this->db->prepare('SELECT * FROM USERS WHERE Username = :username;');
        $stmt->execute($params);
        $user = $stmt->fetch();
        if (!empty($user)) {
            if (password_verify($this->password, $user['Password'])) {
                $token = Verification::createJWT();
                echo json_encode(['message' => 'Successful login.', 'JWT' => $token]);
            } else {
                http_response_code(401);
                echo json_encode(['message' => 'Password incorrect']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Login failed']);
        }
    }

    public function userRegister() : void
    {
        $params = [':email' => $this->email, ':password' => password_hash($this->password, PASSWORD_DEFAULT), ':username' => $this->username];

        if ($this->checkUser()) {
            $stmt = $this->db->prepare('INSERT INTO USERS (Email, Password, Username) VALUES (:email, :password, :username)');
            if ($stmt->execute($params)) {
                echo json_encode(['status' => true, 'message' => 'Successful registration']);
            } else {
                http_response_code(401);
                echo json_encode(['status' => false, 'message' => 'Unable to create user']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['status' => false, 'message' => 'Some problem occured']);
        }
    }

    public function checkUser() : bool
    {
        $stmt = $this->db->prepare('SELECT * FROM USERS WHERE Username = :username');
        $stmt->execute(array(':username' => $this->username));
        $users = $stmt->fetch();
        if (empty($users)) {
            return true;
        }
        return false;
    }
}
