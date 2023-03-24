</div>

<footer class="bg-theme-dark text-gray-200 py-20">
  <div class="container">
    <div class="flex flex-wrap lg:-mx-8">
      <div class="w-full lg:w-6/12 lg:px-8 mb-6 lg:mb-0">
        <div class="text-3xl text-gray-200 font-semibold mb-4"><span class="text-blue-500">i</span>Catalog</div>
        <div class="font-light mb-6">
          Сайт, на котором вы сможете найти нужную информацию. Мы постарались создать мини-гугл. Собрать на одном ресурсе всю полезную информацию. Мы можете добавлять материал на сайт.
        </div>
        <div class="flex text-lg mb-6">
          <div class="border-r border-gray-500 pr-5 mr-5">
            <div class="font-semibold">Более <span class="text-yellow-200">100</span> материалов</div>
          </div>
          <div>
            <div class="font-semibold">Более <span class="text-blue-500">4000</span> объявлений</div>
          </div>
        </div>
        <div>
          
        </div>
      </div>

      <div class="w-full lg:w-3/12 lg:px-8 mb-6 lg:mb-0">
        <div class="text-lg text-gray-400 uppercase mb-4">
          <?php _e('Категории', 'treba-wp'); ?>
        </div>
        <div>
          <ul>
            <?php $footer_categories = get_terms( array( 
              'taxonomy' => 'board',
              'parent' => 0, 
            ) );
            shuffle($footer_categories);
            foreach ( array_slice($footer_categories, 0, 5) as $footer_category ): ?>
              <li class="font-light mb-2">
                <a href="<?php echo get_term_link($footer_category); ?>"><?php echo $footer_category->name ?></a>
              </li>
            <?php endforeach; ?>
            <li class="font-light mb-2">
              <a href="https://icatalog.pro/12585-kak-zashhitit-kameru-videonabljudenija-ot-nasekomyh-i-pautiny/">Как защитить камеру видеонаблюдения</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="w-full lg:w-3/12 lg:px-8">
        <div class="text-lg text-gray-400 uppercase mb-4">
          <?php _e('Рубрики', 'treba-wp'); ?>
        </div>
        <div>
          <ul>
            <?php $footer_tags = get_terms( array( 
              'taxonomy' => 'category', 
              'parent' => 0, 
              'hide_empty' => false,
            ));
            foreach ( array_slice($footer_tags, 0, 5) as $footer_tag ): ?>
              <li class="font-light mb-2">
                <a href="<?php echo get_term_link($footer_tag); ?>"><?php echo $footer_tag->name ?></a>
              </li>
            <?php endforeach; ?>
            <li class="font-light mb-2">
              <a href="https://icatalog.pro/12610-kak-vybrat-pravilnyj-kondicioner-v-dom/">Как выбрать правильный кондиционер в дом</a>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</footer>

<div class="modal-bg hidden"></div>

<div class="modal" data-modal="menu">
  <div class="modal_content w-full h-screen">
    <div class="h-full bg-white rounded-xl">
      <div class="flex items-center justify-between bg-theme-dark text-white text-lg rounded-t-lg px-4 py-6 mb-4">
        <div class="logo font-extrabold">
          <a href="<?php echo get_home_url(); ?>"><span class="text-blue-500">i</span>Catalog</a>
        </div>
        <div class="modal-close-js">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
      <div class="p-4">
        <div class="text-2xl font-title mb-6"><?php _e("Меню", "treba-wp"); ?></div>
        <div>
          <?php wp_nav_menu([
            'theme_location' => 'header',
            'container' => 'div',
            'menu_class' => 'flex flex-col'
          ]); ?> 
        </div>
      </div>
    </div>
  </div>  
</div>

<?php wp_footer(); ?>

</body>
</html>