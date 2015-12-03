<?php
class ModelModuleAdvancedColors extends Model {
	protected $preData = array(
		'enable_product_list'=>'enable',
		'image_width_product_list'=>'150',
		'image_height_product_list'=>'200',
		'icon_swatch_width_product_list'=>'15',
		'icon_swatch_height_product_list'=>'15',
		'enable_product_page'=>'enable',
		'image_width_product_page'=>'450',
		'image_height_product_page'=>'450',
		'submenu_font_size'=>'15',
		'icon_swatch_width_product_page'=>'20',
		'icon_swatch_height_product_page'=>'20',
	);
	public function getOptions(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "advanced_colors_options");
		return $query->rows ? $query->rows : array();
	}

	public function saveOptions($data){
		foreach ($data as $key => $value) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "advanced_colors_options WHERE name = '" . $key . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "advanced_colors_options SET name = '" . $key . "', value = '" . $this->db->escape($value) . "'");
		}
	}
	public function getProductId(){
		$query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product ORDER BY product_id DESC LIMIT 0,1");
		return $query->rows[0]['product_id'];
	}

	public function editProductImages($product_id){
		$data = $this->registry->get('product_submited_data');
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_image'])) {
			foreach ($data['product_image'] as $product_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$product_id . "', image = '" . $this->db->escape($product_image['image']) . "', sort_order = '" . (int)$product_image['sort_order'] . "', default_of_color = '" . (int)$product_image['default_of_color'] . "', color = '" . (int)$product_image['color'] . "'");
			}
		}
	}

	public function getProductImages($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "'");
		return $query->rows;
	}
	public function getSelectOptions(){
		$sql = "SELECT * FROM `" . DB_PREFIX . "option` o LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE od.language_id = '" . (int)$this->config->get('config_language_id') . "' AND o.type='select'";
		$query = $this->db->query($sql);
		return $query->rows ? $query->rows : null;
	}
	public function getOption($name){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "advanced_colors_options WHERE name='".$name."'");
		return $query->row ? $query->row : null;
	}
	public function addOption($data) {
	}

	public function editOption($option_id, $data) {
	}
	public function getOptionValueDescriptions($option_id) {
		$option_value_data = array();

		$option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option_value WHERE option_id = '" . (int)$option_id . "'");

		foreach ($option_value_query->rows as $option_value) {
			$option_value_description_data = array();

			$option_value_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option_value_description WHERE option_value_id = '" . (int)$option_value['option_value_id'] . "'");

			foreach ($option_value_description_query->rows as $option_value_description) {
				$option_value_description_data[$option_value_description['language_id']] = array('name' => $option_value_description['name']);
			}

			$option_value_data[] = array(
				'option_value_id'          => $option_value['option_value_id'],
				'option_value_description' => $option_value_description_data,
				'image'                    => $option_value['image'],
				'sort_order'               => $option_value['sort_order']
			);
		}

		return $option_value_data;
	}

	public function render(){
		// Load Language 
		$this->load->language('module/advanced_colors');

		$this->load->model('catalog/option');
		$default_of_color = '<td class="text-right">' . $this->language->get('entry_image_default_color') . '</td>';
		$color = '<td class="text-right">' . $this->language->get('entry_image_color') . '</td>';
		// Get Color Option
		$colorOption = $this->getOption('option_selected');
		if(!$colorOption)
			return false;
		$colorData = $this->model_catalog_option->getOptionValues($colorOption['value']);
		

		// Load some variables
		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($product_info) && is_file(DIR_IMAGE . $product_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($product_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$placeholder = $this->model_tool_image->resize('no_image.png', 100, 100);
		$entry_sort_order = $this->language->get('entry_sort_order');
		$button_remove = $this->language->get('button_remove');

		// Load product images
		$imagesHtml = '';
		if(isset($this->request->get['product_id'])) {
			$product_id = $this->request->get['product_id'];
			// Images
			if (isset($this->request->post['product_image'])) {
				$product_images = $this->request->post['product_image'];
			} elseif (isset($this->request->get['product_id'])) {
				$product_images = $this->getProductImages($this->request->get['product_id']);
			} else {
				$product_images = array();
			}


			$i = 0;

			foreach ($product_images as $product_image) {
				if (is_file(DIR_IMAGE . $product_image['image'])) {
					$image = $product_image['image'];
					$thumb = $product_image['image'];
				} else {
					$image = '';
					$thumb = 'no_image.png';
				}
				$colorSelector = "<td class='text-right'><select name='product_image[".$i."][color]' class='color-selector'>";
				$defaultColorSelector = "<td class='text-right'><select name='product_image[".$i."][default_of_color]' class='default-color-selector'>";
				$colorSelector .= "<option value='0'>--</option>";
				$defaultColorSelector .= "<option value='0'>--</option>";
				foreach($colorData as $item) {
					$colorselected = '';
					$defaultcolorselected = '';
					if($item['option_value_id']==$product_image['color'])
						$colorselected = "selected='selected'";
					if($item['option_value_id']==$product_image['default_of_color'])
						$defaultcolorselected = "selected='selected'";
					$colorSelector .= "<option value='".$item['option_value_id']."' ".$colorselected.">".$item['name']."</option>";
					$defaultColorSelector .= "<option value='".$item['option_value_id']."' ".$defaultcolorselected.">".$item['name']."</option>";
				}
				$colorSelector .= "</select></td>";
				$defaultColorSelector .= "</select></td>";
				$imagesHtml .= "<tr id='image-row".$i."'>";
				$imagesHtml .= "<td class='text-left'><a href='' id='thumb-image".$i."' data-toggle='image' class='img-thumbnail'><img src='".$this->model_tool_image->resize($thumb, 100, 100)."' alt='' title='' data-placeholder='".$placeholder."' /></a><input type='hidden' name='product_image[".$i."][image]' value='".$image."' id='input-image".$i."' /></td>";
				$imagesHtml .= $defaultColorSelector;
				$imagesHtml .= $colorSelector;
				$imagesHtml .= "<td class='text-right'><input class='form-control' type='text' placeholder=".$entry_sort_order." value='".$product_image['sort_order']."' name='product_image[".$i."][sort_order]'></td>";
				$imagesHtml .= "<td class='text-left'><button type='button' onclick='$(this).parent().parent().remove();' data-toggle='tooltip' title='".$button_remove."' class='btn btn-danger'><i class='fa fa-minus-circle'></i></button></td>";
				$imagesHtml .= "</tr>";
				$i ++;
			}
		}
		$colorSelector = "<td class='text-right'><select name='product_image[][color]' class='color-selector'>";
		$defaultColorSelector = "<td class='text-right'><select name='product_image[][default_of_color]' class='default-color-selector'>";
		$colorSelector .= "<option value='0'>--</option>";
		$defaultColorSelector .= "<option value='0'>--</option>";
		foreach($colorData as $item) {
			$colorSelector .= "<option value='".$item['option_value_id']."'>".$item['name']."</option>";
			$defaultColorSelector .= "<option value='".$item['option_value_id']."'>".$item['name']."</option>";
		}
		$colorSelector .= "</select></td>";
		$defaultColorSelector .= "</select></td>";
		?>
		<script>
		$(document).ready(function() {
			$('#form-product #tab-image #images thead tr td:first').after('<?php echo $default_of_color . $color;?>');
			$('#form-product #tab-image #images tbody').html("<?php echo $imagesHtml;?>");
			$('#form-product #tab-image #images tfoot tr td:first').attr('colspan', 4);
			$('#form-product #tab-image #images tfoot tr td button').attr('onclick', 'addImageCustom();');
			$('.default-color-selector').change(function(){
				var value = $(this).val();
				$('.default-color-selector').not(this).each(function(){
					if($(this).val()==value)
						$(this).val('0');
				})
			});


            $('#form-mproduct #tab-image #images thead tr td:first').after('<?php echo $default_of_color . $color;?>');
            $('#form-mproduct #tab-image #images tbody').html("<?php echo $imagesHtml;?>");
            $('#form-mproduct #tab-image #images tfoot tr td:first').attr('colspan', 4);
            $('#form-mproduct #tab-image #images tfoot tr td button').attr('onclick', 'addImageCustom();');
            $('.default-color-selector').change(function(){
                var value = $(this).val();
                $('.default-color-selector').not(this).each(function(){
                    if($(this).val()==value)
                        $(this).val('0');
                })
            });




        })

		function addImageCustom() {
			var image_row = $('#form-product #tab-image #images tbody tr').length;

            var image_rowm = $('#form-mproduct #tab-image #images tbody tr').length;

            var defaultColorSelector = "<?php echo $defaultColorSelector;?>";
				defaultColorSelector = defaultColorSelector.replace("[]", "[" + image_row + "]");

            var defaultColorSelectorm = "<?php echo $defaultColorSelector;?>";
                defaultColorSelectorm = defaultColorSelectorm.replace("[]", "[" + image_rowm + "]");

            var colorSelectorm = "<?php echo $colorSelector;?>";
				colorSelectorm = colorSelectorm.replace("[]", "[" + image_rowm + "]");

            var colorSelector = "<?php echo $colorSelector;?>";
            colorSelector = colorSelector.replace("[]", "[" + image_rowm + "]");

            html  = '<tr id="image-row' + image_row + '">';
			html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '"data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /><input type="hidden" name="product_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
			html += defaultColorSelector;
			html += colorSelector;
			html += '  <td class="text-right"><input type="text" name="product_image[' + image_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
			html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
			html += '</tr>';

            html  = '<tr id="image-row' + image_rowm + '">';
            html += '  <td class="text-left"><a href="" id="thumb-image' + image_rowm + '"data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /><input type="hidden" name="product_image[' + image_rowm + '][image]" value="" id="input-image' + image_rowm + '" /></td>';
            html += defaultColorSelectorm;
            html += colorSelectorm;
            html += '  <td class="text-right"><input type="text" name="product_image[' + image_rowm + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
            html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_rowm  + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
            html += '</tr>';

            $('#images tbody').append(html);

			$('.default-color-selector').change(function(){
				var value = $(this).val();
				$('.default-color-selector').not(this).each(function(){
					if($(this).val()==value)
						$(this).val('0');
				})
			});
		}
		</script>
		<?php
	}

    public function install() {
		$query = $this->db->query("ALTER TABLE ".DB_PREFIX."product_image
		ADD COLUMN default_of_color int(11) DEFAULT 0");

		$query = $this->db->query("ALTER TABLE ".DB_PREFIX."product_image
		ADD COLUMN color int(11) DEFAULT 0");

		$query = $this->db->query("CREATE TABLE IF NOT EXISTS ".DB_PREFIX."advanced_colors_options
		(
			id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
			name VARCHAR(225) NOT NULL,
			value TEXT NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
		foreach ($this->preData as $key => $value) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "advanced_colors_options WHERE name = '" . $key . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "advanced_colors_options SET name = '" . $key . "', value = '" . $this->db->escape($value) . "'");
		}
		//Event//
		if(VERSION == '2.0.0.0')
		{
			$this->load->model('tool/event');
			$event = $this->model_tool_event;
		} else {
			$this->load->model('extension/event');
			$event = $this->model_extension_event;
		}
		$event->addEvent('advanced_colors', 'pre.admin.product.add', 'module/advanced_colors/preEditProduct');
		$event->addEvent('advanced_colors', 'post.admin.product.add', 'module/advanced_colors/editProduct');
		$event->addEvent('advanced_colors', 'pre.admin.product.edit', 'module/advanced_colors/preEditProduct');
		$event->addEvent('advanced_colors', 'post.admin.product.edit', 'module/advanced_colors/editProduct');
	}
}
?>