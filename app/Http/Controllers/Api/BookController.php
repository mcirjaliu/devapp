<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Traits\ProvidesQueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class BookController extends Controller
{
    use ProvidesQueryFilter;

    /**
     * The filtering model
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * The allowed filters
     */
    protected $filters = [
        [
            'column' => 'id',
            'type'   => 'integer',
        ],
        [
            'column' => 'published_at',
            'type'   => 'date',
        ],
        [
            'column' => 'title',
            'type'   => 'string',
        ],
        [
            'column' => 'author',
            'type'   => 'string',
        ],
    ];

    /**
     * Gets a book by its id and returns its data
     *
     * @param   integer  $id
     *
     * @return  JsonResponse
     */
    public function getById($id): JsonResponse
    {
        return Book::where('user_id', auth()->user()->id)->findOrFail($id);
    }

    /**
     * Here we'll restrict the model records only for the logged user
     *
     * @param   Builder  $query
     *
     * @return  void
     */
    protected function beforeFilter(Builder $query): void
    {
        $query->where('user_id', auth()->user()->id);
    }

    /**
     * Formats the results before sending them
     *
     * @param   Builder  $query
     *
     * @return  void
     */
    protected function formatResults(Collection &$results, Request $request): void
    {
        if ($request->has('sort')) {
            $results = $results->sortBy(function ($result) use ($request) {
                return $result->{$request->sort};
            })->values();
        }
    }
}
