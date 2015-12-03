<?php if (count($languages) > 1) : ?>

    <div class="btn-group">
        <a title="Language" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
            <span class="icon icon-md flaticon-oval33"></span><span class="drop-title"><?php echo $text_language; ?></span>
        </a>
        <div class="ul_sub dropdown-menu" role="menu">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="language">

            <?php foreach ($languages as $language) : ?>

            <div class="li_sub">
                <a href="<?php echo $language['code']; ?>">
                    <img width="16" height="11" src="image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>" />
                    <?php echo $language['name']; ?>
                </a>

            </div>
            <?php endforeach; ?>

            <input type="hidden" name="code" value="" />
            <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
            </form>


        </div>
    </div>


<?php endif; ?>
