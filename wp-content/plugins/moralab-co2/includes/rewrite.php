<?php

Class Carbon_Pages_Rewrite {

    function __construct(){
        //add rewrite rules
        add_action('init', array($this, 'plugin_rules'));
        //add plugin query vars to wordpress
        add_filter('query_vars', array($this, 'plugin_query_vars'));
        //register plugin custom pages template
        add_filter('template_include', array($this, 'plugin_page_template'), 1, 1);
        // add title head
        add_filter( 'wp_title', array($this, 'plugin_page_title'), 10, 2 );
    }
    
    public function plugin_rules() {
        add_rewrite_rule('my-trees/plant-a-tree', 'index.php?mlpage=plant-a-tree', 'top');
        //add_rewrite_rule('carbon/([^/]*)/?$', 'index.php?pagename=carbon&caction=$matches[1]', 'top');
        add_rewrite_rule('my-carbon/?$', 'index.php?mlpage=my-carbon', 'top');
        //add_rewrite_rule('my-carbon/([^/]*)/([^/]*)/?$', 'index.php?pagename=my-carbon&member=$matches[1]&carbon-title=$matches[2]', 'top');
        add_rewrite_rule('my-carbon/([^/]*)/([^/]*)/?$', 'index.php?mlpage=my-carbon&member=$matches[1]&carbon-title=$matches[2]', 'top');
        add_rewrite_rule('my-carbon/ranking?$', 'index.php?mlpage=my-carbon&mlsubpage=ranking', 'top');
    }

    public function plugin_query_vars($vars) {
        $vars[] = 'carbon-title';
        $vars[] = 'member';
        $vars[] = 'caction';
        $vars[] = 'mlpage';
        $vars[] = 'mlsubpage';
        return $vars;
    }

    public function plugin_page_template($template) {
        if (get_query_var('mlpage') == 'plant-a-tree'):
            //add_filter('wp_title', Array(__class__, 'plugin_page_title'));
            return TEMPL_PATH . '/tree-add-template.php';
        //elseif (get_query_var('pagename') == 'my-carbon' && get_query_var('caction') == 'calculator'):
        //  return TEMPL_PATH . '/carbon-summary-template.php';
        elseif (get_query_var('mlpage') == 'my-carbon' && !empty(get_query_var('carbon-title')) ):
            return TEMPL_PATH . '/carbon-paneltab-template.php';
        elseif (get_query_var('mlpage') == 'my-carbon' && get_query_var('mlsubpage') == 'ranking'):
            return TEMPL_PATH . '/carbon-ranking-template.php';
        elseif (get_query_var('mlpage') == 'my-carbon'):
            return TEMPL_PATH . '/carbon-summary-template.php';
      
      else:
        return $template;
      endif;
     }

    public function plugin_page_title( $title) {
        if (get_query_var('mlpage') == 'plant-a-tree'):
            return 'Plant a Tree';
        elseif (get_query_var('mlpage') == 'my-carbon' && get_query_var('mlsubpage') == 'ranking'):
            return 'My Carbon Sumary';
        elseif (get_query_var('mlpage') == 'my-carbon'):
            return 'My Carbon Sumary';
        else:
          return $title;
        endif;
    }
}

new Carbon_Pages_Rewrite;

