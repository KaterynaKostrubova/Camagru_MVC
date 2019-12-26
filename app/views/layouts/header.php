<!---->
<!--<nav class="navbar navbar-color-on-scroll navbar-transparent fixed-top navbar-expand-lg"  color-on-scroll="100">-->
<!--    <div class="container">-->
<!--        <div class="navbar-translate">-->
<!--            <a class="navbar-brand" href="/camagru_mvc/">-->
<!--                <div class="logo-image">-->
<!--                    <img src="/camagru_mvc/public/image/logo.png" class="img-fluid">-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--        <div class="collapse navbar-collapse">-->
<!--            <ul class="navbar-nav ml-auto">-->
<!--                <li class="nav-item">-->
<!--                    <a href="#" class="nav-link">-->
<!--                        <div class="takePhoto">-->
<!--                            <form action="/camagru_mvc/photo/take">-->
<!--                                <span style="font-size: 30px;">-->
<!--                                    <i class="fas fa-camera"><input type="submit" class=""  value="" ></i>-->
<!--                                </span>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="nav-item">-->
<!--                    <a href="#" class="nav-link">-->
<!--                        <div class="logout">-->
<!--                            <form class="setProfile" method="GET" action="/camagru_mvc/profile/profile">-->
<!--                                <span style="font-size: 30px;">-->
<!--                                    <i class="fas fa-cog"><input id="settings" type="submit" value=""/></i>-->
<!--                                </span>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="nav-item">-->
<!--                    <a href="#" class="nav-link">-->
<!--                        <div class="logout">-->
<!--                            <form action="/camagru_mvc/account/logout">-->
<!--                                <span style="font-size: 30px;">-->
<!--                                    <i class="fas fa-sign-out-alt"><input type="submit" value="" ></i>-->
<!--                                </span>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
<!--</nav>-->
<!---->

<header>
    <div class="takePhoto">
        <form action="/camagru_mvc/photo/take">
<!--           <span><i class="fas fa-sign-out-alt"></i></span>-->
<!--         <span><i class="fas fa-camera"></i></span>-->
            <input type="submit" class="photoBtn"  value="" >
        </form>
    </div>
    <div class="logo">Camagru</div>
    <div class="logout">
        <form action="/camagru_mvc/account/logout">
            <input type="submit" class="logoutBtn" value="" >
        </form>
    </div>
</header>
