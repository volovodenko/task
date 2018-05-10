(function () {
    var products = document.querySelector(".side a[href='dashboard/products']"),
        users = document.querySelector(".side a[href='dashboard/users']"),
        dashboard = document.getElementById("dashboard");

    var request, responseBody;


    function getXMLHttpRequest() {
        if (window.XMLHttpRequest) {
            return new XMLHttpRequest();
        }

        return new ActiveXObject('Microsoft.XMLHTTP');

    }

    if (users) {
        users.addEventListener("click", function (e) {
            e.preventDefault();

            request = getXMLHttpRequest();

            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    responseBody = request.responseText;
                    dashboard.innerHTML = responseBody;
                    initUsers();
                }
            };

            request.open('GET', '/dashboard/users', true);
            request.send(null);
        });
    }


    if (products) {
        products.addEventListener("click", function (e) {
            e.preventDefault();

            request = getXMLHttpRequest();

            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    responseBody = request.responseText;
                    dashboard.innerHTML = responseBody;
                }
            };

            request.open('GET', '/dashboard/products', true);
            request.send(null);
        });
    }


    function initUsers() {
        var elemsDel = document.getElementsByClassName('del'),
            elemsEdit = document.getElementsByClassName('edit'),
            findUsers = document.getElementById('findUsers');

        var find = function () {
            request = getXMLHttpRequest();

            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var crud = document.querySelector("section[class='crud']");

                    responseBody = request.responseText;
                    crud.outerHTML = responseBody;
                    initUsers();
                }
            };

            request.open('GET', `/dashboard/findUser?find=${findUsers.value}`, true);
            request.send(null);
        };


        findUsers.addEventListener("keyup", function (e) {
            var k = e.key === "Control"
                || e.key === "Alt"
                || e.key === "Shift"
                || e.key === "CapsLock"
                || e.key === "GroupNext"
                || e.key === "Meta";

            if (k) return;
            find();
        });


        for (var i = 0; i < elemsDel.length; i++) {
            elemsDel[i].addEventListener("click", function (e) {
                var email = e.currentTarget.value; //текущий email
                var delConfirmYes = document.getElementById('delConfirmYes');
                var delConfirmNo = document.getElementById('delConfirmNo');
                var del = document.getElementById('legendDelete');

                del.innerHTML = "Confirm delete user <span style='color: white'>" + email + "</span> ?";

                $("#delForm").offset({right: e.pageX, top: e.pageY});
                $("#delForm").slideDown();

                delConfirmYes.addEventListener("click", function () {
                    request = getXMLHttpRequest();

                    request.onreadystatechange = function () {
                        if (request.readyState == 4 && request.status == 200) {
                            find();
                            initUsers();
                        }
                    };

                    request.open('GET', `/dashboard/delUser?name=${email}`, true);
                    request.send(null);

                    $("#delForm").slideUp();
                });


                delConfirmNo.addEventListener("click", function (e) {
                    $("#delForm").slideUp();
                });

            });
        }


        for (var i = 0; i < elemsEdit.length; i++) {
            elemsEdit[i].addEventListener("click", function (e) {
                var email = e.currentTarget.value; //current email
                var currentIsactive = this.parentElement.parentElement.querySelector(".isactive");
                var currentRole = this.parentElement.parentElement.querySelector(".role");
                var currentId = this.parentElement.parentElement.querySelector("input[name='id']");
                var editConfirmYes = document.getElementById('editConfirmYes');
                var editConfirmNo = document.getElementById('editConfirmNo');
                var newUserEmail = document.getElementById('newUserEmail');
                var newUserPassword = document.getElementById('newUserPassword');
                var newRole;
                var newIsActive = document.getElementById("editForm").querySelector("input[name='isActive']");
                var stringRequest;


                newUserEmail.value = email;

                $("#editForm").offset({right: e.pageX, top: e.pageY});
                $("#editForm").slideDown();

                if (currentIsactive.innerHTML === "Yes") {
                    newIsActive.checked = true;
                }

                if (currentRole.innerHTML === "admin") {
                    document.getElementById("roleAdmin").checked = true;
                } else {
                    document.getElementById("roleUser").checked = true;
                }

                newRole = document.getElementById("roleAdmin").checked ? "admin" : "user";

                document.getElementById("roleAdmin").onclick = function () {
                    newRole = "admin";
                };

                document.getElementById("roleUser").onclick = function () {
                    newRole = "user";
                };


                editConfirmYes.addEventListener("click", function () {
                    request = getXMLHttpRequest();

                    request.onreadystatechange = function () {
                        if (request.readyState == 4 && request.status == 200) {
                            responseBody = request.responseText;

                            if (responseBody === "Alert") {
                                setTimeout(function () {
                                    alert("E-mail already exists");
                                }, 500);

                                return;

                            } else {
                                find();
                                initUsers();
                            }

                        }

                    };


                    stringRequest = "/dashboard/editUser?name="
                        + newUserEmail.value
                        + "&password="
                        + newUserPassword.value
                        + "&role="
                        + newRole
                        + "&isactive="
                        + newIsActive.checked
                        + "&id="
                        + currentId.value;

                    request.open('GET', stringRequest, true);
                    request.send(null);

                    $("#editForm").slideUp();
                });


                editConfirmNo.addEventListener("click", function (e) {
                    $("#editForm").slideUp();
                });

            });

        }

    }
})();