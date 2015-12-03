<?php
	class ControllerModuleSimpleBlog extends Controller {
		public function index($setting) {

			$this->language->load('module/simple_blog');

			$data['heading_title'] = $this->language->get('heading_title');

			$this->load->model('simple_blog/article');

			$data['articles'] = array();

            $data['simple_blog_module'] = $this->config->get('simple_blog_module');


            if (isset($data['simple_blog_module'])){
                $settings = $data['simple_blog_module'];
                foreach ($settings as $setting) {
                    $category_id = $setting['category_id'];

                    if(isset($setting['image_width'])) {
                        $simple_blog_image_width = $setting['image_width'];
                    } else {
                        $simple_blog_image_width = '100';
                    }
                    if(isset($setting['image_height'])) {
                        $simple_blog_image_height = $setting['image_height'];
                    } else {
                        $simple_blog_image_height = '100';
                    }

                    if(isset($setting['module_type'])) {
                        $data['module_type'] = $setting['module_type'];
                    } else {
                        $data['module_type'] = 'horizontal';
                    }

                }


                if ($category_id == 'all') {
                    $data['heading_title'] = $this->language->get('text_latest_all');
                    $data['article_link'] = $this->url->link('simple_blog/article');
                } elseif($category_id == 'popular') {
                    $data['heading_title'] = $this->language->get('text_popular_all');
                    $data['article_link'] = $this->url->link('simple_blog/article');
                } else {
                    $category_info = $this->model_simple_blog_article->getCategory($category_id);
                    $data['heading_title'] = $category_info['name'];
                    $data['article_link'] = $this->url->link('simple_blog/simple_category', 'simple_blog_category_id=' . $category_id);
                }

                if ($category_id == 'all') {
                    $filter_data = array(
                        'start'           => 0,
                        'limit'           => $setting['article_limit']
                    );

                    $results = $this->model_simple_blog_article->getArticleModuleWise($filter_data);

                } else if($category_id == 'popular') {
                    $filter_data = array(
                        'start'           => 0,
                        'limit'           => $setting['article_limit']
                    );

                    $results = $this->model_simple_blog_article->getPopularArticlesModuleWise($filter_data);

                } else {
                    $filter_data = array(
                        'filter_category_id' => $category_id,
                        'start'           => 0,
                        'limit'           => $setting['article_limit']
                    );

                    $results = $this->model_simple_blog_article->getArticleModuleWise($filter_data);
                }

                if ($setting['status']) {

                    /* eTheme changes */
                    //if($this->config->has('simple_blog_short_description_length')) {
                    //$simple_blog_short_description_length = $this->config->get('simple_blog_short_description_length');
                    //} else {
                    //$simple_blog_short_description_length = '100';
                    //}

                    /* end eTheme changes */


                    foreach($results as $result) {

                        //$description = utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $simple_blog_short_description_length) . '...';

                        if($result['image']) {
                            $image = $this->model_tool_image->resize($result['image'], $simple_blog_image_width, $simple_blog_image_height);
                            $image2x = $this->model_tool_image->resize($result['image'], $simple_blog_image_width*2, $simple_blog_image_height*2);

                        } else if($result['featured_image']) {
                            $image = $this->model_tool_image->resize($result['featured_image'], $simple_blog_image_width, $simple_blog_image_height);
                            $image2x = $this->model_tool_image->resize($result['featured_image'], $simple_blog_image_width*2, $simple_blog_image_height*2);

                        } else {
                            $image = $this->model_tool_image->resize('no_image.jpg', $simple_blog_image_width, $simple_blog_image_height);
                            $image2x = $this->model_tool_image->resize('no_image.jpg', $simple_blog_image_width*2, $simple_blog_image_height*2);

                        }

                        // get total comments
                        $total_comments = $this->model_simple_blog_article->getTotalComments($result['simple_blog_article_id']);

                        if($total_comments != 1) {
                            $total_comments .= $this->language->get('text_comments');
                        } else {
                            $total_comments .= $this->language->get('text_comment');
                        }

                        $data['articles'][] = array(
                            'simple_blog_article_id'	=> $result['simple_blog_article_id'],
                            'article_title'		=> $result['article_title'],
                            'author_name'		=> $result['author_name'],
                            'image'				=> $image,
                            'image2x'				=> $image2x,
                            'featured_found'	=> '', // $featured_found
                            'date_added'		=> date($this->language->get('text_date_format'), strtotime($result['date_modified'])),
                            //'description'		=> $description,
                            'allow_comment'		=> $result['allow_comment'],
                            'total_comment'		=> $total_comments,
                            'href'				=> $this->url->link('simple_blog/article/view', 'simple_blog_article_id=' . $result['simple_blog_article_id'], 'SSL'),
                            'author_href'		=> $this->url->link('simple_blog/author', 'simple_blog_author_id=' . $result['simple_blog_author_id'], 'SSL'),
                            'comment_href'		=> $this->url->link('simple_blog/article/view', 'simple_blog_article_id=' . $result['simple_blog_article_id'] . '#comment-section', 'SSL')
                        );
                    }
                }

            }



			$data['text_no_found'] = $this->language->get('text_no_result');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/simple_blog.tpl')) {
    			return $this->load->view($this->config->get('config_template') . '/template/module/simple_blog.tpl', $data);
    		} else {
    			return $this->load->view('default/template/module/simple_blog.tpl', $data);
    		}
		}
	}