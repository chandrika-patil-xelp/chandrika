<?php if($comments) { ?>
<?php foreach ($comments as $comment) { ?>
<div class="comments">
    <div class="comment">
        <div class="inside">
            <p>
                <strong><?php echo $comment['author']; ?></strong><br>
                <?php echo $comment['date_added']; ?>
            </p>
            <p><?php echo $comment['comment']; ?></p>
            <a id="comment_reply" class="btn btn-cool" onclick="setArticleId(<?php echo $comment['simple_blog_comment_id']; ?>);">&nbsp;&nbsp;<span class="icon flaticon-rectangular25"></span><?php echo $text_reply_comment; ?>&nbsp;&nbsp;</a>

        </div>
    </div>


    <?php if($comment['comment_reply']) { ?>
        <?php foreach($comment['comment_reply'] as $comment_reply) { ?>
            <div class="article-reply comment sub">
                <div class="inside">
                    <p>
                        <strong><?php echo ucwords($comment_reply['author']); ?></strong><br>
                        <?php echo $comment_reply['date_added'];  ?>
                    </p>
                    <p><?php echo $comment_reply['comment']; ?></p>
                </div>
            </div>
        <?php } ?>
    <?php } ?>

</div>
<?php } ?>

<div class="form-group">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left"><?php echo $pagination; ?></div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right"><?php echo $results; ?></div>
</div>

<?php } else { ?>
<h5><?php echo $text_no_blog; ?></h5>
<?php } ?>

<script type="text/javascript">
    function setArticleId(article_id) {
        $("#blog-reply-id").val(article_id);
        $("#reply-remove").css('display', 'inline');
    }
    $("#comment_reply").click(function (){
        var tabTop = $("#review-title").offset().top;
        $("html, body").animate({ scrollTop:tabTop }, 1000);
    });

</script>