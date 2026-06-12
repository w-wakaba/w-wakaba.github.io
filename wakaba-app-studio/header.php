<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header -->
<header class="fixed w-full bg-white z-50 shadow-sm top-0">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <?php
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
                echo '<h1 class="text-2xl font-bold text-gray-800">';
                echo '<span class="text-green-800">わかば</span>のアプリ工房';
                echo '</h1>';
            }
            ?>
            
            <nav class="hidden md:flex space-x-8 text-gray-700">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'flex space-x-8',
                    'fallback_cb' => false,
                    'items_wrap' => '%3$s',
                    'walker' => new Wakaba_Nav_Walker()
                ));
                ?>
                <button onclick="toggleLanguage()" class="nav-link">
                    <span data-lang="ja">EN</span>
                    <span data-lang="en" class="hidden">JP</span>
                </button>
            </nav>
            
            <div class="md:hidden">
                <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Menu -->
<div class="mobile-menu">
    <div class="mobile-menu-close" onclick="toggleMobileMenu()">
        <i class="fas fa-times"></i>
    </div>
    <nav class="flex flex-col items-center">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => 'flex flex-col items-center',
            'fallback_cb' => false,
            'items_wrap' => '%3$s',
            'walker' => new Wakaba_Mobile_Nav_Walker()
        ));
        ?>
        <button onclick="toggleLanguage()" class="mobile-nav-link">
            <span data-lang="ja">EN</span>
            <span data-lang="en" class="hidden">JP</span>
        </button>
    </nav>
</div> 