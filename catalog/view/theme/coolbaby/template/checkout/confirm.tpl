<?php if (!isset($redirect)) { ?>
<div>
  <table class="table-shop">
    <thead>
      <tr>
        <th class="text-left"><?php echo $column_name; ?></th>
        <th class="text-left"><?php echo $column_model; ?></th>
        <th class="text-right"><?php echo $column_quantity; ?></th>
        <th class="text-right"><?php echo $column_price; ?></th>
        <th class="text-right"><?php echo $column_total; ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product) { ?>
      <tr>
        <td class="text-left"><div class="th_title visible-xs"><?php echo $column_name; ?>:</div><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
          <?php foreach ($product['option'] as $option) { ?>
          <br />
          &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
          <?php } ?>
          <?php if($product['recurring']) { ?>
          <br />
          <span class="label label-info"><?php echo $text_recurring_item; ?></span> <small><?php echo $product['recurring']; ?></small>
          <?php } ?></td>
        <td class="text-left"><div class="th_title visible-xs"><?php echo $column_model; ?>:</div><?php echo $product['model']; ?></td>
        <td class="text-right"><div class="th_title visible-xs"><?php echo $column_quantity; ?>:</div><?php echo $product['quantity']; ?></td>
        <td class="text-right"><div class="th_title visible-xs"><?php echo $column_price; ?>:</div><?php echo $product['price']; ?></td>
        <td class="text-right"><div class="th_title visible-xs"><?php echo $column_total; ?>:</div><?php echo $product['total']; ?></td>
      </tr>
      <?php } ?>
      <?php foreach ($vouchers as $voucher) { ?>
      <tr>
        <td class="text-left"><?php echo $voucher['description']; ?></td>
        <td class="text-left"></td>
        <td class="text-right">1</td>
        <td class="text-right"><?php echo $voucher['amount']; ?></td>
        <td class="text-right"><?php echo $voucher['amount']; ?></td>
      </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <?php foreach ($totals as $total) { ?>
      <tr>
        <th colspan="4" class="text-right"><strong><?php echo $total['title']; ?>:</strong></th>
        <th class="text-right"><?php echo $total['text']; ?></th>
      </tr>
      <?php } ?>
    </tfoot>
  </table>
</div>
<?php echo $payment; ?>
<?php } else { ?>
<script type="text/javascript"><!--
location = '<?php echo $redirect; ?>';
//--></script>
<?php } ?>
