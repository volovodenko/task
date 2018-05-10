<section class="menu_form collapse" id="loginForm">
    <fieldset>
        <legend>
            Login
        </legend>
        <form method="POST" action="<?=$view?>/login">
            <input type="email" name="userEmail" placeholder="E-mail">
            <input type="password" name="userPassword" placeholder="Password">
            <button type="submit">Login <i class="fa fa-sign-in" aria-hidden="true"></i></button>
        </form>
    </fieldset>
</section>