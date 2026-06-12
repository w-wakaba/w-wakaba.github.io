<?php get_header(); ?>

<!-- Hero Section -->
<section class="hero-section relative h-screen flex items-center justify-center">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="container mx-auto px-4 relative z-10 text-center text-white">
        <h1 class="text-4xl md:text-6xl font-bold mb-6" data-aos="fade-up">
            <span data-lang="ja">わかばのアプリ工房へようこそ</span>
            <span data-lang="en" class="hidden">Welcome to Wakaba App Studio</span>
        </h1>
        <p class="text-xl md:text-2xl mb-8" data-aos="fade-up" data-aos-delay="200">
            <span data-lang="ja">ユーザーに寄り添った、使いやすいアプリを開発しています</span>
            <span data-lang="en" class="hidden">Creating user-friendly apps that make a difference</span>
        </p>
        <a href="#apps" class="btn-primary" data-aos="fade-up" data-aos-delay="400">
            <span data-lang="ja">アプリを見る</span>
            <span data-lang="en" class="hidden">View Apps</span>
        </a>
    </div>
</section>

<!-- Apps Section -->
<section id="apps" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12" data-aos="fade-up">
            <span data-lang="ja">アプリ一覧</span>
            <span data-lang="en" class="hidden">Our Apps</span>
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $apps = new WP_Query(array(
                'post_type' => 'app',
                'posts_per_page' => -1
            ));

            if ($apps->have_posts()) :
                while ($apps->have_posts()) : $apps->the_post();
                    $app_store_url = get_post_meta(get_the_ID(), 'app_store_url', true);
                    $play_store_url = get_post_meta(get_the_ID(), 'play_store_url', true);
            ?>
                <div class="app-card" data-aos="fade-up">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="app-image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="app-content">
                        <h3 class="text-xl font-bold mb-4"><?php the_title(); ?></h3>
                        <p class="text-gray-600 mb-6"><?php the_excerpt(); ?></p>
                        <div class="flex space-x-4">
                            <?php if ($app_store_url) : ?>
                                <a href="<?php echo esc_url($app_store_url); ?>" class="btn-store" target="_blank">
                                    <i class="fab fa-apple"></i> App Store
                                </a>
                            <?php endif; ?>
                            <?php if ($play_store_url) : ?>
                                <a href="<?php echo esc_url($play_store_url); ?>" class="btn-store" target="_blank">
                                    <i class="fab fa-google-play"></i> Google Play
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>

<!-- News Section -->
<section class="py-20">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12" data-aos="fade-up">
            <span data-lang="ja">お知らせ</span>
            <span data-lang="en" class="hidden">News</span>
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $news = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 5
            ));

            if ($news->have_posts()) :
                while ($news->have_posts()) : $news->the_post();
            ?>
                <article class="news-card" data-aos="fade-up">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="news-image">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="news-content">
                        <h3 class="text-xl font-bold mb-2"><?php the_title(); ?></h3>
                        <time class="text-gray-500"><?php echo get_the_date(); ?></time>
                    </div>
                </article>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-8" data-aos="fade-up">
            <span data-lang="ja">お問い合わせ</span>
            <span data-lang="en" class="hidden">Contact Us</span>
        </h2>
        <p class="text-xl mb-8" data-aos="fade-up" data-aos-delay="200">
            <span data-lang="ja">ご質問やご要望がございましたら、お気軽にお問い合わせください。</span>
            <span data-lang="en" class="hidden">Feel free to contact us with any questions or requests.</span>
        </p>
        <div class="flex justify-center space-x-6" data-aos="fade-up" data-aos-delay="400">
            <a href="#" class="text-gray-600 hover:text-gray-900">
                <i class="fab fa-twitter text-2xl"></i>
            </a>
            <a href="#" class="text-gray-600 hover:text-gray-900">
                <i class="fab fa-facebook text-2xl"></i>
            </a>
            <a href="#" class="text-gray-600 hover:text-gray-900">
                <i class="fab fa-instagram text-2xl"></i>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?> 