<?php

namespace App\ViewModels;

use App\Constants\DocumentTypeEnum;
use App\Constants\TypeMicrositeEnum;
use App\Http\Controllers\MicroSiteController;
use App\Models\Category;
use App\Models\Site;
use Spatie\ViewModels\ViewModel;
use \Illuminate\Database\Eloquent\Collection;

class SiteViewModel extends ViewModel
{
    public $site;
    public $indexUrl;
    public function __construct(Site $site = null)
    {
        $this->site = $site;

        $this->indexUrl = action([MicroSiteController::class, 'index']);

    }
    public function site(): Site
    {
        return $this->site ?? new Site();
    }

    public function categories(): array|Collection
    {
        return Category::query()->select(['id', 'name'])->get();
    }
    public function documentTypes(): array
    {
        return array_column(DocumentTypeEnum::cases(), 'name');
    }

    public function siteTypes() : array
    {
        return array_column(TypeMicrositeEnum::cases(), 'name');
    }
}
