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
    <div class="flex flex-wrap lg:-mx-6">
      <div class="w-full lg:w-2/3 lg:px-6 mb-6 lg:mb-0">
        <div class="flex justify-center">
          <h2 class="inline-block bg-theme-dark text-2xl text-gray-200 uppercase rounded-lg -rotate-2 px-4 py-2 mb-10"><?php _e("Новые публикации", "treba-wp"); ?></h2>
        </div> 
        <div class="flex flex-wrap lg:-mx-6 mb-6">
          <?php 
            $new_posts = new WP_Query( array( 
              'post_type' => 'post', 
              'posts_per_page' => 8,
              'order' => 'DESC',
              'offset' => 1,
            ) );
            if ($new_posts->have_posts()) : while ($new_posts->have_posts()) : $new_posts->the_post(); 
          ?>
            <div class="w-full lg:w-1/2 lg:px-6 mb-6">
              <?php get_template_part('template-parts/post-item'); ?>
            </div>
          <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
        <div class="text-center">
          <a href="<?php echo get_page_url('page-blog'); ?>" class="bg-transparent hover:bg-theme-dark border-2 border-theme-dark text-theme-dark hover:text-gray-200 rounded-lg px-6 py-3"><?php _e("Все публикации", "treba-wp"); ?></a>
        </div>
      </div>
      <div class="w-full lg:w-1/3 lg:px-6">
        <div class="sticky top-5">
          <div class="bg-theme-dark text-gray-200 rounded-t-lg px-2 py-4">
            <div class="text-xl text-center font-semibold"><?php _e("ТОП записи", "treba-wp"); ?></div>
          </div>
          <div class="bg-gray-100 rounded-b-lg px-4 py-4 mb-6">
            <ul>
              <li class="mb-3"><a href="https://icatalog.pro/kak-sdelat-gamburger-menyu-gotovyj-kod-i-podrobnoe-obyasnenie/" class="opacity-75 hover:text-blue-500 font-medium">Как сделать гамбургер меню</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/change-color-in-svg/" class="opacity-75 hover:text-blue-500 font-medium">Как изменить цвет SVG в CSS</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/poyavlenie-elementov-pri-skrolle/" class="opacity-75 hover:text-blue-500 font-medium">Появление элементов при скролле</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/kak-pozhalovatsya-na-telegram-kanal-podrobnaya-instrukciya/" class="opacity-75 hover:text-blue-500 font-medium">Как пожаловаться на Telegram канал</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/nick-v-telegram/" class="opacity-75 hover:text-blue-500 font-medium">Ник в Telegram</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/kak-vyrovnyat-kartinku-po-czentru-s-pomoshhyu-css/" class="opacity-75 hover:text-blue-500 font-medium">Как выровнять картинку по центру с помощью CSS</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/kak-sdelat-plavnoe-uvelichenie-kartinki-pri-navedenii-effekt-na-chistom-css/" class="opacity-75 hover:text-blue-500 font-medium">Как сделать плавное увеличение картинки при наведении</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/kak-sdelat-effekt-nazhatiya-knopki-na-css/" class="opacity-75 hover:text-blue-500 font-medium">Как сделать эффект нажатия кнопки на CSS</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/how-to-add-a-css-class-on-scrol/" class="opacity-75 hover:text-blue-500 font-medium"></a></li>
              <li class="mb-3"><a href="https://icatalog.pro/shcho-robyty-yakshcho-zablokuvaly-instahram/" class="opacity-75 hover:text-blue-500 font-medium">Заблокували Instagram: що робити</a></li>
            </ul>
          </div>

          <div class="bg-theme-dark text-gray-200 rounded-t-lg px-2 py-4">
            <div class="text-xl text-center font-semibold"><?php _e("Сейчас читают", "treba-wp"); ?></div>
          </div>
          <div class="bg-gray-100 rounded-b-lg px-4 py-4 mb-6">
            <ul>
              <li class="mb-3"><a href="https://icatalog.pro/7403-jak-pidpisati-podrugu-v-telefoni/" class="opacity-75 hover:text-blue-500 font-medium">Як підписати подругу в телефоні?</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/how-black-in-image/" class="opacity-75 hover:text-blue-500 font-medium">Как сделать затемнение фона (картинки) на CSS</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/kak-ochistit-kesh-v-telegram/" class="opacity-75 hover:text-blue-500 font-medium">Как очистить кэш в Telegram</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/kak-izmenit-czvet-knopki-polnaya-instrukcziya-dlya-novichkov/" class="opacity-75 hover:text-blue-500 font-medium">Как изменить цвет кнопки</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/najpopulyarnishi-polski-imena/" class="opacity-75 hover:text-blue-500 font-medium">Найпопулярніші польські імена</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/add-js-in-html/" class="opacity-75 hover:text-blue-500 font-medium">Правильно подключаем Javascript в HTML</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/samaya-vkusnaya-shaurma-v-kieve/" class="opacity-75 hover:text-blue-500 font-medium">Где в Киеве самая вкусная шаурма</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/seo-optimizacziya-sajta-na-tilde-polnoe-rukovodstvo/" class="opacity-75 hover:text-blue-500 font-medium">Seo-оптимизация сайта на Тильде</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/rokiv-vesillia-pryvitannia-vitannia-do-ahatovoho-vesillia/" class="opacity-75 hover:text-blue-500 font-medium">14 років весілля привітання</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/perenos-sajta-na-tilde-na-svoj-hosting-poshagovoe-rukovodstvo/" class="opacity-75 hover:text-blue-500 font-medium">Перенос сайта на Тильде на свой хостинг</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/kak-zagruzit-golosovoe-soobshchenie-v-telegram/" class="opacity-75 hover:text-blue-500 font-medium">Как скачать голосовое сообщение в Telegram</a></li>
              <li class="mb-3"><a href="https://icatalog.pro/shho-prygotuvaty-yisty-z-nichogo-7-idej/" class="opacity-75 hover:text-blue-500 font-medium">Що приготувати їсти з нічого</a></li>
            </ul>
          </div>
        </div>
      </div>
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