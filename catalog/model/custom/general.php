<?php
class ModelCustomGeneral extends Model {
	public function getCurrentLayout() {
        if ($this->config->get('config_maintenance')) {
            $route = '';

            if (isset($this->request->get['route'])) {
                $part = explode('/', $this->request->get['route']);

                if (isset($part[0])) {
                    $route .= $part[0];
                }
            }

            // Show site if logged in as admin
            $this->user = new User($this->registry);

            if (($route != 'payment') && !$this->user->isLogged()) {
                $layout_id = '';
            } else {
                if (isset($this->request->get['route'])) {
                    $route = $this->request->get['route'];
                } else {
                    $route = 'common/home';
                }
                $layout_id = 0;

                if ($route == 'product/category' && isset($this->request->get['path'])) {
                    $this->load->model('catalog/category');

                    $path = explode('_', (string)$this->request->get['path']);

                    $layout_id = $this->model_catalog_category->getCategoryLayoutId(end($path));
                }

                if ($route == 'product/product' && isset($this->request->get['product_id'])) {
                    $this->load->model('catalog/product');

                    $layout_id = $this->model_catalog_product->getProductLayoutId($this->request->get['product_id']);
                }

                if ($route == 'information/information' && isset($this->request->get['information_id'])) {
                    $this->load->model('catalog/information');

                    $layout_id = $this->model_catalog_information->getInformationLayoutId($this->request->get['information_id']);
                }
                if (!$layout_id) {
                    $this->load->model('design/layout');
                    $layout_id = $this->model_design_layout->getLayout($route);
                }

                if (!$layout_id) {
                    $layout_id = $this->config->get('config_layout_id');
                }


            }

        } else {
            if (isset($this->request->get['route'])) {
                $route = $this->request->get['route'];
            } else {
                $route = 'common/home';
            }
            $layout_id = 0;
            if ($route == 'product/category' && isset($this->request->get['path'])) {
                $this->load->model('catalog/category');

                $path = explode('_', (string)$this->request->get['path']);

                $layout_id = $this->model_catalog_category->getCategoryLayoutId(end($path));
            }

            if ($route == 'product/product' && isset($this->request->get['product_id'])) {
                $this->load->model('catalog/product');

                $layout_id = $this->model_catalog_product->getProductLayoutId($this->request->get['product_id']);
            }

            if ($route == 'information/information' && isset($this->request->get['information_id'])) {
                $this->load->model('catalog/information');

                $layout_id = $this->model_catalog_information->getInformationLayoutId($this->request->get['information_id']);
            }
            if (!$layout_id) {
                $this->load->model('design/layout');
                $layout_id = $this->model_design_layout->getLayout($route);
            }

            if (!$layout_id) {
                $layout_id = $this->config->get('config_layout_id');
            }
        }


        $query = $this->db->query("SELECT route FROM " . DB_PREFIX . "layout_route WHERE layout_id='".(int)$layout_id."' AND store_id = '" . (int)$this->config->get('config_store_id') . "' ");

        if ($query->num_rows) {
            $layout_route = $query->row["route"];

            if ($layout_route == 'common/home'){
                $layout_id = 1;
            } elseif ($layout_route == 'product/product') {
                $layout_id = 2;
            } elseif ($layout_route == 'product/category') {
                $layout_id = 3;
            }





            return $layout_id;
        } else {
            return 0;
        }
    }

    public function getCategoryId($category_href) {
        if (isset($category_href)) {
            $parts = explode('=', (string)$category_href);
        } else {
            $parts = array();
        }
        $category_id = end($parts);


        if (is_numeric($category_id)) {
            $category_id = $category_id;
        } else {
            $parts = explode('/', (string)$category_id);
            $category_id = end($parts);
            $query = $this->db->query("SELECT query as query FROM ".DB_PREFIX."url_alias WHERE keyword='".$this->db->escape($category_id)."'");
            if ($query->num_rows) {
                $parts = explode('=', (string)$query->row['query']);
                $category_id = end($parts);
            }

        }

        return $category_id;
    }

    public function getCategoryOptionById($category_href) {
        if (isset($category_href)) {
            $parts = explode('=', (string)$category_href);
        } else {
            $parts = array();
        }
        $category_id = end($parts);


        if (is_numeric($category_id)) {
            $category_id = $category_id;
        } else {
            $parts = explode('/', (string)$category_id);
            $category_id = end($parts);
            $query = $this->db->query("SELECT query as query FROM ".DB_PREFIX."url_alias WHERE keyword='".$this->db->escape($category_id)."'");
            if ($query->num_rows) {
                $parts = explode('=', (string)$query->row['query']);
                $category_id = end($parts);
            }

        }

        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.category_id = '" . (int)$category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");

        return $query->row;
    }


    public function getSubCategoryOptionById($category_href) {
        if (isset($category_href)) {

            $parts = explode('_', (string)$category_href);
            $str0=strpos($category_href, "sort_order");

            if ($str0 == true) {
                $category_id = $parts[count($parts)-2];
            } else {
                $category_id = end($parts);

            }

        } else {
            $parts = array();
        }

        if (is_numeric($category_id)) {
            $category_id = $category_id;
        } else {

            $str1=strpos($category_id, "?");

            if ($str1 == true) {
                $category_id=substr($category_id, 0, $str1);
            }

            $parts = explode('/', (string)$category_id);
            $category_id = end($parts);


            $query = $this->db->query("SELECT query as query FROM ".DB_PREFIX."url_alias WHERE keyword='".$this->db->escape($category_id)."'");
            if ($query->num_rows) {
                $parts = explode('=', (string)$query->row['query']);
                $category_id = end($parts);
            }

        }

        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.category_id = '" . (int)$category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");

        return $query->row;

    }
    public function getSubCategoryId($category_href) {
        if (isset($category_href)) {
            $parts = explode('_', (string)$category_href);
        } else {
            $parts = array();
        }
        $category_id = end($parts);

        if (is_numeric($category_id)) {
            $category_id = $category_id;
        } else {
            $parts = explode('/', (string)$category_id);
            $category_id = end($parts);
            $query = $this->db->query("SELECT query as query FROM ".DB_PREFIX."url_alias WHERE keyword='".$this->db->escape($category_id)."'");
            if ($query->num_rows) {
                $parts = explode('=', (string)$query->row['query']);
                $category_id = end($parts);
            }

        }
        return $category_id;
    }


    public function getCategoryOption($category_id, $option) {
        $column_exists_option = $this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "category_description LIKE '".$option."' ");
        if ($column_exists_option->num_rows) {
            $query = $this->db->query("SELECT DISTINCT `".$option."` FROM " . DB_PREFIX . "category_description cd WHERE cd.category_id = '" . (int)$category_id . "' ");
            if ($query->rows) {
                $category_option = $query->row["$option"];
            } else {
                $category_option = '';
            }
        } else {
            $category_option = '';
        }
        return $category_option;
    }

    public function getCategoryOptionHref($category_href, $option) {
        if (isset($category_href)) {
            $parts = explode('=', (string)$category_href);
        } else {
            $parts = array();
        }
        $category_id = end($parts);


        if (is_numeric($category_id)) {
            $category_id = $category_id;
        } else {
            $parts = explode('/', (string)$category_id);
            $category_id = end($parts);
            $query = $this->db->query("SELECT query as query FROM ".DB_PREFIX."url_alias WHERE keyword='".$this->db->escape($category_id)."'");
            if ($query->num_rows) {
                $parts = explode('=', (string)$query->row['query']);
                $category_id = end($parts);
            }

        }

        $column_exists_option = $this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "category LIKE '".$option."' ");
        if ($column_exists_option->num_rows) {
            $query = $this->db->query("SELECT DISTINCT `".$option."` FROM " . DB_PREFIX . "category cd WHERE cd.category_id = '" . (int)$category_id . "' ");
            if ($query->rows) {
                $category_option = $query->row["$option"];
            } else {
                $category_option = '';
            }
        } else {
            $category_option = '';
        }
        return $category_option;
    }


    public function getProductOption($product_id, $option, $html = '') {
        $column_exists_option = $this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "product_description LIKE '".$option."' ");
        if ($column_exists_option->num_rows) {
            $query = $this->db->query("SELECT DISTINCT `".$option."` FROM " . DB_PREFIX . "product_description pd WHERE pd.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' ");
            if ($query->rows) {
                $custom1 = $query->row[$option];
                if ($html == 1){
                    $custom = html_entity_decode($custom1, ENT_QUOTES, 'UTF-8');
                } else {
                    $custom = $custom1;
                }
            } else {
                $custom = '';
            }
        } else {
            $custom = '';
        }

        return $custom;
    }

    public function getProductOptionSlick($product_id, $option, $html = '') {
        $column_exists_option = $this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "product LIKE '".$option."' ");
        if ($column_exists_option->num_rows) {
            $query = $this->db->query("SELECT DISTINCT `".$option."` FROM " . DB_PREFIX . "product p WHERE p.product_id = '" . (int)$product_id . "' ");
            if ($query->rows) {
                $custom1 = $query->row[$option];
                if ($html == 1){
                    $custom = html_entity_decode($custom1, ENT_QUOTES, 'UTF-8');
                } else {
                    $custom = $custom1;
                }
            } else {
                $custom = '';
            }
        } else {
            $custom = '';
        }

        return $custom;
    }


    public function getCategoryName($category_id) {
        $query = $this->db->query("SELECT DISTINCT `name` FROM " . DB_PREFIX . "category_description cd WHERE cd.category_id = '" . (int)$category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ");

        if ($query->rows) {
            $category_name = $query->row["name"];
        } else {
            $category_name = '';
        }
        return $category_name;

    }

    public function getModuleSettings($module_code) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "module WHERE code = '" . $module_code . "'");

        $array = $query->row['setting'];

        if (is_array($array)) {
            return unserialize($array["setting"]);
        } else {
            return array();
        }
    }

    public function getProductSeoUrl($product_id) {
        $query = $this->db->query("SELECT keyword as keyword FROM ".DB_PREFIX."url_alias WHERE query='product_id=".(int)$product_id."' ");

        if ($query->rows) {
            $product_link = '/'.$query->row['keyword'];
        } else {
            $product_link = 'index.php?route=product/product&product_id='.(int)$product_id;
        }
        return $product_link;
    }

    public function getCategoryUrl($category_id) {

        $query = $this->db->query("SELECT keyword FROM ".DB_PREFIX."url_alias WHERE query='category_id=".(int)$category_id."' ");

        if (isset($query->row["keyword"]) && $this->config->get("config_seo_url") == 1) {
            $category_link = $query->row["keyword"];
        } else {
            $category_link = $category_id;
        }

        return $category_link;
    }





    public function getDateEnd($product_id) {
        $query = $this->db->query("SELECT date_end FROM ".DB_PREFIX."product_special WHERE product_id='".filter_var($product_id, FILTER_SANITIZE_NUMBER_INT)."' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' ");

        if ($query->num_rows) {
            $special_date = $query->row['date_end'];
        } else {
            $special_date = false;
        }
        return $special_date;
    }


    public function getModulePosition($module_name) {
        $query = $this->db->query("SELECT position FROM " . DB_PREFIX . "layout_module WHERE code LIKE '".$module_name."%' ");

        if ($query->num_rows) {
            $module_position = $query->row['position'];
        } else {
            $module_position = false;
        }
        return $module_position;
    }



    public function getRandomProducts($limit) {
        $product_data = array();

        $query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ");

        $this->load->model('catalog/product');

        foreach ($query->rows as $result) {
            $product_data[$result['product_id']] = $this->model_catalog_product->getProduct($result['product_id']);
        }
        shuffle($product_data);

        $product_data=array_slice($product_data,0,$limit);

        return $product_data;
    }

    public function getCssClass($column_left,$column_right) {
        if ($column_left && $column_right) {
            $class = 'col-sm-6';
        } elseif ($column_left || $column_right) {
             $class = 'col-sm-8 col-md-9 col-lg-10';
        } else {
            $class = 'col-sm-12';
        }
        return $class;
    }


    public function getCurrentCategoryId() {
        if (isset($this->request->get['route'])) {

            if (isset($this->request->get['product_id'])) {
                $class = $this->request->get['product_id'];
            } elseif (isset($this->request->get['path'])) {
                $class = $this->request->get['path'];
            } elseif (isset($this->request->get['manufacturer_id'])) {
                $class = $this->request->get['manufacturer_id'];
            } else {
                $class = '';
            }

            $category_id = $class;
        } else {
            $category_id = 'common-home';
        }
        return $category_id;
    }

    public function getManufacturerImage($manufacturer_href) {

        if (isset($manufacturer_href)) {
            $parts = explode('=', (string)$manufacturer_href);
        } else {
            $parts = array();
        }

        $manufacturer_id = end($parts);


        if (is_numeric($manufacturer_id)) {
            $manufacturer_id = $manufacturer_id;
        } else {
            $parts = explode('/', (string)$manufacturer_id);
            $manufacturer_id = end($parts);
            $query = $this->db->query("SELECT query as query FROM ".DB_PREFIX."url_alias WHERE keyword='".$this->db->escape($manufacturer_id)."'");
            if ($query->num_rows) {
                $parts = explode('=', (string)$query->row['query']);
                $manufacturer_id = end($parts);
            }

        }
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer m LEFT JOIN " . DB_PREFIX . "manufacturer_to_store m2s ON (m.manufacturer_id = m2s.manufacturer_id) WHERE m.manufacturer_id = '" . (int)$manufacturer_id . "' AND m2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");
        if ($query->num_rows) {
            $manufacturer_image = $query->row['image'];
        } else {
            $manufacturer_image = false;
        }

        return $manufacturer_image;
    }

    public function getBreadcrumbs($breadcrumbs) {
        $breadcrumbs_block = '';
        $breadcrumbs_block.= '
        <div class="breadcrumb_bg">
            <div class="container">
                <ul class="breadcrumb">';

                    foreach ($breadcrumbs as $k => $breadcrumb) {
        $breadcrumbs_block.= '<li><span class="divider '.($k == 0 ? 'first_element' :'').'">&nbsp;</span><a href="'.$breadcrumb['href'].'">'.$breadcrumb['text'].'</a></li>';
                    }
        $breadcrumbs_block.= '
                </ul>
            </div>
        </div>
        ';

        return $breadcrumbs_block;
    }


    public function getModuleImage($thumb) {

        $string = $thumb;

        $string1  = explode('-',$string);
        $string2 = array_pop($string1);
        $row=substr($string2, 0, strpos($string2, "."));

        $settings  = explode('x',$row);
        return $settings;

    }


    public function renderProductsList($title,$category_href) {

        if (isset($category_href)) {
            $parts = explode('=', (string)$category_href);
        } else {
            $parts = array();
        }
        $category_id = end($parts);


        if (is_numeric($category_id)) {
            $category_id = $category_id;
        } else {
            $parts = explode('/', (string)$category_id);
            $category_id = end($parts);
            $query = $this->db->query("SELECT query as query FROM ".DB_PREFIX."url_alias WHERE keyword='".$this->db->escape($category_id)."'");
            if ($query->num_rows) {
                $parts = explode('=', (string)$query->row['query']);
                $category_id = end($parts);
            }

        }

        $category_limit = 3;

        $filter_data_category = array('filter_category_id'=> $category_id, 'filter_filter'=> '', 'sort' => 'p.sort_order', 'order'=>'ASC', 'start' => '', 'limit' => $category_limit);
        $results_category = $this->model_catalog_product->getProducts($filter_data_category);

        if (sizeof($results_category) == 0){$results_category = '';}





        if ($results_category != ''){
            $products_category = array();

            foreach ($results_category as $result_category) {
                if ($result_category['image']) {
                    $image = $this->model_tool_image->resize($result_category['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                } else {
                    $image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                }

                if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                    $price = $this->currency->format($this->tax->calculate($result_category['price'], $result_category['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    $price = false;
                }

                if ((float)$result_category['special']) {
                    $special = $this->currency->format($this->tax->calculate($result_category['special'], $result_category['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    $special = false;
                }


                $products_category[] = array(
                    'product_id'  => $result_category['product_id'],
                    'thumb'       => $image,
                    'name'        => $result_category['name'],
                    'price'       => $price,
                    'special'     => $special,
                    'href'        => $this->url->link('product/product', 'product_id=' . $result_category['product_id'])
                );
            }
        }
        /* end output for category1 */


        if (isset($products_category)) :
        ?>
           <div class="pull-left vertical_title_outer title-md"><span><?php echo $title; ?></span></div>

           <div class="pull-left carousel_outer">
               <div class="header-product-carousel slick-style2">

                   <?php foreach ($products_category as $product) : ?>
                    <div class="carousel-item <?php echo $category_id; ?>">
                         <div class="product-preview">
                             <div class="preview">
                                 <a href="<?php echo $product['href']; ?>" class="preview-image">
                                     <img class="img-responsive"  src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" />
                                 </a>
                             </div>
                             <h3 class="title"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h3>

                             <?php if ($product['special']) { ?>
                                 <span class="price old"><?php echo $product['price']; ?></span>
                                 <span class="price new"><?php echo $product['special']; ?></span>
                             <?php } else { ?>
                                 <span class="price regular"><?php echo $product['price']; ?></span>
                             <?php } ?>
                         </div>
                    </div>
                   <?php endforeach; ?>

               </div>
        </div>
           <div class="visible-sm divider-lg"></div>




 <?php
        endif;
    }


}