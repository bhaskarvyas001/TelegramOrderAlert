<?php

class TelegramAlerts extends Module
{
	public function __construct()
	{
		$this->name = 'telegramalerts';
		$this->tab = 'front_office_features';
		$this->version = '0.1';
		$this->author = 'Deepak Kumar';
		$this->displayName = 'Module to setup Telegram alerts for new orders';
		$this->description = 'With this module, you can setup telegram alert for new order events in prestashop';
		$this->bootstrap = true;
		parent::__construct();
	}

	public function install()
	{
		parent::install();
		$this->registerHook('displayOrderConfirmation');
		return true;
	}

	public function hookDisplayOrderConfirmation($params = null)
	{       
		//Get all other details using the $params['objOrder'] order object
		$id_order = Tools::getvalue('id_order');
		$order = new Order($id_order);
		$id_order_ref =  $order->reference;
		$id_customer = $order->id_customer;
		$customer = new Customer($id_customer);
		$customer_email = $customer->email;
		$sale = $order->total_paid;

		//send alert to telegram
		$apiToken = Configuration::get('MYMOD_BOT_ID');
		$chat_id = Configuration::get('MYMOD_CHAT_ID');
		$data = [
			'chat_id' => "$chat_id",
			'text' => "New order #$id_order (ref: $id_order_ref) received from customer $customer_email. Sale value is $sale"
		];
		$response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data));
	}

	public function processConfiguration()
	{
		if (Tools::isSubmit('mymod_pc_form'))
		{	
			$bot_id = Tools::getValue('bot_id');
			$enable_orders = Tools::getValue('enable_orders');
			$chat_id = Tools::getValue('chat_id');
			Configuration::updateValue('MYMOD_BOT_ID', $bot_id);
			Configuration::updateValue('MYMOD_ORDERS', $enable_orders);
			Configuration::updateValue('MYMOD_CHAT_ID', $chat_id);
			$this->context->smarty->assign('confirmation', 'ok');
		}
	}

	public function assignConfiguration()
	{
		$bot_id = Configuration::get('MYMOD_BOT_ID');
		$enable_orders = Configuration::get('MYMOD_ORDERS');
		$chat_id = Configuration::get('MYMOD_CHAT_ID');
		$this->context->smarty->assign('bot_id', $bot_id);
		$this->context->smarty->assign('enable_orders', $enable_orders);
		$this->context->smarty->assign('chat_id', $chat_id);
	}

	public function getContent()
	{
		$this->processConfiguration();
		$this->assignConfiguration();
		return $this->display(__FILE__, 'getContent.tpl');
	}
}
