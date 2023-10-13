<form class="background-blue">
    <button type="button" onclick="showTraining()" class="close-button | with-border font-default fs-500 hover-light">
        <span class="material-symbols-outlined">
            close
        </span>
    </button>
    <select>
        <option>BASIC</option>
        <option>ADVANCED</option>
    </select>
    <input type="text" name="training_name" placeholder="Training name" class="background-lightaccent with-border font-default fs-500">
    <input type="number" name="firstname" placeholder="Duration (in minutes)" class="background-lightaccent with-border font-default fs-500">
    <select multiple>
        <option>How to SQL - Guide to learn SQL Languages</option>
        <option>Designers</option>
    </select>
    <div>
        <h3 class="fs-500 background-darkblue txt-lightaccent font-default">Functions
        </h3>
        <button onclick="addFunction()" type="button" class="hover-light font-default" style="display: flex; align-items: center">
            <span class="material-symbols-outlined">
                add
            </span>
        </button>
    </div>
    <ul id="function_section">
        <li>
            <input type="text" value="Any" class="background-lightaccent font-default fs-400">
            <span class="delete-button fs-400 font-default hover-light fs-400 material-symbols-outlined">delete</span>
        </li>
    </ul>

    <input type="number" style="display: none" value="1" id="function_count">
    <input type="submit" value="Confirm change" class="background-gold with-border font-default fs-400 hover-light">
</form>

<script>
    let FunctionSection = document.getElementById("function_section")

    function addFunction() {
        let button = document.createElement("button")
        button.type = "button"
        button.innerText = "delete"
        button.classList.add("hover-light", "delete-button", "font-default", "fs-400", "material-symbols-outlined")
        button.id = `function${FunctionSection.childElementCount + 1}`
        let li = document.createElement("li")
        li.innerHTML = "<input type='text' placeholder='Name'>"
        button.addEventListener("click", function () {
            FunctionSection.removeChild(li)
            document.getElementById("function_count").setAttribute("value", FunctionSection.childElementCount.toString())
        })
        li.appendChild(button)
        FunctionSection.appendChild(li)
        document.getElementById("function_count").setAttribute("value", FunctionSection.childElementCount.toString())
    }
</script>