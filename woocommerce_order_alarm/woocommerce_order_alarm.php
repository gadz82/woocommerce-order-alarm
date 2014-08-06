<?php
/*
Plugin Name: Woocommerce Order Alarm
Plugin URI: http://www.webglow.it
Description: Estensione Woocommerce per allarme nuovi ordini
Version: 0.0.1
Author: Francesco Marchesini
Author URI: http://www.webglow.it
*/

if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	if (!class_exists( 'woocommerce_order_alarm' ) ) {
		
		class woocommerce_order_alarm{
			
			private $alarm;
			
			public function __construct(){
				add_action('manage_shop_order_posts_custom_column', array($this, 'order_alarm'), 10, 2);
			}
			
			public function order_alarm(){
				if(empty($this->alarm)){
					$this->alarm = plugin_dir_url( __FILE__ ) .'alarm.mp3';
					wp_enqueue_script('order_alarm_js', plugin_dir_url( __FILE__ ) . '/js/order_alarm.js', array('jquery') );
					wp_enqueue_style('order_alarm_css',  plugin_dir_url( __FILE__ ) . '/css/order_alarm.css' );
					wp_localize_script('order_alarm_js', 'alarm', array('sound' => $this->alarm));
				}
			}
		}
	}

	new woocommerce_order_alarm();
}
