<?php
class ControllerModuleAdvancedColors extends Controller {
	private $error = array();
	public function install(){
		$this->load->model('module/advanced_colors');
		$this->model_module_advanced_colors->install();
	}
	public function uninstall() {
		if(VERSION == '2.0.0.0')
		{
			$this->load->model('tool/event');
			$event = $this->model_tool_event;
		} else {
			$this->load->model('extension/event');
			$event = $this->model_extension_event;
		}
		$event->deleteEvent('advanced_colors');
	}
	public function index() {
		$this->load->model('module/advanced_colors');
		$this->load->language('module/advanced_colors');

		$this->document->setTitle($this->language->get('meta_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_module_advanced_colors->saveOptions($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('meta_title');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_product_page'] = $this->language->get('text_product_page');
		$data['text_list_page'] = $this->language->get('text_list_page');
		$data['text_enable_title'] = $this->language->get('text_enable_title');
		$data['text_enable'] = $this->language->get('text_enable');
		$data['text_disable'] = $this->language->get('text_disable');
		$data['text_image_width'] = $this->language->get('text_image_width');
		$data['text_image_height'] = $this->language->get('text_image_height');
		$data['text_view_more_width'] = $this->language->get('text_view_more_width');
		$data['text_view_more_height'] = $this->language->get('text_view_more_height');
		$data['text_icon_swatch_width'] = $this->language->get('text_icon_swatch_width');
		$data['text_icon_swatch_height'] = $this->language->get('text_icon_swatch_height');
		$data['text_select_option'] = $this->language->get('text_select_option');
		$data['text_no_options'] = $this->language->get('text_no_options');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/advanced_colors', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		$data['action'] = $this->url->link('module/advanced_colors/index', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];
		$options = $this->model_module_advanced_colors->getOptions();
		$productOptions = $this->model_module_advanced_colors->getSelectOptions();
		foreach($options as $val){
			$data[$val['name']] = $val['value'];
		}
		$data['productselectoptions'] = $productOptions;
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/advanced_colors.tpl', $data));
	}

	public function preEditProduct($data){
		$this->registry->set('product_submited_data', $data);
	}
	public function editProduct($product_id){
		$this->load->model('module/advanced_colors');
		$this->model_module_advanced_colors->editProductImages($product_id);
	}
	public function editOption($data){
		$this->load->model('module/advanced_colors');
		$this->model_module_advanced_colors->editOption($data);
	}
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/advanced_colors')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}