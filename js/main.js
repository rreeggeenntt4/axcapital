/* ************************************************************************ */
/* Валидация регистрации */
function validate() {
    var valid = true;

    var username = document.getElementById("userName");
    var email = document.getElementById("userEmail");
    var password = document.getElementById("Password");
    var repassword = document.getElementById("RePassword");

    // Имя не должно быть пустым;
    if (username.value.length <= 0) {
        /* alert("Пожалуйста, введите имя пользователя."); */
        username.style.borderColor = 'red';
        valid = false;
    } else {
        username.style.borderColor = 'green';
    }

    // Email не должен быть пустым, в email должен быть один символ @ и как минимум одна точка;
    /* Ищем  "@" и "." */
    var paternemail = /^\w+@\w+\.\w+$/i;
    if ((email.value.length <= 0) || (!(paternemail.test(email.value)))) {
        email.style.borderColor = 'red';
        /* alert("Пожалуйста, введите адрес электронной почты."); */
        valid = false;
    } else {
        email.style.borderColor = 'green';
    }

    // Пароль не должен быть пустым, в пароле минимум 9 символов
    if ((password.value == null || password.value == "") || (password.value.length < 9)) {
        password.style.borderColor = 'red';
        /* alert("Пожалуйста, введите пароль."); */
        valid = false;
    } else {
        password.style.borderColor = 'green';
    }

    // Повторение пароля должно совпадать с полем Пароль. 
    // Пароль не должен быть пустым, в пароле минимум 9 символов
    if ((repassword.value == null || repassword.value == "") || (repassword.value != password.value) || (repassword.value.length < 9)) {
        repassword.style.borderColor = 'red';
        /* alert("Пароль пуст или не соответствует."); */
        valid = false;
    } else {
        repassword.style.borderColor = 'green';
    }

    return valid;
}

//  Кнопка "Очистить форму" регистрации  должна очищать все поля.
function clearFilds() {
    document.getElementById("userName").value = "";
    document.getElementById("userEmail").value = "";
    document.getElementById("Password").value = "";
    document.getElementById("RePassword").value = "";

    validate();
}




function validateauth() {
    var valid = true;
    var email = document.getElementById("userEmail");
    var password = document.getElementById("Password");


    // Email не должен быть пустым, в email должен быть один символ @ и как минимум одна точка;
    /* Ищем  "@" и "." */
    var paternemail = /^\w+@\w+\.\w+$/i;
    if ((email.value.length <= 0) || (!(paternemail.test(email.value)))) {
        email.style.borderColor = 'red';
        /* alert("Пожалуйста, введите адрес электронной почты."); */
        valid = false;
    } else {
        email.style.borderColor = 'green';
    }

    // Пароль не должен быть пустым, в пароле минимум 6 символов
    if ((password.value == null || password.value == "") || (password.value.length < 6)) {
        password.style.borderColor = 'red';
        /* alert("Пожалуйста, введите пароль."); */
        valid = false;
    } else {
        password.style.borderColor = 'green';
    }

    return valid;
}



function validatepopup2() {
    let valid = true;

    let popup2_title = document.getElementById("popup2_title");
    let popup2_descr = document.getElementById("popup2_descr");

    /* Текущий установленый */
    let popup2_id = document.getElementById("popup2_id");
    /* Редактируемый select */
    let popup2_parent_id = document.getElementById("popup2_parent_id");

    if (popup2_id.value.length <= 0) {
        valid = false;
        alert("Не найден id текущей записи");
    }

    if (popup2_title.value.length <= 0) {
        popup2_title.style.borderColor = 'red';
        valid = false;
    } else {
        popup2_title.style.borderColor = 'green';
    }

    if (popup2_descr.value.length <= 0) {
        popup2_descr.style.borderColor = 'red';
        valid = false;
    } else {
        popup2_descr.style.borderColor = 'green';
    }

    /* Элемент не может быть родителем самого себя */
    if (popup2_id.value == popup2_parent_id.value) {
        popup2_parent_id.style.borderColor = 'red';
        valid = false;
        alert("Элемент не может быть родителем самого себя. Так же нужно понимать что корневой элемент не должен содержать parent_id. В случае если будет пересечение элементов у которых нет parent_id у которого он равен NULL, тогда просто не будет варианта отображения элементов, они просто не будут выведенч на экран");
    } else {
        popup2_title.style.borderColor = 'green';
    }

    return valid;
}


function validatepopup3() {
    var valid = true;
    var popup3_title = document.getElementById("popup3_title");
    var popup3_descr = document.getElementById("popup3_descr");


    if (popup3_title.value.length <= 0) {
        popup3_title.style.borderColor = 'red';
        valid = false;
    } else {
        popup3_title.style.borderColor = 'green';
    }

    return valid;
}


//  Кнопка "Очистить форму" авторизации.
function clearFildsauth() {
    document.getElementById("userEmail").value = "";
    document.getElementById("Password").value = "";

    validateauth();
}


/* Авторизация */
if (document.querySelector(".auth_id")) {
    /* var auth_id = document.querySelector(".auth_id"); */
    document.querySelector(".avtorize").addEventListener("click", async function (event) {
        event.preventDefault();

        if (validateauth()) {
            email = document.querySelector(".email_user").value;
            pass = document.querySelector(".pass_user").value;
            console.log("Сработало нажатие");


            let formData = new FormData();
            formData.append('email', email);
            formData.append('pass', pass);

            let response = await fetch('/lk/login.php', {
                method: 'POST',
                body: formData
            });

            let data = await response.json();
            console.dir(data);

            if (data.rezultstatus == "1") {
                document.querySelector(".return_info").textContent = data.rezultmes;
                console.log("Успешная авторизация");
                setTimeout(rloadpage, 2000);
            } else {
                document.querySelector(".return_info").textContent = data.rezultmes;
            }
        }
    });
}





/* Регистрация */
if (document.querySelector(".registration_id")) {
    /* var registration_id = document.querySelector(".registration_id"); */
    document.querySelector(".reg").addEventListener("click", async function (event) {
        event.preventDefault();

        if (validate()) {
            var token = document.getElementById("token").value;
            var username = document.getElementById("userName").value;
            var email = document.getElementById("userEmail").value;
            var pass = document.getElementById("Password").value;
            var repassword = document.getElementById("RePassword").value;
            console.log("Сработало нажатие");


            let formData = new FormData();
            formData.append('token', token);
            formData.append('userName', username);
            formData.append('userEmail', email);
            formData.append('Password', pass);
            formData.append('RePassword', repassword);

            let response = await fetch('/lk/reg_users.php', {
                method: 'POST',
                body: formData
            });

            let data = await response.json();
            console.dir(data);

            if (data.rezultstatus == "1") {
                document.querySelector(".return_info").textContent = data.rezultmes;
                console.log("Успешная регистрация");
                setTimeout(goto_auth_page, 2000);
            } else {
                document.querySelector(".return_info").textContent = data.rezultmes;
            }
        }
    });
}



/* index page */
if (document.querySelector(".index_id")) {

    /* Если страница только что перезагрузилась закрыть все popup */
    let closes = document.querySelectorAll('.close');
    for (let close of closes) {
        close.click();
    };



    /* Edit */
    let boxes = document.querySelectorAll('.edit_category');
    for (let box of boxes) {
        box.addEventListener('click', async function handleClick(event) {
            /* event.preventDefault(); */
            let id = box.getAttribute("data-id");

            /* Вывод данных из бд по id */
            let formData = new FormData();
            formData.append('id', id);

            let response = await fetch('/lk/info.php', {
                method: 'POST',
                body: formData
            });

            let data = await response.json();

            if (data.rezultstatus == "1") {
                document.querySelector(".popup2_id").value = id;
                document.querySelector(".popup2_title").value = data.title;
                document.querySelector(".popup2_descr").textContent = data.descr;
                document.querySelector(".popup2_parent_id").value = data.parent_id;
                console.dir(data);
            } else {
                document.querySelector(".popup2_title").textContent = "Ошибка";
                document.querySelector(".popup2_descr").textContent = "Данные не получены";
                console.dir(data);
            }
        });
    }



    /* Info */
    let boxes2 = document.querySelectorAll('.info_category');
    for (let box2 of boxes2) {
        box2.addEventListener('click', async function handleClick2(event) {
            /* event.preventDefault(); */
            let id = box2.getAttribute("data-id");

            /* Вывод данных из бд по id */
            let formData = new FormData();
            formData.append('id', id);

            let response = await fetch('/lk/info.php', {
                method: 'POST',
                body: formData
            });

            let data = await response.json();

            if (data.rezultstatus == "1") {
                document.querySelector(".popup1_title").textContent = data.title;
                document.querySelector(".popup1_descr").textContent = data.descr;
                console.dir(data);
            } else {
                document.querySelector(".popup1_title").textContent = "Ошибка";
                document.querySelector(".popup1_descr").textContent = "Данные не получены";
                console.dir(data);
            }
        });
    }



    /* Update */
    document.querySelector(".update").addEventListener("click", async function (event) {
        event.preventDefault();

        console.log("Update");

        if (validatepopup2()) {
            console.log("Update valid");

            var token2 = document.getElementById("token2").value;
            var popup2_id = document.getElementById("popup2_id").value;
            var popup2_title = document.getElementById("popup2_title").value;
            var popup2_descr = document.getElementById("popup2_descr").value;
            var popup2_parent_id = document.getElementById("popup2_parent_id").value;
            console.log("Сработало нажатие");


            let formData = new FormData();
            formData.append('token', token2);
            formData.append('popup2_id', popup2_id);
            formData.append('popup2_title', popup2_title);
            formData.append('popup2_descr', popup2_descr);
            formData.append('popup2_parent_id', popup2_parent_id);

            let response = await fetch('/lk/update_category.php', {
                method: 'POST',
                body: formData
            });

            let data = await response.json();
            console.dir(data);

            if (data.rezultstatus == "1") {
                document.querySelector(".return_info2").textContent = data.rezultmes;
                console.log("Обновление успешно");
                setTimeout(rloadpage, 2000);
            } else {
                document.querySelector(".return_info2").textContent = data.rezultmes;
            }
        } else {
            console.log("Update not valid");
        }
    });


    /* Add */
    document.querySelector(".add").addEventListener("click", async function (event) {
        event.preventDefault();

        if (validatepopup3()) {
            var token3 = document.getElementById("token3").value;
            var popup3_title = document.getElementById("popup3_title").value;
            var popup3_descr = document.getElementById("popup3_descr").value;
            var popup3_parent_id = document.getElementById("popup3_parent_id").value;
            console.log("Сработало нажатие");


            let formData = new FormData();
            formData.append('token', token3);
            formData.append('popup3_title', popup3_title);
            formData.append('popup3_descr', popup3_descr);
            formData.append('popup3_parent_id', popup3_parent_id);

            let response = await fetch('/lk/add_category.php', {
                method: 'POST',
                body: formData
            });

            let data = await response.json();
            console.dir(data);

            if (data.rezultstatus == "1") {
                document.querySelector(".return_info3").textContent = data.rezultmes;
                console.log("Добавление успешно");
                setTimeout(rloadpage, 2000);
            } else {
                document.querySelector(".return_info3").textContent = data.rezultmes;
            }
        }
    });


    /* Del */
    document.querySelector(".del").addEventListener("click", async function (event) {
        event.preventDefault();

        var token2 = document.getElementById("token2").value;
        var popup2_id = document.getElementById("popup2_id").value;

        let formData = new FormData();
        formData.append('token', token2);
        formData.append('popup2_id', popup2_id);

        let response = await fetch('/lk/del_category.php', {
            method: 'POST',
            body: formData
        });

        let data = await response.json();
        console.dir(data);

        if (data.rezultstatus == "1") {
            document.querySelector(".return_info2").textContent = data.rezultmes;
            setTimeout(rloadpage, 2000);
        } else {
            document.querySelector(".return_info2").textContent = data.rezultmes;
        }

    });


}



























/* Преобразование в нижний регистр почты и пароля */
// function regtolower() {
//     document.querySelector(".pass_user").addEventListener("input", function () {
//         pastolower = document.querySelector(".pass_user").value;
//         pastolower = pastolower.toLowerCase();
//         document.querySelector(".pass_user").value = pastolower;
//     });

//     document.querySelector(".repass").addEventListener("input", function () {
//         repastolower = document.querySelector(".repass").value;
//         repastolower = repastolower.toLowerCase();
//         document.querySelector(".repass").value = repastolower;
//     });

//     document.querySelector(".email").addEventListener("input", function () {
//         email = document.querySelector(".email").value;
//         email = email.toLowerCase();
//         document.querySelector(".email").value = email;
//     });
// }


/* Преобразование в нижний регистр почты и пароля */
// function authtolower() {
//     document.querySelector(".email_editor").addEventListener("input", function () {
//         email_editor = document.querySelector(".email_editor").value;
//         email_editor = email_editor.toLowerCase();
//         document.querySelector(".email_editor").value = email_editor;
//     });

//     document.querySelector(".pass_editor").addEventListener("input", function () {
//         pass_editor = document.querySelector(".pass_editor").value;
//         pass_editor = pass_editor.toLowerCase();
//         document.querySelector(".pass_editor").value = pass_editor;
//     });
// }


/* Выход */
function exit() {
    document.querySelector(".exit").on("click", function (e) {
        e.preventDefault();
        localStorage.clear();
        document.location.href = "auth.html";
    });
}


/* Перезагрузка страницы */
function rloadpage() {
    document.location.reload();
}


/* Перехожд на страницу */
function goto_auth_page() {
    document.location.href = "/auth.php";
}
