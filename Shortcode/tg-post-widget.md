```
function saur8bh_tg_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'url' => '',
    ), $atts, 'saur8bh-tg' );

    $url = esc_url( $atts['url'] );

    if ( ! $url ) {
        return '';
    }

    preg_match( '/\/(\d+)$/', $url, $matches );

    if ( ! isset( $matches[1] ) ) {
        return '';
    }

    $telegram_post_id = $matches[1];

    ob_start();
    ?>
    <div class="telegram-post" data-telegram-post="<?php echo esc_attr( $telegram_post_id ); ?>"></div>
    <script>
    (function() {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.async = true;
        script.src = "https://telegram.org/js/telegram-widget.js?21";
        var scriptTag = document.getElementsByTagName("script")[0];
        scriptTag.parentNode.insertBefore(script, scriptTag);
    })();
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode( 'saur8bh-tg', 'saur8bh_tg_shortcode' );
```

```
[saur8bh-tg url="https://t.me/mrsktcom/5"]
```
