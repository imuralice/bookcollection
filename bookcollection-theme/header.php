<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="header-content">
            <!-- Text Logo -->
            <div class="site-logo">
                <a href="<?php echo home_url(); ?>">
                    <span class="books">Books</span>
                    <span class="collection">Collection</span>
                </a>
            </div>

            <!-- Navigation Menu -->
            <nav class="main-navigation">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class' => 'nav-menu',
                ]);
                ?>
            </nav>
        </div>
    </header>