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
        0 => 'Laravel',
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
      'slug' => 'careox-v2',
      'name' => 'CareOX v2',
      'category' => 'Web Applications',
      'industry' => 'Logistics / Warehouse & Fulfilment',
      'image' => '/images/careox.png',
      'tech' =>
      array (
        0 => 'Laravel',
        1 => 'Vue.js',
        2 => 'Inertia.js',
        3 => 'Tailwind CSS',
        4 => 'Docker',
      ),
      'liveUrl' => '#',
      'summary' => 'CareOX v2 is a multi-tenant order fulfilment and warehouse management platform that lets a company manage its entire operations pipeline — from sales orders to shipment — in one system.',
      'challenge' => 'Fulfilment businesses needed one system to run warehouse operations, multi-channel orders, CRM, finance and email — instead of stitching together spreadsheets and disconnected tools across multiple client companies.',
      'solution' => 'We built a Laravel 8 + Inertia/Vue 3 ERP-style platform with Admin, Super Admin and Fulfilment roles, a full physical warehouse hierarchy (Warehouse, Building, Aisle, Bay, Bin, Container), order/fulfilment/shipment workflows, direct marketplace integrations, built-in CRM and finance modules, and an in-app email client with IMAP support.',
      'results' =>
      array (
        0 => 'Full warehouse hierarchy: Warehouse, Building, Aisle, Bay, Bin, Container, Stock',
        1 => 'Multi-tenant company/admin/super-admin role management',
        2 => 'Direct sales-channel integrations: Amazon, Groupon, Wowcher, Gogroopie, Ejogga, Xstreamgym',
        3 => 'Built-in CRM: customers, beneficiaries, deals, quotations, cases',
        4 => 'Finance suite: invoices, payments, payment gateways, currency exchange, payroll',
        5 => 'In-app email client (Inbox, Sent, Trash, Junk) with IMAP integration',
      ),
      'featureGroups' =>
      array (
        0 =>
        array (
          'title' => 'User & Access Management',
          'items' =>
          array (
            0 => 'Admin, Super Admin and Fulfilment roles with granular permissions',
            1 => 'Multi-tenant onboarding and management of multiple client companies',
          ),
        ),
        1 =>
        array (
          'title' => 'Warehouse Operations',
          'items' =>
          array (
            0 => 'Full physical warehouse hierarchy: Warehouse, Building, Aisle, Bay, Bin, Container',
            1 => 'Stock management and stock logs/adjustments',
          ),
        ),
        2 =>
        array (
          'title' => 'Orders & Fulfilment',
          'items' =>
          array (
            0 => 'Orders, Fulfilment Orders, Purchase Orders',
            1 => 'Deliveries, Shipments and Shipment Items tracking',
          ),
        ),
        3 =>
        array (
          'title' => 'Sales Channel Integrations',
          'items' =>
          array (
            0 => 'Direct integrations with Amazon, Groupon, Wowcher, Gogroopie, Ejogga and Xstreamgym marketplaces',
          ),
        ),
        4 =>
        array (
          'title' => 'Product & Inventory',
          'items' =>
          array (
            0 => 'Products, product stock and product titles',
            1 => 'Spare parts management',
          ),
        ),
        5 =>
        array (
          'title' => 'CRM & Customer Tools',
          'items' =>
          array (
            0 => 'Customers, beneficiaries, deals and quotations',
            1 => 'Support/case tracking with notes',
          ),
        ),
        6 =>
        array (
          'title' => 'Finance',
          'items' =>
          array (
            0 => 'Invoices and payments with multiple payment gateways',
            1 => 'Currency exchange, payroll and salaries',
          ),
        ),
        7 =>
        array (
          'title' => 'Email Suite',
          'items' =>
          array (
            0 => 'Built-in email client: Inbox, Sent, Trash, Junk',
            1 => 'Email accounts/settings with IMAP integration',
          ),
        ),
        8 =>
        array (
          'title' => 'Reporting & Document Handling',
          'items' =>
          array (
            0 => 'Activity logs, notifications, calendar and reviews API',
            1 => 'PDF generation, Excel import/export and document storage/zipping',
          ),
        ),
      ),
      'architectureHighlights' =>
      array (
        0 => 'Laravel 8 backend with Jetstream and Sanctum, Inertia-Laravel bridging to a Vue 3 SPA-style frontend',
        1 => 'Vue 3 + Inertia.js + Tailwind CSS frontend with ApexCharts for dashboards and FullCalendar for scheduling',
        2 => 'Docker/docker-compose for local and deployment environments, with Bitbucket Pipelines CI/CD',
        3 => 'dompdf for PDF generation and Maatwebsite Excel for import/export across finance and reporting modules',
      ),
      'techTable' =>
      array (
        0 => array ('layer' => 'Backend', 'technology' => 'PHP 8, Laravel 8, Jetstream, Sanctum'),
        1 => array ('layer' => 'Frontend', 'technology' => 'Vue 3, Inertia.js, Tailwind CSS'),
        2 => array ('layer' => 'Data & charts', 'technology' => 'ApexCharts, FullCalendar'),
        3 => array ('layer' => 'Documents', 'technology' => 'dompdf, Maatwebsite Excel'),
        4 => array ('layer' => 'Infrastructure', 'technology' => 'Docker, docker-compose, Bitbucket Pipelines'),
      ),
      'outcome' => 'A single multi-tenant platform covering warehouse operations, order fulfilment, CRM, finance and email — replacing disconnected spreadsheets and tools with one unified operations pipeline.',
      'featured' => true,
    ),
    4 =>
    array (
      'slug' => 'xstream-gym',
      'name' => 'XStream Gym',
      'category' => 'Web Applications',
      'industry' => 'Fitness / Health & Wellness',
      'image' => '/images/XStream Gym.png',
      'tech' =>
      array (
        0 => 'Laravel',
        1 => 'Inertia.js',
        2 => 'Vue.js',
        3 => 'WebSocket',
        4 => 'Redis',
        5 => 'Stripe',
      ),
      'liveUrl' => '#',
      'summary' => 'XStream Gym is a full-stack fitness platform that connects certified trainers with members through live-streamed and on-demand workout classes, built with Laravel and Inertia.js.',
      'challenge' => 'The client wanted a single platform that could stream live fitness classes in real time, run a trainer marketplace with scheduling and payouts, track member health and nutrition, and keep members socially engaged — all under one role-based admin system.',
      'solution' => 'We built a Laravel + Inertia.js platform with a WebSocket/Redis streaming backend for live classes (with class series, comments and attendance tracking), a trainer marketplace with profiles, schedules and reviews, Stripe-powered subscriptions and trainer payouts, integrated diet/nutrition and wearable-device tracking, social features (friends, messaging, likes, notifications), and a role-based admin dashboard covering users, trainers, classes, payments and disputes.',
      'results' =>
      array (
        0 => 'Real-time live class streaming via WebSocket/Redis with class series and attendance tracking',
        1 => 'Trainer marketplace with profiles, schedules, class management and reviews',
        2 => 'Stripe-powered tiered subscriptions, trainer payouts and bank/withdrawal management',
        3 => 'Health & nutrition tracking with diet plans, meal logging and wearable device sync',
        4 => 'Social features: friend connections, messaging, likes and notifications',
        5 => 'Role-based admin dashboard for users, trainers, classes, payments and disputes/cases',
      ),
      'featureGroups' =>
      array (
        0 =>
        array (
          'title' => 'Live Class Streaming',
          'items' =>
          array (
            0 => 'Real-time video classes powered by a WebSocket/Redis streaming backend',
            1 => 'Class series scheduling with live and on-demand playback',
            2 => 'In-class comments and live attendance tracking',
          ),
        ),
        1 =>
        array (
          'title' => 'Trainer Marketplace',
          'items' =>
          array (
            0 => 'Trainer profiles with certifications and specialties',
            1 => 'Class scheduling and management tools for trainers',
            2 => 'Member reviews and ratings',
          ),
        ),
        2 =>
        array (
          'title' => 'Subscriptions & Payments',
          'items' =>
          array (
            0 => 'Tiered membership packages/plans',
            1 => 'Stripe-powered billing and checkout',
            2 => 'Trainer payouts with bank account and withdrawal management',
          ),
        ),
        3 =>
        array (
          'title' => 'Health & Nutrition Tracking',
          'items' =>
          array (
            0 => 'Integrated diet plans and meal/food logging',
            1 => 'Wearable device sync: heart rate, sleep and weight',
            2 => 'Progress tracking over time',
          ),
        ),
        4 =>
        array (
          'title' => 'Social Features',
          'items' =>
          array (
            0 => 'Friend connections and direct messaging',
            1 => 'Likes and engagement notifications',
            2 => 'Activity feed to keep members connected',
          ),
        ),
        5 =>
        array (
          'title' => 'Admin Dashboard',
          'items' =>
          array (
            0 => 'Role-based admin panel for users, trainers and classes',
            1 => 'Payment and payout oversight',
            2 => 'Disputes/cases management and platform settings',
          ),
        ),
      ),
      'architectureHighlights' =>
      array (
        0 => 'Laravel backend with Inertia.js bridging to a Vue.js SPA-style frontend for a seamless single-page experience',
        1 => 'WebSocket/Redis streaming backend powering real-time live class video, comments and attendance',
        2 => 'Stripe integration for tiered subscriptions, one-off billing and trainer payout/withdrawal flows',
        3 => 'Role-based access control separating member, trainer and admin experiences within one codebase',
      ),
      'techTable' =>
      array (
        0 => array ('layer' => 'Backend', 'technology' => 'Laravel (PHP)'),
        1 => array ('layer' => 'Frontend', 'technology' => 'Inertia.js, Vue.js'),
        2 => array ('layer' => 'Real-time streaming', 'technology' => 'WebSocket, Redis'),
        3 => array ('layer' => 'Payments', 'technology' => 'Stripe (subscriptions, billing, payouts)'),
        4 => array ('layer' => 'Health data', 'technology' => 'Wearable device sync (heart rate, sleep, weight)'),
      ),
      'outcome' => 'A unified fitness platform where members stream live and on-demand classes, track their health, and stay socially engaged, while trainers run their own marketplace presence and get paid — all managed through one role-based admin dashboard.',
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
        0 => 'Laravel',
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
        0 => 'Laravel',
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
    5 =>
    array (
      'slug' => 'careox-v2',
      'name' => 'CareOX v2',
      'category' => 'Web Applications',
      'industry' => 'Logistics / Warehouse & Fulfilment',
      'image' => '/images/careox.png',
      'tech' =>
      array (
        0 => 'Laravel',
        1 => 'Vue.js',
        2 => 'Inertia.js',
        3 => 'Tailwind CSS',
        4 => 'Docker',
      ),
      'liveUrl' => '#',
      'summary' => 'CareOX v2 is a multi-tenant order fulfilment and warehouse management platform that lets a company manage its entire operations pipeline — from sales orders to shipment — in one system.',
      'challenge' => 'Fulfilment businesses needed one system to run warehouse operations, multi-channel orders, CRM, finance and email — instead of stitching together spreadsheets and disconnected tools across multiple client companies.',
      'solution' => 'We built a Laravel 8 + Inertia/Vue 3 ERP-style platform with Admin, Super Admin and Fulfilment roles, a full physical warehouse hierarchy (Warehouse, Building, Aisle, Bay, Bin, Container), order/fulfilment/shipment workflows, direct marketplace integrations, built-in CRM and finance modules, and an in-app email client with IMAP support.',
      'results' =>
      array (
        0 => 'Full warehouse hierarchy: Warehouse, Building, Aisle, Bay, Bin, Container, Stock',
        1 => 'Multi-tenant company/admin/super-admin role management',
        2 => 'Direct sales-channel integrations: Amazon, Groupon, Wowcher, Gogroopie, Ejogga, Xstreamgym',
        3 => 'Built-in CRM: customers, beneficiaries, deals, quotations, cases',
        4 => 'Finance suite: invoices, payments, payment gateways, currency exchange, payroll',
        5 => 'In-app email client (Inbox, Sent, Trash, Junk) with IMAP integration',
      ),
      'featureGroups' =>
      array (
        0 =>
        array (
          'title' => 'User & Access Management',
          'items' =>
          array (
            0 => 'Admin, Super Admin and Fulfilment roles with granular permissions',
            1 => 'Multi-tenant onboarding and management of multiple client companies',
          ),
        ),
        1 =>
        array (
          'title' => 'Warehouse Operations',
          'items' =>
          array (
            0 => 'Full physical warehouse hierarchy: Warehouse, Building, Aisle, Bay, Bin, Container',
            1 => 'Stock management and stock logs/adjustments',
          ),
        ),
        2 =>
        array (
          'title' => 'Orders & Fulfilment',
          'items' =>
          array (
            0 => 'Orders, Fulfilment Orders, Purchase Orders',
            1 => 'Deliveries, Shipments and Shipment Items tracking',
          ),
        ),
        3 =>
        array (
          'title' => 'Sales Channel Integrations',
          'items' =>
          array (
            0 => 'Direct integrations with Amazon, Groupon, Wowcher, Gogroopie, Ejogga and Xstreamgym marketplaces',
          ),
        ),
        4 =>
        array (
          'title' => 'Product & Inventory',
          'items' =>
          array (
            0 => 'Products, product stock and product titles',
            1 => 'Spare parts management',
          ),
        ),
        5 =>
        array (
          'title' => 'CRM & Customer Tools',
          'items' =>
          array (
            0 => 'Customers, beneficiaries, deals and quotations',
            1 => 'Support/case tracking with notes',
          ),
        ),
        6 =>
        array (
          'title' => 'Finance',
          'items' =>
          array (
            0 => 'Invoices and payments with multiple payment gateways',
            1 => 'Currency exchange, payroll and salaries',
          ),
        ),
        7 =>
        array (
          'title' => 'Email Suite',
          'items' =>
          array (
            0 => 'Built-in email client: Inbox, Sent, Trash, Junk',
            1 => 'Email accounts/settings with IMAP integration',
          ),
        ),
        8 =>
        array (
          'title' => 'Reporting & Document Handling',
          'items' =>
          array (
            0 => 'Activity logs, notifications, calendar and reviews API',
            1 => 'PDF generation, Excel import/export and document storage/zipping',
          ),
        ),
      ),
      'architectureHighlights' =>
      array (
        0 => 'Laravel 8 backend with Jetstream and Sanctum, Inertia-Laravel bridging to a Vue 3 SPA-style frontend',
        1 => 'Vue 3 + Inertia.js + Tailwind CSS frontend with ApexCharts for dashboards and FullCalendar for scheduling',
        2 => 'Docker/docker-compose for local and deployment environments, with Bitbucket Pipelines CI/CD',
        3 => 'dompdf for PDF generation and Maatwebsite Excel for import/export across finance and reporting modules',
      ),
      'techTable' =>
      array (
        0 => array ('layer' => 'Backend', 'technology' => 'PHP 8, Laravel 8, Jetstream, Sanctum'),
        1 => array ('layer' => 'Frontend', 'technology' => 'Vue 3, Inertia.js, Tailwind CSS'),
        2 => array ('layer' => 'Data & charts', 'technology' => 'ApexCharts, FullCalendar'),
        3 => array ('layer' => 'Documents', 'technology' => 'dompdf, Maatwebsite Excel'),
        4 => array ('layer' => 'Infrastructure', 'technology' => 'Docker, docker-compose, Bitbucket Pipelines'),
      ),
      'outcome' => 'A single multi-tenant platform covering warehouse operations, order fulfilment, CRM, finance and email — replacing disconnected spreadsheets and tools with one unified operations pipeline.',
      'featured' => true,
    ),
    6 =>
    array (
      'slug' => 'xstream-gym',
      'name' => 'XStream Gym',
      'category' => 'Web Applications',
      'industry' => 'Fitness / Health & Wellness',
      'image' => '/images/XStream Gym.png',
      'tech' =>
      array (
        0 => 'Laravel',
        1 => 'Inertia.js',
        2 => 'Vue.js',
        3 => 'WebSocket',
        4 => 'Redis',
        5 => 'Stripe',
      ),
      'liveUrl' => '#',
      'summary' => 'XStream Gym is a full-stack fitness platform that connects certified trainers with members through live-streamed and on-demand workout classes, built with Laravel and Inertia.js.',
      'challenge' => 'The client wanted a single platform that could stream live fitness classes in real time, run a trainer marketplace with scheduling and payouts, track member health and nutrition, and keep members socially engaged — all under one role-based admin system.',
      'solution' => 'We built a Laravel + Inertia.js platform with a WebSocket/Redis streaming backend for live classes (with class series, comments and attendance tracking), a trainer marketplace with profiles, schedules and reviews, Stripe-powered subscriptions and trainer payouts, integrated diet/nutrition and wearable-device tracking, social features (friends, messaging, likes, notifications), and a role-based admin dashboard covering users, trainers, classes, payments and disputes.',
      'results' =>
      array (
        0 => 'Real-time live class streaming via WebSocket/Redis with class series and attendance tracking',
        1 => 'Trainer marketplace with profiles, schedules, class management and reviews',
        2 => 'Stripe-powered tiered subscriptions, trainer payouts and bank/withdrawal management',
        3 => 'Health & nutrition tracking with diet plans, meal logging and wearable device sync',
        4 => 'Social features: friend connections, messaging, likes and notifications',
        5 => 'Role-based admin dashboard for users, trainers, classes, payments and disputes/cases',
      ),
      'featureGroups' =>
      array (
        0 =>
        array (
          'title' => 'Live Class Streaming',
          'items' =>
          array (
            0 => 'Real-time video classes powered by a WebSocket/Redis streaming backend',
            1 => 'Class series scheduling with live and on-demand playback',
            2 => 'In-class comments and live attendance tracking',
          ),
        ),
        1 =>
        array (
          'title' => 'Trainer Marketplace',
          'items' =>
          array (
            0 => 'Trainer profiles with certifications and specialties',
            1 => 'Class scheduling and management tools for trainers',
            2 => 'Member reviews and ratings',
          ),
        ),
        2 =>
        array (
          'title' => 'Subscriptions & Payments',
          'items' =>
          array (
            0 => 'Tiered membership packages/plans',
            1 => 'Stripe-powered billing and checkout',
            2 => 'Trainer payouts with bank account and withdrawal management',
          ),
        ),
        3 =>
        array (
          'title' => 'Health & Nutrition Tracking',
          'items' =>
          array (
            0 => 'Integrated diet plans and meal/food logging',
            1 => 'Wearable device sync: heart rate, sleep and weight',
            2 => 'Progress tracking over time',
          ),
        ),
        4 =>
        array (
          'title' => 'Social Features',
          'items' =>
          array (
            0 => 'Friend connections and direct messaging',
            1 => 'Likes and engagement notifications',
            2 => 'Activity feed to keep members connected',
          ),
        ),
        5 =>
        array (
          'title' => 'Admin Dashboard',
          'items' =>
          array (
            0 => 'Role-based admin panel for users, trainers and classes',
            1 => 'Payment and payout oversight',
            2 => 'Disputes/cases management and platform settings',
          ),
        ),
      ),
      'architectureHighlights' =>
      array (
        0 => 'Laravel backend with Inertia.js bridging to a Vue.js SPA-style frontend for a seamless single-page experience',
        1 => 'WebSocket/Redis streaming backend powering real-time live class video, comments and attendance',
        2 => 'Stripe integration for tiered subscriptions, one-off billing and trainer payout/withdrawal flows',
        3 => 'Role-based access control separating member, trainer and admin experiences within one codebase',
      ),
      'techTable' =>
      array (
        0 => array ('layer' => 'Backend', 'technology' => 'Laravel (PHP)'),
        1 => array ('layer' => 'Frontend', 'technology' => 'Inertia.js, Vue.js'),
        2 => array ('layer' => 'Real-time streaming', 'technology' => 'WebSocket, Redis'),
        3 => array ('layer' => 'Payments', 'technology' => 'Stripe (subscriptions, billing, payouts)'),
        4 => array ('layer' => 'Health data', 'technology' => 'Wearable device sync (heart rate, sleep, weight)'),
      ),
      'outcome' => 'A unified fitness platform where members stream live and on-demand classes, track their health, and stay socially engaged, while trainers run their own marketplace presence and get paid — all managed through one role-based admin dashboard.',
      'featured' => true,
    ),
    7 =>
    array (
      'slug' => 'universal-services',
      'name' => 'Universal Services',
      'category' => 'Web Applications',
      'industry' => 'Finance / Remittance',
      'image' => '/images/universal-services.jpg',
      'tech' =>
      array (
        0 => 'Laravel',
        1 => 'Vue.js',
        2 => 'Inertia.js',
        3 => 'Tailwind CSS',
        4 => 'MySQL',
      ),
      'liveUrl' => '#',
      'summary' => 'Universal Services is a secure, full-stack remittance platform for international money transfers, built with Laravel 8, Vue.js 2, and Inertia.js for a fast, SPA-like experience without a separate API layer.',
      'challenge' => 'The client needed a compliant, trustworthy platform for cross-border money transfers that could handle multi-currency rates, KYC/AML onboarding, and a full back-office for suppliers, collection stations and payments — all with real-time visibility for both customers and admins.',
      'solution' => 'We built a Laravel 8 + Inertia/Vue 2 platform combining a customer-facing transfer flow with a comprehensive admin dashboard: multi-currency exchange rate management, KYC/AML compliance workflows, beneficiary management with transfer tracking, and reporting via DomPDF and Laravel Excel, secured with Jetstream/Fortify role-based access and two-factor authentication.',
      'results' =>
      array (
        0 => 'Multi-currency support with real-time exchange rate management',
        1 => 'KYC/AML compliant customer onboarding workflows',
        2 => 'Beneficiary management with live transfer tracking',
        3 => 'Admin dashboard covering suppliers, collection stations, rates, cheques and payments',
        4 => 'PDF and Excel reporting: customer statements, outstanding balances, supplier rates, transfer history',
        5 => 'Role-based access control with two-factor authentication',
      ),
      'featureGroups' =>
      array (
        0 =>
        array (
          'title' => 'Transfers & Rates',
          'items' =>
          array (
            0 => 'Multi-currency support with real-time exchange rate management',
            1 => 'Beneficiary management and transfer tracking',
            2 => 'Send-money flow with delivery method and purpose selection',
          ),
        ),
        1 =>
        array (
          'title' => 'Compliance',
          'items' =>
          array (
            0 => 'Customer onboarding with KYC/AML compliance workflows',
            1 => 'Compliance status monitoring and audit logs',
          ),
        ),
        2 =>
        array (
          'title' => 'Admin Dashboard',
          'items' =>
          array (
            0 => 'Suppliers, collection stations, rates, cheques and payments management',
            1 => 'Real-time transfer volume, beneficiary and compliance stats',
            2 => 'Recent activity feed and audit logs',
          ),
        ),
        3 =>
        array (
          'title' => 'Reporting',
          'items' =>
          array (
            0 => 'PDF and Excel report generation via DomPDF and Laravel Excel',
            1 => 'Customer statements, outstanding balances, supplier rates, transfer history',
          ),
        ),
        4 =>
        array (
          'title' => 'Security',
          'items' =>
          array (
            0 => 'Role-based access control and two-factor authentication via Laravel Jetstream and Fortify',
            1 => 'File imports/exports for bulk data handling, with AWS S3-backed file storage',
          ),
        ),
      ),
      'architectureHighlights' =>
      array (
        0 => 'Laravel 8 backend with Jetstream and Fortify, Inertia.js bridging to a Vue.js 2 SPA-style frontend without a separate API layer',
        1 => 'AWS S3-backed file storage for bulk import/export handling',
        2 => 'DomPDF and Laravel Excel for customer statements, balances, rates and transfer history reports',
      ),
      'techTable' =>
      array (
        0 => array ('layer' => 'Backend', 'technology' => 'Laravel 8 (PHP)'),
        1 => array ('layer' => 'Frontend', 'technology' => 'Vue.js 2, Inertia.js, Tailwind CSS'),
        2 => array ('layer' => 'Auth', 'technology' => 'Laravel Jetstream, Fortify, Sanctum, 2FA'),
        3 => array ('layer' => 'Documents', 'technology' => 'DomPDF, Laravel Excel'),
        4 => array ('layer' => 'Storage', 'technology' => 'AWS S3'),
        5 => array ('layer' => 'Database', 'technology' => 'MySQL'),
        6 => array ('layer' => 'Build tooling', 'technology' => 'Laravel Mix/Webpack'),
      ),
      'outcome' => 'A secure remittance platform covering the full transfer lifecycle — multi-currency rates, KYC/AML onboarding, beneficiary tracking and admin reporting — with role-based access and two-factor authentication throughout.',
      'featured' => true,
    ),
  ),
);
