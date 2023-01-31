<?php
/*
Template Name: All Items
*/
?>
<?php get_header(); ?>

<div class="container py-10">
  <div class="flex flex-wrap lg:-mx-6">
    <div class="w-full lg:w-2/3 lg:px-6">
      <h1 class="inline-block bg-blue-500 text-2xl text-gray-200 uppercase rounded-lg -rotate-2 px-4 py-2 mb-10"><?php _e("Все объявления", "treba-wp"); ?></h1>
      <div class="mb-10">
        <?php 
          $current_page = !empty( $_GET['page'] ) ? $_GET['page'] : 1;
          $all_items = new WP_Query( array( 
            'post_type' => 'items', 
            'posts_per_page' => 20,
            'order' => 'DESC',
            'paged' => $current_page,
          ) );
          if ($all_items->have_posts()) : while ($all_items->have_posts()) : $all_items->the_post(); 
        ?>
          <div class="w-full border-b border-gray-200 last:border-transparent pb-4 mb-4">
            <?php get_template_part('template-parts/item-item'); ?>
          </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>
      </div>
      <div class="b_pagination text-center mb-12">
        <?php 
          $big = 9999999991; // уникальное число
          echo paginate_links( array(
            'format' => '?page=%#%',
            'total' => $all_items->max_num_pages,
            'current' => $current_page,
            'prev_next' => true,
            'next_text' => (''),
            'prev_text' => (''),
          )); 
        ?>
      </div>
    </div>
    <div class="w-full lg:w-1/3 lg:px-6">
      <?php get_template_part('template-parts/sidebar'); ?>
    </div>
  </div>  
</div>

<?php get_footer(); ?>