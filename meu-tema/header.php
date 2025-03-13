<!-- Coloque este código no arquivo header.php do seu tema WordPress -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Logo ou nome do site -->
        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
            <?php bloginfo('name'); ?>
        </a>

        <!-- Botão toggle para mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" 
                data-bs-target="#navbarOffcanvas" aria-controls="navbarOffcanvas" 
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Conteúdo da navbar -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvas" 
             aria-labelledby="navbarOffcanvasLabel">
            
            <!-- Cabeçalho do offcanvas -->
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="navbarOffcanvasLabel">
                    <?php bloginfo('name'); ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" 
                        aria-label="Close"></button>
            </div>

            <!-- Corpo do offcanvas -->
            <div class="offcanvas-body">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary', // Certifique-se de registrar este menu no functions.php
                    'menu_class' => 'navbar-nav ms-auto mb-2 mb-lg-0', // Classes do Bootstrap
                    'container' => false,
                    'depth' => 2,
                    'walker' => new WP_Bootstrap_Navwalker(), // Classe personalizada (explicada abaixo)
                ));
                ?>
            </div>
        </div>
    </div>
</nav>