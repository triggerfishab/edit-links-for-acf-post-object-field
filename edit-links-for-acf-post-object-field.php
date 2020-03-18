<?php

/**
 * Plugin Name: Edit Links for ACF Post Object Field
 * Description: This plugin adds edit links to the posts in the administration of the ACF Post Object Field.
 * Author: Joi Glifberg, Triggerfish
 * Author URI: https://www.triggerfish.se/
 * Version: 1.0.0
 */

add_action('admin_footer', function () {
    ?>
    <script>
    acf.add_filter('select2_args', function(args, $select) {
        $select.on('select2:selecting', function(e) {
            if (e.params.args.originalEvent.target.classList.contains('js-post-object-list-link')) {
                e.preventDefault();
            }
        });

        return args;
    });
    </script>
    <?php
});

add_filter('acf/fields/post_object/result', function ($title, $post): string {
    return sprintf('%s <a href="%s" class="js-post-object-list-link" style="float: right; margin-left: .5em; margin-right: .5em;">%s</a>', $title, get_edit_post_link($post), esc_html__('Edit'));
}, 10, 2);

