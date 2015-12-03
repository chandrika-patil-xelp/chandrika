<?php
class ModelModuleAdvancedColors extends Model {
	protected $selectedOption = 0;
	protected $configurationOptions = array();
	public function renderListPage($product_id, $width_settings, $height_settings){
		$this->load->model('tool/image');
		if(!$this->checkAvailableSelectOption($product_id) or $this->getConfigurationOption('enable_product_list')=='disable')
			return false;
		$optionvalues = $this->getOptionValuesOfProduct($product_id);
		$width = $this->getConfigurationOption('icon_swatch_width_product_list');
		$height = $this->getConfigurationOption('icon_swatch_height_product_list');
		?>
		<ul id="icons-selector-<?php echo $product_id;?>" class='prp-colorswatch-listpage-icons'>
			<?php foreach($optionvalues as $key=>$value) : ?>
				<?php
					$bg_img = '';
					if($value['image']){
						$bg_img = $this->model_tool_image->resize($value['image'], $width, $height);
					}
				?>
				<?php $rand = rand(0, 10000);?>
				<li style="list-style:none;display:inline-block;padding:1px;border:1px solid #ccc"><a onclick="swatchImage<?php echo $rand?><?php echo $product_id;?>('<?php echo $value['option_value_id'];?>');" data-option-id="<?php echo $value['option_value_id'];?>" href="javascript:void(0);" style="background:url('<?php echo $bg_img;?>') no-repeat center center;?>;display:inline-block;width:<?php echo $width ? $width : 15?>px;height:<?php echo $height ? $height : 15?>px;float:left"></a>
				<script type="text/javascript">
					function swatchImage<?php echo $rand?><?php echo $product_id;?>(optionId){
						<?php if(!$this->getDefaultImageProductList($product_id, $value['option_value_id'], $width_settings, $height_settings)) : ?>
						return false;
						<?php else : ?>
						$('img#product-img-<?php echo $product_id; ?>').attr('src', '<?php echo $this->getDefaultImageProductList($product_id, $value['option_value_id'], $width_settings, $height_settings);?>')
						<?php endif;?>
					}
				</script>
				</li>
			<?php endforeach;?>
		</ul>
		<?php
	}
	public function renderProductPage($product_id){
		$this->load->model('tool/image');
		if(!$this->checkAvailableSelectOption($product_id) or $this->getConfigurationOption('enable_product_page')=='disable')
			return false;
		$optionvalues = $this->getOptionValuesOfProduct($product_id);
		$width = $this->getConfigurationOption('icon_swatch_width_product_page');
		$height = $this->getConfigurationOption('icon_swatch_height_product_page');
		?>
		<script type="text/javascript">
			var colorOptionId = '<?php echo $this->getHtmlId($this->selectedOption, $product_id);?>';
			$(document).ready(function(){
				$('#input-option<?php echo $this->getHtmlId($this->selectedOption, $product_id);?>').parent().hide();
				$('#input-option<?php echo $this->getHtmlId($this->selectedOption, $product_id);?> option').each(function(){
					var text = $(this).text().replace(/\s{2,}/g, ' ');
					var val = $(this).attr('value');
					$('.prp-colorswatch-productpage-icons li a').each(function(index, element){
						if($(element).attr('data-option-id')==val){
							$(element).attr('title', text);
						}
					})
				})
				$('.prp-colorswatch-productpage-icons li a').click(function(){
					$('.prp-colorswatch-productpage-icons .selected-option').html('<span style="float:left;padding-left:5px">'+ $(this).attr('title') +'</span>');
				})
			})
			function swatchImageProductPage(obj, optionValueId, optionId){
				$('#input-option<?php echo $this->getHtmlId($this->selectedOption, $product_id);?>').val(optionValueId).trigger('change');
				$('.image-additional-custom').find('.item').each(function(){
					$(this).parent().show();
					var defaultColor = $(this).attr('data-default-color');
					var color = $(this).attr('data-color');
					/* Change Main Image */
					if(defaultColor == optionId){
						$(this).find('a').click();
						var index = parseInt($(this).attr('data-slick-index'));
						if(index > 0)
							$('.image-additional-custom').slick('slickGoTo', (index));
					}
					
				});
				$('.prp-colorswatch-productpage-icons li span').hide();
				$(obj).parent().children('span').show();
			}
		</script>
		<ul id="icons-selector-<?php echo $product_id;?>" class='prp-colorswatch-productpage-icons'>
			<?php foreach($optionvalues as $key=>$value) : ?>
				<?php
					$bg_img = '';
					if(isset($value['image'])){
						$bg_img = $this->model_tool_image->resize($value['image'], $width, $height);
					}
				?>
				<li style="list-style:none;display:inline-block;padding:1px;border:1px solid #ccc;position:relative">
                    <a onclick="swatchImageProductPage(this, '<?php echo $this->getValueId($this->selectedOption, $value['option_value_id'], $product_id);?>', '<?php echo $value['option_value_id'];?>');" data-option-id="<?php echo $this->getValueId($this->selectedOption, $value['option_value_id'], $product_id);?>" href="javascript:void(0);" style="background:url('<?php echo $bg_img;?>') no-repeat center center;display:inline-block;width:<?php echo $width ? $width : 15?>px;height:<?php echo $height ? $height : 15?>px;float:left"></a>
                    <span class="flaticon-check35 check-icon" style="color:#D3D3D3;position:absolute;top:1px;left:1px;width:<?php echo $width ? $width : 15?>px;height:<?php echo $height ? $height : 15?>px;text-align:center;display:none;line-height:<?php echo $height ? $height : 15?>px"></span>
                </li>
			<?php endforeach;?>
				<li class="selected-option" style="list-style:none;display:inline-block;"></li>
		</ul>
		<?php
	}
	public function renderImagesBlock($product_id, $thumb, $popup, $heading_title, $youtube_video = ''){
		$images = $this->getProductImages($product_id);
		?>
		<?php if ($thumb || $images) { ?>
		<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/advanced_colors/slick.css" property="stylesheet" media="screen" />
		<script type="text/javascript" src="catalog/view/javascript/advanced_colors/slick.min.js"></script>
		<script type="text/javascript" src="catalog/view/javascript/advanced_colors/jquery.elevateZoom-3.0.8.min.js"></script>

		  <?php if ($thumb) { ?>
			<a style="display:block;text-align:center;width:100%" class="zoom-image" href="javascript:void(0);" title="<?php echo $heading_title; ?>">
				<img itemprop="image" class="img-responsive" src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" data-zoom-image="<?php echo $popup; ?>" />
			</a>
		  <?php } ?>

		  <?php $preload = "";?>
		  <?php if ($images) { ?>

            <div id="color-swatch-more-view" style="margin-top:20px;position:relative;" class="slick-style2">
				<div class="image-additional-custom" style="box-shadow:none;margin-bottom:30px">
				<?php foreach ($images as $key => $image) { ?>
				<?php
				if($key==count($images)-1)
					$preload .= '"'.$image['mediun_thumb'].'","'.$image['popup'].'"';
				else
					$preload .= '"'.$image['mediun_thumb'].'","'.$image['popup'].'",';
				?>
				<div style="float:left" class="item" data-default-color="<?php echo $image['default_of_color'];?>" data-color="<?php echo $image['color'];?>">
					<div class="col-inner" style="text-align:center">
						<a href="#" data-image="<?php echo $image['mediun_thumb']; ?>" data-zoom-image="<?php echo $image['popup']; ?>">
							<img class="img-responsive" src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
						</a>
					</div>
				</div>
				<?php } ?>

                    <?php if ($youtube_video != '') : ?>
                        <div class="video-link" style="margin:0">
                            <a href="<?php echo $youtube_video; ?>" class="video-popup">
                                <span class="img-outer">
                                     <img src="<?php echo $thumb; ?>" alt="">
                                </span>
                            </a>
                        </div>
                    <?php endif; ?>


				</div>
                <?php if (count($images) > 3 || (count($images) == 3 && $youtube_video != '')): ?>
				<button style="position:absolute;top:50%;left:0px;margin-top:-18px;text-align:center;z-index:1000" class="prev slick-prev" id="prev-more-view"></button>
				<button style="position:absolute;top:50%;right:0px;margin-top:-18px;text-align:center;z-index:1000" class="next slick-next" id="next-more-view"></button>
                <?php endif; ?>
			</div>

            <script type="text/javascript">
				$(document).ready(function() {
				//$('.left').css('width', $('a.zoom-image img').width() + 'px');
				$('.image-additional-custom').slick({
					infinite: true,
				  	slidesToShow: 3,
				  	slidesToScroll: 1,
				  	arrows : false
				});
				$('#color-swatch-more-view').show();
				$('#color-swatch-more-view .prev').click(function(){
					$('.image-additional-custom').slick('slickPrev');
				})
				$('#color-swatch-more-view .next').click(function(){
					$('.image-additional-custom').slick('slickNext');
				  })
				});
		  </script>
		  <?php } ?>

		<script type="text/javascript">
			$("#image").elevateZoom({gallery:'color-swatch-more-view', cursor: 'pointer', galleryActiveClass: 'active'}); 
		</script>
		<script type="text/javascript">
		<!--//--><![CDATA[//><!--
			var images = new Array()
			function preload() {
				for (i = 0; i < preload.arguments.length; i++) {
					images[i] = new Image()
					images[i].src = preload.arguments[i]
				}
			}
			$(window).load(function() {
				preload(
					<?php echo $preload;?>
				)
			})
		//--><!]]>
		</script>
		<?php } ?>
		<?php
	}
	protected function getProductImages($product_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "' ORDER BY sort_order ASC");
		$results = $query->rows;
		$images = array();
		foreach ($results as $result) {
			$images[] = array(
				'popup' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
				'thumb' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height')),
				'mediun_thumb' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height')),
				'default_of_color' => $result['default_of_color'],
				'color' => $result['color']
			);
		}
		return $images;
	}
	protected function checkAvailableSelectOption($product_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option WHERE type='select'");
		if(!$query->rows)
			return false;
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "advanced_colors_options WHERE name='option_selected'");
		if(!$query->row or $query->row['value']==0)
			return false;
		else
			$this->selectedOption = $query->row['value'];
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_option` po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND o.type = 'select' AND o.option_id = '".$this->selectedOption ."'");
		if(!$query->row)
			return false;
		return true;	
	}
	protected function getOptionValuesOfProduct($product_id){
		$product_option_value_data = array();
		$product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value ovl LEFT JOIN `" . DB_PREFIX . "option_value` ol ON (ovl.option_value_id = ol.option_value_id) WHERE ovl.product_id = '" . (int)$product_id . "' AND ovl.option_id = '".$this->selectedOption ."'");
		foreach ($product_option_value_query->rows as $product_option_value) {
		if($product_option_value['quantity'] > 0)
		$product_option_value_data[] = array(
				'product_option_value_id' => $product_option_value['product_option_value_id'],
				'option_value_id'         => $product_option_value['option_value_id'],
				'quantity'                => $product_option_value['quantity'],
				'subtract'                => $product_option_value['subtract'],
				'price'                   => $product_option_value['price'],
				'price_prefix'            => $product_option_value['price_prefix'],
				'points'                  => $product_option_value['points'],
				'points_prefix'           => $product_option_value['points_prefix'],						
				'weight'                  => $product_option_value['weight'],
				'weight_prefix'           => $product_option_value['weight_prefix'],				
				'image'                   => $product_option_value['image']				
			);
		}
		return $product_option_value_data;
	}
	protected function getDefaultImageProductList($productId, $optionId, $width_settings, $height_settings){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE default_of_color='".$optionId."' AND product_id='".$productId."'");
		if(!$query->row)
			return false;
		$this->load->model('tool/image');

		if (file_exists(DIR_IMAGE . $query->row['image'])) {
			return $this->model_tool_image->resize($query->row['image'], $width_settings, $height_settings);
		} else {
			return $this->model_tool_image->resize('no_image.jpg', $width_settings, $height_settings);
		}
	}
	protected function getDefaultImageProductPage($productId, $optionId){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE default_of_color='".$optionId."' AND product_id='".$productId."'");
		if(!$query->row)
			return false;
		$this->load->model('tool/image');

		if (file_exists(DIR_IMAGE . $query->row['image'])) {
			return $this->model_tool_image->resize($query->row['image'], $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
		} else {
			return $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
		}
	}
	protected function getConfigurationOption($name){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "advanced_colors_options WHERE name='".$name."'");
		return $query->row ? $query->row['value'] : null;
	}
	protected function getHtmlId($option_id, $product_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option WHERE option_id='".$option_id."' AND product_id='".$product_id."'");
		return $query->row ? $query->row['product_option_id'] : null;
	}
	protected function getValueId($option_id, $optionValueId, $product_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value WHERE option_id='".$option_id."' AND product_id='".$product_id."' AND option_value_id='".$optionValueId."'");
		return $query->row ? $query->row['product_option_value_id'] : null;
	}
}
?>