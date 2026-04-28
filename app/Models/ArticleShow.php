<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ArticleShow extends Model
{
    use HasFactory;

    public const ARTICLE_PATH_PREFIX = 'artikel';

    public function articles()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
    public function articleshowgallery()
    {
        return $this->hasMany(ArticleShowGallery::class);
    }
    public function phoneNumber() 
    {
        return $this->belongsTo(PhoneNumber::class);
    }
    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

    public static function buildSlug(string $title, ?string $articleType = null): string
    {
        $baseSlug = Str::slug($title);

        if (self::isArticleType($articleType)) {
            return self::ARTICLE_PATH_PREFIX . '/' . $baseSlug;
        }

        return $baseSlug;
    }

    public static function isArticleType(?string $articleType): bool
    {
        return in_array($articleType, [
            Article::TYPE_SPINTAX,
            Article::TYPE_ARTICLE_UNIQUE,
            Article::TYPE_ARTICLE_SPINTAX,
        ], true);
    }

    public function getRouteSlugAttribute(): string
    {
        return Str::after($this->slug, self::ARTICLE_PATH_PREFIX . '/');
    }

    public function getDetailRouteNameAttribute(): string
    {
        return self::isArticleType(optional($this->articles)->article_type)
            ? 'article.detail'
            : 'business';
    }

    public function getPublicPathAttribute(): string
    {
        return self::isArticleType(optional($this->articles)->article_type)
            ? '/' . self::ARTICLE_PATH_PREFIX . '/' . $this->route_slug
            : '/' . $this->route_slug;
    }

    public function getDetailUrlAttribute(): string
    {
        return route($this->detail_route_name, ['slug' => $this->route_slug]);
    }
}
