<?php if (count($currencies) > 1) : ?>
<div class="btn-group">

    <a title="<?php echo $text_currency; ?>" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
        <span class="icon">
                <?php
                foreach ($currencies as $currency) :

          if ($currency['symbol_left'] && $currency['code'] == $code) {
             echo $currency['symbol_left'];
             } elseif ($currency['symbol_right'] && $currency['code'] == $code) {
             echo $currency['symbol_right'];
            }

            ?>

            <?php endforeach; ?>

        </span>
        <span class="drop-title"><?php echo $text_currency; ?></span>
    </a>
    <div class="dropdown-menu" role="menu">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="currency">

        <?php
            foreach ($currencies as $currency) :

                 if ($currency['symbol_left']) {
                     $currency_symbol = $currency['symbol_left'];
                 } else {
                     $currency_symbol = $currency['symbol_right'];
                 }
        ?>


                <div class="li_sub">
                    <a title="<?php echo $currency['title']; ?>" onclick="$('input[name=\'code\']').attr('value', '<?php echo $currency['code']; ?>'); $(this).parent().parent().submit();">
                        <?php echo $currency_symbol; ?>
                        <?php echo $currency['title']; ?>
                    </a>
                </div>

            <?php endforeach; ?>

            <input type="hidden" name="code" value="" />
            <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />


        </form>


    </div>



</div>



<?php endif; ?>
