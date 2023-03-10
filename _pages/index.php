<?php

// select all topics
$topics = $conn->query("SELECT topic FROM questions");
$topics = $topics->fetchAll(PDO::FETCH_ASSOC);
$topics = array_unique($topics, SORT_REGULAR);

// if score is not defined set it to 0
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}

// initialize current question index if not set
if (!isset($_SESSION['current_question'])) {
    $_SESSION['current_question'] = 0;
}



// Retrieve the image file name for the selected topic from the MySQL database and set placeholder if no topic set

if (isset($_SESSION['topic'])) {
    $stmt = $conn->prepare("SELECT image FROM questions WHERE topic = :topic");
    $stmt->bindParam(':topic', $_SESSION['topic']);
    $stmt->execute();
    $resultImgQuery = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultImgQuery !== false) {
      $imageFilename = $resultImgQuery['image'];
        } else {
      $imageFilename = null;
        }
    } else {
    $imageFilename = null;
}

// Repeat query topic for generation fo class attribute used for backgroundcolor-styling for each topic (ln58 end)
$stmt = $conn->prepare("SELECT image FROM questions WHERE topic = :topic");
$stmt->bindParam(':topic', $_SESSION['topic']);
$stmt->execute();

?>

<header class="header-2">
 <div class="page-header min-vh-50 relative" style="background-image: url(<?php echo isset($imageFilename) ? './assets/img/'.$imageFilename : './assets/img/placeholder.jpg'; ?>)">
     <span class="mask bg-gradient-primary opacity-2"></span>
     <div class="container">
         <div class="row">
             <div class="col-lg-7 text-center mx-auto">
                 <h2 class="text-white py-3 mt-n8" style="font-family:Poppins;">WinX Reloaded <br>- you're smart aint'ya?</h2>
                 <!-- <p class="lead text-white mt-3">Are you ready for the Ultimate Quiz experience. <br /> Join the fun today.</p> -->
             </div>
         </div>
     </div>
 </div>
</header>

<div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n12 mt-md-n11 <?php echo $_SESSION['topic'];?>">
 <section class="my-0 py-1">
     <div class="container mt-sm-5 mt-3 mb-0">
         <div class="row justify-content-center">
             <div class="col-sm-12">
                 <?php if (!isset($_SESSION['topic'])) { ?>
                     <div class="position-sticky pb-lg-3 pb-2 mx-md-5 mt-lg-0 mt-0 ps-2" style="top: 100px">
                         <h3>And Your Topic Is...</h3>
                         <p></p>
                         <h5 class="lead text-dark font-weight-normal pe-3">Please choose the category of the quiz you wanna do!</h5>
                     </div>
                 <?php } else { ?>
                     <div class="position-sticky pb-lg-3 pb-2 mx-md-5 mt-lg-0 mt-0 ps-2" style="top: 100px">
                         <h3>Have Fun</h3>
                         <h5 class="lead text-dark font-weight-normal pe-3">Have fun answering the Questions of the quiz!</h5>
                     </div>
                 <?php } ?>
             </div>
             <div class="row justify-content-center">
             <div class="col-sm-12 mt-0 animate__animated animate__rollIn">
                     <?php if (!isset($_SESSION['topic']) && isset($_SESSION['LOGGEDIN']) && $_SESSION['LOGGEDIN'] == true) { ?>
                         <!-- Questions -->
                         <form action="" method="post">
                             <div class="col-lg pxy-6">
                                 <div class="position-relative border-radius-md overflow-hidden shadow-lg mb-7">
                                     <div class="container border-bottom">
                                         <div class="row justify-space-between py-2 mb-0">
                                             <div class="col-lg-8 me-auto">
                                                 <p class="lead text-dark pt-1 mb-0"><?php if (!isset($result)) { echo 'Choose your topic'; } else { echo $result; }; ?></p>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="tab-content tab-space">
                                         <div class="tab-pane active" id="preview-btn-color">
                                             <div class="row text-center px-3 mt-3">
                                                 <div class="col-12 mx-auto">
                                                     <select name="topic" class="form-select form-select-lg my-3" aria-label=".form-select-lg example">
                                                     <?php foreach ($topics as $topic) { ?>
                                                        <option value="<?php echo $topic['topic']; ?>"><?php echo ucfirst($topic['topic']); ?></option><?php } ?>
                                                     </select>                                                                      
                                                        <button type="submit" class="btn1 border-0 text-secondary">
                                                        <i class="fa-light fa-circle-arrow-right fa-4x">
                                                        <p style="font-family: Poppins, sans-serif; font-weight:bold; font-size: 20%">Start Quiz</p></i></button>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </form>
                     <?php } else if (isset($_SESSION['topic']) && $logged_in) { ?>
                         <!-- Questions -->
                         <div class="col-12">
                             <div class="position-relative border-radius-md overflow-hidden shadow-lg mb-0">
                                 <div class="container border-bottom">
                                     <div class="row justify-space-between py-2">
                                         <div class="col-lg-3 me-auto">
                                             <p class="lead text-dark pt-1 mb-0">
                                                 <?php echo ucfirst($_SESSION['topic']); ?>
                                             </p>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="tab-content tab-space">
                                     <div class="tab-pane active" id="preview-btn-color">
                                         <div class="row text-center py-3 mt-2">
                                             <div class="col-12 mx-auto">

                                                 <?php
                                                    if (isset($result)) {
                                                        /* echo "<span style='text-align: left;'>"; */
                                                        echo '<h4 class="lead text-dark px-5 mx-auto text-start text-md-center">' . $result . '</h4>';
                                                        /* echo "</span>"; */
                                                    } else if (isset($_SESSION['current_question'])) {
                                                        /* echo "<span style='text-align: left;'>"; */
                                                        echo '<h4 class="lead text-dark px-5 mx-auto text-start text-md-center">' . $current_question['question'] . '</h4>';
                                                        /* echo "</span>"; */
                                                        echo '<form method="post">';
                                                        echo '<div class="row text-center py-2 px-4 mt-3">
                                                                <div class="col-sm-8 col-md-6 mx-auto">';
                                                        for ($i = 0; $i < count($answers); $i++) {
                                                            if ($current_question['type'] == 'SINGLE') {
                                                                echo '<div class="form-check text-start py-2">';
                                                                echo '<input class="form-check-input" type="radio" name="answer" value="' . ($i + 1) . '" id="flexRadioDefault' . ($i + 1) . '" required>';
                                                                echo '<label class="form-check-label my-1" for="flexRadioDefault' . ($i + 1) . '">' . $answers[$i]['answer'] . '</label>';
                                                                echo '</div>';
                                                            } else if ($current_question['type'] == 'MULTIPLE') {
                                                                echo '<div class="form-check text-start py-2">';
                                                                echo '<input class="form-check-input" type="checkbox" name="answer" value="' . ($i + 1) . '" id="flexCheckDefault' . ($i + 1) . '">';
                                                                echo '<label class="form-check-label my-1" for="flexCheckDefault' . ($i + 1) . '">' . $answers[$i]['answer'] . '</label>';
                                                                echo '</div>';
                                                            }
                                                        }
                                                        echo '<button type="submit" name="next" class="btn1 btn1-round border-0 text-secondary mx-auto px-2 me-2 mt-1">
                                                        <i class="fa-light fa-circle-arrow-right fa-4x">
                                                        <p style="font-family: Poppins, sans-serif; font-size: 25%">next question</p></i></button>';
                                                        echo '<button type="submit" name="back" class="btn1 btn1-round border-0 text-secondary mx-auto px-2 me-2 mt-1">
                                                        <i class="fa-light fa-forward-step fa-3x">
                                                        <p style="font-family: Poppins, sans-serif; font-size: 25%">last question</p></i></button>';                      
                                                        echo '</form>';
                                                    }
                                                    ?>
                                             </div>
                                         </div>
                                            <div class="row justify-content-center">
                                                <div class="col-sm-2 m-1">
                                                    <a href="#" class="btn1 btn1-round border-0 text-secondary"><i class="fa-light fa-circle-arrow-up fa-2x"><p style="font-family: Poppins, sans-serif;" class="btn1 btn1-round">Up!</p></i></a>
                                                </div>
                                            </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     <?php } else { ?>
                         <div class="col-12">
                             <div class="position-relative border-radius-md overflow-hidden shadow-lg mb-7">
                                 <div class="container border-bottom">
                                     <div class="row justify-space-between py-2">
                                         <div class="col-lg-3 me-auto">
                                             <p class="lead text-dark pt-1 mb-0">
                                                 Not Loggedin
                                             </p>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="tab-content tab-space">
                                     <div class="tab-pane active" id="preview-btn-color">
                                         <div class="row text-center py-3 mt-3">
                                             <div class="col-12 mx-auto">
                                                 <p class="lead text-dark pt-1 mb-0">
                                                     <?php echo "You need to be logged in to take the quiz!"; ?>
                                                 </p>
                                                 <a href="index.php?page=sign-in" class="btn1 btn1-round border-0 text-secondary w-auto me-3 mb-0"><i class="fa-light fa-right-to-bracket fa-4x"><p style="font-family: Poppins, sans-serif;">Login</p></i></a>
                                                 
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     <?php } ?>
                </div>
             </div>
 </section>