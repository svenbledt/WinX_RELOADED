<?php
// check if reset button is pressed
if (isset($_GET['newtopic'])) {
    unset($_SESSION['topic']);
    unset($_SESSION['current_question']);
    header('Location: index.php?page=index');
}
// check if back button is pressed
if (isset($_POST['back'])) {
    if ($_SESSION['current_question'] <= 0) {
        $_SESSION['current_question'] = 0;
        header("Location: index.php?page=index");
    } else {
        $_SESSION['current_question'] = $_SESSION['current_question'] - 1;
        header("Location: index.php?page=index");
    }
}

// check if logout button is pressed
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    logout();
    header('Location: index.php?page=index');
}

// set topic
if (isset($_POST['topic'])) {
    $_SESSION['topic'] = $_POST['topic'];
    header('Location: index.php?page=index');
}
// get all information for current topic
if (isset($_SESSION['topic'])) {
    $qsInfo = $conn->query("SELECT * FROM questions WHERE topic = '" . $_SESSION['topic'] . "'");
    $qsInfo = $qsInfo->fetchAll(PDO::FETCH_ASSOC);
    $qs_answers = $conn->query("SELECT * FROM answers WHERE question_id = '" . $qsInfo[$_SESSION['current_question']]['id'] . "'");
    $answers = $qs_answers->fetchAll(PDO::FETCH_ASSOC);
}

// get current question
if (!isset($_SESSION['current_question'])) {
    $_SESSION['current_question'] = 0;
}

// set current question to variable for easier access later
$current_question = $qsInfo[$_SESSION['current_question']];


// check if form is submitted
if (isset($_POST['next'])) {

    // insert answer into database
    $timest = getTimestamp();
    $correct = "SELECT is_correct FROM answers WHERE question_id = '" . $current_question['id'] . "' AND answer = '" . $_POST['answer'] . "'";
    $correct = $conn->query($correct);

    if ($correct == 1) {
        $correct = 1;
    } else {
        $correct = 0;
    }
    $find = "SELECT * FROM summary WHERE user_id = :user_id AND question_id = :question_id";
    $stmt = $conn->prepare($find);
    $stmt->bindParam(':user_id', $_SESSION['ID']);
    $stmt->bindParam(':question_id', $current_question['id']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $sql = "UPDATE summary SET answer = :answer, correct = :correct, timest = :timest WHERE user_id = :user_id AND question_id = :question_id";
    } else {
        $sql = "INSERT INTO summary (user_id, question_id, answer, correct, timest) VALUES (:user_id, :question_id, :answer, :correct, :timest)";
    }
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $_SESSION['ID']);
    $stmt->bindParam(':question_id', $current_question['id']);
    $stmt->bindParam(':answer', $_POST['answer']);
    $stmt->bindParam(':correct', $correct);
    $stmt->bindParam(':timest', $timest);
    $stmt->execute();
    // increment current question index
    $_SESSION['current_question'] = $_SESSION['current_question'] + 1;

    // check if all questions have been answered
    if ($_SESSION['current_question'] >= count($qsInfo)) {
        // reset current question index
        $result = "All questions answered, show results here";
        unset($_SESSION['current_question']);
        unset($_SESSION['topic']);
        header("Location: index.php?page=index");
    }
    header("Location: index.php?page=index");
}
?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">

    <title>
        Trivia Quiz by Sven Bledt
    </title>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <link id="fontawesome" href="./assets/css/all.css" rel="stylesheet" />

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- CSS Files -->

    <link id="pagestyle" href="./assets/css/style.css?v=3.0.4" rel="stylesheet" />

    <!-- Animate-style-liprary css cdn -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;800&display=swap" rel="stylesheet">

</head>

<body class="index-page bg-gray-200">

    <!-- Navbar -->
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg  blur border-radius-md top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid px-0">
                        <a class="navbar-brand font-weight-bolder ms-sm-3" href="index.php" rel="tooltip" title="Designed and Coded by Sven Bledt" data-placement="bottom" target="_blank">
                            WinX Reloaded
                        </a>
                        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon mt-2">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
                            <ul class="navbar-nav navbar-nav-hover ms-auto">
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuPages" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="material-icons opacity-6 me-2 text-md">dashboard</i>
                                        Pages
                                        <img src="./assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-auto ms-md-2">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-xl mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages">
                                        <div class="d-none d-lg-block">
                                            <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">
                                                Landing Pages
                                            </h6>
                                            <a href="index.php?page=index" class="dropdown-item border-radius-md">
                                                <span>Home</span>
                                            </a>
                                            <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1 mt-3">
                                                Account
                                            </h6>
                                            <a href="index.php?page=sign-in" class="dropdown-item border-radius-md">
                                                <span>Sign In</span>
                                            </a>

                                            <a href="index.php?page=register" class="dropdown-item border-radius-md">
                                                <span>
                                                    Register
                                                </span>
                                            </a>
                                        </div>

                                        <div class="d-lg-none">
                                            <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">
                                                Sites
                                            </h6>

                                            <a href="index.php?page=index" class="dropdown-item border-radius-md">
                                                <span>Home</span>
                                            </a>

                                            <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1 mt-3">
                                                Account
                                            </h6>
                                            <a href="index.php?page=sign-in" class="dropdown-item border-radius-md">
                                                <span>Sign In</span>
                                            </a>
                                            <a href="index.php?page=register" class="dropdown-item border-radius-md">
                                                <span>
                                                    Register
                                                </span>
                                            </a>

                                        </div>

                                    </div>
                                </li>

                                <li class="nav-item ms-lg-auto">
                                    <a class="nav-link nav-link-icon me-2" href="https://github.com/svenbledt" target="_blank">
                                        <i class="fa fa-github me-1"></i>
                                        <p class="d-inline text-sm z-index-1 font-weight-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Star us on Github">Github</p>
                                    </a>
                                </li>
                                <li class="nav-item my-auto ms-3 ms-lg-0">

                                    <?php
                                    if (isset($_SESSION['LOGGEDIN']) && $_SESSION['LOGGEDIN'] == true) {
                                        echo '<a href="index.php?page=index&logout=true" class="btn btn-sm  bg-gradient-primary  mb-0 me-1 mt-2 mt-md-0"><i class="fas fa-sign-out-alt mx-1"></i>' . $user['username'] . '</a>';
                                    } else {
                                        echo '<a href="index.php?page=sign-in" class="btn btn-sm  bg-gradient-primary  mb-0 me-1 mt-2 mt-md-0"><i class="fas fa-sign-in-alt mx-1"></i>Login</a>';
                                    };
                                    ?>

                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>