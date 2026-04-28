<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public const TYPE_CATALOG = 'catalog';
    public const TYPE_LEGACY_UNIQUE = 'unique';
    public const TYPE_SPINTAX = 'spintax';
    public const TYPE_ARTICLE_UNIQUE = 'article_unique';
    public const TYPE_ARTICLE_SPINTAX = 'article_spintax';

    protected $fillable = ['phone_number_id'];

    public static function catalogTypes(): array
    {
        return [
            self::TYPE_CATALOG,
            self::TYPE_LEGACY_UNIQUE,
        ];
    }

    public function scopeCatalog($query)
    {
        return $query->whereIn('article_type', self::catalogTypes());
    }

    public function isCatalogType(): bool
    {
        return in_array($this->article_type, self::catalogTypes(), true);
    }

    public function scopeArticleUnique($query)
    {
        return $query->where('article_type', self::TYPE_ARTICLE_UNIQUE);
    }

    public function articleshow()
    {
        return $this->hasMany(ArticleShow::class);
    }
    public function articlebanner()
    {
        return $this->hasMany(ArticleBanner::class);
    }
    public function articlegallery()
    {
        return $this->hasMany(ArticleGallery::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function articletag()
    {
        return $this->belongsToMany(ArticleTag::class, 'pivot_articles_tags', 'article_id', 'tag_id');
    } 
    public function articlecategory()
    {
        return $this->belongsToMany(ArticleCategory::class, 'pivot_articles_categories', 'article_id', 'category_id');
    } 
    public function template()
    {
        return $this->belongsToMany(Template::class, 'pivot_templates_articles', 'article_id', 'template_id');
    }
}
