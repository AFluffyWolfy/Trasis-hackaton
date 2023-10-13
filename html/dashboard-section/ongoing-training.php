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
                <p class="background-lightaccent txt-darkblue fs-400 font-default" id="end_date">Date</p>
                <div class="material-symbols-outlined background-darkblue with-border txt-darkblue">check</div>
            </li>
        </ul>
    </section>
</main>
</div>

<section class="center-form hidden" id="validateSection">
    <?php require "valid-training.php" ?>
</section>

<script>
    let validateSection = document.getElementById("validateSection")

    function showValidateTraining(id) {
        if (validateSection.classList.contains("hidden")) {
            validateSection.classList.remove("hidden")
        } else {
            validateSection.classList.add("hidden")
        }
        document.getElementById("id").setAttribute("value", id.toString())
    }
</script>

