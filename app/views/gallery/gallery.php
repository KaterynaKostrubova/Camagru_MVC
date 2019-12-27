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
<div class="general-gallery">
    <?php for($i = 0; $i < count($vars['photos']); $i++) {?>
        <img class="photo photo-<?php echo $i?>" src="<?php echo $vars['photos'][$i]['path']?>" alt="">
    <?php }?>
</div>
