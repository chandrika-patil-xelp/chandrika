<?php
class ControllerModuleTopslider extends Controller {
	public function index($setting) {
		if (isset($setting['module_description'][$this->config->get('config_language_id')])) {

            //$this->document->addScript('catalog/view/theme/'. $this->config->get('config_template') .'/rs-plugin/js/jquery.themepunch.plugins.min.js');
            //$this->document->addScript('catalog/view/theme/'. $this->config->get('config_template') .'/rs-plugin/js/jquery.themepunch.revolution.min.js');

            $this->document->addScript('catalog/view/theme/'. $this->config->get('config_template') .'/rs-plugin/js/jquery_common_revolution.js');


            $customisation_colors = $this->config->get('customisation_colors_store');
            $store_id = $this->config->get('config_store_id');

            if (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'lingerie') {
                $this->document->addScript('catalog/view/theme/'. $this->config->get('config_template') .'/rs-plugin/js/jquery.themepunch-lingerie.js');
            } elseif (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'kids') {
                $this->document->addScript('catalog/view/theme/'. $this->config->get('config_template') .'/rs-plugin/js/jquery.themepunch-kids.js');
            } elseif (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'tools') {
                $this->document->addScript('catalog/view/theme/'. $this->config->get('config_template') .'/rs-plugin/js/jquery.themepunch-tools.js');
            } elseif (isset($customisation_colors["layout_skin"][$store_id]) && $customisation_colors["layout_skin"][$store_id] == 'art') {
                $this->document->addScript('catalog/view/theme/'. $this->config->get('config_template') .'/rs-plugin/js/jquery.themepunch-art.js');
            } else {
                $this->document->addScript('catalog/view/theme/'. $this->config->get('config_template') .'/rs-plugin/js/jquery.themepunch_go.js');
            }

            $data['heading_title'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['title'], ENT_QUOTES, 'UTF-8');
			$data['html'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['description'], ENT_QUOTES, 'UTF-8');
		
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/topslider.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/topslider.tpl', $data);
			}
		}
	}
}