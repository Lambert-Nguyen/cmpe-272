<?php

require_once __DIR__ . '/Controller.php';

class ProductController extends Controller {
    
    // Product catalog with 10 products
    private $products = [
        1 => [
            'id' => 1,
            'name' => 'Custom Web Application Development',
            'category' => 'Software Development',
            'price' => '$15,000 - $100,000',
            'icon' => 'fas fa-laptop-code',
            'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&h=500&fit=crop',
            'short_description' => 'Tailored web applications built with modern frameworks and best practices.',
            'description' => 'We design and develop custom web applications that perfectly match your business requirements. Using cutting-edge technologies like React, Vue.js, Angular, PHP Laravel, and Node.js, we create scalable, secure, and high-performance web solutions. Our team follows agile methodologies to ensure timely delivery and continuous improvement throughout the development lifecycle.',
            'features' => [
                'Modern JavaScript frameworks (React, Vue, Angular)',
                'RESTful API development',
                'Responsive and mobile-first design',
                'Database architecture and optimization',
                'Third-party integrations',
                'Security best practices implementation',
                'Performance optimization',
                'Comprehensive testing and QA'
            ],
            'technologies' => ['React', 'Node.js', 'PHP', 'MySQL', 'MongoDB', 'AWS']
        ],
        2 => [
            'id' => 2,
            'name' => 'Cloud Migration & Deployment',
            'category' => 'Cloud Services',
            'price' => '$10,000 - $75,000',
            'icon' => 'fas fa-cloud-upload-alt',
            'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&h=500&fit=crop',
            'short_description' => 'Seamless migration to AWS, Azure, or Google Cloud Platform.',
            'description' => 'Transform your infrastructure with our expert cloud migration services. We help businesses transition from on-premises systems to cloud platforms with zero downtime. Our comprehensive approach includes infrastructure assessment, migration planning, execution, and post-migration support. We specialize in AWS, Microsoft Azure, and Google Cloud Platform, ensuring you leverage the best features of each platform.',
            'features' => [
                'Infrastructure assessment and planning',
                'Zero-downtime migration strategies',
                'Multi-cloud and hybrid cloud solutions',
                'Cost optimization and right-sizing',
                'Security and compliance configuration',
                'Disaster recovery setup',
                'Performance monitoring and optimization',
                '24/7 post-migration support'
            ],
            'technologies' => ['AWS', 'Azure', 'Google Cloud', 'Docker', 'Kubernetes', 'Terraform']
        ],
        3 => [
            'id' => 3,
            'name' => 'Mobile App Development (iOS & Android)',
            'category' => 'Mobile Solutions',
            'price' => '$20,000 - $150,000',
            'icon' => 'fas fa-mobile-alt',
            'image' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=800&h=500&fit=crop',
            'short_description' => 'Native and cross-platform mobile applications for iOS and Android.',
            'description' => 'Build powerful mobile applications that engage your users and drive business growth. We develop both native apps (Swift for iOS, Kotlin for Android) and cross-platform solutions using React Native and Flutter. Our mobile apps are designed with user experience in mind, featuring intuitive interfaces, smooth animations, and robust performance. We handle everything from concept to deployment on App Store and Google Play.',
            'features' => [
                'Native iOS and Android development',
                'Cross-platform solutions (React Native, Flutter)',
                'UI/UX design and prototyping',
                'Push notifications and real-time updates',
                'Offline functionality and data sync',
                'Payment gateway integration',
                'App Store and Google Play deployment',
                'Analytics and crash reporting'
            ],
            'technologies' => ['Swift', 'Kotlin', 'React Native', 'Flutter', 'Firebase', 'Redux']
        ],
        4 => [
            'id' => 4,
            'name' => 'AI & Machine Learning Solutions',
            'category' => 'Artificial Intelligence',
            'price' => '$25,000 - $200,000',
            'icon' => 'fas fa-robot',
            'image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&h=500&fit=crop',
            'short_description' => 'Intelligent automation and predictive analytics powered by AI.',
            'description' => 'Leverage the power of artificial intelligence and machine learning to transform your business operations. We develop custom AI solutions including predictive analytics, natural language processing, computer vision, and intelligent chatbots. Our data scientists and ML engineers work with frameworks like TensorFlow, PyTorch, and scikit-learn to build models that deliver actionable insights and automate complex tasks.',
            'features' => [
                'Predictive analytics and forecasting',
                'Natural Language Processing (NLP)',
                'Computer vision and image recognition',
                'Recommendation engines',
                'Intelligent chatbots and virtual assistants',
                'Anomaly detection and fraud prevention',
                'Sentiment analysis',
                'Custom ML model development and training'
            ],
            'technologies' => ['Python', 'TensorFlow', 'PyTorch', 'OpenAI', 'scikit-learn', 'Pandas']
        ],
        5 => [
            'id' => 5,
            'name' => 'Enterprise Resource Planning (ERP)',
            'category' => 'Enterprise Software',
            'price' => '$50,000 - $300,000',
            'icon' => 'fas fa-building',
            'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=500&fit=crop',
            'short_description' => 'Comprehensive ERP systems for streamlined business operations.',
            'description' => 'Optimize your entire business operations with our custom ERP solutions. We design and implement comprehensive enterprise resource planning systems that integrate all aspects of your business - from finance and HR to inventory and supply chain management. Our ERP solutions provide real-time visibility, improve efficiency, and support data-driven decision-making across your organization.',
            'features' => [
                'Financial management and accounting',
                'Human resources and payroll',
                'Inventory and supply chain management',
                'Customer relationship management (CRM)',
                'Project management and tracking',
                'Reporting and business intelligence',
                'Multi-location and multi-currency support',
                'Role-based access control'
            ],
            'technologies' => ['Java', 'Spring Boot', 'Oracle', 'SAP', 'Microsoft Dynamics', 'PostgreSQL']
        ],
        6 => [
            'id' => 6,
            'name' => 'E-Commerce Platform Development',
            'category' => 'E-Commerce',
            'price' => '$18,000 - $120,000',
            'icon' => 'fas fa-shopping-cart',
            'image' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=800&h=500&fit=crop',
            'short_description' => 'Full-featured online stores with payment processing and inventory management.',
            'description' => 'Launch your online business with our powerful e-commerce solutions. We build custom online stores using platforms like Shopify, WooCommerce, Magento, or custom-built solutions tailored to your unique needs. Our e-commerce platforms feature secure payment processing, inventory management, order tracking, and advanced marketing tools to help you maximize sales and provide excellent customer experiences.',
            'features' => [
                'Product catalog management',
                'Shopping cart and checkout optimization',
                'Multiple payment gateway integration',
                'Inventory and order management',
                'Customer account and wishlist',
                'Discount codes and promotions',
                'SEO optimization for products',
                'Analytics and sales reporting'
            ],
            'technologies' => ['Shopify', 'WooCommerce', 'Magento', 'Stripe', 'PayPal', 'Elasticsearch']
        ],
        7 => [
            'id' => 7,
            'name' => 'Cybersecurity & Penetration Testing',
            'category' => 'Security Services',
            'price' => '$8,000 - $50,000',
            'icon' => 'fas fa-shield-alt',
            'image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=800&h=500&fit=crop',
            'short_description' => 'Comprehensive security audits and vulnerability assessments.',
            'description' => 'Protect your digital assets with our comprehensive cybersecurity services. Our certified security experts conduct thorough penetration testing, vulnerability assessments, and security audits to identify and remediate potential threats. We help you achieve compliance with industry standards (GDPR, HIPAA, PCI-DSS) and implement robust security measures including encryption, authentication, and intrusion detection systems.',
            'features' => [
                'Penetration testing and ethical hacking',
                'Vulnerability assessment and remediation',
                'Security code review',
                'Compliance consulting (GDPR, HIPAA, PCI-DSS)',
                'Security architecture design',
                'Incident response planning',
                'Security awareness training',
                'Continuous monitoring and threat detection'
            ],
            'technologies' => ['Kali Linux', 'Metasploit', 'Burp Suite', 'OWASP', 'Splunk', 'Wireshark']
        ],
        8 => [
            'id' => 8,
            'name' => 'DevOps & CI/CD Implementation',
            'category' => 'DevOps',
            'price' => '$12,000 - $60,000',
            'icon' => 'fas fa-cogs',
            'image' => 'https://images.unsplash.com/photo-1618401471353-b98afee0b2eb?w=800&h=500&fit=crop',
            'short_description' => 'Automated deployment pipelines and infrastructure as code.',
            'description' => 'Accelerate your software delivery with our DevOps consulting and implementation services. We set up continuous integration and continuous deployment (CI/CD) pipelines, implement infrastructure as code, and establish monitoring and logging systems. Our DevOps solutions help you achieve faster time-to-market, improved collaboration between teams, and more reliable software releases.',
            'features' => [
                'CI/CD pipeline setup and optimization',
                'Infrastructure as Code (IaC)',
                'Containerization with Docker and Kubernetes',
                'Automated testing and quality gates',
                'Configuration management',
                'Monitoring and logging solutions',
                'Automated deployment strategies',
                'GitOps workflow implementation'
            ],
            'technologies' => ['Jenkins', 'GitLab CI', 'Docker', 'Kubernetes', 'Ansible', 'Prometheus']
        ],
        9 => [
            'id' => 9,
            'name' => 'Data Analytics & Business Intelligence',
            'category' => 'Data Solutions',
            'price' => '$15,000 - $90,000',
            'icon' => 'fas fa-chart-bar',
            'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=500&fit=crop',
            'short_description' => 'Turn your data into actionable insights with advanced analytics.',
            'description' => 'Transform raw data into valuable business insights with our analytics and business intelligence solutions. We design and implement data warehouses, create interactive dashboards, and develop custom reporting tools. Using technologies like Power BI, Tableau, and custom Python/R solutions, we help you visualize trends, identify opportunities, and make data-driven decisions that drive growth.',
            'features' => [
                'Data warehouse design and implementation',
                'Interactive dashboard development',
                'Custom reporting and KPI tracking',
                'Predictive analytics and forecasting',
                'Data visualization and storytelling',
                'ETL pipeline development',
                'Real-time analytics',
                'Self-service BI tools'
            ],
            'technologies' => ['Power BI', 'Tableau', 'Python', 'R', 'Apache Spark', 'Snowflake']
        ],
        10 => [
            'id' => 10,
            'name' => 'API Development & Integration',
            'category' => 'Integration Services',
            'price' => '$10,000 - $70,000',
            'icon' => 'fas fa-plug',
            'image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800&h=500&fit=crop',
            'short_description' => 'RESTful and GraphQL APIs with seamless third-party integrations.',
            'description' => 'Connect your systems and enable seamless data flow with our API development and integration services. We build robust, secure, and well-documented APIs (REST, GraphQL) and integrate your applications with third-party services. Whether you need to connect CRM systems, payment gateways, or custom software, we ensure reliable and efficient data exchange across all your platforms.',
            'features' => [
                'RESTful API development',
                'GraphQL API implementation',
                'API documentation (OpenAPI/Swagger)',
                'Third-party service integration',
                'API security and authentication (OAuth, JWT)',
                'Rate limiting and throttling',
                'API versioning and backward compatibility',
                'Webhook implementation'
            ],
            'technologies' => ['Node.js', 'Express', 'GraphQL', 'Swagger', 'Postman', 'API Gateway']
        ]
    ];
    
    /**
     * Display individual product page with cookie tracking
     */
    public function show() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if (!isset($this->products[$id])) {
            header('Location: /company/products');
            exit;
        }
        
        $product = $this->products[$id];
        
        // Track visit in cookies
        $this->trackProductVisit($id);
        
        $data = [
            'title' => $product['name'] . ' - Lambert Nguyen Company',
            'product' => $product,
            'related_products' => $this->getRelatedProducts($id)
        ];
        
        $this->render('products/show', $data);
    }
    
    /**
     * Display last 5 recently visited products
     */
    public function recentlyVisited() {
        $recentIds = $this->getRecentlyVisitedIds();
        $products = [];
        
        foreach ($recentIds as $id) {
            if (isset($this->products[$id])) {
                $products[] = $this->products[$id];
            }
        }
        
        $data = [
            'title' => 'Recently Visited Products - Lambert Nguyen Company',
            'products' => $products
        ];
        
        $this->render('products/recently-visited', $data);
    }
    
    /**
     * Display 5 most visited products (Extra Credit)
     */
    public function mostVisited() {
        $mostVisitedData = $this->getMostVisitedProducts();
        $products = [];
        
        foreach ($mostVisitedData as $item) {
            if (isset($this->products[$item['id']])) {
                $product = $this->products[$item['id']];
                $product['visit_count'] = $item['count'];
                $products[] = $product;
            }
        }
        
        $data = [
            'title' => 'Most Visited Products - Lambert Nguyen Company',
            'products' => $products
        ];
        
        $this->render('products/most-visited', $data);
    }
    
    /**
     * Track product visit in cookies
     * Stores last 5 visited products and visit counts
     */
    private function trackProductVisit($productId) {
        // Track last visited (for recently visited feature)
        $recentIds = $this->getRecentlyVisitedIds();
        
        // Remove if already exists (to move to front)
        $recentIds = array_filter($recentIds, function($id) use ($productId) {
            return $id != $productId;
        });
        
        // Add to front
        array_unshift($recentIds, $productId);
        
        // Keep only last 5
        $recentIds = array_slice($recentIds, 0, 5);
        
        // Store in cookie (30 days)
        setcookie('recently_visited', json_encode($recentIds), time() + (30 * 24 * 60 * 60), '/');
        
        // Track visit count (for most visited feature - Extra Credit)
        $visitCounts = isset($_COOKIE['visit_counts']) ? json_decode($_COOKIE['visit_counts'], true) : [];
        
        if (!isset($visitCounts[$productId])) {
            $visitCounts[$productId] = 0;
        }
        $visitCounts[$productId]++;
        
        // Store in cookie (30 days)
        setcookie('visit_counts', json_encode($visitCounts), time() + (30 * 24 * 60 * 60), '/');
    }
    
    /**
     * Get recently visited product IDs from cookie
     */
    private function getRecentlyVisitedIds() {
        if (isset($_COOKIE['recently_visited'])) {
            $ids = json_decode($_COOKIE['recently_visited'], true);
            return is_array($ids) ? $ids : [];
        }
        return [];
    }
    
    /**
     * Get most visited products from cookie (Extra Credit)
     */
    private function getMostVisitedProducts() {
        $visitCounts = isset($_COOKIE['visit_counts']) ? json_decode($_COOKIE['visit_counts'], true) : [];
        
        if (empty($visitCounts)) {
            return [];
        }
        
        // Sort by visit count descending
        arsort($visitCounts);
        
        // Get top 5
        $top5 = array_slice($visitCounts, 0, 5, true);
        
        $result = [];
        foreach ($top5 as $id => $count) {
            $result[] = ['id' => $id, 'count' => $count];
        }
        
        return $result;
    }
    
    /**
     * Get related products (same category, exclude current)
     */
    private function getRelatedProducts($currentId) {
        $current = $this->products[$currentId];
        $related = [];
        
        foreach ($this->products as $product) {
            if ($product['id'] != $currentId && $product['category'] == $current['category']) {
                $related[] = $product;
                if (count($related) >= 3) break;
            }
        }
        
        return $related;
    }
    
    /**
     * Get all products for listing
     */
    public function getAllProducts() {
        return $this->products;
    }
}
