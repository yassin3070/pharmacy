<?php

namespace App\Traits;
use Illuminate\Http\Request;

trait PaginationTrait
{

     /**
     * Retrieve pagination parameters: per_page and page.
     *
     * @param Request $request
     * @return array
     */
    public function getPaginationParams(Request $request): array
    {
        return [
            'per_page' => (int) $request->input('per_page', 10),
            'page' => (int) $request->input('page', 1),
        ];
    }

    public function paginationModel($col)
    {
        return [
            'total_items'   => $col->total(),
            'count_items'   => (int) $col->count(),
            'per_page'      => $col->perPage(),
            'total_pages'   => $col->lastPage(),
            'current_page'  => $col->currentPage(),
            'next_page_url' => (string) $col->nextPageUrl(),
            'perv_page_url' => (string) $col->previousPageUrl(),
        ];

    }
}
