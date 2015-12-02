<?php  
class ControllerModuleFooterInfo extends Controller {
    public function index($setting) {
        $this->load->language('module/footer_info');

        //$data['heading_title'] = html_entity_decode($setting['module_description']['heading'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');

        $data['title_facebook'] = html_entity_decode($this->language->get('title_facebook'), ENT_QUOTES, 'UTF-8');
        $data['title_twitter'] = html_entity_decode($this->language->get('title_twitter'), ENT_QUOTES, 'UTF-8');

        $data['account_facebook'] = (isset($setting['module_description']['account_facebook']) ? $setting['module_description']['account_facebook'] : '');
        $data['account_twitter'] = (isset($setting['module_description']['account_twitter']) ? $setting['module_description']['account_twitter'] : '');


        $data['description_about'] = (isset($setting['module_description'][$this->config->get('config_language_id')]['description_about']) ? html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['description_about'], ENT_QUOTES, 'UTF-8') : '');



        $data['description_contact'] = (isset($setting['module_description'][$this->config->get('config_language_id')]['description_contact']) ? html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['description_contact'], ENT_QUOTES, 'UTF-8') : '');
        $data['heading_about'] = (isset($setting['module_description'][$this->config->get('config_language_id')]['heading_about']) ? html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['heading_about'], ENT_QUOTES, 'UTF-8') : '');
        $data['heading_contact'] = (isset($setting['module_description'][$this->config->get('config_language_id')]['heading_contact']) ? html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['heading_contact'], ENT_QUOTES, 'UTF-8') : '');
        $data['heading_facebook'] = (isset($setting['module_description'][$this->config->get('config_language_id')]['heading_facebook']) ? html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['heading_facebook'], ENT_QUOTES, 'UTF-8') : '');
        $data['heading_twitter'] = (isset($setting['module_description'][$this->config->get('config_language_id')]['heading_twitter']) ? html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['heading_twitter'], ENT_QUOTES, 'UTF-8') : '');





        /*
        if (isset($setting['module_description'][$this->config->get('config_language_id')]['description_about'])) {
            $data['description_about'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['description_about'], ENT_QUOTES, 'UTF-8');
        } else {
            $data['description_about'] = '';
        }
        if (isset($setting['module_description'][$this->config->get('config_language_id')]['description_contact'])) {
            $data['description_contact'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['description_contact'], ENT_QUOTES, 'UTF-8');
        } else {
            $data['description_contact'] = '';
        }

        if (isset($setting['module_description'][$this->config->get('config_language_id')]['heading_about'])) {
            $data['heading_about'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['heading_about'], ENT_QUOTES, 'UTF-8');
        } else {
            $data['heading_about'] = '';
        }
        if (isset($setting['module_description'][$this->config->get('config_language_id')]['heading_contact'])) {
            $data['heading_contact'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['heading_contact'], ENT_QUOTES, 'UTF-8');
        } else {
            $data['heading_contact'] = '';
        }

        if (isset($setting['module_description'][$this->config->get('config_language_id')]['heading_facebook'])) {
            $data['heading_facebook'] = $setting['module_description'][$this->config->get('config_language_id')]['heading_facebook'];
        } else {
            $data['heading_facebook'] = '';
        }

        if (isset($setting['module_description'][$this->config->get('config_language_id')]['heading_twitter'])) {
            $data['heading_twitter'] = $setting['module_description'][$this->config->get('config_language_id')]['heading_twitter'];
        } else {
            $data['heading_twitter'] = '';
        }

        */


        $sort_order_facebook = (isset($setting['module_description']['sort_order_facebook']) ? $setting['module_description']['sort_order_facebook'] : 1);
        $sort_order_twitter = (isset($setting['module_description']['sort_order_twitter']) ? $setting['module_description']['sort_order_twitter'] : 2);
        $sort_order_about = (isset($setting['module_description']['sort_order_about']) ? $setting['module_description']['sort_order_about'] : 3);
        $sort_order_testimonials = (isset($setting['module_description']['sort_order_testimonials']) ? $setting['module_description']['sort_order_testimonials'] : 4);


        $facebook = array(
            "key" => "facebook",
            "title" => $data['heading_facebook'],
            "content" => $data['account_facebook']
        );

        $twitter = array(
            "key" => "twitter",
            "title" => $data['heading_twitter'],
            "content" => $data['account_twitter']
        );

        $about= array(
            "key" => "about",
            "title" => $data['heading_about'],
            "content" => $data['description_about'],
        );

        $testimonials= array(
            "key" => "testimonials",
            "title" => $data['heading_contact'],
            "content" => $data['description_contact']
        );


        $data['blocks'] = array($sort_order_facebook=>$facebook, $sort_order_twitter=>$twitter, $sort_order_about=>$about, $sort_order_testimonials=>$testimonials);

        ksort($data['blocks']);
        reset($data['blocks']);






        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/footer_info.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/footer_info.tpl', $data);
		}

	}
}