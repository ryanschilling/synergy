<?php
/**
 * Cleaner walker for wp_nav_menu()
 *
 * Walker_Nav_Menu (WordPress default) example output:
 *   <li id="menu-item-8" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8"><a href="/">Home</a></li>
 *   <li id="menu-item-9" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9"><a href="/sample-page/">Sample Page</a></l
 *
 * Roots_Nav_Walker example output:
 *   <li class="menu-home"><a href="/">Home</a></li>
 *   <li class="menu-sample-page"><a href="/sample-page/">Sample Page</a></li>
 */
class Roots_Nav_Walker extends Walker_Nav_Menu {
  function check_current($classes) {
    return preg_match('/(current[-_])|active|dropdown/', $classes);
  }

  function start_lvl(&$output, $depth = 0, $args = array()) {
    $output .= "\n<ul class=\"dropdown-menu\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $item_html = '';
    parent::start_el($item_html, $item, $depth, $args);

    if ($item->is_dropdown && ($depth === 0)) {
      $item_html = str_replace('<a', '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#"', $item_html);
      $item_html = str_replace('</a>', ' <b class="caret"></b></a>', $item_html);
    }
    elseif (stristr($item_html, 'li class="divider')) {
      $item_html = preg_replace('/<a[^>]*>.*?<\/a>/iU', '', $item_html);
    }
    elseif (stristr($item_html, 'li class="dropdown-header')) {
      $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
    }

    $item_html = apply_filters('roots_wp_nav_menu_item', $item_html);
    $output .= $item_html;
  }

  function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
    $element->is_dropdown = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));

    if ($element->is_dropdown) {
      $element->classes[] = 'dropdown';
    }

    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }
}

/**
 * Remove the id="" on nav menu items
 * Return 'menu-slug' for nav menu classes
 */
function roots_nav_menu_css_class($classes, $item) {
  $slug = sanitize_title($item->title);
  $new_classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes);
  $new_classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $new_classes);

  $new_classes[] = 'menu-' . $slug;
  $new_class_counts = array_count_values($new_classes);
  $new_classes = array_unique($new_classes);
  if($new_class_counts['active'] < 2 && array_search('current-menu-item', $classes) === false)
  {
    unset($new_classes[array_search('active', $new_classes)]);
  }
  return array_filter($new_classes, 'is_element_empty');
}
add_filter('nav_menu_css_class', 'roots_nav_menu_css_class', 10, 2);
add_filter('nav_menu_item_id', '__return_null');

/**
 * Clean up wp_nav_menu_args
 *
 * Remove the container
 * Use Roots_Nav_Walker() by default
 */
function roots_nav_menu_args($args = '') {
  $roots_nav_menu_args['container'] = false;

  if (!$args['items_wrap']) {
    $roots_nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
  }

  if (current_theme_supports('bootstrap-top-navbar') && !$args['depth']) {
    $roots_nav_menu_args['depth'] = 2;
  }

  if (!$args['walker']) {
    $roots_nav_menu_args['walker'] = new Roots_Nav_Walker();
  }

  return array_merge($args, $roots_nav_menu_args);
}
add_filter('wp_nav_menu_args', 'roots_nav_menu_args');


/**
 * Generate breadcrumbs
 *
 * http://mkoerner.de/breadcrumbs-for-wordpress-themes-with-bootstrap-3/
 */
function roots_breadcrumbs() {
  if(!is_front_page()) {
    echo '<ol class="breadcrumb">';
    echo '<li><a href="'.get_option('home').'"><i class="fa fa-fw fa-2x fa-home"></i> Home</a></li>';

    $post = get_post();

    // Post
    if (is_single()) {
      switch($post->post_type)
      {
        case 'review':
          echo '<li>';
          echo '<a href="/products">Products</a>';
          echo '</li>';
          echo '<li>';
          echo '<a href="/products/reviews">Reviews</a>';
          echo '</li>';
          break;

        case 'faq':
          $term = wp_get_post_terms($post->ID, array('faq-section', 'faq-topic'));
          echo '<li>';
          echo '<a href="/support">Support</a>';
          echo '</li>';
          echo '<li>';
          echo '<a href="/support/knowledge-base">Knowledge Base</a>';
          echo '</li>';
          if(!empty($term[0]))
          {
            echo '<li>';
            echo '<a href="/support/knowledge-base/section/'.$term[0]->slug.'">'.$term[0]->name.'</a>';
            echo '</li>';
          }
          break;

        case 'training-video':
          $term = wp_get_post_terms($post->ID, 'training-video-series');
          echo '<li>';
          echo '<a href="/support">Support</a>';
          echo '</li>';
          echo '<li>';
          echo '<a href="/support/training-videos">Training Videos</a>';
          echo '</li>';
          if(!empty($term[0]))
          {
            echo '<li>';
            echo '<a href="/support/training-videos/series/'.$term[0]->slug.'">'.$term[0]->name.'</a>';
            echo '</li>';
          }
          break;

        case 'product':
          $term = wp_get_post_terms($post->ID, 'product-type');
          echo '<li>';
          echo '<a href="/products">Products</a>';
          echo '</li>';
          if(!empty($term[0]))
          {
            echo '<li>';
            echo '<a href="/products/types/'.$term[0]->slug.'">'.$term[0]->name.'</a>';
            echo '</li>';
          }
          break;

        case 'case-study':
          echo '<li>';
          echo '<a href="/solutions">Solutions</a>';
          echo '</li>';
          echo '<li>';
          echo '<a href="/solutions/case-studies">Case Studies</a>';
          echo '</li>';
          break;

        case 'post':
          echo '<li>';
          echo '<a href="/blog">Blog</a>';
          echo '</li>';
          echo '<li>';
          the_category(', ');
          echo '</li>';
          break;
      }
      echo '<li>';
      the_title();
      echo '</li>';

    // Categories
    } elseif (is_category()) {
      echo '<li>';
      echo '<a href="/blog">Blog</a>';
      echo '</li>';
      echo '<li>';
      single_cat_title();
      echo '</li>';

    // Page
    } elseif (is_page() && (!is_front_page())) {
      $post = get_post();
      if($post->post_parent){
        $anc = get_post_ancestors( $post->ID );
        foreach ( $anc as $ancestor ) {
            $output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li>';
        }
        echo $output;
      }
      echo '<li>'.get_the_title().'</li>';

    // Tag
    } elseif (is_tag()) {
      echo '<li>';
      echo '<a href="/blog">Blog</a>';
      echo '</li>';
      echo '<li>';
      single_tag_title();
      echo '</li>';

    // Day Archive
    } elseif (is_day()) {
      echo '<li>';
      echo '<a href="/blog">Blog</a>';
      echo '</li>';
      echo'<li>Archive for ';
      the_time('F jS, Y');
      echo'</li>';

    // Month Archive
    } elseif (is_month()) {
      echo '<li>';
      echo '<a href="/blog">Blog</a>';
      echo '</li>';
      echo'<li>Archive for ';
      the_time('F, Y');
      echo'</li>';

    // Year Archive
    } elseif (is_year()) {
      echo'<li>Archive for ';
      the_time('Y');
      echo'</li>';

    // Author Archive
    } elseif (is_author()) {
      echo '<li>';
      echo '<a href="/blog">Blog</a>';
      echo '</li>';
      echo'<li>Author Archives</li>';

    // Knowledge Base Topic Archive
    } elseif (is_tax('faq-topic')) {
      
        $terms = get_terms('faq-topic', array('hide_empty' => false));
        echo '<li>';
        echo '<a href="/support">Support</a>';
        echo '</li>';
        echo '<li>';
        echo '<a href="/support/knowledge-base">Knowledge Base</a>';
        echo '</li>';
        echo '<li>';
        foreach($terms as $term)
        {
          if(is_tax('faq-topic', $term->term_id))
          {
            echo $term->name;
            break;
          }
        }
        echo '</li>';

    // Knowledge Base Section Archive
    } elseif (is_tax('faq-section')) {
      
        $terms = get_terms('faq-section', array('hide_empty' => false));
        echo '<li>';
        echo '<a href="/support">Support</a>';
        echo '</li>';
        echo '<li>';
        echo '<a href="/support/knowledge-base">Knowledge Base</a>';
        echo '</li>';
        echo '<li>';
        foreach($terms as $term)
        {
          if(is_tax('faq-section', $term->term_id))
          {
            echo $term->name;
            break;
          }
        }
        echo '</li>';

    // Knoweldge Base Archive
    } elseif (is_post_type_archive('faq')) {
          
      echo '<li>';
      echo '<a href="/support">Support</a>';
      echo '</li>';
      echo '<li>';
      echo 'Knowledge Base';
      echo '</li>';

    // Training Video Series Archive
    } elseif (is_tax('training-video-series')) {
        
      $terms = get_terms('training-video-series', array('hide_empty' => false));
      echo '<li>';
      echo '<a href="/support">Support</a>';
      echo '</li>';
      echo '<li>';
      echo '<a href="/support/training-videos">Training Videos</a>';
      echo '</li>';
      echo '<li>';
      foreach($terms as $term)
      {
        if(is_tax('training-video-series', $term->term_id))
        {
          echo $term->name;
          break;
        }
      }
      echo '</li>';
    
    // Training Videos Archive
    } elseif (is_post_type_archive('training-video')) {
          
      echo '<li>';
      echo '<a href="/support">Support</a>';
      echo '</li>';
      echo '<li>';
      echo 'Training Videos';
      echo '</li>';

    // Review Archive
    } elseif (is_post_type_archive('review')) {
      
      echo '<li>';
      echo '<a href="/products">Products</a>';
      echo '</li>';
      echo '<li>';
      echo 'Reviews';
      echo '</li>';

    // Product Features Archive
    } elseif (is_tax('product-feature')) {
      
        $terms = get_terms('product-feature', array('hide_empty' => false));
        echo '<li>';
        echo '<a href="/products">Products</a>';
        echo '</li>';
        echo '<li>';
        foreach($terms as $term)
        {
          if(is_tax('product-feature', $term->term_id))
          {
            echo $term->name;
            break;
          }
        }
        echo '</li>';

    // Product Manufacturer Archive
    } elseif (is_tax('product-manufacturer')) {
      
        $terms = get_terms('product-manufacturer', array('hide_empty' => false));
        echo '<li>';
        echo '<a href="/products">Products</a>';
        echo '</li>';
        echo '<li>';
        foreach($terms as $term)
        {
          if(is_tax('product-manufacturer', $term->term_id))
          {
            echo $term->name;
            break;
          }
        }
        echo '</li>';

    // Product Type Archive
    } elseif (is_tax('product-type')) {
        
      $terms = get_terms('product-type', array('hide_empty' => false));
      echo '<li>';
      echo '<a href="/products">Products</a>';
      echo '</li>';
      echo '<li>';
      foreach($terms as $term)
      {
        if(is_tax('product-type', $term->term_id))
        {
          echo $term->name;
          break;
        }
      }
      echo '</li>';

    // Product Archive
    } elseif (is_post_type_archive('product')) {
      
      echo '<li>';
      echo 'Products';
      echo '</li>';

    // Case Studies Archive
    } elseif (is_post_type_archive('case-study')) {
          
      echo '<li>';
      echo '<a href="/solutions">Solutions</a>';
      echo '</li>';
      echo '<li>';
      echo 'Case Studies';
      echo '</li>';

    // Case Studies Archive
    } elseif (is_post_type_archive('case-study')) {
          
      echo '<li>';
      echo '<a href="/solutions">Solutions</a>';
      echo '</li>';
      echo '<li>';
      echo 'Case Studies';
      echo '</li>';

    // Search Results
    } elseif (is_search()) {
      echo'<li>Search Results</li>';
    
    // Blog Archive
    } else{
      echo '<li>Blog</li>';
    }

    echo '</ol>';
  }
}