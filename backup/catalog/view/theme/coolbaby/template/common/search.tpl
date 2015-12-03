<div id="openSearch">
    <div class="container">
        <div class="inside">
            <div id="searchHeader">
                <div id="search" class="input-outer">
                        <input type="text" name="search" class="search-input" value="<?php echo $text_search; ?>"
                           onclick="this.value = '';"
                           onblur="if (this.value == '') {this.value = '<?php echo $text_search; ?>';}"
                           onfocus="if(this.value == '<?php echo $text_search; ?>') {this.value = '';}">

                        <a class="pull-right search-close"><i class="icon">&#10005;</i></a>
                        <button type="button" class="pull-right"><i class="icon  icon-xl flaticon-zoom45"></i></button>
                </div>
            </div>

        </div>
    </div>
</div>