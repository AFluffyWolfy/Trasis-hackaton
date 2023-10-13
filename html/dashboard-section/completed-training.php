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
                <p class="background-lightaccent txt-darkblue fs-400 font-default" id="duration">Completed date</p>
                <p class="background-lightaccent txt-darkblue fs-400 font-default" id="end_date">Expiration date</p>
                <div class="material-symbols-outlined background-darkblue with-border txt-darkblue">description</div>
            </li>
            <li>
                <span class="background-darkblue txt-lightaccent fs-400 font-default" id="type">BASIC</span>
                <h2 class="background-darkblue txt-lightaccent fs fs-400 font-default">How to SQL - Guide to learn SQL Languages</h2>
                <p class="background-darkblue txt-lightaccent fs-400 font-default" id="duration">1:30</p>
                <p class="background-darkblue txt-lightaccent fs fs-400 font-default" id="end_date">1/04/2023</p>
                <div class="material-symbols-outlined background-gold with-border txt-darkblue hover-light" onclick="showFile()">description</div>
            </li>
        </ul>
    </section>
</main>
</div>
<section class="center-form hidden" id="file" onclick="showFile()">
    <?php require "file-display.php" ?>
</section>

<script>
    let file = document.getElementById("file")

    function showFile() {
        if (file.classList.contains("hidden")) {
            file.classList.remove("hidden")
        } else {
            file.classList.add("hidden")
        }

    }
</script>