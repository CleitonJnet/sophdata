<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class ServiceCategoryController extends Controller
{
    public function business(string $category): View
    {
        return $this->show('business', $category);
    }

    public function personal(string $category): View
    {
        return $this->show('personal', $category);
    }

    private function show(string $portal, string $slug): View
    {
        $category = null;

        foreach ($this->categories($portal) as $candidate) {
            if (($candidate['slug'] ?? null) === $slug) {
                $category = $candidate;

                break;
            }
        }

        abort_if($category === null, 404);

        $portalConfig = config("sophdata_portals.{$portal}");
        $portalFaq = config("sophdata_services.portal_faq.{$portal}", []);
        $categoryFaq = $category['faq'] ?? [];

        $data = [
            'category' => $category,
            'portal' => $portalConfig,
            'faq' => filled($categoryFaq) ? $categoryFaq : $portalFaq,
        ];

        return $portal === 'business'
            ? view('pages.business.category', $data)
            : view('pages.personal.category', $data);
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function categories(string $portal): array
    {
        $categories = config("sophdata_services.{$portal}");

        if (! is_array($categories)) {
            return [];
        }

        return array_values(array_filter($categories, is_array(...)));
    }
}
