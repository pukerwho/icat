<div class="bg-theme-dark text-gray-200 rounded-t-lg px-2 py-4">
  <div class="text-xl text-center font-semibold"><?php _e("Популярные записи", "treba-wp"); ?></div>
</div>
<div class="bg-gray-100 rounded-b-lg px-4 py-4 mb-6">
  <?php 
  $new_posts = new WP_Query( array( 
    'post_type' => 'post', 
    'posts_per_page' => 10,
    'orderby' => 'rand',
    'tax_query' => array(
      array(
        'taxonomy'  => 'category',
        'field'     => 'term_id',
        'terms'     => array( 79, 4, 1, 82 ),
      )
    ),
  ) );
  if ($new_posts->have_posts()) : while ($new_posts->have_posts()) : $new_posts->the_post(); 
  ?>
  <div class="relative flex items-center border-b border-gray-300 pb-4 mb-4 last-of-type:pb-0 last-of-type:border-none">
    <a href="<?php the_permalink(); ?>" class="w-full h-full absolute top-0 left-0 z-1"></a>
    <div class="w-1/3"><img  src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title(); ?>" class="object-cover aspect-video"></div>
    <div class="w-2/3"><div class="font-medium ml-4"><?php the_title(); ?></div></div>
  </div>
  <?php endwhile; endif; wp_reset_postdata(); ?>
</div>

<div class="bg-theme-dark text-gray-200 rounded-t-lg px-2 py-4">
  <div class="text-xl text-center font-semibold"><?php _e("Сейчас читают", "treba-wp"); ?></div>
</div>
<div class="bg-gray-100 rounded-b-lg px-4 py-4 mb-6">
  <div class="flex flex-wrap lg:-mx-2">
    <?php 
    $now_posts = new WP_Query( array( 
      'post_type' => 'post', 
      'posts_per_page' => 10,
      'orderby' => 'rand',
      'tax_query' => array(
        array(
          'taxonomy'  => 'category',
          'field'     => 'term_id',
          'terms'     => array( 79, 4, 1, 82 ),
        )
      ),
    ) );
    if ($now_posts->have_posts()) : while ($now_posts->have_posts()) : $now_posts->the_post(); 
    ?>
    <div class="w-full lg:w-1/2 relative border-b border-gray-300 pb-4 mb-4 px-2 last-of-type:pb-0 last-of-type:border-none">
      <a href="<?php the_permalink(); ?>" class="w-full h-full absolute top-0 left-0 z-1"></a>
      <div class="mb-4">
        <img  src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title(); ?>" class="w-full h-full object-cover aspect-video">
      </div>
      <div class="font-medium text-sm text-center">
        <?php the_title(); ?>
      </div>
    </div>
    <?php endwhile; endif; wp_reset_postdata(); ?>
  </div>
</div>

<div class="bg-theme-dark text-gray-200 rounded-t-lg px-2 py-4">
  <div class="text-xl text-center font-semibold"><?php _e("Категории", "treba-wp"); ?></div>
</div>
<div class="bg-gray-100 rounded-b-lg px-4 py-4 mb-6">
  <?php $categories = get_terms( array( 
    'taxonomy' => 'board',
    'parent' => 0, 
  ) );
  foreach ($categories as $category){ ?>
    <li class="mb-3"><a href="<?php echo get_term_link($category->term_id, 'board') ?>" class="opacity-75 hover:text-blue-500 font-medium"><?php echo $category->name; ?></a></li>
  <?php } ?>  
</div>

<div class="bg-theme-dark text-gray-200 rounded-t-lg px-2 py-4">
  <div class="text-xl text-center font-semibold"><?php _e("Полезные ссылки", "treba-wp"); ?></div>
</div>
<div class="bg-gray-100 rounded-b-lg px-4 py-4">
  <div class="treba-links">
    <?php if ( is_home() ): ?>
      <a href="https://priazovka.com/" target="_blank">priazovka.com</a>
      <a href="https://s-cast.ua/" target="_blank">s-cast.ua</a>
      <a href="https://treba-solutions.com/" target="_blank">treba-solutions.com</a>
      <a href="https://webgolovolomki.com/" target="_blank">webgolovolomki.com</a>
      <a href="https://tarakan.org.ua/" target="_blank">tarakan.org.ua</a>
      <a href="https://d-art.org.ua/" target="_blank">d-art.org.ua</a>
      <a href="https://sdamkvartiry.com/" target="_blank">sdamkvartiry.com</a>
    <?php else: ?>

      <?php 
        $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $super_links = super_links($current_url);
        // shuffle($super_links);
        foreach ($super_links as $super_link):
      ?>
        <?php echo $super_link->top_links; ?>
      <?php endforeach; ?>

      <?php 
        // do_shortcode('[render-treba-links]'); 
        // echo do_shortcode('[render-treba-top-links]');
      ?>
    <?php endif; ?>
  </div>
</div>

