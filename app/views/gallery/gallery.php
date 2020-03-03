<!--<div id="infinite-scroll">-->
<!--    <div>-->
<!--        <script>-->
<!--            for( let i = 0; i < 100; i++ )-->
<!--                document.write("<div>Случайный текст или еще, что то</div>");-->
<!--        </script>-->
<!--    </div>-->
<!--</div>-->
<!--<script>-->
<!---->
<!--    window.addEventListener("scroll", function(){-->
<!---->
<!--        var block = document.getElementById('infinite-scroll');-->
<!--        var counter = 1;-->
<!---->
<!--        var contentHeight = block.offsetHeight;      // 1) высота блока контента вместе с границами-->
<!--        var yOffset       = window.pageYOffset;      // 2) текущее положение скролбара-->
<!--        var window_height = window.innerHeight;      // 3) высота внутренней области окна документа-->
<!--        var y             = yOffset + window_height;-->
<!---->
<!--        // если пользователь достиг конца-->
<!--        if(y >= contentHeight)-->
<!--        {-->
<!--            //загружаем новое содержимое в элемент-->
<!--            block.innerHTML = block.innerHTML + "<div>Случайный текст или еще, что то</div>";-->
<!--        }-->
<!--    });-->
<!---->
<!--</script>-->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/camagru_mvc/app/views/layouts/header_min.php';

?>
<div class="public_gallery">
        <?php for($i = 0; $i < count($vars['photos']); $i++) {?>
            <div class="img_card">
                <div class="left">
                    <div class="img_head">
                        <?php
                            $search = $vars['photos'][$i]['photo_id'];
                            $column = array_column($vars["owners"], 'photo_id');
                            $row = array_search($search, $column);
                        ?>
                        <p class="crop_min">
                            <img src="<?php echo $vars['owners'][$row]['path']?>" alt="" class="avatar">
                        </p>

                        <div class="usr_login"><?php echo $vars['photos'][$i]['login']?></div>
                    </div>
                    <img class="photo photo-<?php echo $i?>" src="<?php echo $vars['photos'][$i]['path']?>" alt="">
                </div>
                <div class="right">
                    <div class="likes">
                        <img src="" alt="" class="heart">
                        <div class="number_likes"></div>
                    </div>
                    <div class="comments">

                    </div>
                    <div class="post_comment">
                        <textarea name="" id="" cols="30" rows="10"></textarea>
                        <input type="text" class="post" value="public">
                    </div>
                </div>
            </div>
        <?php }?>
</div>
