<?php get_header(); ?>

<div class="container py-10">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div class="w-full lg:w-10/12 xl:w-8/12 mx-auto" itemscope itemtype="http://schema.org/Article">
    <!-- BREADCRUMBS -->
    <div class="breadcrumbs text-sm text-gray-800 dark:text-gray-200 mb-6" itemprop="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
      <ul class="flex items-center flex-wrap -mr-4">
        <li itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem' class="breadcrumbs_item px-4 pl-8">
          <a itemprop="item" href="<?php echo home_url(); ?>" class="text-blue-500">
            <span itemprop="name"><?php _e( 'Главная', 'treba-wp' ); ?></span>
          </a>                        
          <meta itemprop="position" content="1">
        </li>
        <li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem' class="breadcrumbs_item px-4">
          <a itemprop="item" href="<?php echo get_page_url('page-blog'); ?>" class="text-blue-500">
            <span itemprop="name"><?php _e( 'Блог', 'treba-wp' ); ?></span>
          </a>                        
          <meta itemprop="position" content="2">
        </li>
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumbs_item text-gray-600 px-4">
          <span itemprop="name"><?php the_title(); ?></span>
          <meta itemprop="position" content="3" />
        </li>
      </ul>
    </div>
    <!-- TITLE -->
    <h1 class="text-2xl lg:text-3xl font-semibold mb-4" itemprop="headline"><?php the_title(); ?></h1>  
    <!-- AUTHOR -->
    <div class="mb-4">
      <span class="font-semibold"><?php _e("Автор", "treba-wp"); ?></span>: 
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
    <!-- CATEGORY -->
    <div class="mb-4">
      <span class="font-semibold">Рубрика</span>: 
      <?php
      $post_categories = get_the_terms( get_the_ID(), 'category' );
      foreach (array_slice($post_categories,0,1) as $post_category){ ?>
        <a href="<?php echo get_term_link($post_category->term_id, 'category') ?>" class="text-blue-500 border-b-2 border-blue-500 hover:border-transparent"><?php echo $post_category->name; ?></a>
      <?php } ?>
    </div>
    <!-- DATE -->
    <div class="flex items-center mb-4">
      <div class="mr-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>
      <div class="text-gray-600 text-sm"><?php echo get_the_modified_time('d.m.Y') ?>;</div>
    </div>
    <!-- IMG -->
    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="w-full h-full xl:h-full object-cover rounded-xl bg-white shadow-xl border p-6 mb-6" itemprop="image">
    <!-- CONTENT -->
    <div class="content mb-8" itemprop="articleBody">
      <div class="single-subjects mb-5">
        <div class="inline-block bg-theme-dark text-2xl text-gray-200 uppercase rounded-lg -rotate-2 px-4 py-2 mb-4"><?php _e("Содержание", "treba-wp"); ?></div>
        <div class="single-subjects-inner"></div>
      </div>
      <?php the_content(); ?>
    </div>
    <!-- COMMENTS --> 
    <div class="flex justify-center mb-4">
      <div class="inline-block bg-blue-500 text-2xl text-gray-200 uppercase rounded-lg -rotate-2 px-4 py-2"><?php _e("Комментарии", "treba-wp"); ?></div>
    </div>
    <div class="content mb-10">
      <?php comments_template(); ?>
    </div>
  </div>
  <?php endwhile; endif; wp_reset_postdata(); ?>

  <div class="flex justify-center mb-6">
    <div class="inline-block bg-theme-dark text-2xl text-gray-200 uppercase rounded-lg -rotate-2 px-4 py-2 "><?php _e("Похожие записи", "treba-wp"); ?></div>
  </div>
  <div class="flex flex-wrap lg:-mx-6 mb-6">
    <?php 
      $current_id = get_the_ID();
      $similar_posts = new WP_Query( array( 
        'post_type' => 'post', 
        'posts_per_page' => 3,
        'order' => 'DESC',
        'post__not_in' => array($current_id),
      ) );
      if ($similar_posts->have_posts()) : while ($similar_posts->have_posts()) : $similar_posts->the_post(); 
    ?>
      <div class="w-full lg:w-1/3 lg:px-6 mb-6">
        <?php get_template_part('template-parts/post-item'); ?>
      </div>
    <?php endwhile; endif; wp_reset_postdata(); ?>
  </div>
</div>

<?php get_footer(); ?>