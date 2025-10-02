<?php ob_start(); ?>

<div class="container">
    <!-- Page Header -->
    <section class="page-header" data-aos="fade-up">
        <div class="text-center">
            <h1 class="page-title">About <?php echo htmlspecialchars($company_name); ?></h1>
            <p class="page-subtitle">Leading the way in technology innovation and business transformation</p>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="section-padding">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h2 class="section-title">Our Mission</h2>
                <p class="lead"><?php echo htmlspecialchars($mission); ?></p>
                
                <h2 class="section-title mt-5">Our Vision</h2>
                <p class="lead"><?php echo htmlspecialchars($vision); ?></p>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="about-image">
                    <div class="image-placeholder">
                        <i class="fas fa-building fa-5x text-primary"></i>
                        <p class="mt-3 text-muted">Lambert Nguyen Company Office</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Company Values -->
    <section class="section-padding bg-light">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Our Core Values</h2>
            <p class="section-subtitle">The principles that guide everything we do</p>
        </div>
        
        <div class="row g-4">
            <?php foreach ($values as $value_name => $value_description): ?>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="<?php echo array_search($value_name, array_keys($values)) * 100; ?>">
                <div class="value-card">
                    <div class="value-header">
                        <div class="value-icon">
                            <?php 
                            $icons = ['Innovation' => 'lightbulb', 'Excellence' => 'star', 'Partnership' => 'handshake', 'Integrity' => 'shield-alt'];
                            echo '<i class="fas fa-' . ($icons[$value_name] ?? 'check') . '"></i>';
                            ?>
                        </div>
                        <h3><?php echo htmlspecialchars($value_name); ?></h3>
                    </div>
                    <p><?php echo htmlspecialchars($value_description); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Company History -->
    <section class="section-padding">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="history-image">
                    <div class="image-placeholder">
                        <i class="fas fa-history fa-5x text-primary"></i>
                        <p class="mt-3 text-muted">Our Journey</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h2 class="section-title">Our Story</h2>
                <p><?php echo htmlspecialchars($history); ?></p>
            </div>
        </div>
    </section>

    <!-- Team Statistics -->
    <section class="section-padding bg-primary text-white">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title text-white">By the Numbers</h2>
            <p class="section-subtitle text-light">Our achievements speak for themselves</p>
        </div>
        
        <div class="row g-4 text-center">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-item">
                    <div class="stat-number"><?php echo htmlspecialchars($team_stats['clients_served']); ?></div>
                    <div class="stat-label">Clients Served</div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-item">
                    <div class="stat-number"><?php echo htmlspecialchars($team_stats['projects_completed']); ?></div>
                    <div class="stat-label">Projects Completed</div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-item">
                    <div class="stat-number"><?php echo htmlspecialchars($team_stats['team_members']); ?></div>
                    <div class="stat-label">Team Members</div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-item">
                    <div class="stat-number"><?php echo htmlspecialchars($team_stats['years_experience']); ?></div>
                    <div class="stat-label">Years of Excellence</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="section-padding">
        <div class="cta-section text-center" data-aos="fade-up">
            <h2>Let's Build Something Amazing Together</h2>
            <p class="lead">Ready to start your digital transformation journey?</p>
            <div class="cta-buttons">
                <a href="/company/contacts" class="btn-modern btn-modern-primary">
                    <i class="fas fa-envelope"></i>
                    Contact Us
                </a>
                <a href="/company/products" class="btn-modern btn-modern-outline">
                    <i class="fas fa-cogs"></i>
                    Our Services
                </a>
            </div>
        </div>
    </section>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>