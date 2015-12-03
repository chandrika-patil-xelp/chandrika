    <div id="box-filter">
        <?php foreach ($filter_groups as $filter_group) : ?>

        <div class="panel">
            <div class="panel-heading">
                <a data-toggle="collapse" href="#filter-group<?php echo $filter_group['filter_group_id']; ?>">
                    <span class="arrow-down">+</span>
                    <span class="arrow-up">-</span>
                    <?php echo $filter_group['name']; ?>
                </a>
            </div>

            <div id="filter-group<?php echo $filter_group['filter_group_id']; ?>" class="panel-collapse in">
                <div class="panel-body">
                    <ul class="simple-list">
                        <?php foreach ($filter_group['filter'] as $filter) { ?>
                        <li>
                            <label class="checkbox">
                                <input data-type="search" name="filter[]" type="checkbox" value="<?php echo $filter['filter_id']; ?>" <?php if (in_array($filter['filter_id'], $filter_category)) { ?> checked="checked" <?php } ?> />
                                <a><?php echo $filter['name']; ?></a>
                            </label>

                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>


        </div>
        <?php endforeach; ?>

        <div class="panel-footer">
            <button type="button" id="button-filter" class="btn btn-cool"><?php echo $button_filter; ?></button>
        </div>
        <div class="filter_clear_button">
            <button id="clear-filter" type="reset"><i class="flaticon-close19"></i></button>
        </div>

    </div>



    <script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	filter = [];
	
	$('input[name^=\'filter\']:checked').each(function(element) {
		filter.push(this.value);
	});
	
	location = '<?php echo $action; ?>&filter=' + filter.join(',');
});
//--></script>

    <script>
        $(document).on('click', '#clear-filter', function(){
            $('input[data-type="search"]').attr('checked', false);
            location = '<?php echo $action; ?>';

        });
    </script>
