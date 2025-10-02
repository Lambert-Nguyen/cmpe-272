<?php ob_start(); ?>

<div class="container">
    <!-- Page Header -->
    <section class="page-header" data-aos="fade-up">
        <div class="text-center">
            <h1 class="page-title">Latest News</h1>
            <p class="page-subtitle">Stay updated with our latest achievements, partnerships, and industry insights</p>
        </div>
    </section>

    <!-- News Articles -->
    <section class="section-padding">
        <div class="row g-4">
            <?php foreach ($news_articles as $index => $article): ?>
            <div class="col-lg-12" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                <article class="news-article">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-4">
                            <div class="news-image">
                                <div class="image-placeholder">
                                    <?php 
                                    $categoryIcons = [
                                        'Company News' => 'fas fa-building',
                                        'Case Study' => 'fas fa-chart-line',
                                        'Partnership' => 'fas fa-handshake',
                                        'Award' => 'fas fa-trophy',
                                        'Service Launch' => 'fas fa-rocket'
                                    ];
                                    $icon = $categoryIcons[$article['category']] ?? 'fas fa-newspaper';
                                    ?>
                                    <i class="<?php echo $icon; ?> fa-4x text-primary"></i>
                                    <p class="mt-3 text-muted"><?php echo htmlspecialchars($article['category']); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="news-content">
                                <div class="news-meta">
                                    <span class="news-category"><?php echo htmlspecialchars($article['category']); ?></span>
                                    <span class="news-date"><?php echo date('F j, Y', strtotime($article['date'])); ?></span>
                                </div>
                                
                                <h2 class="news-title">
                                    <a href="#news-<?php echo $index; ?>" data-bs-toggle="collapse">
                                        <?php echo htmlspecialchars($article['title']); ?>
                                    </a>
                                </h2>
                                
                                <p class="news-excerpt"><?php echo htmlspecialchars($article['excerpt']); ?></p>
                                
                                <a href="#news-<?php echo $index; ?>" class="read-more-btn" data-bs-toggle="collapse">
                                    Read Full Article <i class="fas fa-chevron-down ms-1"></i>
                                </a>
                                
                                <div class="collapse mt-3" id="news-<?php echo $index; ?>">
                                    <div class="news-full-content">
                                        <p><?php echo htmlspecialchars($article['content']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Newsletter Signup -->
    <section class="section-padding bg-light">
        <div class="text-center" data-aos="fade-up">
            <h2 class="section-title">Stay Updated</h2>
            <p class="section-subtitle">Subscribe to our newsletter for the latest company news and industry insights</p>
            
            <div class="newsletter-form">
                <form class="row g-3 justify-content-center align-items-center">
                    <div class="col-auto">
                        <label for="email" class="visually-hidden">Email</label>
                        <input type="email" class="form-control form-control-lg" id="email" placeholder="Enter your email">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane me-2"></i>Subscribe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Social Media -->
    <section class="section-padding">
        <div class="text-center" data-aos="fade-up">
            <h2 class="section-title">Follow Us</h2>
            <p class="section-subtitle">Connect with us on social media for real-time updates</p>
            
            <div class="social-links">
                <a href="#" class="social-link">
                    <i class="fab fa-linkedin"></i>
                    LinkedIn
                </a>
                <a href="#" class="social-link">
                    <i class="fab fa-twitter"></i>
                    Twitter
                </a>
                <a href="#" class="social-link">
                    <i class="fab fa-facebook"></i>
                    Facebook
                </a>
                <a href="#" class="social-link">
                    <i class="fab fa-instagram"></i>
                    Instagram
                </a>
                <a href="#" class="social-link">
                    <i class="fab fa-youtube"></i>
                    YouTube
                </a>
            </div>
        </div>
    </section>

    <!-- Related Articles -->
    <section class="section-padding bg-primary text-white">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title text-white">Related Resources</h2>
            <p class="section-subtitle text-light">Explore more about our company and services</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="resource-card">
                    <div class="resource-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h4>About Us</h4>
                    <p>Learn more about our mission, vision, and company values</p>
                    <a href="/company/about" class="btn btn-outline-light">
                        Read More <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="resource-card">
                    <div class="resource-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h4>Our Services</h4>
                    <p>Discover our comprehensive range of technology solutions</p>
                    <a href="/company/products" class="btn btn-outline-light">
                        View Services <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="resource-card">
                    <div class="resource-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h4>Contact Us</h4>
                    <p>Get in touch with our team for your next project</p>
                    <a href="/company/contacts" class="btn btn-outline-light">
                        Contact Us <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>