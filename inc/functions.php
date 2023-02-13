<?php
// get User Data
if (isset($_SESSION['EMAIL'])) {
    $user = getUser($conn, $_SESSION['EMAIL']);
}
// Session Controller
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800) && !isset($_SESSION['REMEMBER'])) {
    // last request was more than 30 minutes ago
    session_unset(); // unset $_SESSION variable for the run-time 
    session_destroy(); // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp


// Database Connection
function selectFrom($conn, $table)
{
    $thisTable = $conn->query("SELECT * FROM $table");
    $row = $thisTable->fetch(PDO::FETCH_ASSOC);
    return $row;
}

// hash password
function sha256($string)
{
    $encryptionkey = "z%C*F-JaNdRgUkXp2s5v8y/B?D(G+KbP";
    $hash = hash_hmac('sha256', $string, $encryptionkey);
    return $hash;
}

// get timestamp
function getTimestamp()
{
    $date = new DateTime();
    $timestamp = $date->getTimestamp();
    return $timestamp;
}

// register
function register($conn, $email, $password, $username)
{
    $password = sha256($password);
    $timestamp = getTimestamp();
    try {
        $sql = "INSERT INTO users (email, password_sha256, username, created_at, ip) VALUES (:email, :password, :username, :created_at, :ip)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':created_at', $timestamp);
        $stmt->bindParam(':ip', getrealip(), PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// login
function login($conn, $email, $password)
{
    try {
        $sql = "SELECT * FROM users WHERE email = :email AND password_sha256";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', sha256($password), PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// update last login
function updateUser($conn, $email)
{
    $sql = "UPDATE users SET last_login = :last_login, ip = :ip WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':last_login', getTimestamp(), PDO::PARAM_STR);
    $stmt->bindParam(':ip', getrealip(), PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
}

// logout
function logout()
{
    session_unset();
    session_destroy();
}

// get user information
function getUser($conn, $email)
{
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}


// validate email
function mailValidate($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match("/@.+\./", $email)) {
        return true;
    } else {
        return false;
    }
}

// validate password
function pwdValidate($password)
{
    if (strlen($password) >= 8 && preg_match("#[0-9]+#", $password) && preg_match("#[a-zA-Z]+#", $password)) {
        return true;
    } else {
        return false;
    }
}


// validate username
function userValidate($username)
{
    if (strlen($username) >= 3 && preg_match("/^[a-zA-Z0-9]+$/", $username)) {
        return true;
    } else {
        return false;
    }
}

// get real ip address of site visitor
function getrealip()
{
    if (isset($_SERVER)) {
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")) {
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } elseif (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
    return $realip;
}

// get image_name from images table
function getQuestionImage($conn, $image)
{
    $sql = "SELECT image FROM questions WHERE topic = :image";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':type', $image, PDO::PARAM_STR);
    $stmt->execute();
    $image = $stmt->fetch(PDO::FETCH_ASSOC);
    $image_name = $image['image'];
    return $image_name;
}

$topicNameMap = [
    'geography' => 'Geography',
    'music' => 'Music',
    'ch-norris' => 'Chuck Norris',
    'animals' => 'Animals',
    'movies' => 'Movies',
];