<?php
class ControllerModuleFcategory extends Controller {
	public function index($setting) {
		$this->load->language('module/fcategory');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');

		$this->load->model('catalog/category');
        $this->load->model('catalog/product');

        $this->load->model('tool/image');

		$data['categories'] = array();

		if (!$setting['limit']) {
			$setting['limit'] = 4;
		}

        if (!($setting['limit_products'])) {
            $setting['limit_products'] = 4;
        }

        $data['products'] = array();


        if (!empty($setting['category'])) {
			$categories = array_slice($setting['category'], 0, (int)$setting['limit']);

			foreach ($categories as $category_id) {
				$category_info = $this->model_catalog_category->getCategory($category_id);

				if ($category_info) {
					$data['categories'][] = array(
						'category_id'  => $category_info['category_id'],
						'name'        => $category_info['name'],
						'description' => utf8_substr(strip_tags(html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
						'href'        => $this->url->link('product/category', 'path=' . $category_info['category_id']),
                    );

                    $filter_data_category = array('filter_category_id'=> $category_info['category_id'], 'filter_filter'=> '', 'sort' => 'p.sort_order', 'order'=>'ASC', 'start' => '', 'limit' => $setting['limit_products']);
                    $products = $this->model_catalog_product->getProducts($filter_data_category);

                    if ($products) {
                        foreach ($products as $product) {
                            if ($product['image']) {
                                $image = $this->model_tool_image->resize($product['image'], $setting['width'], $setting['height']);
                                $image2x = $this->model_tool_image->resize($product['image'], $setting['width']*2, $setting['height']*2);

                            } else {
                                $image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
                                $image2x = $this->model_tool_image->resize('placeholder.png', $setting['width']*2, $setting['height']*2);
                            }

                            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                                $price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')));
                            } else {
                                $price = false;
                            }

                            if ((float)$product['special']) {
                                $special = $this->currency->format($this->tax->calculate($product['special'], $product['tax_class_id'], $this->config->get('config_tax')));
                            } else {
                                $special = false;
                            }

                            if ($this->config->get('config_tax')) {
                                $tax = $this->currency->format((float)$product['special'] ? $product['special'] : $product['price']);
                            } else {
                                $tax = false;
                            }



                            $data['products'][] = array(
                                'category_id'  => $category_info['category_id'],
                                //'image_path'       => 'image/'.$product['image'],

                                'product_id'  => $product['product_id'],
                                'thumb'       => ($setting['status_size'] == 1 ? $image : 'image/'.$product['image']),
                                'thumb2x'       => ($setting['status_size'] == 1 ? $image2x : 'image/'.$product['image']),
                                'name'        => $product['name'],
                                'rating'        => $product['rating'],
                                'price'       => $price,
                                'special'     => $special,
                                'tax'         => $tax,

                                //'description' => utf8_substr(strip_tags(html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
                                'href'        => $this->url->link('product/product', 'product_id=' . $product['product_id']),
                            );
                        }
                    }





                }
			}
		}

		if ($data['categories']) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/fcategory.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/fcategory.tpl', $data);
			} else {
				return $this->load->view('default/template/module/fcategory.tpl', $data);
			}
		}
	}
}