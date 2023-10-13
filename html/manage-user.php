<form action="../php/create_user.php" method="post" class="background-blue">
    <button type="button" onclick="showManageUser()" class="close-button | with-border font-default fs-500 hover-light">
        <span class="material-symbols-outlined">
            close
        </span>
    </button>
    <input type="text" name="mail" placeholder="Email" class="background-lightaccent with-border font-default fs-500">
    <input type="text" name="firstname" placeholder="Firstname" class="background-lightaccent with-border font-default fs-500">
    <input type="text" name="lastname" placeholder="Lastname" class="background-lightaccent with-border font-default fs-500">
    <div>
        <h3 class="fs-500 background-darkblue txt-lightaccent font-default">Functions
        </h3>
        <button type="button" id="addFunction" class="hover-light font-default" style="display: flex; align-items: center">
            <span class="material-symbols-outlined">
                add
            </span>
        </button>
    </div>
    <ul id="function_section_user">
        <li>
            <select name="function1">
                <option value="Logistics Officer">Logistics Officer</option>
                <option value="IT Infrastructure Manager">IT Infrastructure Manager</option>
                <option value="Planning Officer">Planning Officer</option>
            </select>
            <span property="disable" class="delete-button fs-400 font-default material-symbols-outlined">
                delete
            </span>
        </li>
    </ul>

    <input type="number" name="function_count" style="display: none" value="1" id="function_count">
    <input type="submit" value="Create user" class="background-gold with-border font-default fs-400 hover-light">
</form>

