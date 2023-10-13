function openForm() {
    document.getElementById("manage").style.display = "block";
}
function openDeleteForm() {
    document.getElementById("delete").style.display = "block";
}

function closeForm() {
    document.getElementById("manage").style.display = "none";
}
function closeDeleteForm() {
    document.getElementById("delete").style.display = "none";
}

// document.getElementById("closeDeleteForm").addEventListener("click", () => {
//     closeDeleteForm()
// })
//
// document.getElementById("closeForm").addEventListener("click", () => {
//     closeForm()
// })

let archive_user_btn = document.getElementById("archive_user")

document.getElementById("close_form").addEventListener("click", closeDeleteForm)

archive_user_btn.addEventListener("click", (event) => {
    console.log('In the ass' + document.getElementById("idDeletedUser").value)
    fetch(`../php/manage_users.inc.php?archive_user&idUser=${document.getElementById("idDeletedUser").value}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`[${response.status}]: ${response.statusText} `)
            }
            return response
        })
        .then(response => {
            console.log(response)
            return response.text()
        })
        .then(result => {
            console.log("On archive user")
            console.log(`Result of request: ${result}`)
            closeDeleteForm()
        })
})
document.getElementById("not_archive_user").addEventListener("click", () => {
    closeDeleteForm()
})

fetch(`../php/get_users.inc.php`)
    .then(response => {
        if (!response.ok) {
            throw new Error(`[${response.status}]: ${response.statusText} `)
        }
        return response
    })
    .then(response => {
        console.log(response)
        return response.json()
    })
    .then(result => {
        console.log(result)
        if(result.message !== undefined) {
            throw new Error(result.message)
        } else {
            let users_list = document.getElementById("users_list")

            for (let u of result){
                let li = document.createElement("li")
                let edit = document.createElement("a")
                edit.className = "edit-button | fs-600 material-symbols-outlined"
                edit.innerHTML = `edit`
                let archive = document.createElement("a")
                archive.className = "delete-button | fs-600 material-symbols-outlined txt-lightaccent"
                archive.innerHTML = `archive`
                li.innerHTML = `<h2 class="fs-600 background-darkblue txt-lightaccent">${u.lastname.toUpperCase()} ${u.firstname}| ${u.mail}</h2>`
                li.append(edit, archive)
                users_list.appendChild(li)
                li.childNodes[1].addEventListener("click", () => {
                    fetch(`../php/get_users.inc.php?editUser=${u.idUser}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`[${response.status}]: ${response.statusText} `)
                            }
                            return response
                        })
                        .then(response => {
                            console.log(response)
                            return response.json()
                        })
                        .then(result => {
                            console.log(u.idUser)
                            openForm()
                        })
                })
                li.childNodes[2].addEventListener("click", () => {
                    console.log("On delete user: " + u.idUser)
                    document.getElementById("idDeletedUser").value = u.idUser
                    openDeleteForm()
                })
            }
        }
    })