<?php

class User {

    private $con, $sqlData;

    public function __construct($con, $username) {
        $this->con = $con;

        $query = $this->con->prepare("SELECT * FROM users WHERE username = :un");
        $query->bindParam(":un", $username);
        $query->execute();

        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);

        // Handle the case where no user is found
        if ($this->sqlData === false) {
            // Set default empty values for the keys
            $this->sqlData = array(
                "username" => "",
                "firstName" => "",
                "lastName" => "",
                "email" => "",
                "profilePic" => "",
                "signUpDate" => ""
            );
        }
    }

    public function getUsername() {
        return isset($this->sqlData["username"]) ? $this->sqlData["username"] : "";
    }

    public function getName() {
        $firstName = isset($this->sqlData["firstName"]) ? $this->sqlData["firstName"] : "";
        $lastName = isset($this->sqlData["lastName"]) ? $this->sqlData["lastName"] : "";
        return trim($firstName . " " . $lastName);
    }

    public static function isLoggedIn() {
        return isset($_SESSION["userLoggedIn"]);
    }

    public function getFirstName() {
        return isset($this->sqlData["firstName"]) ? $this->sqlData["firstName"] : "";
    }

    public function getLastName() {
        return isset($this->sqlData["lastName"]) ? $this->sqlData["lastName"] : "";
    }

    public function getEmail() {
        return isset($this->sqlData["email"]) ? $this->sqlData["email"] : "";
    }

    public function getProfilePic() {
        return isset($this->sqlData["profilePic"]) ? $this->sqlData["profilePic"] : "";
    }

    public function getSignUpDate() {
        return isset($this->sqlData["signUpDate"]) ? $this->sqlData["signUpDate"] : "";
    }

    public function getFullName() {
        $firstName = isset($this->sqlData["firstName"]) ? $this->sqlData["firstName"] : "";
        $lastName = isset($this->sqlData["lastName"]) ? $this->sqlData["lastName"] : "";
        return trim($firstName . " " . $lastName);
    }

    public function isSubscribedTo($userTo) {
        $query = $this->con->prepare("SELECT * FROM subscribers WHERE userTo = :userTo AND userFrom = :userFrom");
        $username = $this->getUsername();
        $query->bindParam(":userTo", $userTo);
        $query->bindParam(":userFrom", $username);
        $query->execute();

        return $query->rowCount() > 0;
    }

    public function getSubscriberCount() {
        $query = $this->con->prepare("SELECT * FROM subscribers WHERE userTo = :userTo");
        $username = $this->getUsername();
        $query->bindParam(":userTo", $username);
        $query->execute();

        return $query->rowCount();
    }

    public function getSubscriptions() {
        $query = $this->con->prepare("SELECT userTo FROM subscribers WHERE userFrom = :userFrom");
        $username = $this->getUsername();
        $query->bindParam(":userFrom", $username);
        $query->execute();

        $subs = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($this->con, $row["userTo"]);
            array_push($subs, $user);
        }
        return $subs;
    }
}
?>
