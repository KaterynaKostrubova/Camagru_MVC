<?php include $_SERVER['DOCUMENT_ROOT'] . '/camagru_mvc/app/views/layouts/header_min.php';

?>
<div class="img_card card">
        <div class="img_head">
            <p class="crop_min_min">
                <img src="<?php echo $vars['avaPath']?>" alt="" class="avatar_min_min">
            </p>
            <div class="usr_login"><?php echo $vars['login']?></div>
        </div>
        <img src="<?php echo $vars['picturePath']?>" class="photo photo-<?php echo $vars['id']?>" alt="picture"/>
        <div class="likes">
            <input type="button" class="like <?php if (!empty($like)) echo 'liked'?>" id="like-<?php echo $vars['id']?>" onclick="like(event)">
            <div class="number_likes"><?php  echo $vars['numberOfLikes']?> likes</div>
            <div class="number_comments"><?php echo count($vars['comments'])?> comments</div>
        </div>
        <div class="comment-box">
            <textarea type="text" id="text-<?php echo $vars['id']?>" class="comment-input" placeholder="Type comment..."></textarea>
            <label for="send-<?php echo $vars['id']?>">comment</label>
            <input type="button" class="send" id="send-<?php echo $vars['id']?>" onclick="postComment(event)">
        </div>
        <div class="comments">
            <?php for($i = 0; $i < count($vars['comments']); $i++) {?>
                <div class="comment_block">
                    <div class="comment_login"><?php echo $vars['comments'][$i]['user_id']; ?></div>
                    <div class="comment_text"><?php echo $vars['comments'][$i]['text']; ?></div>
                </div>
            <?php } ?>
        </div>

</div>
<script src="/camagru_mvc/public/scripts/gallery.js"></script>