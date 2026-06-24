<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class BusinessCatalogController extends Controller
{
    public function softwareIndex(): View
    {
        return $this->blockIndex('sophdata_desenvolvimento', 'business.software.category');
    }

    public function softwareCategory(string $category): View
    {
        return $this->blockCategory('sophdata_desenvolvimento', $category);
    }

    public function infrastructureIndex(): View
    {
        return $this->blockIndex('sophdata_infraestrutura', 'business.infrastructure.category');
    }

    public function infrastructureCategory(string $category): View
    {
        return $this->blockCategory('sophdata_infraestrutura', $category);
    }

    public function serversIndex(): View
    {
        return $this->blockIndex('sophdata_servidores', 'business.servers.category');
    }

    public function serversCategory(string $category): View
    {
        return $this->blockCategory('sophdata_servidores', $category);
    }

    public function plans(): View
    {
        $plans = config('sophdata_planos_empresa', []);

        return view('pages.business.plans', [
            'portal' => config('sophdata_empresa', []),
            'menu' => config('sophdata_empresa_menu', []),
            'plans' => $plans,
            'seo' => $this->seoForPage($plans),
        ]);
    }

    public function howWeWork(): View
    {
        $page = config('sophdata_empresa.how_we_work', []);

        return view('pages.business.how-we-work', [
            'portal' => config('sophdata_empresa', []),
            'menu' => config('sophdata_empresa_menu', []),
            'page' => $page,
            'seo' => $this->seoForPage($page),
        ]);
    }

    public function contact(): View
    {
        $page = config('sophdata_empresa.contact_page', []);

        return view('pages.business.contact', [
            'portal' => config('sophdata_empresa', []),
            'menu' => config('sophdata_empresa_menu', []),
            'page' => $page,
            'empresa' => config('sophdata_empresa', []),
            'seo' => $this->seoForPage($page),
        ]);
    }

    private function blockIndex(string $configKey, string $categoryRouteName): View
    {
        $catalog = config($configKey);

        abort_unless(is_array($catalog), 404);

        return view('pages.business.catalog-index', [
            'portal' => config('sophdata_empresa', []),
            'menu' => config('sophdata_empresa_menu', []),
            'catalog' => $catalog,
            'categoryRouteName' => $categoryRouteName,
            'seo' => $this->seoForPage($catalog),
        ]);
    }

    private function blockCategory(string $configKey, string $slug): View
    {
        $catalog = config($configKey);

        abort_unless(is_array($catalog), 404);

        $category = null;

        foreach ($catalog['categories'] ?? [] as $candidate) {
            if (is_array($candidate) && ($candidate['slug'] ?? null) === $slug) {
                $category = $candidate;

                break;
            }
        }

        abort_if($category === null, 404);

        return view('pages.business.catalog-category', [
            'portal' => config('sophdata_empresa', []),
            'menu' => config('sophdata_empresa_menu', []),
            'catalog' => $catalog,
            'category' => $category,
            'parentTitle' => $catalog['title'] ?? 'Catalogo empresarial',
            'parentUrl' => $catalog['route'] ?? '/para-empresas',
            'seo' => $this->seoForCategory($catalog, $category),
        ]);
    }

    private function seoForPage(array $page): array
    {
        $seo = $page['seo'] ?? [];
        $image = $seo['og_image'] ?? $page['image'] ?? 'img/sophdata/portals/business-hero.webp';

        return [
            'title' => $seo['title'] ?? (($page['title'] ?? 'SophData para Empresas').' | SophData'),
            'description' => $seo['description'] ?? $page['description'] ?? 'Solucoes empresariais SophData.',
            'canonical' => $seo['canonical'] ?? $page['route'] ?? null,
            'og_title' => $seo['og_title'] ?? $seo['title'] ?? $page['title'] ?? null,
            'og_description' => $seo['og_description'] ?? $seo['description'] ?? $page['description'] ?? null,
            'og_image' => $image,
            'robots' => $seo['robots'] ?? 'index, follow',
        ];
    }

    private function seoForCategory(array $catalog, array $category): array
    {
        $seo = $category['seo'] ?? [];
        $catalogSeo = $catalog['seo'] ?? [];
        $catalogTitle = $catalog['title'] ?? 'SophData';
        $categoryTitle = $category['title'] ?? 'Solucao empresarial';
        $image = $seo['og_image'] ?? $category['image'] ?? $catalogSeo['og_image'] ?? $catalog['image'] ?? 'img/sophdata/portals/business-hero.webp';

        return [
            'title' => $seo['title'] ?? "{$categoryTitle} | {$catalogTitle} SophData",
            'description' => $seo['description'] ?? $category['description'] ?? $catalogSeo['description'] ?? $catalog['description'] ?? 'Solucao empresarial SophData.',
            'canonical' => $seo['canonical'] ?? $category['route'] ?? null,
            'og_title' => $seo['og_title'] ?? $seo['title'] ?? $categoryTitle,
            'og_description' => $seo['og_description'] ?? $seo['description'] ?? $category['description'] ?? null,
            'og_image' => $image,
            'robots' => $seo['robots'] ?? 'index, follow',
        ];
    }
}
