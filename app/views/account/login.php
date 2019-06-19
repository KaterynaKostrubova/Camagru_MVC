<div class="form">
    <ul class="select">
        <!--    <ul onclick="myFunction(event)" class="select">-->
        <li>
            <a href="/camagru_mvc/account/signup" id="register">Sign Up</a>
        </li>
        <li>
            <a href="/camagru_mvc/account/login" id="login" class="active">Log In</a>
        </li>
    </ul>
    <div class = "tab">
        <div id="log_in">
            <h1>Welcome Back!</h1>
            <form action="/camagru_mvc/account/login" method="post" class="log_in_form">
                <p>
                    <span><i class="fas fa-at"></i></span>
                    <input type="email" name="email" value="" placeholder="email@gmail.com" required />
                </p>
                <p>
                    <span><i class="fas fa-key"></i></span>
                    <input type="password" name="passwd" value="" placeholder="Set a password" />
                </p>
                <p><input class="button_subm" type="submit" name="submit" value="OK" autofocus /></p>
            </form>
        </div>
    </div>
</div>