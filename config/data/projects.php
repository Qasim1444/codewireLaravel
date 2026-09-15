<?php

return array (
  'featuredProjects' => 
  array (
    0 => 
    array (
      'slug' => 'chefshub',
      'name' => 'ChefsHub',
      'category' => 'Web Applications',
      'industry' => 'Food & Hospitality',
      'image' => '/images/chefshub.jpeg',
      'tech' =>
      array (
        0 => 'Laravel',
        1 => 'PHP',
        2 => 'MySQL',
        3 => 'Vue.js',
        4 => 'Nuxt.js',
        5 => 'Flutter',
      ),
      'liveUrl' => 'https://chefshub.site/Api_z/public/en',
      'summary' => 'ChefsHub is a full-stack platform connecting chefs with suppliers, offering a Laravel-powered backend API, public website, supplier and chef admin panels, a Nuxt.js-based admin dashboard, and a native Flutter mobile app.',
      'challenge' => 'The client needed one backend to power four very different experiences — a public website, supplier and chef admin panels, a platform-wide admin dashboard, and a native mobile app — without duplicating business logic or compromising on scale.',
      'solution' => 'We built a Laravel 11 + Sanctum backend exposing separate route groups per client (api.php, ChefMobileApi.php, ChefAdminApi.php, AdminApi.php, web/site/supplier routes), paired with a Vue.js/Vite public site, a Nuxt.js admin SPA, and a Flutter mobile app for chefs and users — covering everything from recipes, courses and a marketplace to wallets, WhatsApp messaging and Stripe payments.',
      'results' =>
      array (
        0 => 'One Laravel backend powering web, admin, supplier and mobile clients',
        1 => 'Native Flutter app (iOS & Android) on a dedicated Sanctum-authenticated Mobile API',
        2 => 'Full marketplace: product catalog, cart, orders, promo codes, Stripe checkout',
        3 => 'Training courses with scheduled sessions, bookings and payments',
        4 => 'WhatsApp integration, push notifications (FCM) and templated email',
        5 => 'Admin panel with activity/audit logging, moderation and system-wide settings',
      ),
      'featureGroups' =>
      array (
        0 =>
        array (
          'title' => 'User Accounts',
          'items' =>
          array (
            0 => 'Email/social login, OTP verification, password reset, EULA acceptance',
            1 => 'Profile management, account deletion',
            2 => 'Wallet with transaction history',
            3 => 'Multi-address book (city/district selection)',
            4 => 'Push notification token management',
          ),
        ),
        1 =>
        array (
          'title' => 'Chef Features',
          'items' =>
          array (
            0 => 'Public chef directory & profile pages',
            1 => '"Chef of the Month" spotlight',
            2 => 'Follow/unfollow, bookmarking',
            3 => 'Chef-managed content via dedicated admin/mobile APIs',
          ),
        ),
        2 =>
        array (
          'title' => 'Recipes & Content',
          'items' =>
          array (
            0 => 'Meals with "Meal of the Month"',
            1 => 'Step-by-step tutorials (steps, ingredients, delivery images/videos)',
            2 => 'Social posts with images, nested comments, likes/dislikes',
            3 => 'Video content (FFmpeg processing)',
            4 => 'Regional & general cuisine tagging',
            5 => 'Ingredient database with per-user allergy/dislike tracking and dietary preferences',
            6 => 'Likes, shares, views tracking; content reporting/moderation',
          ),
        ),
        3 =>
        array (
          'title' => 'Marketplace',
          'items' =>
          array (
            0 => 'Product catalog with variations & images',
            1 => 'Cart system (box-based ordering) and order management',
            2 => 'Promo codes and Stripe checkout with payment redirect handling',
            3 => 'Supplier panel for product/order management',
          ),
        ),
        4 =>
        array (
          'title' => 'Training Courses',
          'items' =>
          array (
            0 => 'Course catalog, categories & category types/values',
            1 => 'Scheduled course sessions',
            2 => 'Course bookings & payments',
            3 => '"My Courses" enrollment view',
          ),
        ),
        5 =>
        array (
          'title' => 'Communication',
          'items' =>
          array (
            0 => 'WhatsApp integration with error handling',
            1 => 'Transactional/templated email (welcome, OTP, password reset)',
            2 => 'Admin-to-chef direct messaging',
            3 => 'Contact Us form',
          ),
        ),
        6 =>
        array (
          'title' => 'Admin & Platform Management',
          'items' =>
          array (
            0 => 'Full admin panel: users, chefs, suppliers, content moderation',
            1 => 'Activity/audit logging',
            2 => 'System parameters & app settings',
            3 => 'Banners & search banners (promo content)',
            4 => 'Terms & Conditions management',
            5 => 'Reference/config data management',
            6 => 'Time slot management for bookings/deliveries',
          ),
        ),
      ),
      'architectureHighlights' =>
      array (
        0 => 'Four experiences, one backend: Backend API (Flutter + web clients), Public Website (Laravel Blade), Supplier Panel, Chef Admin Panel, a Nuxt.js Admin Panel, and a Flutter mobile app',
        1 => 'Route separation per client: api.php, ChefMobileApi.php, ChefAdminApi.php, AdminApi.php, and web.php/site.php/supplier.php for Blade routes',
        2 => 'Laravel Sanctum token auth for the API/mobile clients, with Laravel Socialite for OAuth/social login',
        3 => 'AWS S3 + Cloudflare R2 for file storage, FFmpeg for video processing, Intervention Image for images',
        4 => 'Spatie Activity Log for audit trails; Firebase Cloud Messaging for push notifications',
        5 => 'Laravel queue workers & Artisan scheduler on a self-managed VPS, with Nginx/Apache reverse proxy',
      ),
      'techTable' =>
      array (
        0 => array ('layer' => 'Backend', 'technology' => 'Laravel 11.x, PHP 8.1+, MySQL 8.0+'),
        1 => array ('layer' => 'Auth', 'technology' => 'Laravel Sanctum, Laravel Socialite'),
        2 => array ('layer' => 'Storage & media', 'technology' => 'AWS S3, Cloudflare R2, FFmpeg, Intervention Image'),
        3 => array ('layer' => 'Payments', 'technology' => 'Stripe'),
        4 => array ('layer' => 'Notifications', 'technology' => 'Firebase Cloud Messaging, WhatsApp integration'),
        5 => array ('layer' => 'Mobile', 'technology' => 'Flutter (iOS & Android), Sanctum-authenticated Mobile API'),
        6 => array ('layer' => 'Web frontend', 'technology' => 'Vite 4.x, Vue.js 3, Tailwind CSS 3.x, Pinia'),
        7 => array ('layer' => 'Admin panel', 'technology' => 'Nuxt.js SPA (staging & production)'),
        8 => array ('layer' => 'Infrastructure', 'technology' => 'Self-managed VPS, Nginx/Apache, Composer + NPM pipeline, queue workers & scheduler'),
      ),
      'outcome' => 'A single Laravel backend cleanly serving four distinct experiences — public web, supplier and chef admin panels, a Nuxt.js admin dashboard, and a native Flutter app — with a full marketplace, training courses and communication tooling built in.',
      'featured' => true,
    ),
    1 => 
    array (
      'slug' => 'project360ai',
      'name' => 'Project360 AI',
      'category' => 'AI & Automation',
      'industry' => 'AI / SaaS',
      'image' => '/images/project360.jpeg',
      'tech' => 
      array (
        0 => 'Python',
        1 => 'OpenAI',
        2 => 'React',
        3 => 'Node.js',
        4 => 'AWS',
      ),
      'liveUrl' => 'https://project360ai.com',
      'summary' => 'An AI-powered project management platform that automates planning, tracking and reporting for modern teams.',
      'challenge' => 'Teams were wasting hours on manual status updates, reports and task prioritization across disconnected tools.',
      'solution' => 'We built an intelligent platform with AI-driven task suggestions, auto-generated progress reports and real-time collaboration — all in one dashboard.',
      'results' => 
      array (
        0 => 'AI-assisted planning',
        1 => 'Automated reporting',
        2 => 'Faster project delivery',
      ),
      'featured' => true,
    ),
    2 => 
    array (
      'slug' => 'coolbuffs',
      'name' => 'CoolBuffs — AI-Powered Recruitment Platform',
      'category' => 'AI & Automation',
      'industry' => 'Recruitment / HR Tech',
      'image' => '/images/coolbuffs.jpeg',
      'tech' =>
      array (
        0 => 'Laravel',
        1 => 'Vue.js',
        2 => 'Python (FastAPI)',
        3 => 'MySQL',
        4 => 'Redis',
      ),
      'liveUrl' => 'https://coolbuffs.com/',
      'summary' => 'CoolBuffs is a full-scale job board and recruitment platform serving three user types — job seekers, employers, and platform admins — with a custom-built AI assistant layered on top to help visitors get instant answers about the platform.',
      'challenge' => 'Traditional job boards make users dig through FAQs, pricing pages, and dashboards to find answers. CoolBuffs solves this with a site-wide AI chatbot that understands the platform\'s own documentation and can answer visitor questions in real time — while the core job-matching experience handles the actual hiring workflow end-to-end.',
      'solution' => 'We built a multi-role Laravel + Vue.js job board with a custom-built, RAG-powered AI assistant layered on top — a decoupled Python/FastAPI microservice that answers using content from documents uploaded into the platform\'s own knowledge base, not just generic LLM knowledge, detects who\'s chatting (guest, job seeker or employer), and streams responses in real time.',
      'results' =>
      array (
        0 => 'Custom RAG-based AI chatbot (not a third-party plugin)',
        1 => 'Swappable AI provider layer: Gemini, OpenAI, Anthropic, OpenRouter, Ollama',
        2 => 'Local FAISS vector search — no third-party vector DB lock-in',
        3 => 'Redis-backed rate limiting with full usage logging',
        4 => 'Admin AI control panel with health checks, reindexing and token-usage analytics',
        5 => 'Multi-gateway checkout: Stripe, PayPal, PayU',
      ),
      'featureGroups' =>
      array (
        0 =>
        array (
          'title' => 'For Job Seekers',
          'items' =>
          array (
            0 => 'Rich candidate profile builder: education history, work experience, languages, skills, portfolio projects, and profile summary',
            1 => 'CV/resume upload with an in-app resume builder tool',
            2 => 'Job search with filters by industry, functional area, career level, job type, shift, and location',
            3 => 'Save/favourite jobs and companies',
            4 => 'Direct messaging with employers and applicant status tracking',
          ),
        ),
        1 =>
        array (
          'title' => 'For Employers',
          'items' =>
          array (
            0 => 'Company profile pages with logo, branding, and details',
            1 => 'Post and manage job listings',
            2 => 'Browse, favourite, and message candidates',
            3 => 'Paid promotion: ad packages and subscription tiers to boost job visibility',
            4 => 'Multi-gateway checkout: Stripe, PayPal, and PayU',
          ),
        ),
        2 =>
        array (
          'title' => 'AI Chatbot (custom-built, not a third-party plugin)',
          'items' =>
          array (
            0 => 'Retrieval-Augmented Generation (RAG) architecture: the bot answers using content from documents uploaded into the platform\'s own knowledge base, not just generic LLM knowledge',
            1 => 'Detects who\'s chatting (guest, job seeker, or employer) and tailors responses accordingly',
            2 => 'Real-time streaming responses (answers appear word-by-word, like ChatGPT)',
            3 => 'Built-in safety: input length limits, prompt-injection resistance (ignores instructions hidden in uploaded files), and citations that only reveal document names — never internal file paths or raw content',
            4 => 'Redis-backed rate limiting so one visitor can\'t burn through the AI budget',
            5 => 'Full usage logging for every conversation',
          ),
        ),
        3 =>
        array (
          'title' => 'Admin Back Office',
          'items' =>
          array (
            0 => 'Manage every aspect of the platform: users, companies, jobs, taxonomies (industries, degree types, career levels, etc.), CMS pages, sliders, testimonials, SEO settings',
            1 => 'Dedicated AI Chatbot Control Panel: live health check of the AI service',
            2 => 'Upload/list/delete knowledge-base documents',
            3 => 'One-click reindex of the AI\'s search index',
            4 => 'Daily and monthly token usage graphs to track and control AI spend',
            5 => 'Toggle the chatbot widget on/off site-wide without touching code',
          ),
        ),
      ),
      'architectureHighlights' =>
      array (
        0 => 'Decoupled AI microservice: rather than bolting AI onto the main app, a separate Python (FastAPI) service handles all chatbot logic, keeping the core platform stable and letting the AI layer scale or fail independently',
        1 => 'Local vector search (FAISS): document embeddings are indexed and searched entirely in-house, avoiding third-party vector database costs and lock-in',
        2 => 'Swappable AI provider layer: the service supports Google Gemini, OpenAI, Anthropic, OpenRouter, or self-hosted Ollama models behind one interface — the platform isn\'t locked into a single AI vendor',
        3 => 'Cost-conscious design: output token caps, retry logic for provider outages, and usage dashboards were built specifically to keep AI operating costs predictable at scale',
        4 => 'Production hardening: systemd-managed service deployment, permission/storage isolation, and safe database migrations that never risk destroying existing data on rollback',
      ),
      'techTable' =>
      array (
        0 => array ('layer' => 'Backend framework', 'technology' => 'Laravel (PHP)'),
        1 => array ('layer' => 'Frontend', 'technology' => 'Vue.js, Bootstrap, jQuery'),
        2 => array ('layer' => 'AI microservice', 'technology' => 'Python, FastAPI'),
        3 => array ('layer' => 'AI/ML', 'technology' => 'Google Gemini, FAISS vector search, BAAI/bge-m3 embeddings'),
        4 => array ('layer' => 'Caching/rate-limiting', 'technology' => 'Redis'),
        5 => array ('layer' => 'Database', 'technology' => 'MySQL'),
        6 => array ('layer' => 'Payments', 'technology' => 'Stripe, PayPal, PayU'),
        7 => array ('layer' => 'Auth', 'technology' => 'Social login (via Socialite), email verification, reCAPTCHA'),
      ),
      'outcome' => 'A production job board with a genuinely differentiated feature — an in-house, cost-controlled AI assistant with its own admin analytics — rather than a bolt-on chat widget from a SaaS vendor.',
      'featured' => true,
    ),
  ),
  'projectCategories' =>
  array (
    0 => 'All',
    1 => 'Web Applications',
    2 => 'Mobile Apps',
    3 => 'E-commerce',
    4 => 'WordPress',
    5 => 'UI/UX',
    6 => 'AI & Automation',
  ),
  'projects' => 
  array (
    0 => 
    array (
      'slug' => 'chefshub',
      'name' => 'ChefsHub',
      'category' => 'Web Applications',
      'industry' => 'Food & Hospitality',
      'image' => '/images/chefshub.jpeg',
      'tech' =>
      array (
        0 => 'Laravel',
        1 => 'PHP',
        2 => 'MySQL',
        3 => 'Vue.js',
        4 => 'Nuxt.js',
        5 => 'Flutter',
      ),
      'liveUrl' => 'https://chefshub.site/Api_z/public/en',
      'summary' => 'ChefsHub is a full-stack platform connecting chefs with suppliers, offering a Laravel-powered backend API, public website, supplier and chef admin panels, a Nuxt.js-based admin dashboard, and a native Flutter mobile app.',
      'challenge' => 'The client needed one backend to power four very different experiences — a public website, supplier and chef admin panels, a platform-wide admin dashboard, and a native mobile app — without duplicating business logic or compromising on scale.',
      'solution' => 'We built a Laravel 11 + Sanctum backend exposing separate route groups per client (api.php, ChefMobileApi.php, ChefAdminApi.php, AdminApi.php, web/site/supplier routes), paired with a Vue.js/Vite public site, a Nuxt.js admin SPA, and a Flutter mobile app for chefs and users — covering everything from recipes, courses and a marketplace to wallets, WhatsApp messaging and Stripe payments.',
      'results' =>
      array (
        0 => 'One Laravel backend powering web, admin, supplier and mobile clients',
        1 => 'Native Flutter app (iOS & Android) on a dedicated Sanctum-authenticated Mobile API',
        2 => 'Full marketplace: product catalog, cart, orders, promo codes, Stripe checkout',
        3 => 'Training courses with scheduled sessions, bookings and payments',
        4 => 'WhatsApp integration, push notifications (FCM) and templated email',
        5 => 'Admin panel with activity/audit logging, moderation and system-wide settings',
      ),
      'featureGroups' =>
      array (
        0 =>
        array (
          'title' => 'User Accounts',
          'items' =>
          array (
            0 => 'Email/social login, OTP verification, password reset, EULA acceptance',
            1 => 'Profile management, account deletion',
            2 => 'Wallet with transaction history',
            3 => 'Multi-address book (city/district selection)',
            4 => 'Push notification token management',
          ),
        ),
        1 =>
        array (
          'title' => 'Chef Features',
          'items' =>
          array (
            0 => 'Public chef directory & profile pages',
            1 => '"Chef of the Month" spotlight',
            2 => 'Follow/unfollow, bookmarking',
            3 => 'Chef-managed content via dedicated admin/mobile APIs',
          ),
        ),
        2 =>
        array (
          'title' => 'Recipes & Content',
          'items' =>
          array (
            0 => 'Meals with "Meal of the Month"',
            1 => 'Step-by-step tutorials (steps, ingredients, delivery images/videos)',
            2 => 'Social posts with images, nested comments, likes/dislikes',
            3 => 'Video content (FFmpeg processing)',
            4 => 'Regional & general cuisine tagging',
            5 => 'Ingredient database with per-user allergy/dislike tracking and dietary preferences',
            6 => 'Likes, shares, views tracking; content reporting/moderation',
          ),
        ),
        3 =>
        array (
          'title' => 'Marketplace',
          'items' =>
          array (
            0 => 'Product catalog with variations & images',
            1 => 'Cart system (box-based ordering) and order management',
            2 => 'Promo codes and Stripe checkout with payment redirect handling',
            3 => 'Supplier panel for product/order management',
          ),
        ),
        4 =>
        array (
          'title' => 'Training Courses',
          'items' =>
          array (
            0 => 'Course catalog, categories & category types/values',
            1 => 'Scheduled course sessions',
            2 => 'Course bookings & payments',
            3 => '"My Courses" enrollment view',
          ),
        ),
        5 =>
        array (
          'title' => 'Communication',
          'items' =>
          array (
            0 => 'WhatsApp integration with error handling',
            1 => 'Transactional/templated email (welcome, OTP, password reset)',
            2 => 'Admin-to-chef direct messaging',
            3 => 'Contact Us form',
          ),
        ),
        6 =>
        array (
          'title' => 'Admin & Platform Management',
          'items' =>
          array (
            0 => 'Full admin panel: users, chefs, suppliers, content moderation',
            1 => 'Activity/audit logging',
            2 => 'System parameters & app settings',
            3 => 'Banners & search banners (promo content)',
            4 => 'Terms & Conditions management',
            5 => 'Reference/config data management',
            6 => 'Time slot management for bookings/deliveries',
          ),
        ),
      ),
      'architectureHighlights' =>
      array (
        0 => 'Four experiences, one backend: Backend API (Flutter + web clients), Public Website (Laravel Blade), Supplier Panel, Chef Admin Panel, a Nuxt.js Admin Panel, and a Flutter mobile app',
        1 => 'Route separation per client: api.php, ChefMobileApi.php, ChefAdminApi.php, AdminApi.php, and web.php/site.php/supplier.php for Blade routes',
        2 => 'Laravel Sanctum token auth for the API/mobile clients, with Laravel Socialite for OAuth/social login',
        3 => 'AWS S3 + Cloudflare R2 for file storage, FFmpeg for video processing, Intervention Image for images',
        4 => 'Spatie Activity Log for audit trails; Firebase Cloud Messaging for push notifications',
        5 => 'Laravel queue workers & Artisan scheduler on a self-managed VPS, with Nginx/Apache reverse proxy',
      ),
      'techTable' =>
      array (
        0 => array ('layer' => 'Backend', 'technology' => 'Laravel 11.x, PHP 8.1+, MySQL 8.0+'),
        1 => array ('layer' => 'Auth', 'technology' => 'Laravel Sanctum, Laravel Socialite'),
        2 => array ('layer' => 'Storage & media', 'technology' => 'AWS S3, Cloudflare R2, FFmpeg, Intervention Image'),
        3 => array ('layer' => 'Payments', 'technology' => 'Stripe'),
        4 => array ('layer' => 'Notifications', 'technology' => 'Firebase Cloud Messaging, WhatsApp integration'),
        5 => array ('layer' => 'Mobile', 'technology' => 'Flutter (iOS & Android), Sanctum-authenticated Mobile API'),
        6 => array ('layer' => 'Web frontend', 'technology' => 'Vite 4.x, Vue.js 3, Tailwind CSS 3.x, Pinia'),
        7 => array ('layer' => 'Admin panel', 'technology' => 'Nuxt.js SPA (staging & production)'),
        8 => array ('layer' => 'Infrastructure', 'technology' => 'Self-managed VPS, Nginx/Apache, Composer + NPM pipeline, queue workers & scheduler'),
      ),
      'outcome' => 'A single Laravel backend cleanly serving four distinct experiences — public web, supplier and chef admin panels, a Nuxt.js admin dashboard, and a native Flutter app — with a full marketplace, training courses and communication tooling built in.',
      'featured' => true,
    ),
    1 => 
    array (
      'slug' => 'project360ai',
      'name' => 'Project360 AI',
      'category' => 'AI & Automation',
      'industry' => 'AI / SaaS',
      'image' => '/images/project360.jpeg',
      'tech' => 
      array (
        0 => 'Python',
        1 => 'OpenAI',
        2 => 'React',
        3 => 'Node.js',
        4 => 'AWS',
      ),
      'liveUrl' => 'https://project360ai.com',
      'summary' => 'An AI-powered project management platform that automates planning, tracking and reporting for modern teams.',
      'challenge' => 'Teams were wasting hours on manual status updates, reports and task prioritization across disconnected tools.',
      'solution' => 'We built an intelligent platform with AI-driven task suggestions, auto-generated progress reports and real-time collaboration — all in one dashboard.',
      'results' => 
      array (
        0 => 'AI-assisted planning',
        1 => 'Automated reporting',
        2 => 'Faster project delivery',
      ),
      'featured' => true,
    ),
    2 => 
    array (
      'slug' => 'coolbuffs',
      'name' => 'CoolBuffs — AI-Powered Recruitment Platform',
      'category' => 'AI & Automation',
      'industry' => 'Recruitment / HR Tech',
      'image' => '/images/coolbuffs.jpeg',
      'tech' =>
      array (
        0 => 'Laravel',
        1 => 'Vue.js',
        2 => 'Python (FastAPI)',
        3 => 'MySQL',
        4 => 'Redis',
      ),
      'liveUrl' => 'https://coolbuffs.com/',
      'summary' => 'CoolBuffs is a full-scale job board and recruitment platform serving three user types — job seekers, employers, and platform admins — with a custom-built AI assistant layered on top to help visitors get instant answers about the platform.',
      'challenge' => 'Traditional job boards make users dig through FAQs, pricing pages, and dashboards to find answers. CoolBuffs solves this with a site-wide AI chatbot that understands the platform\'s own documentation and can answer visitor questions in real time — while the core job-matching experience handles the actual hiring workflow end-to-end.',
      'solution' => 'We built a multi-role Laravel + Vue.js job board with a custom-built, RAG-powered AI assistant layered on top — a decoupled Python/FastAPI microservice that answers using content from documents uploaded into the platform\'s own knowledge base, not just generic LLM knowledge, detects who\'s chatting (guest, job seeker or employer), and streams responses in real time.',
      'results' =>
      array (
        0 => 'Custom RAG-based AI chatbot (not a third-party plugin)',
        1 => 'Swappable AI provider layer: Gemini, OpenAI, Anthropic, OpenRouter, Ollama',
        2 => 'Local FAISS vector search — no third-party vector DB lock-in',
        3 => 'Redis-backed rate limiting with full usage logging',
        4 => 'Admin AI control panel with health checks, reindexing and token-usage analytics',
        5 => 'Multi-gateway checkout: Stripe, PayPal, PayU',
      ),
      'featureGroups' =>
      array (
        0 =>
        array (
          'title' => 'For Job Seekers',
          'items' =>
          array (
            0 => 'Rich candidate profile builder: education history, work experience, languages, skills, portfolio projects, and profile summary',
            1 => 'CV/resume upload with an in-app resume builder tool',
            2 => 'Job search with filters by industry, functional area, career level, job type, shift, and location',
            3 => 'Save/favourite jobs and companies',
            4 => 'Direct messaging with employers and applicant status tracking',
          ),
        ),
        1 =>
        array (
          'title' => 'For Employers',
          'items' =>
          array (
            0 => 'Company profile pages with logo, branding, and details',
            1 => 'Post and manage job listings',
            2 => 'Browse, favourite, and message candidates',
            3 => 'Paid promotion: ad packages and subscription tiers to boost job visibility',
            4 => 'Multi-gateway checkout: Stripe, PayPal, and PayU',
          ),
        ),
        2 =>
        array (
          'title' => 'AI Chatbot (custom-built, not a third-party plugin)',
          'items' =>
          array (
            0 => 'Retrieval-Augmented Generation (RAG) architecture: the bot answers using content from documents uploaded into the platform\'s own knowledge base, not just generic LLM knowledge',
            1 => 'Detects who\'s chatting (guest, job seeker, or employer) and tailors responses accordingly',
            2 => 'Real-time streaming responses (answers appear word-by-word, like ChatGPT)',
            3 => 'Built-in safety: input length limits, prompt-injection resistance (ignores instructions hidden in uploaded files), and citations that only reveal document names — never internal file paths or raw content',
            4 => 'Redis-backed rate limiting so one visitor can\'t burn through the AI budget',
            5 => 'Full usage logging for every conversation',
          ),
        ),
        3 =>
        array (
          'title' => 'Admin Back Office',
          'items' =>
          array (
            0 => 'Manage every aspect of the platform: users, companies, jobs, taxonomies (industries, degree types, career levels, etc.), CMS pages, sliders, testimonials, SEO settings',
            1 => 'Dedicated AI Chatbot Control Panel: live health check of the AI service',
            2 => 'Upload/list/delete knowledge-base documents',
            3 => 'One-click reindex of the AI\'s search index',
            4 => 'Daily and monthly token usage graphs to track and control AI spend',
            5 => 'Toggle the chatbot widget on/off site-wide without touching code',
          ),
        ),
      ),
      'architectureHighlights' =>
      array (
        0 => 'Decoupled AI microservice: rather than bolting AI onto the main app, a separate Python (FastAPI) service handles all chatbot logic, keeping the core platform stable and letting the AI layer scale or fail independently',
        1 => 'Local vector search (FAISS): document embeddings are indexed and searched entirely in-house, avoiding third-party vector database costs and lock-in',
        2 => 'Swappable AI provider layer: the service supports Google Gemini, OpenAI, Anthropic, OpenRouter, or self-hosted Ollama models behind one interface — the platform isn\'t locked into a single AI vendor',
        3 => 'Cost-conscious design: output token caps, retry logic for provider outages, and usage dashboards were built specifically to keep AI operating costs predictable at scale',
        4 => 'Production hardening: systemd-managed service deployment, permission/storage isolation, and safe database migrations that never risk destroying existing data on rollback',
      ),
      'techTable' =>
      array (
        0 => array ('layer' => 'Backend framework', 'technology' => 'Laravel (PHP)'),
        1 => array ('layer' => 'Frontend', 'technology' => 'Vue.js, Bootstrap, jQuery'),
        2 => array ('layer' => 'AI microservice', 'technology' => 'Python, FastAPI'),
        3 => array ('layer' => 'AI/ML', 'technology' => 'Google Gemini, FAISS vector search, BAAI/bge-m3 embeddings'),
        4 => array ('layer' => 'Caching/rate-limiting', 'technology' => 'Redis'),
        5 => array ('layer' => 'Database', 'technology' => 'MySQL'),
        6 => array ('layer' => 'Payments', 'technology' => 'Stripe, PayPal, PayU'),
        7 => array ('layer' => 'Auth', 'technology' => 'Social login (via Socialite), email verification, reCAPTCHA'),
      ),
      'outcome' => 'A production job board with a genuinely differentiated feature — an in-house, cost-controlled AI assistant with its own admin analytics — rather than a bolt-on chat widget from a SaaS vendor.',
      'featured' => true,
    ),
    3 =>
    array (
      'slug' => 'brokerconvalor',
      'name' => 'Broker Con Valor',
      'category' => 'Web Applications',
      'industry' => 'Finance / Real Estate',
      'image' => '/images/brokerconvalor.jpeg',
      'tech' => 
      array (
        0 => 'WordPress',
        1 => 'PHP',
        2 => 'JavaScript',
        3 => 'CSS',
      ),
      'liveUrl' => 'https://brokerconvalor.it',
      'summary' => 'A professional brokerage and real estate advisory website for an Italian financial services firm.',
      'challenge' => 'The client needed a clean, trustworthy web presence in Italian that clearly communicated their financial and real estate services to high-value clients.',
      'solution' => 'We built a polished multilingual WordPress site with service pages, lead capture forms and SEO optimization targeting the Italian market.',
      'results' => 
      array (
        0 => 'Professional brand presence',
        1 => 'Lead generation ready',
        2 => 'SEO optimized for Italy',
      ),
      'featured' => false,
    ),
    4 => 
    array (
      'slug' => 'pro1-platform',
      'name' => 'Healthy Food',
      'category' => 'Web Applications',
      'industry' => 'Technology',
      'image' => '/images/pro1.jpeg',
      'tech' => 
      array (
        0 => 'React',
        1 => 'Node.js',
        2 => 'MongoDB',
        3 => 'Tailwind CSS',
      ),
      'liveUrl' => '#',
      'summary' => 'A modern web platform built for a tech-forward business, featuring a clean UI, fast performance and scalable architecture.',
      'challenge' => 'The client needed a robust, maintainable web application that could grow with their business and provide an excellent user experience from day one.',
      'solution' => 'We architected a full-stack React + Node.js application with a component-driven frontend, RESTful API and cloud-ready infrastructure.',
      'results' => 
      array (
        0 => 'Sub-2s load time',
        1 => 'Scalable cloud architecture',
        2 => 'Clean component system',
      ),
      'featured' => false,
    ),
  ),
);
