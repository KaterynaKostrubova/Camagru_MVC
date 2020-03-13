<?php include $_SERVER['DOCUMENT_ROOT'] . '/camagru_mvc/app/views/layouts/header_min.php';
//var_dump($vars);

if ($vars['picturePath']){
?>
<div class="card">
        <div class="img_head">
            <p class="crop_min_min">
                <img src="<?php echo $vars['avaPath']?>" alt="" class="avatar_min_min">
            </p>
            <div class="usr_login"><?php echo $vars['login']?></div>
        </div>
        <div class="mid">
            <img src="<?php echo $vars['picturePath']?>" class="photo photo-<?php echo $vars['id']?>" alt="picture"/>
            <div class="right_block">
                <div class="likes-block">
                    <a href="#"><input type="button" class="like <?php if (!empty($like)) echo 'liked'?>" id="like-<?php echo $vars['id']?>" onclick="like(event)"></a>
                    <div class="number_likes"><?php  echo $vars['numberOfLikes']?></div>
                </div>
                <div class="comments-block">
                    <a href="#type"><input type="button" class="img_comment"></a>
                    <div class="number_comments"><?php echo count($vars['comments'])?></div>
                </div>
                <?php if ($vars['info'][0]['id'] === $vars['userId']) {?>
                    <div class="delete-block">
                        <a href="#"><input type="button" id="inside_<?php echo $vars['id']?>" class="dlt" onclick="deleteCard(event)"></a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="comment-box" id="type">
            <textarea type="text" id="text-<?php echo $vars['id']?>" class="comment-input" placeholder="Type comment..."></textarea>
            <label for="send-<?php echo $vars['id']?>">comment</label>
            <input type="button" class="send" id="send-<?php echo $vars['id']?>" onclick="postComment(event)">
        </div>
        <div class="comments">
            <?php for($i = 0; $i < count($vars['comments']); $i++) {?>
                <div class="comment_block">
                    <div class="comment_login"><?php echo $vars['comments'][$i]['login']; ?></div>
                    <div class="comment_text"><?php echo $vars['comments'][$i]['text']; ?></div>
                </div>
            <?php } ?>
        </div>
</div>

<?php } else { ?>
    <div class="card" style="text-align: center">PHOTO NOT FOUND</div>
<?php }?>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/camagru_mvc/app/views/main/footer.php";?>
</div>
<script src="/camagru_mvc/public/scripts/gallery.js"></script>