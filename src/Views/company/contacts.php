<?php ob_start(); ?>

<div class="container">
    <!-- Page Header -->
    <section class="page-header" data-aos="fade-up">
        <div class="text-center">
            <h1 class="page-title">Contact Us</h1>
            <p class="page-subtitle">Ready to start your next project? Get in touch with our expert team</p>
        </div>
    </section>

    <!-- Company Information -->
    <section class="section-padding">
        <div class="row g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <h2 class="section-title">Get In Touch</h2>
                <p class="lead">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
                
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h5>Headquarters</h5>
                            <p><?php echo htmlspecialchars($company_info['address']); ?></p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-details">
                            <h5>Phone</h5>
                            <p><?php echo htmlspecialchars($company_info['phone']); ?></p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h5>Email</h5>
                            <p><?php echo htmlspecialchars($company_info['email']); ?></p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-details">
                            <h5>Business Hours</h5>
                            <p><?php echo htmlspecialchars($company_info['hours']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="contact-form-container">
                    <h3>Send Us a Message</h3>
                    <form class="contact-form">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name *</label>
                                <input type="text" class="form-control" id="firstName" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name *</label>
                                <input type="text" class="form-control" id="lastName" required>
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="col-12">
                                <label for="company" class="form-label">Company</label>
                                <input type="text" class="form-control" id="company">
                            </div>
                            <div class="col-12">
                                <label for="service" class="form-label">Service Interest</label>
                                <select class="form-select" id="service">
                                    <option selected>Choose a service...</option>
                                    <option value="software-development">Custom Software Development</option>
                                    <option value="cloud-migration">Cloud Migration Services</option>
                                    <option value="digital-transformation">Digital Transformation Consulting</option>
                                    <option value="ai-ml">AI & Machine Learning Solutions</option>
                                    <option value="enterprise-integration">Enterprise Integration</option>
                                    <option value="support">Technical Support & Maintenance</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Message *</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Tell us about your project..." required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Directory -->
    <section class="section-padding bg-light">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Our Team Directory</h2>
            <p class="section-subtitle">Meet the experts behind Lambert Nguyen Company</p>
        </div>
        
        <?php if (!empty($contacts)): ?>
        <div class="row g-4">
            <?php foreach ($contacts as $index => $contact): ?>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo $index * 50; ?>">
                <div class="team-member-card">
                    <div class="member-avatar">
                        <i class="fas fa-user-circle fa-4x text-primary"></i>
                    </div>
                    <div class="member-info">
                        <h4><?php echo htmlspecialchars($contact['name']); ?></h4>
                        <p class="member-position"><?php echo htmlspecialchars($contact['position']); ?></p>
                        <p class="member-department">
                            <i class="fas fa-building me-1"></i>
                            <?php echo htmlspecialchars($contact['department']); ?>
                        </p>
                        <div class="member-contact">
                            <a href="mailto:<?php echo htmlspecialchars($contact['email']); ?>" class="contact-link">
                                <i class="fas fa-envelope me-1"></i>
                                <?php echo htmlspecialchars($contact['email']); ?>
                            </a>
                            <a href="tel:<?php echo htmlspecialchars($contact['phone']); ?>" class="contact-link">
                                <i class="fas fa-phone me-1"></i>
                                <?php echo htmlspecialchars($contact['phone']); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            Contact directory is currently being updated. Please check back soon or contact us directly.
        </div>
        <?php endif; ?>
    </section>

    <!-- Office Locations -->
    <section class="section-padding">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Our Office Locations</h2>
            <p class="section-subtitle">Find us across the West Coast</p>
        </div>
        
        <div class="row g-4">
            <?php foreach ($offices as $index => $office): ?>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                <div class="office-card">
                    <div class="office-header">
                        <h4><?php echo htmlspecialchars($office['city']); ?></h4>
                        <span class="office-type"><?php echo htmlspecialchars($office['type']); ?></span>
                    </div>
                    <div class="office-details">
                        <p class="office-address">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <?php echo htmlspecialchars($office['address']); ?>
                        </p>
                        <p class="office-phone">
                            <i class="fas fa-phone me-2"></i>
                            <?php echo htmlspecialchars($office['phone']); ?>
                        </p>
                    </div>
                    <div class="office-actions">
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fas fa-directions me-1"></i>Get Directions
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="section-padding bg-primary text-white">
        <div class="cta-section text-center" data-aos="fade-up">
            <h2 class="text-white">Ready to Transform Your Business?</h2>
            <p class="lead text-light">Let's discuss your project and explore how we can help you achieve your goals</p>
            <div class="cta-buttons">
                <a href="tel:<?php echo htmlspecialchars($company_info['phone']); ?>" class="btn btn-light btn-lg">
                    <i class="fas fa-phone me-2"></i>
                    Call Now
                </a>
                <a href="mailto:<?php echo htmlspecialchars($company_info['email']); ?>" class="btn btn-outline-light btn-lg ms-3">
                    <i class="fas fa-envelope me-2"></i>
                    Email Us
                </a>
            </div>
        </div>
    </section>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>