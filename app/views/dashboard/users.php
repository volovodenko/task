<section class="find">
    <input type="text" placeholder="Find user" id="findUsers">
</section>

<?php
include_once(VIEWS . DS . "dashboard" . DS . "userstable.php");
?>

<div class="menu_form collapse" id="delForm">
    <fieldset>
        <legend id="legendDelete">
        </legend>
        <button id="delConfirmYes" value="">Yes</button>
        <button id="delConfirmNo">Cancel</button>
    </fieldset>
</div>

<div class="menu_form collapse" id="editForm">
    <fieldset>
        <legend>
            Edit user
        </legend>

        <input type="email" name="newUserEmail" placeholder="E-mail" value="" id="newUserEmail">
        <input type="password" name="newUserPassword" placeholder="Password" id="newUserPassword">
        <legend>
            Role:
            <label>
                <input type="radio" name="role" id="roleAdmin">
                Admin
            </label>
            <label>
                <input type="radio" name="role" id="roleUser">
                User
            </label>
        </legend>
        <label>
            Is active
            <input type="checkbox" name="isActive">
        </label>
        <button id="editConfirmYes">Submit</button>
        <button id="editConfirmNo">Cancel</button>
    </fieldset>
</div>
