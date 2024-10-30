<?php
/*
Plugin Name: IM WooCommerce Account Widget
Plugin URI: http://wordpress.org/plugins/im-woocommerce-my-account-widget/
Description: Shows woocommerce account data in a widget.
Author: Fabio Folcio
Text Domain: im-woocommerce-my-account-widget
Domain Path: /languages
Author URI: http://www.i-motion.it
Version: 0.4.0
*/

class IMWooCommerceMyAccountWidget extends WP_Widget
{
function __construct()
{
	$widget_ops = array('classname' => 'IMWooCommerceMyAccountWidget', 'description' => __( 'IM WooCommerce My Account Widget shows order & account data', 'im-woocommerce-my-account-widget' ) );
    parent::__construct('IMWooCommerceMyAccountWidget', __( 'IM WooCommerce My Account Widget', 'im-woocommerce-my-account-widget' ), $widget_ops);
}
function form($instance)
{
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
	$show_cartlink = isset( $instance['show_cartlink'] ) ? (bool) $instance['show_cartlink'] : false;
	$show_orderslink = isset( $instance['show_orderslink'] ) ? (bool) $instance['show_orderslink'] : false;
	$show_addresslink = isset( $instance['show_addresslink'] ) ? (bool) $instance['show_addresslink'] : false;
	$show_accountdetaillink = isset( $instance['show_accountdetaillink'] ) ? (bool) $instance['show_accountdetaillink'] : false;
	$show_items = isset( $instance['show_items'] ) ? (bool) $instance['show_items'] : false;
	$show_upload = isset( $instance['show_upload'] ) ? (bool) $instance['show_upload'] : false;
	$show_upload_new = isset( $instance['show_upload_new'] ) ? (bool) $instance['show_upload_new'] : false;
	$show_unpaid = isset( $instance['show_unpaid'] ) ? (bool) $instance['show_unpaid'] : false;
	$show_pending = isset( $instance['show_pending'] ) ? (bool) $instance['show_pending'] : false;
	$show_logout_link = isset( $instance['show_logout_link'] ) ? (bool) $instance['show_logout_link'] : false;
	$login_with_email = isset( $instance['login_with_email'] ) ? (bool) $instance['login_with_email'] : false;
	
?>
	<p><label for="<?php echo $this->get_field_id('logged_out_title'); ?>"><?php _e('Logged out title:', 'im-woocommerce-my-account-widget') ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('logged_out_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('logged_out_title') ); ?>" value="<?php if (isset ( $instance['logged_out_title'])) echo esc_attr( $instance['logged_out_title'] ); else echo __('Customer Login', 'im-woocommerce-my-account-widget'); ?>" /></p>
	
	<p><label for="<?php echo $this->get_field_id('logged_in_title'); ?>"><?php _e('Logged in title:', 'im-woocommerce-my-account-widget') ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('logged_in_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('logged_in_title') ); ?>" value="<?php if (isset ( $instance['logged_in_title'])) echo esc_attr( $instance['logged_in_title'] ); else echo __('Welcome %s', 'im-woocommerce-my-account-widget'); ?>" /></p>

   	<p> <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_cartlink') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_cartlink') ); ?>"<?php checked( $show_cartlink ); ?> />
		<label for="<?php echo $this->get_field_id('show_cartlink'); ?>"><?php _e( 'Show link to shopping cart', 'im-woocommerce-my-account-widget' ); ?></label><br />
		
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_orderslink') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_orderslink') ); ?>"<?php checked( $show_orderslink ); ?> />
		<label for="<?php echo $this->get_field_id('show_orderslink'); ?>"><?php _e( 'Show link to orders page', 'im-woocommerce-my-account-widget' ); ?></label><br />
		
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_addresslink') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_addresslink') ); ?>"<?php checked( $show_addresslink ); ?> />
		<label for="<?php echo $this->get_field_id('show_addresslink'); ?>"><?php _e( 'Show link to address page', 'im-woocommerce-my-account-widget' ); ?></label><br />
		
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_accountdetaillink') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_accountdetaillink') ); ?>"<?php checked( $show_accountdetaillink ); ?> />
		<label for="<?php echo $this->get_field_id('show_accountdetaillink'); ?>"><?php _e( 'Show link to account details', 'im-woocommerce-my-account-widget' ); ?></label><br />
		
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_items') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_items') ); ?>"<?php checked( $show_items ); ?> />
		<label for="<?php echo $this->get_field_id('show_items'); ?>"><?php _e( 'Show number of items in cart', 'im-woocommerce-my-account-widget' ); ?></label><br />

        <?php if (class_exists('WPF_Uploads')): ?>
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_upload_new') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_upload_new') ); ?>"<?php checked( $show_upload_new ); ?> />
		<label for="<?php echo $this->get_field_id('show_upload_new'); ?>"><?php _e( 'Show number of uploads left', 'im-woocommerce-my-account-widget' ); ?></label><br />
		<?php elseif (function_exists('woocommerce_umf_admin_menu')): ?>
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_upload') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_upload') ); ?>"<?php checked( $show_upload ); ?> />
		<label for="<?php echo $this->get_field_id('show_upload'); ?>"><?php _e( 'Show number of uploads left', 'im-woocommerce-my-account-widget' ); ?></label><br />
		<?php endif; ?>
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_unpaid') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_unpaid') ); ?>"<?php checked( $show_unpaid ); ?> />
		<label for="<?php echo $this->get_field_id('show_unpaid'); ?>"><?php _e( 'Show number of unpaid orders', 'im-woocommerce-my-account-widget' ); ?></label><br/>
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_pending') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_pending') ); ?>"<?php checked( $show_pending ); ?> />
		<label for="<?php echo $this->get_field_id('show_pending'); ?>"><?php _e( 'Show number of uncompleted orders', 'im-woocommerce-my-account-widget' ); ?></label><br>
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_logout_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_logout_link') ); ?>"<?php checked( $show_logout_link ); ?> />
		<label for="<?php echo $this->get_field_id('show_logout_link'); ?>"><?php _e( 'Show logout link', 'im-woocommerce-my-account-widget' ); ?></label>
	</p>
	<p><label for="<?php echo $this->get_field_id('wma_redirect'); ?>"><?php _e('Redirect to page after login:', 'im-woocommerce-my-account-widget') ?></label>
		<select name="<?php echo esc_attr( $this->get_field_name('wma_redirect') ); ?>" class="widefat">
			<option value="">
				<?php echo esc_attr( __( 'Select page','im-woocommerce-my-account-widget' ) ); ?></option> 
				<?php 
				$pages = get_pages(); 
				foreach ( $pages as $page ) {
					$option = '<option value="' . $page->ID . '" '.selected($instance['wma_redirect'],$page->ID,false).'>';
					$option .= $page->post_title;
					$option .= '</option>';
					echo $option;
				}
				?>
		</select>

	<p><?php _e('Other options','im-woocommerce-my-account-widget');?>:<br>
		<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('login_with_email') ); ?>" name="<?php echo esc_attr( $this->get_field_name('login_with_email') ); ?>"<?php checked( $login_with_email ); ?> />
		<label for="<?php echo $this->get_field_id('login_with_email'); ?>"><?php _e( 'Login with email address', 'im-woocommerce-my-account-widget' ); ?></label>
	</p>
<?php
}
 
function update($new_instance, $old_instance)
{
    $instance = $old_instance;
	$instance['logged_out_title'] = strip_tags(stripslashes($new_instance['logged_out_title']));
	$instance['logged_in_title'] = strip_tags(stripslashes($new_instance['logged_in_title']));
	$instance['show_cartlink'] = !empty($new_instance['show_cartlink']) ? 1 : 0;
	$instance['show_orderslink'] = !empty($new_instance['show_orderslink']) ? 1 : 0;
	$instance['show_addresslink'] = !empty($new_instance['show_addresslink']) ? 1 : 0;
	$instance['show_accountdetaillink'] = !empty($new_instance['show_accountdetaillink']) ? 1 : 0;
	$instance['show_items'] = !empty($new_instance['show_items']) ? 1 : 0;
	$instance['show_upload'] = !empty($new_instance['show_upload']) ? 1 : 0;
	$instance['show_upload_new'] = !empty($new_instance['show_upload_new']) ? 1 : 0;
	$instance['show_unpaid'] = !empty($new_instance['show_unpaid']) ? 1 : 0;
	$instance['show_pending'] = !empty($new_instance['show_pending']) ? 1 : 0;
	$instance['show_logout_link'] = !empty($new_instance['show_logout_link']) ? 1 : 0;
	$instance['login_with_email'] = !empty($new_instance['login_with_email']) ? 1 : 0;
	$instance['wma_redirect'] = esc_attr($new_instance['wma_redirect']);
	
	if($instance['login_with_email']==1) {
		add_option('wma_login_with_email', $new_instance['login_with_email']);
	} else {
		delete_option('wma_login_with_email');
	}
	
	return $instance;
}
function widget($args, $instance)
{	
	extract($args, EXTR_SKIP);
	global $woocommerce;


	//$logged_out_title = (!empty()) ? $instance['logged_out_title'] : __('Customer Login', 'woocommerce-my-account-widget');
	$logged_out_title = apply_filters( 'widget_title', empty($instance['logged_out_title']) ? __('Customer Login', 'im-woocommerce-my-account-widget') : $instance['logged_out_title'], $instance );
	//$logged_in_title = (!empty()) ? $instance['logged_in_title'] : __('Welcome %s', 'woocommerce-my-account-widget');
	$logged_in_title = apply_filters( 'widget_title', empty($instance['logged_in_title']) ? __('Welcome %s', 'im-woocommerce-my-account-widget') : $instance['logged_in_title'], $instance );

	echo $before_widget;
    
	$c = (isset($instance['show_cartlink']) && $instance['show_cartlink']) ? '1' : '0';
	$cart_page_id = get_option('woocommerce_cart_page_id');
	
	//check if user is logged in 
	if ( is_user_logged_in() ) {
		
		$or = (isset($instance['show_orderslink']) && $instance['show_orderslink']) ? '1' : '0';
		$ad = (isset($instance['show_addresslink']) && $instance['show_addresslink']) ? '1' : '0';
		$de = (isset($instance['show_accountdetaillink']) && $instance['show_accountdetaillink']) ? '1' : '0';
		$it = (isset($instance['show_items']) && $instance['show_items']) ? '1' : '0';
		$u = (isset($instance['show_upload']) && $instance['show_upload']) ? '1' : '0';
		$unew = (isset($instance['show_upload_new']) && $instance['show_upload_new']) ? '1' : '0';
		$up = (isset($instance['show_unpaid']) && $instance['show_unpaid']) ? '1' : '0';
		$p = (isset($instance['show_pending']) && $instance['show_pending']) ? '1' : '0';
		$lo = (isset($instance['show_logout_link']) && $instance['show_logout_link']) ? '1' : '0';
	
	// redirect url after login / logout
	if(is_multisite()) { $woo_ma_home=network_home_url(); } else {$woo_ma_home=home_url();}
	
		$user = get_user_by('id', get_current_user_id());
		echo '<div class=login>';
		if($user->first_name!="") { $uname=$user->first_name;} else { $uname=$user->display_name; }
		if ( $logged_in_title ) echo sprintf( $logged_in_title, ucwords($uname) );
		

		
				
		if($c) {echo '<p><a class="woo-ma-button cart-link woo-ma-cart-link" href="'.get_permalink(wma_lang_id($cart_page_id)) .'" title="'. __('View your shopping cart','im-woocommerce-my-account-widget').'">'.__('View your shopping cart','im-woocommerce-my-account-widget').'</a></p>';}
		
		$notcompleted=0;
		$uploadfile=0;
		$uploadfile_new=0;
		$notpaid=0;
		$customer_id = get_current_user_id();
		if ( version_compare( WOOCOMMERCE_VERSION, "2.2" ) < 0 ) {

            $customer_orders = get_posts( array(
                'numberposts' => -1,
                'meta_key'    => '_customer_user',
                'meta_value'  => get_current_user_id(),
                'post_type'   => 'shop_order',
                'post_status' => 'publish'
            ) );

        } else {

            $customer_orders = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
            	'numberposts' => -1,
            	'meta_key'    => '_customer_user',
            	'meta_value'  => get_current_user_id(),
            	'post_type'   => wc_get_order_types( 'view-orders' ),
            	'post_status' => array_keys( wc_get_order_statuses() )
            ) ) );

        }
		if ($customer_orders) {
    			foreach ($customer_orders as $customer_order) :
    				$woocommerce1=0;
    				if ( version_compare( WOOCOMMERCE_VERSION, "2.2" ) < 0 ) {
    				    $order = new WC_Order();
                        $order->populate( $customer_order );
                    } else {
                        $order = wc_get_order($customer_order->ID);
                    }
    		   
    				//$status = get_term_by('slug', $order->status, 'shop_order_status');
    				if($order->status!='completed' && $order->status!='cancelled'){ $notcompleted++; }


    			/* upload files */
    		if (function_exists('woocommerce_umf_admin_menu')) {
    			if(get_max_upload_count($order) >0 ) {
    				$j=1;
    				foreach ( $order->get_items() as $order_item ) {
    					$max_upload_count=get_max_upload_count($order,$order_item['product_id']);
    					$i=1;
    					$upload_count=0;
    					while ($i <= $max_upload_count) {
    						if(get_post_meta( $order->id, '_woo_umf_uploaded_file_name_' . $j, true )!="") {$upload_count++;}
    						$i++;
    						$j++;
    					}
    					/* toon aantal nog aan te leveren bestanden */
    					$upload_count=$max_upload_count-$upload_count;
    					$uploadfile+=$upload_count;
    				}
    			}
    		}


            if (class_exists('WPF_Uploads')) {

                // Uploads needed
                $uploads_needed = WPF_Uploads::order_needs_upload($order, true);
                $uploaded_count_new = WPF_Uploads::order_get_upload_count($order->id);

                $uploads_needed_left = $uploads_needed - $uploaded_count_new;

                $uploadfile_new = $uploadfile_new + $uploads_needed_left;
            }


    		if (in_array($order->status, array('on-hold','pending', 'failed'))) { $notpaid++;}
    		endforeach;
		}
		
		$my_account_id=wma_lang_id(get_option('woocommerce_myaccount_page_id'));
		
		echo '<p><a class="woo-ma-button woo-ma-myaccount-link myaccount-link" href="'.get_permalink( $my_account_id ).'" title="'. __('My Account','im-woocommerce-my-account-widget').'">'.__('My Account','im-woocommerce-my-account-widget').'</a></p>';
		
		echo '<ul class="clearfix woo-ma-list">';
			if($or) {
				echo '<li class="woo-ma-link item">
						<a class="cart-contents-new" href="'.get_permalink( $my_account_id ).'orders/" title="'. __('View your orders', 'im-woocommerce-my-account-widget').'"> '
							.__('Orders', 'im-woocommerce-my-account-widget' ).'
						</a>
					</li>';
			} 
			if($ad) {
				echo '<li class="woo-ma-link item">
						<a class="cart-contents-new" href="'.get_permalink( $my_account_id ).'edit-address/" title="'. __('View your address', 'im-woocommerce-my-account-widget').'"> '
							.__('Address', 'im-woocommerce-my-account-widget' ).'
						</a>
					</li>';
			} 
			
			if($de) {
				echo '<li class="woo-ma-link item">
						<a class="cart-contents-new" href="'.get_permalink( $my_account_id ).'edit-account/" title="'. __('Account details', 'im-woocommerce-my-account-widget').'"> '
							.__('Account details', 'im-woocommerce-my-account-widget' ).'
						</a>
					</li>';
			} 
			
			if($it) {
				//$woocommerce->cart->get_cart_url()
				echo '<li class="woo-ma-link item">
						<a class="cart-contents-new" href="'.get_permalink(wma_lang_id($cart_page_id)).'" title="'. __('View your shopping cart', 'im-woocommerce-my-account-widget').'">
							<span>'.$woocommerce->cart->cart_contents_count.'</span> '
							._n('product in your shopping cart','products in your shopping cart', $woocommerce->cart->cart_contents_count, 'im-woocommerce-my-account-widget' ).'
						</a>
					</li>';
			} 
			if($u && function_exists('woocommerce_umf_admin_menu')) {

				echo '<li class="woo-ma-link upload">
						<a href="'.get_permalink( $my_account_id ).'" title="'. __('Upload files', 'woocommerce-my-account-widget').'">
							<span>'.$uploadfile.'</span> '
							._n('file to upload','files to upload', $uploadfile, 'im-woocommerce-my-account-widget' ).'
						</a>
					</li>';
			}
            if($unew && class_exists('WPF_Uploads')) {

				echo '<li class="woo-ma-link upload">
						<a href="'.get_permalink( $my_account_id ).'" title="'. __('Upload files', 'im-woocommerce-my-account-widget').'">
							<span>'.$uploadfile_new.'</span> '
							._n('file to upload','files to upload', $uploadfile_new, 'im-woocommerce-my-account-widget' ).'
						</a>
					</li>';
			}
			if($up) {
				echo '<li class="woo-ma-link paid">
						<a href="'.get_permalink( $my_account_id ).'" title="'. __('Pay orders', 'im-woocommerce-my-account-widget').'">
							<span>'.$notpaid.'</span> '
							._n('payment required','payments required', $notpaid, 'im-woocommerce-my-account-widget' ).'
						</a>
					</li>';
			}
			if($p) {
				echo '<li class="woo-ma-link pending">
						<a href="'.get_permalink( $my_account_id ).'" title="'. __('View uncompleted orders', 'im-woocommerce-my-account-widget').'">
							<span>'.$notcompleted.'</span> '
							._n('order pending','orders pending', $notcompleted, 'im-woocommerce-my-account-widget' ).'
						</a>
					</li>';
			} 
			if($lo==1) {
				echo '<li class="woo-ma-link pending">
						<a class="woo-ma-button woo-ma-logout-link logout-link" href="'.wp_logout_url($woo_ma_home).'" title="'. __('Log out','im-woocommerce-my-account-widget').'">'.__('Log out','im-woocommerce-my-account-widget').'
						</a>
					</li>';
			}
			
		echo '</ul>';
		
	}
	else {
		echo '<div class=logout>';
		// user is not logged in
		if ( $logged_out_title ) echo $before_title . $logged_out_title . $after_title;
		if(isset($_GET['login']) && $_GET['login']=='failed') {
			echo '<p class="woo-ma-login-failed woo-ma-error">';
			_e('Login failed, please try again','im-woocommerce-my-account-widget');
			echo '</p>';
		}
		// login form
		$args = array(
			'echo' => true,
			'form_id' => 'wma_login_form',
			'label_username' => __( 'Username','im-woocommerce-my-account-widget'),
			'label_password' => __( 'Password','im-woocommerce-my-account-widget'),
			'label_remember' => __( 'Remember Me','im-woocommerce-my-account-widget' ),
			'label_log_in' => __( 'Log In','im-woocommerce-my-account-widget'),
			'id_username' => 'user_login',
			'id_password' => 'user_pass',
			'id_remember' => 'rememberme',
			'id_submit' => 'wp-submit',
			'remember' => true,
			'value_username' => NULL,
			'value_remember' => false );
			
		if(isset($instance['wma_redirect']) && $instance['wma_redirect']!="") {
			$args['redirect']=get_permalink(wma_lang_id($instance['wma_redirect']));
		}
		
		wp_login_form( $args );
		echo '<a class="woo-ma-link woo-ma-lost-pass" href="'. wp_lostpassword_url().'">'. __('Lost password?', 'im-woocommerce-my-account-widget').'</a>';
		
		if(get_option('users_can_register')) {  
			echo ' <a class="woo-ma-button woo-ma-register-link register-link" href="'.get_permalink( get_option('woocommerce_myaccount_page_id') ).'" title="'. __('Register','im-woocommerce-my-account-widget').'">'.__('Register','im-woocommerce-my-account-widget').'</a>';
		}
		if($c) {
			echo '<p><a class="woo-ma-button woo-ma-cart-link cart-link" href="'.get_permalink(wma_lang_id($cart_page_id)) .'" title="'. __('View your shopping cart','im-woocommerce-my-account-widget').'">'.__('View your shopping cart','im-woocommerce-my-account-widget').'</a></p>';
		}
	}
	echo '</div>';
    echo $after_widget;
}

}

add_action('plugins_loaded', 'wma_load_textdomain');

function wma_load_textdomain() {

    load_plugin_textdomain('im-woocommerce-my-account-widget', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

}

add_action( 'widgets_init', create_function('', 'return register_widget("IMWooCommerceMyAccountWidget");') );

/**
* Redirect to homepage after failed login 
* Since 0.2.3
*/
add_action('wp_login_failed', 'wma_login_fail'); 
 
function wma_login_fail($username){
    // Get the reffering page, where did the post submission come from?
    $referer = parse_url($_SERVER['HTTP_REFERER']);
	$referer= '//'.$referer['host'].''.$referer['path'];
 
    // if there's a valid referrer, and it's not the default log-in screen
    if(!empty($referer) && !strstr($referer,'wp-login') && !strstr($referer,'wp-admin')){
        // let's append some information (login=failed) to the URL for the theme to use
        wp_redirect($referer . '?login=failed'); 
    exit;
    }
}

/**
 * Use e-mail address for login
 * Since 0.3
 */
function wma_email_login_auth( $user, $username, $password ) {
	if ( is_a( $user, 'WP_User' ) )
		return $user;

	if ( !empty( $username ) ) {
		$username = str_replace( '&', '&amp;', stripslashes( $username ) );
		$user = get_user_by( 'email', $username );
		if ( isset( $user, $user->user_login, $user->user_status ) && 0 == (int) $user->user_status )
			$username = $user->user_login;
	}
	return wp_authenticate_username_password( null, $username, $password );
}

add_action( 'wp_footer', 'wma_login_validate' );

function wma_login_validate() {
?>
	<script type="text/javascript">

        jQuery('form#wma_login_form').submit(function(){

            if (jQuery(this).find('#user_login').val() == '' || jQuery(this).find('#user_pass').val() == '') {
              alert('<?php _e("Please fill in your username and password", "im-woocommerce-my-account-widget"); ?>');
              return false;
            }


        });

    </script>

<?php
}

if(get_option('wma_login_with_email')=='on') {
	remove_filter( 'authenticate', 'wp_authenticate_username_password', 20, 3 );
	add_filter( 'authenticate', 'wma_email_login_auth', 20, 3 );
    add_action( 'wp_footer', 'wma_email_login' );
}

function wma_email_login() {
?>
	<script type="text/javascript">
	// Form Label
	if ( document.getElementById('wma_login_form') )
		document.getElementById('wma_login_form').childNodes[1].childNodes[1].childNodes[0].nodeValue = '<?php echo esc_js( __( 'Username or Email', 'im-woocommerce-my-account-widget' ) ); ?>';
    </script>

<?php
}

/** 
 * Get WPML ID
 * Since 0.3
 */
function wma_lang_id($id){
  if(function_exists('icl_object_id')) {
    return icl_object_id($id,'page',true);
  } else {
    return $id;
  }
}
?>