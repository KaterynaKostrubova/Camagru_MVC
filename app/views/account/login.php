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
                    <span><i class="fas fa-user"></i></span>
                    <input type="text" name="name" value="" placeholder="Name"  required />
                </p>
                <p>
                    <span><i class="fas fa-key"></i></span>
                    <input type="password" name="passwd" value="" placeholder="Password" required />
                </p>
                <p><input class="button_subm" type="submit" name="submit" value="OK" autofocus /></p>
                <p class="forgot"><a href="/camagru_mvc/account/changepass">Forgot your password?</a></p>
            </form>

        </div>
    </div>
</div>