<?php get_header(); ?>

<div class="welcome bg-theme-dark pt-16 pb-48">
  <div class="container">
    <h1 class="text-4xl text-gray-200 font-semibold text-center mb-10"><span class="text-blue-500">i</span>Catalog - тут есть все!</h1>
    <div class="text-center">
      <div class="text-xl text-gray-200 font-light mb-10">На этом сайте найдеться <span class="theme-brush text-yellow-300">любая информация</span>, которая будет вам полезна.</div>
      <div class="text-lg text-gray-400">
        💥 Также, не забывайте про наш <a href="#" class="text-blue-500 hover:text-yellow-300 border-b-2 border-blue-500 hover:border-yellow-300">каталог товаров</a>.
      </div>
    </div>
  </div>
</div>

<div class="container mb-10">
  <div class="-mt-32 mb-10">
    <?php 
      $top_post = new WP_Query( array( 
        'post_type' => 'post', 
        'posts_per_page' => 1,
        'order' => 'DESC'
      ) );
      if ($top_post->have_posts()) : while ($top_post->have_posts()) : $top_post->the_post(); 
    ?>
      <div class="bg-white rounded-lg p-6">
        <div class="flex flew-wrap items-center flex-col lg:flex-row lg:-mx-4">
          <div class="w-full lg:w-3/5 lg:px-4">
            <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="w-full lg:h-[350px] object-cover object-top mb-6 lg:mb-0">
          </div>
          <div class="w-full lg:w-2/5 lg:px-4">
            <div class="text-sm text-gray-500 opacity-75 mb-4">
              <?php echo get_the_modified_time('d.m.Y') ?>
            </div>
            <div class="text-xl font-bold mb-4">
              <a href="<?php the_permalink(); ?>" class="hover:text-blue-500"><?php the_title(); ?></a>
            </div>
            <div class="text-sm text-gray-500 mb-2">
              <?php 
                $content_text = wp_strip_all_tags( get_the_content() );
                echo mb_strimwidth($content_text, 0, 200, '...');
              ?>
            </div>
            <div class="mb-6">
              <a href="<?php the_permalink(); ?>" class="text-blue-500 border-b-2 border-blue-500 hover:border-transparent"><?php _e("Читать дальше", "treba-wp"); ?></a>
            </div>
            <div class="text-sm text-gray-700 italic opacity-75">
              <div class="mb-2">
                <span class="font-semibold">Автор</span>: 
                <?php if (carbon_get_the_post_meta('crb_post_author')): ?>
                  <span class="italic"><?php echo carbon_get_the_post_meta('crb_post_author'); ?></span>
                  <div class="flex items-center text-sm">
                    <!-- instagram -->
                    <?php if (carbon_get_the_post_meta('crb_post_author_instagram')): ?>
                      <div class="italic pb-2 pr-3"><a href="<?php echo carbon_get_the_post_meta('crb_post_author_instagram'); ?>" class="text-indigo-500">Instagram</a></div>
                    <?php endif; ?>
                    <!-- facebook --> 
                    <?php if (carbon_get_the_post_meta('crb_post_author_facebook')): ?>
                      <div class="italic pb-2"><a href="<?php echo carbon_get_the_post_meta('crb_post_author_facebook'); ?>" class="text-indigo-500">Facebook</a></div>
                    <?php endif; ?>
                  </div>

                <?php else: ?>
                  <?php echo get_the_author(); ?>
                <?php endif; ?>
              </div>
              <div class="mb-2">
                <span class="font-semibold">Рубрика</span>: 
                <?php
                $post_categories = get_the_terms( get_the_ID(), 'category' );
                foreach ($post_categories as $post_category){ ?>
                  <a href="<?php echo get_term_link($post_category->term_id, 'category') ?>" class="text-blue-500 border-b-2 border-blue-500   hover:border-transparent"><?php echo $post_category->name; ?></a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; endif; wp_reset_postdata(); ?>
  </div>
  <div class="mb-20">
    <div class="flex justify-center">
      <h2 class="inline-block bg-theme-dark text-2xl text-gray-200 uppercase rounded-lg -rotate-2 px-4 py-2 mb-10"><?php _e("Новые публикации", "treba-wp"); ?></h2>
    </div> 
    <div class="flex flex-wrap lg:-mx-6 mb-6">
      <?php 
        $new_posts = new WP_Query( array( 
          'post_type' => 'post', 
          'posts_per_page' => 9,
          'order' => 'DESC',
          'offset' => 1,
        ) );
        if ($new_posts->have_posts()) : while ($new_posts->have_posts()) : $new_posts->the_post(); 
      ?>
        <div class="w-full lg:w-1/3 lg:px-6 mb-6">
          <?php get_template_part('template-parts/post-item'); ?>
        </div>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>
    <div class="text-center">
      <a href="<?php echo get_page_url('page-blog'); ?>" class="bg-transparent hover:bg-theme-dark border-2 border-theme-dark text-theme-dark hover:text-gray-200 rounded-lg px-6 py-3"><?php _e("Все публикации", "treba-wp"); ?></a>
    </div>
  </div>

  <!-- Объявления -->
  <div class="mb-20">
    <div class="flex flex-wrap lg:-mx-6">
      <div class="w-full lg:w-2/3 lg:px-6">
        <h2 class="inline-block bg-blue-500 text-2xl text-gray-200 uppercase rounded-lg -rotate-2 px-4 py-2 mb-10"><?php _e("ТОП объявления", "treba-wp"); ?></h2>
        <div class="mb-10">
          <?php 
            $top_items = new WP_Query( array( 
              'post_type' => 'items', 
              'posts_per_page' => 10,
              'order' => 'DESC',
            ) );
            if ($top_items->have_posts()) : while ($top_items->have_posts()) : $top_items->the_post(); 
          ?>
            <div class="w-full border-b border-gray-200 last:border-transparent pb-4 mb-4">
              <?php get_template_part('template-parts/item-item'); ?>
            </div>
          <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
        <div class="text-center mb-12 lg:mb-0">
          <a href="<?php echo get_page_url('page-items'); ?>" class="bg-transparent hover:bg-blue-500 border-2 border-blue-500 text-theme-dark hover:text-gray-200 rounded-lg px-6 py-3"><?php _e("Все объявления", "treba-wp"); ?></a>
        </div>
      </div>
      <div class="w-full lg:w-1/3 lg:px-6">
        <?php get_template_part('template-parts/sidebar'); ?>
      </div>
    </div>
  </div>
  <!-- END Объявления -->
</div>

<?php get_footer(); ?>