<?php
$title = "Admin-Main";
$message = "";
$erreur = "";
?>

<?php require '../php/headRequire.php'; ?>

<body class="background-lightaccent">
<?php require 'navigation-bar.php' ?>
<section class="tool-bar | background-lightblue">
    <h2 class="txt-lightaccent">Admin main</h2>
    <ul>
        <li class="background-gold hover-light" onclick="showManageUser()"> Create user
        <li class="background-gold hover-light" onclick="showManageFunction()"> Add formations
    </ul>
</section>
<div class="width-screen">
<main class="box-list | background-lightblue">
    <section>
        <ul id="users_list">
        </ul>
    </section>
</main>
</div>
<div class="center-form hidden" id="manage">
    <?php include "manage-user.php" ?>
</div>
<section class="center-form hidden" id="delete">
    <?php require "delete-user.php" ?>
</section>
<section class="center-form hidden" id="user">
    <?php require 'manage-user.php' ?>
</section>
<section class="center-form hidden" id="functions">
    <?php require 'manage-functions.php' ?>
</section>
</body>
</html>
<script src="../js/admin-main.js" type="module"></script>
<script>
    document.querySelector("#user #addFunction").addEventListener("click", addFunctionUser)
    let FunctionSectionCreateUser = document.querySelector("#user #function_section_user")

    document.querySelector("#manage #addFunction").addEventListener("click", addFunctionManageUser)
    let FunctionSectionManageUser = document.querySelector("#manage #function_section_user")

    function addFunctionUser() {
        let button = document.createElement("button")
        button.type = "button"
        button.innerText = "delete"
        button.classList.add("hover-light", "delete-button", "font-default", "fs-400", "material-symbols-outlined")
        button.id = `function${FunctionSectionCreateUser.childElementCount + 1}`
        let li = document.createElement("li")
        li.innerHTML = `<select name="function${FunctionSectionCreateUser.childElementCount + 1}">  <option value="Logistics Officer">Logistics Officer</option> <option value="IT Infrastructure Manager">IT Infrastructure Manager</option> <option value="Planning Officer">Planning Officer</option> </select>`
        button.addEventListener("click", function () {
            FunctionSectionCreateUser.removeChild(li)
            document.querySelector("#user #function_count").setAttribute("value", FunctionSectionCreateUser.childElementCount.toString())
        })
        li.appendChild(button)
        FunctionSectionCreateUser.appendChild(li)
        document.querySelector("#user #function_count").setAttribute("value", FunctionSectionCreateUser.childElementCount.toString())
    }

    function addFunctionManageUser() {
        let button = document.createElement("button")
        button.type = "button"
        button.innerText = "delete"
        button.classList.add("hover-light", "delete-button", "font-default", "fs-400", "material-symbols-outlined")
        button.id = `function${FunctionSectionManageUser.childElementCount + 1}`
        let li = document.createElement("li")
        li.innerHTML = `<select name="function${FunctionSectionManageUser.childElementCount + 1}">  <option value="Logistics Officer">Logistics Officer</option> <option value="IT Infrastructure Manager">IT Infrastructure Manager</option> <option value="Planning Officer">Planning Officer</option> </select>`
        button.addEventListener("click", function () {
            FunctionSectionManageUser.removeChild(li)
            document.querySelector("#manage #function_count").setAttribute("value", FunctionSectionCreateUser.childElementCount.toString())
        })
        li.appendChild(button)
        FunctionSectionManageUser.appendChild(li)
        document.querySelector("#manage #function_count").setAttribute("value", FunctionSectionCreateUser.childElementCount.toString())
    }

    let userForm = document.getElementById("user")
    let functionForm = document.getElementById("functions")

    function showManageUser() {
        if (userForm.classList.contains("hidden")) {
            userForm.classList.remove("hidden")
        } else {
            userForm.classList.add("hidden")
        }
        if (!functionForm.classList.contains("hidden"))
            functionForm.classList.add("hidden")
    }

    function showManageFunction() {
        if (functionForm.classList.contains("hidden")) {
            functionForm.classList.remove("hidden")
        } else {
            functionForm.classList.add("hidden")
        }
        if (!userForm.classList.contains("hidden"))
            userForm.classList.add("hidden")
    }
</script>