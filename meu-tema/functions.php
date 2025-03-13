<?php
function enqueue_bootstrap() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap');

function enqueue_custom_script() {
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/plugin-video.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_script');

function get_youtube_feed_videos() {
    if (false === ($data = get_transient('youtube_feed_cache'))) {
        include_once(ABSPATH . WPINC . '/feed.php');
        // colocar o id do canal
        $rss_url = 'https://www.youtube.com/feeds/videos.xml?channel_id=UCo2TEcZ114Ul8DJWT5O_PZg';
        $max_items = 10;
        $rss = fetch_feed($rss_url);

        if (is_wp_error($rss)) {
            return ['error' => 'Erro ao carregar o feed.'];
        }

        $maxitems = $rss->get_item_quantity($max_items);
        $rss_items = $rss->get_items(0, $maxitems);

        if ($maxitems == 0) {
            return ['error' => 'Nenhum vídeo encontrado.'];
        }

        $videos = [];
        foreach ($rss_items as $item) {
            $title = $item->get_title();
            $link = $item->get_link();
            parse_str(parse_url($link, PHP_URL_QUERY), $params);
            $video_id = $params['v'];
            $thumbnail = "https://img.youtube.com/vi/{$video_id}/default.jpg";

            $videos[] = [
                'video_id' => $video_id,
                'title' => $title,
                'thumbnail' => $thumbnail
            ];
        }
        $data = $videos;
        set_transient('youtube_feed_cache', $data, 12 * HOUR_IN_SECONDS);
    }
    return $data;
}