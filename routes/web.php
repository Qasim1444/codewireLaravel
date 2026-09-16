<?php

use App\Support\SiteData;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('HomeView', [
        'homeServices' => SiteData::homeServices(),
        'featuredProjects' => SiteData::projects(),
        'stats' => SiteData::stats(),
        'clientTestimonials' => SiteData::clientTestimonials(),
        'recentPosts' => SiteData::recentPosts(),
        'techCategories' => SiteData::techCategories(),
        'differentiators' => SiteData::differentiators(),
        'processSteps' => SiteData::processSteps(),
        'courses' => SiteData::courses(),
    ]);
})->name('home');

Route::get('/about', function () {
    return Inertia::render('AboutView', [
        'team' => SiteData::team(),
        'values' => SiteData::values(),
        'timeline' => SiteData::timeline(),
        'stats' => SiteData::stats(),
    ]);
})->name('about');

// Services
Route::get('/services', function () {
    return Inertia::render('ServicesView', [
        'services' => SiteData::services(),
    ]);
})->name('services');

Route::get('/services/{slug}', function (string $slug) {
    return Inertia::render('ServiceDetailView', [
        'service' => SiteData::getService($slug),
        'services' => SiteData::services(),
        'slug' => $slug,
    ]);
})->name('service-detail');

// Work / case studies
Route::get('/work', function () {
    return Inertia::render('WorkView', [
        'projects' => SiteData::projects(),
        'projectCategories' => SiteData::projectCategories(),
    ]);
})->name('work');

Route::get('/work/{slug}', function (string $slug) {
    return Inertia::render('WorkDetailView', [
        'project' => SiteData::getProject($slug),
        'projects' => SiteData::projects(),
        'slug' => $slug,
    ]);
})->name('work-detail');

// Academy / courses
Route::get('/academy', function () {
    return Inertia::render('AcademyView', [
        'courses' => SiteData::courses(),
        'academyStats' => SiteData::academyStats(),
        'studentProjects' => SiteData::studentProjects(),
    ]);
})->name('academy');

Route::get('/academy/{slug}', function (string $slug) {
    return Inertia::render('CourseDetailView', [
        'course' => SiteData::getCourse($slug),
        'courses' => SiteData::courses(),
        'slug' => $slug,
    ]);
})->name('course-detail');

// Blog
Route::get('/blog', function () {
    return Inertia::render('BlogView', [
        'posts' => SiteData::posts(),
        'blogCategories' => SiteData::blogCategories(),
        'featuredPost' => SiteData::featuredPost(),
    ]);
})->name('blog');

Route::get('/blog/{slug}', function (string $slug) {
    return Inertia::render('BlogPostView', [
        'post' => SiteData::getPost($slug),
        'relatedPosts' => SiteData::relatedPosts($slug, 3),
        'slug' => $slug,
    ]);
})->name('blog-post');

// Standalone secondary pages
Route::get('/technologies', function () {
    return Inertia::render('TechnologiesView', [
        'techCategories' => SiteData::techCategories(),
    ]);
})->name('technologies');

Route::get('/student-projects', function () {
    return Inertia::render('StudentProjectsView', [
        'studentProjects' => SiteData::studentProjects(),
    ]);
})->name('student-projects');

Route::get('/reviews', function () {
    return Inertia::render('ReviewsView', [
        'clientTestimonials' => SiteData::clientTestimonials(),
        'studentTestimonials' => SiteData::studentTestimonials(),
    ]);
})->name('reviews');

Route::get('/resources', function () {
    return Inertia::render('ResourcesView', [
        'resources' => SiteData::resources(),
        'resourceTypes' => SiteData::resourceTypes(),
    ]);
})->name('resources');

Route::get('/faq', function () {
    return Inertia::render('FaqView', [
        'faqGroups' => SiteData::faqGroups(),
        'allFaqs' => SiteData::allFaqs(),
    ]);
})->name('faq');

Route::get('/consultation', function () {
    return Inertia::render('ConsultationView', [
        'services' => SiteData::services(),
    ]);
})->name('consultation');

Route::get('/careers', function () {
    return Inertia::render('CareersView', [
        'values' => SiteData::values(),
    ]);
})->name('careers');

Route::get('/contact', function () {
    return Inertia::render('ContactView', [
        'services' => SiteData::services(),
    ]);
})->name('contact');

Route::fallback(function () {
    return Inertia::render('NotFoundView');
})->name('not-found');
