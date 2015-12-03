<?php if($categories) : ?>
    <section class="container-widget simple_blog_category">
        <h3><?php echo $heading_title; ?></h3>

        <ul class="simple-list">
            <?php foreach ($categories as $category) : ?>
            <li class="<?php echo ($category['simple_blog_category_id'] == $category_id ? 'active' : 'none-active'); ?>">
                <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>

                <?php if ($category['children']) { ?>
                    <?php foreach ($category['children'] as $child) { ?>
                        <a href="<?php echo $child['href']; ?>" class="list-group-item <?php ($child['category_id'] == $child_id ? 'active' : 'none-active'); ?>">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a>
                    <?php } ?>
                <?php } ?>

            </li>

            <?php endforeach; ?>
        </ul>
    </section>
        	
        	<?php if((isset($simple_blog_category_search_article)) && ($simple_blog_category_search_article)) { ?>
        		<div id="blog-search" style="margin-top: 5px; margin-bottom: 5px;">
        			<div>
        				<input type="text" name="article_search" value="<?php echo $blog_search; ?>" placeholder="<?php echo $text_search_article; ?>" class="form-control" style="margin-bottom: 5px;" />
                        
    	    			<a id="button-search" class="btn"><i class="fa fa-search"></i></a>
        			</div>
        		</div>
        	<?php } ?>
        	
<?php endif; ?>



<script type="text/javascript">
	$('#blog-search input[name=\'article_search\']').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#button-search').trigger('click');
		}
	});

	$('#button-search').bind('click', function() {
		url = 'index.php?route=simple_blog/search';
		
		var article_search = $('#blog-search input[name=\'article_search\']').val();
		
		if (article_search) {
			url += '&blog_search=' + encodeURIComponent(article_search);
		}
		
		location = url;
	});
</script> 
