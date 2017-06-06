<?php

namespace App\Services;

class PaginationService
{
	// 建立pager
	public function createPager($data)
	{
		$result = (object)array(
    		'data' => $data->items(),
		);

        $result->pager = (object)array(
            'page' => $data->currentPage(),
            'pages' => $data->lastPage(),
            'rows' => $data->total(),
            'next' => $data->nextPageUrl(),
            'previous' => $data->previousPageUrl(),
            'per' => $data->perPage(),
            'count' => $data->count(),
        );
		return $result;
	}
}
?>