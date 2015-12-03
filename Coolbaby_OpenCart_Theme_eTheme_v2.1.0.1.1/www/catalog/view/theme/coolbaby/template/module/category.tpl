<div class="panel-heading panel-heading-category">
    <a data-toggle="collapse" href="#box-category">
        <span class="arrow-down">+</span>
        <span class="arrow-up">-</span> <?php echo $heading_title; ?>
    </a>
</div>

<div id="box-category" class="panel-collapse in">
    <div class="panel-body">
        <ul class="simple-list">
            <?php foreach ($categories as $category) : ?>
                <li>
                    <a href="<?php echo $category['href']; ?>" class="<?php echo ($category['category_id'] == $category_id ? 'active' : ''); ?>"><?php echo $category['name']; ?></a>
                    <?php if ($category['children']) : ?>
                    <ul class="simple-list subcategory">
                        <?php foreach ($category['children'] as $child) : ?>
                            <li><a href="<?php echo $child['href']; ?>" class="<?php echo ($child['category_id'] == $child_id ? 'active' : ''); ?>"><?php echo $child['name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>