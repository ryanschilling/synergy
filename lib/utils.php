<?php
/**
 * Utility functions
 */
function add_filters($tags, $function) {
  foreach($tags as $tag) {
    add_filter($tag, $function);
  }
}

function is_element_empty($element) {
  $element = trim($element);
  return empty($element) ? false : true;
}

function get_menu_block($id, $template='menu-block') {
  global $item;
  $item = get_post($id);
  if(!empty($item)):
    get_template_part('templates/partial', $template);
  endif;
}

function is_tree( $pid ) {      // $pid = The ID of the page we're looking for pages underneath
    global $post;               // load details about this page

    if ( is_page($pid) )
        return true;            // we're at the page or at a sub page

    $anc = get_post_ancestors( $post->ID );
    foreach ( $anc as $ancestor ) {
        if( is_page() && $ancestor == $pid ) {
            return true;
        }
    }

    return false;  // we arn't at the page, and the page is not an ancestor
}

function get_the_section(){
  global $post;
  $section = '';

  // About section
  if(
    is_page(array(115, 386, 389))
  ){
    $section = 'about';

  // Solutions section
  }elseif(
    is_page(2) ||
    is_tree(2) ||
    is_singular(array(
      'case-study'
      )
    ) ||
    is_post_type_archive(array(
      'case-study',
      )
    ) ||
    is_tax(array(
      'case-study-industry',
      )
    )
  ){
    $section = 'solutions';

  // Products section
  }elseif(
    is_page(88) ||
    is_singular(array(
      'review',
      'product'
      )
    ) ||
    is_post_type_archive(array(
      'product',
      'review'
      )
    ) ||
    is_tax(array(
      'product-type',
      'product-manufacturer',
      'product-feature'
      )
    )
  ){
    $section = 'products';

  // Partners section
  }elseif(
    is_tree(95) ||
    is_page(883)
  ){
    $section = 'partners';

  // Support section
  }elseif(
    is_tree(105) ||
    is_singular(array(
      'faq',
      'training-video'
      )
    ) ||
    is_post_type_archive(array(
      'faq',
      'training-video'
      )
    ) ||
    is_tax(array(
      'faq-section',
      'faq-topic',
      'training-video-series'
      )
    )
  ){
    $section = 'support';
  }

  return $section;
}