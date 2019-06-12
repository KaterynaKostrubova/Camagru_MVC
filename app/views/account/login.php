<!--<h3>Log in</h3>-->
<!--<form action="/mvc_php/account/login" method="post">-->
<!--    <p>Login</p>-->
<!--    <p><input type="text" name="log"></p>-->
<!--    <p>Password</p>-->
<!--    <p><input type="text" name="pass"></p>-->
<!--    <input type="submit" name="OK">-->
<!--</form>-->
<div class="form">
    <ul class="select">
<!--    <ul onclick="myFunction(event)" class="select">-->
        <li>
            <a href="#register" id="register" class="active">Sign Up</a>
        </li>
<!--        <li>-->
<!--            <a href="#login" id="login">Log In</a>-->
<!--        </li>-->
    </ul>
    <div class = "tab">
        <div id="sign_up">
            <h1>Welcome to Camagru!</h1>
            <form action="/camagru_mvc/account/login" method="post" class="sign_up_form">
                <p>
                    <span><i class="fas fa-user"></i></span>
                    <input type="text" name="name" value="" placeholder="Name" pattern="[A-Za-z]{1}[A-Za-z-0-9]{3,32}"
                           title="Can't begin with a number. Can contain letter, number and at least 3 and no more 32 characters" required />
                </p>
                <p>
                    <span><i class="fas fa-at"></i></span>
                    <input type="email" name="email" placeholder="email@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required />
                </p>
                <p>
                    <span><i class="fas fa-key"></i></span>
                    <input type="password" name="passwd" placeholder="Set a password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                           title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required />
                </p>
                <p id="sbm"><input class="button_subm" type="submit" name="submit" value="Get started" autofocus /></p>
            </form>
        </div>
<!--        <div id="log_in">-->
<!--            <h1>Welcome Back!</h1>-->
<!--            <form action="/camagru_mvc/account/login" method="post" class="log_in_form">-->
<!--                <p>-->
<!--                    <span><i class="fas fa-at"></i></span>-->
<!--                    <input type="email" name="email" value="" placeholder="email@gmail.com" required />-->
<!--                </p>-->
<!--                <p>-->
<!--                    <span><i class="fas fa-key"></i></span>-->
<!--                    <input type="password" name="passwd" value="" placeholder="Set a password" />-->
<!--                </p>-->
<!--                <p><input class="button_subm" type="submit" name="submit" value="OK" autofocus /></p>-->
<!--            </form>-->
<!--        </div>-->

    </div>
</div>


