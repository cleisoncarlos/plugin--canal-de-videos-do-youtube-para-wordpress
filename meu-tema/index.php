<?php
/*
 Template Name: Página de Vídeos
*/
get_header();


$videos = get_youtube_feed_videos();
$main_video = !empty($videos) && !isset($videos['error']) ? $videos[0] : null;
?>

<div class="container my-5">
    <div class="card bg-dark">
        <div class="card-body">
            <div class="row">
                <!-- Vídeo Principal -->
                <div class="col-lg-7">
                    <?php if ($main_video && !isset($videos['error'])): ?>
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($main_video['video_id']); ?>" 
                                    title="<?php echo esc_attr($main_video['title']); ?>" 
                                    allowfullscreen></iframe>
                        </div>
                        <h4 class="text-white"><?php echo esc_html($main_video['title']); ?></h4>
                    <?php else: ?>
                        <p><?php echo esc_html($videos['error']); ?></p>
                    <?php endif; ?>
                </div>

                <!-- Lista de Vídeos Relacionados -->
                <div class="col-lg-5">
                    <div class="overflow-y-scroll" style="height: 400px;">
                        <?php
                        if (!empty($videos) && !isset($videos['error'])) {
                            foreach ($videos as $video) {
                                echo '


<div class="card border-0 rounded-0 mb-3 bg-secondary">
  <div class="row g-0">
    <div class="col-md-3">
       <img src="' . esc_url($video['thumbnail']) . '" class="img-fluid" alt="' . esc_attr($video['title']) . '">
    </div>
    <div class="col">
      <div class="card-body">
     <h5 class="text-white">' . esc_html($video['title']) . '</h6>  
        </div>
    </div>
  </div>
</div>







                                
                                ';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>