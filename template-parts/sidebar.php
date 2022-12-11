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
    <?php do_shortcode('[render-treba-links]'); ?>
    <?php echo do_shortcode('[render-treba-top-links]'); ?>
    <?php if ( is_home() ): ?>
      <a href="https://priazovka.com/">priazovka</a>
    <?php endif; ?>
  </div>
</div>

