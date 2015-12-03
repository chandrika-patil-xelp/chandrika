<div class="sub-menu-title"><?php echo $heading_title; ?></div>
<ul id="sub-menu" class="sm sm-vertical sm-mega sm-mega-vertical">
    <?php foreach ($categories as $category) : ?>
    <li>
        <a href="<?php echo $category['href']; ?>" class="<?php echo ($category['children'] ? 'has-submenu' : ''); ?>">
            <?php echo $category['name']; ?>
        </a>
        <?php if ($category['children']) : ?>
            <ul>
                <?php foreach ($category['children'] as $child) : ?>
                    <li>
                        <a class="item_children <?php echo ($child['grandchildren'] ? 'has-submenu' : ''); ?>" href="<?php echo $child['href']; ?>">
                            <?php echo $child['name']; ?>
                        </a>
                        <?php if ($child['grandchildren']) : ?>
                        <ul>
                            <?php foreach ($child['grandchildren'] as $grandchild) : ?>
                            <li><a href="<?php echo $grandchild['href']; ?>"><?php echo $grandchild['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>



