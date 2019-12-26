<div class="wrapper">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/camagru_mvc/app/views/layouts/header.php';?>
    <div class="content">
        <div class="userInfo">
            <div class="avatar">
                <img src="https://images.pexels.com/photos/104827/cat-pet-animal-domestic-104827.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class=
                'avatar' alt="">
            </div>
            <form class="setProfile" method="GET" action="/camagru_mvc/profile/profile">
                <input id="settings" type="submit" name="submit" value="profile"/>
            </form>
        </div>
        <?php var_dump($users);?>
    </div>
    <?php include "footer.php";?>
</div>