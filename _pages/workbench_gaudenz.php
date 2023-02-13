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

?>
<header class="header-2">
 <div class="page-header min-vh-75 relative" style="background-image: url('./assets/img/bg_main.jpg')">
     <span class="mask bg-gradient-primary opacity-4"></span>
     <div class="container">
         <div class="row">
             <div class="col-lg-7 text-center mx-auto">
                 <h1 class="text-white pt-3 mt-n5">WinX Reloaded</h1>
                 <p class="lead text-white mt-3">Are you ready for the Ultimate Quiz experience. <br /> Join the fun today.</p>
             </div>
         </div>
     </div>
 </div>
</header>

<div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
 <section class="my-5 py-5">
     <div class="container mt-sm-5 mt-3">
         <div class="row justify-content-center">
             <div class="col-sm-8">
                 <?php if (!isset($_SESSION['topic'])) { ?>
                     <div class="position-sticky pb-lg-5 pb-3 mx-md-5 mt-lg-0 mt-0 ps-2" style="top: 100px">
                         <h3>And Your Topic Is...</h3>
                         <p></p>
                         <h6 class="text-secondary font-weight-normal pe-3">Please choose the category of the quiz you wanna do!</h6>
                     </div>
                 <?php } else { ?>
                     <div class="position-sticky pb-lg-5 pb-3 mx-md-5 mt-lg-0 mt-0 ps-2" style="top: 100px">
                         <h3>Have Fun</h3>
                         <h6 class="text-secondary font-weight-normal pe-3">Have fun answering the Questions of the quiz!</h6>
                     </div>
                 <?php } ?>
             </div>
             <div class="row justify-content-center">
             <div class="col-sm-12 mt-0">
                     <?php if (!isset($_SESSION['topic']) && isset($_SESSION['LOGGEDIN']) && $_SESSION['LOGGEDIN'] == true) { ?>
                         <!-- Questions -->
                         <form action="" method="post">
                             <div class="col-lg pxy-6">
                                 <div class="position-relative border-radius-md overflow-hidden shadow-lg mb-7">
                                     <div class="container border-bottom">
                                         <div class="row justify-space-between py-2">
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
                                                        <option value="<?php echo $topic['topic']; ?>"><?php echo ucwords($topic['topic']); ?></option><?php } ?>
                                                     </select>                                                                      
                                                     <button type="submit" class="btn btn-secondary">Start Quiz</button>
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
                             <div class="position-relative border-radius-md overflow-hidden shadow-lg mb-7">
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
                                         <div class="row text-center py-3 mt-3">
                                             <div class="col-12 mx-auto">

                                                 <?php
                                                    if (isset($result)) {
                                                        echo '<p class="lead text-dark pt-1 mb-0">' . $result . '</p>';
                                                    } else if (isset($_SESSION['current_question'])) {
                                                        echo '<p class="lead text-dark pt-1 mb-0">' . $current_question['question'] . '</p>';
                                                        echo '<form method="post">';
                                                        echo '<div class="row text-center py-2 mt-3"><div class="col-4 mx-auto text-start">';
                                                        for ($i = 0; $i < count($answers); $i++) {
                                                            if ($current_question['type'] == 'SINGLE') {
                                                                echo '<div class="form-check">';
                                                                echo '<span><input class="form-check-input" type="radio" name="answer" value="' . ($i + 1) . '" id="flexRadioDefault' . ($i + 1) . '" required></span>';
                                                                echo '<label class="form-check-label" for="flexRadioDefault' . ($i + 1) . '">' . $answers[$i]['answer'] . '</label>';
                                                                echo '</div>';
                                                            } else if ($current_question['type'] == 'MULTIPLE') {
                                                                echo '<div class="form-check">';
                                                                echo '<span><input class="form-check-input" type="checkbox" name="answer" value="' . ($i + 1) . '" id="flexCheckDefault' . ($i + 1) . '"></span>';
                                                                echo '<label class="form-check-label" for="flexCheckDefault' . ($i + 1) . '">' . $answers[$i]['answer'] . '</label>';
                                                                echo '</div>';
                                                            }
                                                        }
                                                        echo '<button type="submit" name="next" class="btn btn-primary">Next Question</button>';
                                                        echo '<button type="submit" name="back" class="btn btn-primary">Last Question</button>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                        echo '</form>';
                                                    }
                                                    ?>
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
                                             <pclass="lead text-dark pt-1 mb-0">

                                                 Not Loggedin
                                             </p><div  style="text-align: center"><
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
                                                 
                                                 <a href="index.php?page=sign-in" class="btn btn-primary w-auto me-1 mb-0">Login</a>
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
 

echo '<button type="submit" name="next" class="btn mx-auto px-2 me-2 mt-2"><i class="fa-light fa-circle-arrow-right fa-4x"><p class="btnFont" style="font-family:Poppins,sans-serif;">Next Question</p></i></button>';
echo '<button type="submit" name="back" class="btn btn-primary mx-auto px-2 me-2 mt-2">Last Question</button>';


<div class="container">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
                                                <i class="fas fa-arrow-up"></i>
                                                </button>
                                            </div>
                                        </div>
                                     </div>
                                                           

                                     <i class="fa-light fa-circle-arrow-up"></i>



<script>
    /* Button to top scrolling ----------------------------------------------------------------- */
    //Get the button
    /* let mybutton = document.getElementById("btn-back-to-top");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () {
      scrollFunction();
    };

    function scrollFunction() {
      if (
        document.body.scrollTop > 20 ||
        document.documentElement.scrollTop > 20
      ) {
        mybutton.style.display = "block";
      } else {
        mybutton.style.display = "none";
      }
    }
    // When the user clicks on the button, scroll to the top of the document
    mybutton.addEventListener("click", backToTop);

    function backToTop() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    } */
</script>                                     

<style>
  /*   #btn-back-to-top {
  position: fixed;
  bottom: 20px;
  right: 20px;
  display: none;
} */
/* .card{
    background:  linear-gradient(180deg, rgba(255,145,192,1) 0%, rgba(255,204,232,1) 5%, rgba(255,255,255,1) 100%);

} */


/* .Geography {
  background: linear-gradient(180deg, rgba(255,145,192,1) 0%, rgba(255,204,232,1) 5%, rgba(255,255,255,1) 100%);
}
.Astronautics {
  background: linear-gradient(180deg, rgba(72,27,255,1) 0%, rgba(204,236,255,1) 8%, rgba(255,255,255,1) 100%);
} */


</style>

<i class="fa-light fa-forward-step"></i>




<?php echo ucfirst($topic);  ?> 