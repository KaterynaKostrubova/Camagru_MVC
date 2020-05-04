<div class="form">
    <form class="login_signup" action="<?php DIR_NAME . '/account/newpass?name='.$_GET['token']?>" method="post">
        <h1>Create a new password</h1>
        <p>
            <span><i class="fas fa-key"></i></span>
            <input type="password" name="pass_first" placeholder="Type new password" required />
        </p>
        <p>
            <span><i class="fas fa-key"></i></span>
            <input type="password" name="pass_second" placeholder="Type again" required />
        </p>
        <p id="sbm"><input class="button_subm" type="submit" name="submit" value="Change password" autofocus /></p>
    </form>
</div>
