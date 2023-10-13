<?php require '../php/headRequire.php'; ?>
<body class="background-lightaccent">
<?php require 'navigation-bar.php' ?>
<section class="filter-bar">
    <ul>
        <li class="background-darkblue txt-lightaccent hover-light">Mine
        <li class="background-darkblue txt-lightaccent hover-light">My team
    </ul>
</section>
<div class="width-screen">
    <main class="box-list | background-lightblue">
        <section>
            <ul>
                <li>
                    <span class="background-lightaccent txt-darkblue fs-400 font-default" id="type">Type</span>
                    <h2 class="background-lightaccent txt-darkblue fs-400 font-default">Training name</h2>
                    <p class="background-lightaccent txt-darkblue fs-400 font-default" id="duration">Duration</p>
                    <p class="background-lightaccent txt-darkblue fs-400 font-default" id="end_date">For</p>
                    <button class="material-symbols-outlined background-darkblue with-border txt-lightaccent" onclick="showTraining()">add</button>
                </li>
            </ul>
        </section>
    </main>
</div>
    <section class="center-form hidden" id="training">
<?php require "training-form.php" ?>
    </section>
</body>

<script>
    let training = document.getElementById("training")

    function showTraining() {
        if (training.classList.contains("hidden")) {
            training.classList.remove("hidden")
        } else {
            training.classList.add("hidden")
        }
    }
</script>
