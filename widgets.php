<?php 

/*-----------------------------------------------------------------------------------*/
/*	RECENT POSTS WIDGET
/*-----------------------------------------------------------------------------------*/
add_action('widgets_init', 'tucson_recent_posts_load_widget');
function tucson_recent_posts_load_widget(){
	register_widget('tucson_recent_posts_widget');
}

class tucson_recent_posts_widget extends WP_Widget {
	
	function tucson_recent_posts_widget()
	{
		$widget_ops = array('classname' => 'tucson-recent_posts-widget', 'description' => '');

		$control_ops = array('id_base' => 'tucson_recent_posts-widget');

		$this->WP_Widget('tucson_recent_posts-widget', 'Tucson: Recent Posts', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;

		if($title)
			echo  $before_title.$title.$after_title;
	?>
			
			<div class="tabs">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#popularPosts" data-toggle="tab"><i class="icon icon-star"></i> Popular</a></li>
					<li><a href="#recentPosts" data-toggle="tab">Recent</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="popularPosts">
						<ul class="simple-post-list">
						
							<?php 
								$popular = new WP_Query('post_type=post&posts_per_page=3&orderby=comment_count&order=DESC'); 
								if( $popular->have_posts() ) : while ( $popular->have_posts() ): $popular->the_post(); 
							?>
							
								<li>
									<div class="post-image">
										<div class="img-thumbnail">
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail(array(50,50)); ?>
											</a>
										</div>
									</div>
									<div class="post-info">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										<div class="post-meta">
												<?php the_time( get_option('date_format') ); ?>
										</div>
									</div>
								</li>
								
							<?php 
								endwhile; 
								endif; 
								wp_reset_query(); 
							?>

						</ul>
					</div>
					<div class="tab-pane" id="recentPosts">
						<ul class="simple-post-list">
							
							<?php 
								$recent = new WP_Query('post_type=post&posts_per_page=3'); 
								if( $recent->have_posts() ) : while ( $recent->have_posts() ) : $recent->the_post(); 
							?>
								
								<li>
									<div class="post-image">
										<div class="img-thumbnail">
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail(array(50,50)); ?>
											</a>
										</div>
									</div>
									<div class="post-info">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										<div class="post-meta">
												<?php the_time( get_option('date_format') ); ?>
										</div>
									</div>
								</li>
								
							<?php 
								endwhile; 
								endif; 
								wp_reset_query(); 
							?>
							
						</ul>
					</div>
				</div>
			</div>
			
	<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	function form($instance){
		$defaults = array('title' => 'Recent Portfolio');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
	<?php
	}
}
/*-----------------------------------------------------------------------------------*/
/*	END RECENT POSTS WIDGET
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	CONTACT WIDGET
/*-----------------------------------------------------------------------------------*/
add_action('widgets_init', 'tucson_contact_load_widgets');
function tucson_contact_load_widgets()
{
	register_widget('tucson_contact_Widget');
}

class tucson_contact_Widget extends WP_Widget {
	
	function tucson_contact_Widget()
	{
		$widget_ops = array('classname' => 'tucson_contact', 'description' => '');

		$control_ops = array('id_base' => 'tucson_contact-widget');

		$this->WP_Widget('tucson_contact-widget', 'Tucson: Contact Details', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;

		if($title)
			echo  $before_title.$title.$after_title;
	?>

		<?php echo wpautop(htmlspecialchars_decode(trim($instance['amount']))); ?>
		
		<div class="contact-details">
			<ul class="contact">
				<li><p><i class="icon icon-map-marker"></i> <?php echo htmlspecialchars_decode($instance['address']); ?></p></li>
				<li><p><i class="icon icon-phone"></i> <?php echo htmlspecialchars_decode($instance['phone']); ?></p></li>
				<li><p><i class="icon icon-envelope"></i> <?php echo htmlspecialchars_decode($instance['email']); ?></p></li>
			</ul>
		</div>
		
	<?php 
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['amount'] = esc_textarea($new_instance['amount']);
		$instance['address'] = esc_textarea($new_instance['address']);
		$instance['phone'] = esc_textarea($new_instance['email']);
		$instance['email'] = esc_textarea($new_instance['phone']);

		return $instance;
	}

	function form($instance)
	{
		$defaults = array(
			'title' => 'Contact Details', 
			'amount' => 'Tucson is a very powerful HTML5 template, you will be able to create an awesome website in a very simple way. <a href="#" class="btn-flat btn-xs">View More <i class="icon icon-arrow-right"></i></a>',
			'address' => '<strong>Address:</strong> 123 Street Name, City, USA',
			'phone' => '<strong>Phone:</strong> (123) 456-7890',
			'email' => '<strong>Email:</strong> <a href="mailto:mail@example.com">mail@example.com</a>'
		);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('amount'); ?>">Widget Content:</label>
			<textarea class="widefat" style="width: 100%;" id="<?php echo $this->get_field_id('amount'); ?>" name="<?php echo $this->get_field_name('amount'); ?>"><?php echo $instance['amount']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('address'); ?>">Address:</label>
			<textarea class="widefat" style="width: 100%;" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>"><?php echo $instance['address']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('phone'); ?>">Phone:</label>
			<textarea class="widefat" style="width: 100%;" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>"><?php echo $instance['phone']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('email'); ?>">Email:</label>
			<textarea class="widefat" style="width: 100%;" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>"><?php echo $instance['email']; ?></textarea>
		</p>
	<?php
	}
}
/*-----------------------------------------------------------------------------------*/
/*	END CONTACT WIDGET
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	POPULAR POSTS WIDGET
/*-----------------------------------------------------------------------------------*/
add_action('widgets_init', 'tucson_popular_load_widgets');
function tucson_popular_load_widgets()
{
	register_widget('tucson_popular_Widget');
}

class tucson_popular_Widget extends WP_Widget {
	
	function tucson_popular_Widget()
	{
		$widget_ops = array('classname' => 'tucson_popular', 'description' => '');

		$control_ops = array('id_base' => 'tucson_popular-widget');

		$this->WP_Widget('tucson_popular-widget', 'Tucson: Popular Posts', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;

		if($title)
			echo  $before_title.$title.$after_title;
	?>
	
    	<?php ( get_option( 'show_on_front' ) == 'page' ) ? $url = get_permalink( get_option('page_for_posts' ) ) : $url = home_url(); ?>
    	
		<ul class="nav nav-list primary">
			<?php 
				$popular = new WP_Query('post_type=post&posts_per_page=' . $instance['amount'] . '&orderby=comment_count&order=DESC'); 
				if( $popular->have_posts() ) : while ( $popular->have_posts() ): $popular->the_post(); 
			?>
				<li>
					<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</li>
			<?php 
				endwhile; 
				endif; 
				wp_reset_query(); 
			?>
		</ul>

		<a href="<?php echo $url; ?>" class="btn-flat pull-right btn-xs view-more-recent-work"><?php echo get_option('blog_title','Our Blog'); ?> <i class="icon icon-arrow-right"></i></a>
		
	<?php 
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		if( is_numeric($new_instance['amount']) ){
			$instance['amount'] = $new_instance['amount'];
		} else {
			$new_instance['amount'] = '3';
		}

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Popular Posts', 'amount' => '3');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('amount'); ?>">Amount of Posts:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('amount'); ?>" name="<?php echo $this->get_field_name('amount'); ?>" value="<?php echo $instance['amount']; ?>" />
		</p>
	<?php
	}
}
/*-----------------------------------------------------------------------------------*/
/*	END POPULAR POSTS WIDGET
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	RECENT PORTFOLIO WIDGET
/*-----------------------------------------------------------------------------------*/
add_action('widgets_init', 'tucson_latest_portfolio_load_widget');
function tucson_latest_portfolio_load_widget(){
	register_widget('tucson_latest_portfolio_widget');
}

class tucson_latest_portfolio_widget extends WP_Widget {
	
	function tucson_latest_portfolio_widget()
	{
		$widget_ops = array('classname' => 'tucson-portfolio-widget', 'description' => '');

		$control_ops = array('id_base' => 'tucson_portfolio-widget');

		$this->WP_Widget('tucson_portfolio-widget', 'Tucson: Recent Portfolio', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;

		if($title)
			echo  $before_title.$title.$after_title;
			
	  	$recent_portfolio = new WP_Query('post_type=dslc_projects&posts_per_page=6'); 
	  	

	  ?>
	  
		    <ul class="list-unstyled recent-work">
		    
		    	<?php if( $recent_portfolio->have_posts() ) : while ( $recent_portfolio->have_posts() ): $recent_portfolio->the_post();  ?>
		    	
					<li>
						<a class="thumb-info" href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('recent-portfolio', array( 'class' => 'img-responsive' ) ); ?>
						</a>
					</li>
				
				<?php 
					endwhile; 
					endif; 
					wp_reset_query();
				?>
				
			</ul>
	
			<a href="<?php echo home_url(  ); ?>" class="btn-flat pull-right btn-xs view-more-recent-work"><?php echo get_option('portfolio_title','Our Work'); ?> <i class="icon icon-arrow-right"></i></a>
		 
	<?php 
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	function form($instance){
		$defaults = array('title' => 'Recent Portfolio');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
	<?php
	}
}
/*-----------------------------------------------------------------------------------*/
/*	END RECENT PORTFOLIO WIDGET
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	TWITTER WIDGET
/*-----------------------------------------------------------------------------------*/
add_action( 'widgets_init', create_function( '', 'register_widget("tucson_Tweets_Plugin_Widget");' ) );

//REQUIRED
require_once('oauth/twitteroauth.php');

//WIDGET CLASS
class tucson_Tweets_Plugin_Widget extends WP_Widget {

private $tucson_twitter_oauth = array();

	/*===================================================================*/
	/*	WIDGET SETUP
	/*===================================================================*/
	public function __construct() 
	{
		parent::__construct(
			'tucson_tweets', // BASE ID
			__('Tucson: Tweets', 'tucson'), // NAME
			array(
				'classname' => 'widget_tucson_tweets',
				'description' => __('A widget that displays your most recent tweets', 'tucson')
			)
		);
	}
	
	/*===================================================================*/
	/*	DISPLAY WIDGET
	/*===================================================================*/	
	public function widget( $args, $instance ) 
	{
		extract( $args, EXTR_SKIP );
	
		echo $before_widget;
	
		$title = apply_filters('widget_title', $instance['title'] );
		if ( $title ) { echo $before_title . $title . $after_title; }
	
		$result = $this->getTweets($instance['username'], $instance['count']);
		
		echo '<a class="twitter-account" href="http://www.twitter.com/'. $instance['username'] .'" target="_blank">@'. $instance['username'] .'</a>';

		echo '<div id="tweet" class="twitter">';
	
			if( $result && is_array($result) ) {
				foreach( $result as $tweet ) {
					$text = $this->link_replace($tweet['text']);
						echo '<i class="icon icon-twitter"></i>';
						echo $text;
						echo '<a class="twitter-time-stamp time" href="http://twitter.com/' . $instance['username'] . '/status/' . $tweet['id'] . '">' . $tweet['timestamp'] . '</a>';
				}
			} else {
				echo __('There was an error grabbing the Twitter feed', 'tucson');
			}
	
		echo '</div>';
	
		echo $after_widget;
	} // end widget
	
	/*===================================================================*/
	/*	UPDATE WIDGET
	/*===================================================================*/
	public function update( $new_instance, $old_instance ) 
	{
		$instance = $old_instance;
	
		// STRIP TAGS TO REMOVE HTML - IMPORTANT FOR TEXT IMPUTS
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
	
		return $instance;
	} // end update

	/*===================================================================*/
	/*	WIDGET SETTINGS (FRONT END PANEL)
	/*===================================================================*/ 
	public function form( $instance ) 
	{
		$instance = wp_parse_args(
			(array) $instance
		);
	
		//WIDGET DEFAULTS
		$defaults = array(
			'title' => 'Twitter.',
			'username' => '',
			'count' => '3',
			'tweettext' => 'Follow',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
	
		$access_token = get_option('tucson_tw_access_token');
		$access_token_secret = get_option('tucson_tw_access_token_secret');
		$consumer_key = get_option('tucson_tw_consumer_key');
		$consumer_key_secret = get_option('tucson_tw_consumer_secret');
	
		//IF SETTINGS ARE EMPTY
		if( empty($access_token) || empty($access_token_secret) || empty($consumer_key) || empty($consumer_key_secret) ) {
			echo '<p><a href="options-general.php?page=tucson-tweets-plugin-settings">Configure Twitter Widget</a></p>'; 
		} else { ?>
	
			<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'tucson') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</p>
			
			<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Twitter Username: (ex: <a href="http://www.twitter.com/madeinebor" target="_blank">madeinebor</a>)', 'tucson') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
			</p>
			
			<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of Tweets:', 'tucson') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" />
			</p>
		
		<?php
		} //END if( empty($access_token)
	
	} // END FORM

	/**
	 * Return tweets, grab links and output.
	 *  
	 *   
	 * @package WordPress
	 * @subpackage tucson Tweets
	 * @author tommusrhodus
	 * @since tucson Tweets 2.0
	 */
 		 
	/*===================================================================*/
	/*	RETURN TWEETS
	/*===================================================================*/ 	 
	public function getTweets($username, $count) 
	{
		$config = array();
		$config['username'] = $username;
		$config['count'] = $count;
		$config['access_token'] = get_option('tucson_tw_access_token');
		$config['access_token_secret'] = get_option('tucson_tw_access_token_secret');
		$config['consumer_key'] = get_option('tucson_tw_consumer_key');
		$config['consumer_key_secret'] = get_option('tucson_tw_consumer_secret');
	
		$transname = 'tucson_tw_' . $username . '_' . $count;
	
		$result = get_transient( $transname );
		if( !$result ) {
			$result = $this->oauthRetrieveTweets($config);
	
			if( isset($result['errors']) ){
				$result = NULL; 
			} else {
				$result = $this->parseTweets( $result );
				set_transient( $transname, $result, 300 );
			}
		} else {
			if( is_string($result) )
				unserialize($result);
		}
	
		return $result;
	}
	
	/*===================================================================*/
	/*	OAUTH - API 1.1
	/*===================================================================*/  
	private function oauthRetrieveTweets($config) 
	{
		if( empty($config['access_token']) ) 
			return array('error' => __('Not properly configured, check settings', 'tucson'));		
		if( empty($config['access_token_secret']) ) 
			return array('error' => __('Not properly configured, check settings', 'tucson'));
		if( empty($config['consumer_key']) ) 
			return array('error' => __('Not properly configured, check settings', 'tucson'));		
		if( empty($config['consumer_key_secret']) ) 
			return array('error' => __('Not properly configured, check settings', 'tucson'));		
	
		$options = array(
			'trim_user' => true,
			'exclude_replies' => false,
			'include_rts' => true,
			'count' => $config['count'],
			'screen_name' => $config['username']
		);
	
		$connection = new TwitterOAuth($config['consumer_key'], $config['consumer_key_secret'], $config['access_token'], $config['access_token_secret']);
		$result = $connection->get('statuses/user_timeline', $options);
	
		return $result;
	}

	/*===================================================================*/
	/*	PARSE / SANITIZE
	/*===================================================================*/   
	public function parseTweets($results = array()) 
	{
		$tweets = array();
		if( $results ){
			foreach($results as $result) {
				$temp = explode(' ', $result['created_at']);
				$timestamp = $temp[2] . ' ' . $temp[1] . ' ' . $temp[5];
		
				$tweets[] = array(
					'timestamp' => $timestamp,
					'text' => filter_var($result['text'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
					'id' => $result['id_str']
				);
			}
		}
	
		return $tweets;
	}
	
	/*===================================================================*/
	/*	CHANGE TEXT TO LINK
	/*===================================================================*/    
	private function tucson_change_text_links($matches) 
	{
		return '<a href="' . $matches[0] . '" target="_blank">' . $matches[0] . '</a>';
	} //END tucson_change_text_links

	/*===================================================================*/
	/*	USERNAME LINK
	/*===================================================================*/ 
	private function tucson_change_username_link($matches) 
	{
		return '<a href="http://twitter.com/' . $matches[0] . '" target="_blank">' . $matches[0] . '</a>';
	} //END tucson_change_username_link

	/*===================================================================*/
	/*	CONVERT LINKS
	/*===================================================================*/ 
	public function link_replace($text) 
	{
		//LINKS
		$string = preg_replace_callback(
			"/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/",
			array(&$this, 'tucson_change_text_links'),
			$text
		);
	
		//USERNAMES
		$string = preg_replace_callback(
			'/@([A-Za-z0-9_]{1,15})/', 
			array(&$this, 'tucson_change_username_link'), 
			$string
		);
	
		return $string;
	} //END link_replace
	
} // END CLASS

/**
 * Widget Settings Admin Page Output.
 * This section adds a "Twitter Settings" to the Settings dashboard link.
 *  
 *   
 * @package WordPress
 * @subpackage tucson Tweets
 * @author tommusrhodus
 * @since tucson Tweets 2.0
 */
 
/*===================================================================*/
/*	CREATE ADMIN LINK
/*===================================================================*/ 
function tucson_tweets_options_page_settings() 
{
	add_options_page(
		__('Twitter Settings', 'tucson'), __('Tucson: Tweets', 'tucson'), 'manage_options', 'tucson-tweets-plugin-settings', 'tucson_tweets_admin_page'
	);
} //END tucson_tweets_settings

add_action( 'admin_menu', 'tucson_tweets_options_page_settings' );

/*===================================================================*/
/*	REGISTER SETTINGS
/*===================================================================*/  
add_action('admin_init', 'tucson_tw_register_settings');

function tucson_tweets_settings() 
{
	$tucson_tw = array();
	$tucson_tw[] = array('label' => 'Consumer Key:', 'name' => 'tucson_tw_consumer_key');
	$tucson_tw[] = array('label' => 'Consumer Secret:', 'name' => 'tucson_tw_consumer_secret');
	$tucson_tw[] = array('label' => 'Account Access Token:', 'name' => 'tucson_tw_access_token');
	$tucson_tw[] = array('label' => 'Account Access Token Secret:', 'name' => 'tucson_tw_access_token_secret');

	return $tucson_tw;
} //END tucson_tweets_settings

function tucson_tw_register_settings() 
{
	$settings = tucson_tweets_settings();
	foreach($settings as $setting) {
		register_setting('tucson_tweets_settings', $setting['name']);
	}
} //END tucson_tw_register_settings

/*===================================================================*/
/*	CREATE THE SETTINGS PAGE
/*===================================================================*/  
function tucson_tweets_admin_page() 
{
	if( !current_user_can('manage_options') ) { wp_die( __('Insufficient permissions', 'tucson') ); }

	$settings = tucson_tweets_settings();
	
	$license = get_option( 'edd_tucsontweets_license_key' );
	$status = get_option( 'edd_tucsontweets_license_status' );

	echo '<div class="wrap">';
	 	screen_icon();
		echo '<h2>Tucson: Tweets</h2>';
		echo '<div class="wrap">'; 
		echo '<p>' . __('Display your most recent tweets throughout your theme with the tucson Tweets widget. In order to do this, you must first create a Twitter application and insert the required codes below. Then, simply add the tucson Tweets widget to a widget area within your Widgets Dashboard. If you need additional help, we wrote a detailed <strong><a href="http://themebeans.com/how-to-create-access-tokens-for-twitter-api-1-1/" target="_blank">OAuth Guide</a></strong> to help you along. Cheers!', 'tucson' ) . '</p></br>';

			echo '<form method="post" action="options.php">';
				
				
				
				echo '<h4 style="font-size: 15px; font-weight: 600; color: #222; margin-bottom: 10px;">' . __('How To', 'tucson' ) . '</h4>';
				echo '<ol>';
					echo '<li><a href="https://dev.twitter.com/apps/new" target="_blank">' . __( 'Create a Twitter application', 'tucson' ) . '</a></li>';
					echo '<li>' . __( 'Fill in all fields on the create application page.', 'tucson' ) . '</li>';
					echo '<li>' . __( 'Agree to rules, fill out captcha, and submit your application.', 'tucson' ) . '</li>';
					echo '<li>' . __( 'Click the "Create my Access Tokens" button.', 'tucson' ) . '</li>';
					echo '<li>' . __( 'Upon refresh, copy the Consumer Key, Consumer Secret, Access Token & Access Token Secret codes.', 'tucson' ) . '</li>';
					echo '<li>' . __( "Paste each code into their respective fields below." ) . '</li>';
					echo '<li>' . __( "Click the 'Save Changes' button below." ) . '</li>';
					echo '<li>' . __( "Add the 'tucson Tweets' widget to a widget area in your <a href='widgets.php'>Widgets Dashboard</a>." ) . '</li>';
				echo '</ol></br>';
	
				settings_fields('tucson_tweets_settings');
				
				echo '<h4 style="font-size: 15px; font-weight: 600; color: #222; margin-bottom: 7px;">' . __('OAuth Codes', 'tucson' ) . '</h4>';
				
				echo '<table>';
					foreach($settings as $setting) {
						echo '<tr>';
							echo '<td style="padding-right: 20px;">' . $setting['label'] . '</td>';
							echo '<td><input type="text" style="width:500px;" name="'.$setting['name'].'" value="'.get_option($setting['name']).'" /></td>';
						echo '</tr>';
					}
				echo '</table>';
	
				submit_button();
	
			echo '</form>';
		echo '</div>';
	echo '</div>';
}
/*-----------------------------------------------------------------------------------*/
/*	END TWITTER WIDGET
/*-----------------------------------------------------------------------------------*/