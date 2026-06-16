<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PortalController extends Controller
{
    public function business(): View
    {
        return $this->show('business');
    }

    public function personal(): View
    {
        return $this->show('personal');
    }

    public function choose(): View
    {
        return view('pages.choose-portal');
    }

    private function show(string $portalKey): View
    {
        $categories = config("sophdata_services.{$portalKey}", []);

        abort_unless(is_array($categories), 500);

        $problemCards = [];

        foreach ($categories as $category) {
            if (! is_array($category)) {
                continue;
            }

            foreach ($category['customer_problem_cards'] ?? [] as $card) {
                if (is_array($card)) {
                    $problemCards[] = $card;
                }
            }
        }

        $data = [
            'categories' => $categories,
            'portal' => config("sophdata_portals.{$portalKey}"),
            'problemCards' => $problemCards,
        ];

        return $portalKey === 'business'
            ? view('pages.business.index', $data)
            : view('pages.personal.index', $data);
    }
}
