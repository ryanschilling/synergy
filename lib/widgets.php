<?php
/**
 * Register sidebars and widgets
 */
function roots_widgets_init() {
  // Sidebars
  register_sidebar(array(
    'name'          => __('Sidebar Widget Area', 'roots'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));

  register_sidebar(array(
    'name'          => __('Footer Widget Area', 'roots'),
    'id'            => 'sidebar-widgets',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));

  register_sidebar(array(
    'name'          => __('Landing Page Widget Area', 'roots'),
    'id'            => 'landing-widgets',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));

  // Widgets
  register_widget('Customer_Review_Widget');
  register_widget('Subscribe_Form_Widget');
}
add_action('widgets_init', 'roots_widgets_init');


/**
 * Customer Review Widget
 */
class Customer_Review_Widget extends WP_Widget {
  private $fields = array(
    'title'          => 'Title',
    'google'         => 'Google+',
    'facebook'       => 'Facebook',
    'twitter'        => 'Twitter',
    'linkedin'       => 'LinkedIn',
    'website'        => 'Website'
  );

  function __construct() {
    $widget_ops = array('classname' => 'widget_customer_review', 'description' => __('Use this widget to show a customer review', 'roots'));

    $this->WP_Widget('widget_customer_review', __('Customer Review', 'roots'), $widget_ops);
    $this->alt_option_name = 'widget_customer_review';

    add_action('save_post', array(&$this, 'flush_widget_cache'));
    add_action('deleted_post', array(&$this, 'flush_widget_cache'));
    add_action('switch_theme', array(&$this, 'flush_widget_cache'));
  }

  function widget($args, $instance) {
    $cache = wp_cache_get('widget_customer_review', 'widget');

    if (!is_array($cache)) {
      $cache = array();
    }

    if (!isset($args['widget_id'])) {
      $args['widget_id'] = null;
    }

    if (isset($cache[$args['widget_id']])) {
      echo $cache[$args['widget_id']];
      return;
    }

    ob_start();
    extract($args, EXTR_SKIP);

    $title = apply_filters('widget_title', empty($instance['title']) ? __('Customer Review', 'roots') : $instance['title'], $instance, $this->id_base);

    foreach($this->fields as $name => $label) {
      if (!isset($instance[$name])) { $instance[$name] = ''; }
    }

    echo $before_widget;

    if ($title) {
      echo $before_title, $title, $after_title;
    }

    query_posts( 'post_type=review&posts_per_page=3' );
    if (have_posts()) :
      while (have_posts()) :
        the_post();
        echo '<blockquote class="review">';
        switch(get_field('review_type'))
        {
          case 'facebook':
            echo '<a href="'.$instance['facebook'].'" target="_blank" class="type"><i class="fa fa-fw fa-facebook"></i> /SynergyTelecom</a>';
            break;
          case 'linkedin':
            echo '<a href="'.$instance['linkedin'].'" target="_blank" class="type"><i class="fa fa-fw fa-linkedin"></i> Synergy Telecom, Inc.</a>';
            break;
          case 'google':
            echo '<a href="'.$instance['google'].'" target="_blank" class="type"><i class="fa fa-fw fa-google-plus-square"></i> Google+</a>';
            break;
          case 'twitter':
            echo '<a href="'.$instance['twitter'].'" target="_blank" class="type"><i class="fa fa-fw fa-twitter"></i> @SynergyTelecom</a>';
            break;
          case 'website':
          case 'other':
          default:
            echo '<a href="'.$instance['website'].'" target="_blank" class="type"><i class="fa fa-fw fa-globe"></i> SynergyTele.com</a>';
            break;
        }
        echo '<q>';
        echo substr(trim(get_the_excerpt(),' "“”.'), 0, 166) . '...';
        echo '</q>';
        echo '<footer>';
        if(get_field('review_source')):
          echo '<a target="_blank" href="'.get_field('review_source').'">';
        endif;
        echo get_field('review_author');
        if(get_field('review_company')):
          echo ' (<em>' . get_field('review_company') .'</em>)';
        endif;
        if(get_field('review_source')):
          echo '</a>';
        endif;
        echo '</footer>';
        echo '</blockquote>';
      endwhile;
    endif;
    rewind_posts();
    
    echo $after_widget;

    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_customer_review', $cache, 'widget');
  }

  function update($new_instance, $old_instance) {
    $instance = array_map('strip_tags', $new_instance);

    $this->flush_widget_cache();

    $alloptions = wp_cache_get('alloptions', 'options');

    if (isset($alloptions['widget_customer_review'])) {
      delete_option('widget_customer_review');
    }

    return $instance;
  }

  function flush_widget_cache() {
    wp_cache_delete('widget_customer_review', 'widget');
  }

  function form($instance) {
    foreach($this->fields as $name => $label) {
      ${$name} = isset($instance[$name]) ? esc_attr($instance[$name]) : '';
    ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id($name)); ?>"><?php _e("{$label}:", 'roots'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id($name)); ?>" name="<?php echo esc_attr($this->get_field_name($name)); ?>" type="text" value="<?php echo ${$name}; ?>">
    </p>
    <?php
    }
  }
}


/**
 * Subscribe Form Widget
 */
class Subscribe_Form_Widget extends WP_Widget {
  private $fields = array(
    'title'          => 'Title',
    'description'    => 'Description',
  );

  function __construct() {
    $widget_ops = array('classname' => 'widget_subscribe_form', 'description' => __('Use this widget to show a subscription form', 'roots'));

    $this->WP_Widget('widget_subscribe_form', __('Subscribe Form', 'roots'), $widget_ops);
    $this->alt_option_name = 'widget_subscribe_form';

    add_action('save_post', array(&$this, 'flush_widget_cache'));
    add_action('deleted_post', array(&$this, 'flush_widget_cache'));
    add_action('switch_theme', array(&$this, 'flush_widget_cache'));
  }

  function widget($args, $instance) {
    $cache = wp_cache_get('widget_subscribe_form', 'widget');

    if (!is_array($cache)) {
      $cache = array();
    }

    if (!isset($args['widget_id'])) {
      $args['widget_id'] = null;
    }

    if (isset($cache[$args['widget_id']])) {
      echo $cache[$args['widget_id']];
      return;
    }

    ob_start();
    extract($args, EXTR_SKIP);

    $title = apply_filters('widget_title', empty($instance['title']) ? __('Subscribe Form', 'roots') : $instance['title'], $instance, $this->id_base);

    foreach($this->fields as $name => $label) {
      if (!isset($instance[$name])) { $instance[$name] = ''; }
    }

    echo $before_widget;

    if ($title) {
      echo $before_title, $title, $after_title;
    }
    
    echo "<p>". $instance['description'] ."</p>";
    ?>
    <form class="form-inline" role="form">
        <div class="form-group">
          <i class="fa fa-4x fa-inbox"></i>
        </div>
        <div class="form-group">
          <label class="sr-only" for="subscribeFormName">Your name</label>
          <input type="name" name="name" class="form-control" style="width: 150px;margin-left:10px;" id="subscribeFormName" placeholder="Your name">
        </div>
        <div class="form-group">
          <label class="sr-only" for="subscribeFormEmail">Email address</label>
          <input type="email" name="email" class="form-control" style="width: 150px;margin-left:10px;" id="subscribeFormEmail" placeholder="Email address">
        </div>
        <button type="submit" class="btn btn-primary" style="margin-left: 10px;"><span class="visible-xs">Sign Up <i class="fa fa-fw fa-chevron-right"></i></span><i class="fa fa-fw fa-chevron-right hidden-xs"></i></button>
      </div>
    </form>
    <?php
    echo $after_widget;

    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_subscribe_form', $cache, 'widget');
  }

  function update($new_instance, $old_instance) {
    $instance = $new_instance;
    $instance['title'] = strip_tags($instance['title']);
    $this->flush_widget_cache();

    $alloptions = wp_cache_get('alloptions', 'options');

    if (isset($alloptions['widget_subscribe_form'])) {
      delete_option('widget_subscribe_form');
    }

    return $instance;
  }

  function flush_widget_cache() {
    wp_cache_delete('widget_subscribe_form', 'widget');
  }

  function form($instance) {
    foreach($this->fields as $name => $label) {
      ${$name} = isset($instance[$name]) ? esc_attr($instance[$name]) : '';
    ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id($name)); ?>"><?php _e("{$label}:", 'roots'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id($name)); ?>" name="<?php echo esc_attr($this->get_field_name($name)); ?>" type="text" value="<?php echo ${$name}; ?>">
    </p>
    <?php
    }
  }
}