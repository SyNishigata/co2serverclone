
<ul class="accordion" data-accordion>
    <li class="accordion-item is-active" data-accordion-item>
      <a class="accordion-title">Travel</a>
      <div class="accordion-content" data-tab-content>
        <?php get_plugin_template('travel-consumption'); ?>
      </div>
    </li>
    <!-- ... -->
    <li class="accordion-item" data-accordion-item>
      <a class="accordion-title">Utility</a>
      <div class="accordion-content" data-tab-content>
        <?php get_plugin_template('utility-consumption'); ?>
      </div>
    </li>
    <li class="accordion-item" data-accordion-item>
      <a class="accordion-title">Food</a>
      <div class="accordion-content" data-tab-content>
        <?php get_plugin_template('food-consumption'); ?>
      </div>
    </li>
    <!-- ... -->
    <li class="accordion-item" data-accordion-item>
      <a class="accordion-title">Shopping</a>
      <div class="accordion-content" data-tab-content>
        <?php get_plugin_template('shopping-consumption'); ?>
      </div>
    </li>
    <!-- ... -->
</ul>