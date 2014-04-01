<?php
/**
 * Page titles
 */
function roots_title() {
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      return get_the_title(get_option('page_for_posts', true));
    } else {
      return __('Latest Posts', 'roots');
    }
  } elseif (is_archive()) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    if ($term) {
      return apply_filters('single_term_title', $term->name);
    } elseif (is_post_type_archive()) {
      return apply_filters('the_title', get_queried_object()->labels->name);
    } elseif (is_day()) {
      return sprintf(__('Blog Archives: %s', 'roots'), get_the_date());
    } elseif (is_month()) {
      return sprintf(__('Blog Archives: %s', 'roots'), get_the_date('F Y'));
    } elseif (is_year()) {
      return sprintf(__('Blog Archives: %s', 'roots'), get_the_date('Y'));
    } elseif (is_author()) {
      $author = get_queried_object();
      return sprintf(__('%s\'s Blogs', 'roots'), $author->display_name);
    } else {
      return single_cat_title('', false);
    }
  } elseif (is_search()) {
    $query = trim(get_search_query(), ' +');
    return (!empty($query)) ? sprintf(__('Search Results for %s', 'roots'), $query) : __('Search Results', 'roots');
  } elseif (is_404()) {
    return __('Not Found', 'roots');
  } elseif (is_singular('faq')) {
    return 'FAQ: '.get_the_title();
  } else {
    return get_the_title();
  }
}

function roots_subtitle(){

  // Archive
  if(is_archive())
  {
    $subtitle = is_author() ? '<p>'.get_the_author_meta('description').'</p>' : term_description();
    return $subtitle;
  }

  // Page/Post
  if((is_page() || is_singular(array('post', 'product', 'case-study', 'training-video'))) && get_field('page_subtitle')):
    return '<p>'.html_entity_decode(get_field('page_subtitle')).'</p>';
  endif;

}