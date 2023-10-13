<?php $user_name = "";

if (isset($_SESSION["firstname"]) && isset($_SESSION["lastname"])) {
    $user_name = strtoupper($_SESSION["firstname"])." ".strtoupper($_SESSION["lastname"]);
}

?>

<nav class="navigation-bar | background-blue txt-lightaccent">
    <a href="../index.php" class="company-icon"><img class="company-icon | background-lightaccent hover-black" src="img/company-icon.png"></a>
    <?php if(basename($_SERVER['PHP_SELF']) !== "authentification.php") {
        echo "
            <div class='page'>
        <ul>
            <li class='background-gold fs-500 hover-light'>
                <a href='dashboard.php' class='txt-darkaccent'>DASHBOARD</a>
            </li>
            <li class='background-gold fs-500 hover-light'>
                <a href='catalogue.php' class='txt-darkaccent'>CATALOGUE</a>
            </li>
            <li class='background-gold fs-500 hover-light'>
                <a href='admin-main.php' class='txt-darkaccent'>ADMIN PANEL</a>
            </li>
        </ul>
    </div>
        <div>
        <ul>
        <li> $user_name
    <li> <a href=\"../index.php\" class='logout-button | background-lightaccent txt-darkblue hover-black material-symbols-outlined'>logout</a>
        </ul>
        </div>";
    } ?>
</nav>