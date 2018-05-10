<section class="menu_form collapse" id="regForm">
    <fieldset>
        <legend>
            Registration
        </legend>
        <form method="POST" action="<?=$view?>/register">
            <input type="email" name="userEmail" placeholder="E-mail">
            <input type="password" name="userPassword" placeholder="Password">
            <button type="submit">Submit</button>
        </form>
    </fieldset>
</section>