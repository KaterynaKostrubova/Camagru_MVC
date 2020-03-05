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
//var_dump($vars['photos']);

?>
<div class="public_gallery">
        <?php for($i = 0; $i < count($vars['photos']); $i++) {?>
            <div class="img_card">
                <div class="img_head">
                        <?php
                            $search = $vars['photos'][$i]['photo_id'];
                            $column = array_column($vars["owners"], 'photo_id');
                            $row = array_search($search, $column);

//                            $likes =  array_search($vars['photos'][$i]['id'], array_column($vars['likes'], 'photo_id'));


//                        $col = array_column($vars['comments'], 'id');
//                        var_dump(count($col));
                        ?>
                        <p class="crop_min_min">
                            <img src="<?php echo $vars['owners'][$row]['path']?>" alt="" class="avatar_min_min">
                        </p>
                        <div class="usr_login"><?php echo $vars['photos'][$i]['login']?></div>
                </div>
                <a href="/camagru_mvc/gallery/photo?id=<?php echo $vars['photos'][$i]['id']?>">
                    <img class="photo photo-<?php echo $vars['photos'][$i]['id']?>" src="<?php echo $vars['photos'][$i]['path']?>" alt="picture"/>
                </a>
            </div>
        <?php }?>
</div>
<script src="/camagru_mvc/public/scripts/gallery.js"></script>