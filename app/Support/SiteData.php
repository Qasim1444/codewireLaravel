<?php

namespace App\Support;

/**
 * Static content accessor. Mirrors the shape of the original Vue project's
 * src/data/*.js modules, loaded here from config/data/*.php as plain arrays.
 */
class SiteData
{
    protected static array $cache = [];

    protected static function file(string $name): array
    {
        return static::$cache[$name] ??= require config_path("data/{$name}.php");
    }

    public static function courses(): array
    {
        return static::file('courses')['courses'];
    }

    public static function studentProjects(): array
    {
        return static::file('courses')['studentProjects'];
    }

    public static function getCourse(?string $slug): ?array
    {
        foreach (static::courses() as $c) {
            if (($c['slug'] ?? null) === $slug) {
                return $c;
            }
        }
        return null;
    }

    public static function faqGroups(): array
    {
        return static::file('faq')['faqGroups'];
    }

    public static function allFaqs(): array
    {
        return static::file('faq')['allFaqs'];
    }

    public static function posts(): array
    {
        return static::file('posts')['posts'];
    }

    public static function blogCategories(): array
    {
        return static::file('posts')['blogCategories'];
    }

    public static function featuredPost(): ?array
    {
        return static::file('posts')['featuredPost'];
    }

    public static function recentPosts(): array
    {
        return static::file('posts')['recentPosts'];
    }

    public static function getPost(?string $slug): ?array
    {
        foreach (static::posts() as $p) {
            if (($p['slug'] ?? null) === $slug) {
                return $p;
            }
        }
        return null;
    }

    public static function relatedPosts(?string $slug, int $n = 3): array
    {
        $post = static::getPost($slug);
        $tags = $post['tags'] ?? [];
        $others = array_values(array_filter(static::posts(), fn ($p) => ($p['slug'] ?? null) !== $slug));
        $scored = array_filter($others, fn ($p) => count(array_intersect($p['tags'] ?? [], $tags)) > 0);
        $result = array_slice(array_values($scored), 0, $n);
        if (count($result) < $n) {
            foreach ($others as $p) {
                if (count($result) >= $n) {
                    break;
                }
                if (!in_array($p, $result, true)) {
                    $result[] = $p;
                }
            }
        }
        return array_slice($result, 0, $n);
    }

    public static function processSteps(): array
    {
        return static::file('process')['processSteps'];
    }

    public static function differentiators(): array
    {
        return static::file('process')['differentiators'];
    }

    public static function projects(): array
    {
        return static::file('projects')['projects'];
    }

    public static function projectCategories(): array
    {
        return static::file('projects')['projectCategories'];
    }

    public static function featuredProjects(): array
    {
        return static::file('projects')['featuredProjects'];
    }

    public static function getProject(?string $slug): ?array
    {
        foreach (static::projects() as $p) {
            if (($p['slug'] ?? null) === $slug) {
                return $p;
            }
        }
        return null;
    }

    public static function resources(): array
    {
        return static::file('resources')['resources'];
    }

    public static function resourceTypes(): array
    {
        return static::file('resources')['resourceTypes'];
    }

    public static function services(): array
    {
        return static::file('services')['services'];
    }

    public static function homeServices(): array
    {
        return static::file('services')['homeServices'];
    }

    public static function getService(?string $slug): ?array
    {
        foreach (static::services() as $s) {
            if (($s['slug'] ?? null) === $slug) {
                return $s;
            }
        }
        return null;
    }

    public static function site(): array
    {
        return static::file('site');
    }

    public static function stats(): array
    {
        return static::file('stats')['stats'];
    }

    public static function academyStats(): array
    {
        return static::file('stats')['academyStats'];
    }

    public static function team(): array
    {
        return static::file('team')['team'];
    }

    public static function values(): array
    {
        return static::file('team')['values'];
    }

    public static function timeline(): array
    {
        return static::file('team')['timeline'];
    }

    public static function techCategories(): array
    {
        return static::file('techStack')['techCategories'];
    }

    public static function clientTestimonials(): array
    {
        return static::file('testimonials')['clientTestimonials'];
    }

    public static function studentTestimonials(): array
    {
        return static::file('testimonials')['studentTestimonials'];
    }
}
