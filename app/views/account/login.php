<!--<h3>Log in</h3>-->
<!--<form action="/mvc_php/account/login" method="post">-->
<!--    <p>Login</p>-->
<!--    <p><input type="text" name="log"></p>-->
<!--    <p>Password</p>-->
<!--    <p><input type="text" name="pass"></p>-->
<!--    <input type="submit" name="OK">-->
<!--</form>-->
<div class="form">
    <ul onclick="myFunction(event)" class="select">
        <li>
            <a href="#register" id="register">Sign Up</a>
        </li>
        <li>
            <a href="#login" id="login" class="active">Log In</a>
        </li>
    </ul>
    <div class = "tab">
        <div id="sign_up">
            <h1>Welcome to Camagru!</h1>
            <form action="/mvc_php/account/login" method="post" class="sign_up_form">
                <p>
                    <span><i class="fas fa-user"></i></span>
                    <input type="text" name="name" value="" placeholder="Name" required />
                </p>
                <p>
                    <span><i class="fas fa-at"></i></span>
                    <input type="email" name="email" placeholder="email@gmail.com" required />
                </p>
                <p>
                    <span><i class="fas fa-key"></i></span>
                    <input type="password" name="passwd" placeholder="Set a password" required />
                </p>
                <p><input class="button_subm" type="submit" name="submit" value="Get started" autofocus /></p>
            </form>
        </div>
        <div id="log_in">
            <h1>Welcome Back!</h1>
            <form action="/mvc_php/account/login" method="post" class="log_in_form">
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


