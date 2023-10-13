<?php
$title = "dashboard";
$message = "";
$erreur = "";

$page = "dashboard-section/";

if (isset($_GET["page"])) {
    if ($_GET["page"] === "completed") {
        $page .= "completed-training.php";
        $page_name = "Completed training";
    } else if ($_GET["page"] === "request") {
        $page .= "requested-training.php";
        $page_name = "Requested training";
    } else if ($_GET["page"] === "accreditation") {
        $page .= "accreditation.php";
        $page_name = "Accreditation";
    } else if ($_GET["page"] === "training-path") {
        $page .= "training-path.php";
        $page_name = "Training path";
    } else {
        $page .= "ongoing-training.php";
        $page_name = "Ongoing training";
    }
} else {
    $page .= "ongoing-training.php";
    $page_name = "Ongoing training";
}

require '../php/headRequire.php';
?>

<body class="background-lightaccent">
<?php require 'navigation-bar.php' ?>
<section class="tool-bar | background-lightblue">
    <h2 class="txt-lightaccent"><?= $page_name?></h2>
    <ul>
        <li class="background-gold hover-light"> <a href="dashboard.php" class="txt-darkaccent">Ongoing training</a>
        <li class="background-gold hover-light"> <a href="dashboard.php?page=completed" class="txt-darkaccent">Completed training</a>
        <li class="background-gold hover-light"> <a href="dashboard.php?page=request" class="txt-darkaccent">Request training</a>
        <li class="background-gold hover-light"> <a href="dashboard.php?page=training-path" class="txt-darkaccent">Training path</a>
        <li class="background-gold hover-light"> <a href="dashboard.php?page=accreditation" class="txt-darkaccent">Accreditation</a>
    </ul>
</section>
<?php require $page ?>
</body>
</html>
