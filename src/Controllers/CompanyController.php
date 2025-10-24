<?php

require_once __DIR__ . '/Controller.php';

class CompanyController extends Controller {
    
    public function index() {
        $data = [
            'title' => 'Lambert Nguyen Company - Technology Consulting & Software Development',
            'company_name' => 'Lambert Nguyen Company',
            'tagline' => 'Innovative Technology Solutions for Modern Businesses',
            'description' => 'We specialize in enterprise software development, cloud migration, and digital transformation consulting.',
            'hero_features' => [
                'Custom Software Development',
                'Cloud Infrastructure Solutions',
                'Digital Transformation Consulting',
                'AI & Machine Learning Integration'
            ]
        ];
        
        $this->render('company/index', $data);
    }
    
    public function about() {
        $data = [
            'title' => 'About Lambert Nguyen Company',
            'company_name' => 'Lambert Nguyen Company',
            'mission' => 'To empower businesses through innovative technology solutions that drive growth, efficiency, and competitive advantage.',
            'vision' => 'To be the leading technology consulting firm that transforms how businesses operate in the digital age.',
            'values' => [
                'Innovation' => 'We embrace cutting-edge technologies and creative solutions.',
                'Excellence' => 'We deliver exceptional quality in every project we undertake.',
                'Partnership' => 'We build lasting relationships with our clients and stakeholders.',
                'Integrity' => 'We operate with transparency, honesty, and ethical standards.'
            ],
            'history' => 'Founded in 2020, Lambert Nguyen Company has grown from a small startup to a trusted technology partner for businesses across various industries. Our team of experienced developers, architects, and consultants brings decades of combined expertise to every project.',
            'team_stats' => [
                'clients_served' => '150+',
                'projects_completed' => '300+',
                'team_members' => '25+',
                'years_experience' => '5+'
            ]
        ];
        
        $this->render('company/about', $data);
    }
    
    public function products() {
        // Get all products from ProductController
        require_once __DIR__ . '/ProductController.php';
        $productController = new ProductController();
        $allProducts = $productController->getAllProducts();
        
        $data = [
            'title' => 'Products & Services - Lambert Nguyen Company',
            'company_name' => 'Lambert Nguyen Company',
            'products' => $allProducts
        ];
        
        $this->render('company/products', $data);
    }
    
    public function news() {
        $data = [
            'title' => 'Latest News - Lambert Nguyen Company',
            'company_name' => 'Lambert Nguyen Company',
            'news_articles' => [
                [
                    'title' => 'Lambert Nguyen Company Expands AI Services Division',
                    'date' => '2024-09-15',
                    'category' => 'Company News',
                    'excerpt' => 'We are excited to announce the expansion of our AI and Machine Learning services division, bringing cutting-edge artificial intelligence solutions to our clients.',
                    'content' => 'Our new AI services division will focus on developing custom machine learning models, implementing chatbot solutions, and creating predictive analytics systems. This expansion represents our commitment to staying at the forefront of technology innovation.',
                    'image' => '/images/ai-expansion.jpg'
                ],
                [
                    'title' => 'Successful Cloud Migration for Fortune 500 Client',
                    'date' => '2024-08-28',
                    'category' => 'Case Study',
                    'excerpt' => 'We successfully completed a major cloud migration project for a Fortune 500 manufacturing company, reducing their infrastructure costs by 40%.',
                    'content' => 'The six-month project involved migrating over 200 applications and 50TB of data to AWS cloud infrastructure. The client now enjoys improved scalability, enhanced security, and significant cost savings.',
                    'image' => '/images/cloud-migration.jpg'
                ],
                [
                    'title' => 'New Partnership with Leading University for Research',
                    'date' => '2024-08-10',
                    'category' => 'Partnership',
                    'excerpt' => 'Lambert Nguyen Company partners with San Jose State University to advance research in enterprise software platforms and cloud computing.',
                    'content' => 'This strategic partnership will involve collaborative research projects, internship programs, and knowledge sharing initiatives. Students will gain hands-on experience with real-world technology challenges.',
                    'image' => '/images/university-partnership.jpg'
                ],
                [
                    'title' => 'Industry Recognition: Best Technology Consulting Firm 2024',
                    'date' => '2024-07-22',
                    'category' => 'Award',
                    'excerpt' => 'We are honored to receive the "Best Technology Consulting Firm 2024" award from the Silicon Valley Business Journal.',
                    'content' => 'This recognition reflects our team\'s dedication to delivering exceptional technology solutions and our commitment to client success. We thank our clients and partners for their continued trust and support.',
                    'image' => '/images/award-2024.jpg'
                ],
                [
                    'title' => 'Cybersecurity Services Now Available',
                    'date' => '2024-07-05',
                    'category' => 'Service Launch',
                    'excerpt' => 'Introducing our comprehensive cybersecurity services to help businesses protect their digital assets and ensure compliance.',
                    'content' => 'Our new cybersecurity division offers penetration testing, security audits, compliance consulting, and incident response services. Protect your business with our expert security solutions.',
                    'image' => '/images/cybersecurity.jpg'
                ]
            ]
        ];
        
        $this->render('company/news', $data);
    }
    
    public function contacts() {
        // Read contacts from text file
        $contactsFile = __DIR__ . '/../../database/contacts.txt';
        $contacts = [];
        
        if (file_exists($contactsFile)) {
            $contactsData = file_get_contents($contactsFile);
            $contactLines = array_filter(explode("\n", $contactsData));
            
            foreach ($contactLines as $line) {
                if (trim($line) && !str_starts_with(trim($line), '#')) {
                    $parts = explode('|', $line);
                    if (count($parts) >= 4) {
                        $contacts[] = [
                            'name' => trim($parts[0]),
                            'position' => trim($parts[1]),
                            'email' => trim($parts[2]),
                            'phone' => trim($parts[3]),
                            'department' => isset($parts[4]) ? trim($parts[4]) : 'General'
                        ];
                    }
                }
            }
        }
        
        $data = [
            'title' => 'Contact Us - Lambert Nguyen Company',
            'company_name' => 'Lambert Nguyen Company',
            'contacts' => $contacts,
            'company_info' => [
                'address' => '123 Technology Drive, San Jose, CA 95110',
                'phone' => '+1 (408) 555-0123',
                'email' => 'info@lambertnguyen.com',
                'hours' => 'Monday - Friday: 9:00 AM - 6:00 PM PST',
                'website' => 'www.lambertnguyen.com'
            ],
            'offices' => [
                [
                    'city' => 'San Jose, CA',
                    'address' => '123 Technology Drive, San Jose, CA 95110',
                    'phone' => '+1 (408) 555-0123',
                    'type' => 'Headquarters'
                ],
                [
                    'city' => 'San Francisco, CA',
                    'address' => '456 Innovation Way, San Francisco, CA 94105',
                    'phone' => '+1 (415) 555-0124',
                    'type' => 'Branch Office'
                ],
                [
                    'city' => 'Seattle, WA',
                    'address' => '789 Tech Center, Seattle, WA 98101',
                    'phone' => '+1 (206) 555-0125',
                    'type' => 'Branch Office'
                ]
            ]
        ];
        
        $this->render('company/contacts', $data);
    }
}