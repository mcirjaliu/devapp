<?php

namespace App\Traits;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

trait ProvidesQueryFilter
{
    /**
     * The arguments allowed
     *
     * @var array
     */
    protected $arguments = [
        'orderBy',
        'limit',
    ];

    /**
     * Builds the query builder and returns its results
     *
     * @param   Request  $request
     *
     * @return  JsonResponse
     */
    public function get(Request $request)
    {
        // build the query builder according to the filters
        $builder = $this->buildQueryBuilder($this->model ?? null, $request);

        // apply additional restrictions
        if (\method_exists($this, 'beforeFilter')) {
            $this->beforeFilter($builder);
        }

        // process the arguments
        $this->processArguments($builder, $request);

        // get the results
        // pagination maybe ??
        $results = $builder->get();

        // format the results if needed
        if (\method_exists($this, 'formatResults')) {
            $this->formatResults($results, $request);
        }

        return $results;
    }

    /**
     * Process the argument
     *
     * @param   QueryBuilder  $builder
     * @param   Request       $request
     *
     * @return  void
     */
    protected function processOrderbyArgument(Builder $builder, Request $request)
    {
        if ($request->has('orderBy')) {
            list($col, $dir) = explode(',', $request->orderBy);
            $builder->orderBy($col, $dir);
        }
    }

    /**
     * Process the argument
     *
     * @param   QueryBuilder  $builder
     * @param   Request       $request
     *
     * @return  void
     */
    protected function processLimitArgument(Builder $builder, Request $request)
    {
        if ($request->filled('limit') && is_integer($request->limit)) {
            $builder->limit($request->limit);
        }
    }

    /**
     * Process the arguments
     *
     * @param   Request   $request
     *
     * @return  Response
     */
    protected function processArguments(Builder $builder, Request $request)
    {
        collect($this->arguments)->each(function ($argument) use ($builder, $request) {
            if ($request->has($argument)) {
                $this->{sprintf("process%sArgument", ucfirst($argument))}(
                    $builder,
                    $request
                );
            }
        });
    }

    /**
     * Builds the model query and returns it
     *
     * @param   mixed    $model
     * @param   Request  $request
     *
     * @return  Builder
     */
    protected function buildQueryBuilder($model, Request $request): Builder
    {
        if (!is_subclass_of($model, Model::class)) {
            throw new Exception('Invalid model provided');
        }

        $query = ($model = new $model)::query();
        // maybe get the type directly from the schema
        $attributes = Schema::getColumnListing($model->getTable());

        // naive implementation of filters
        collect($this->filters)->each(function ($filter) use ($attributes, &$query, $request) {
            if (in_array($filter['column'], $attributes) && $request->filled(sprintf('filter.%s', $filter['column']))) {
                $column = $filter['column'];
                $value  = $request->filter[$filter['column']];

                // a basic type switch
                switch ($filter['type']) {
                    case 'integer':
                        if (!is_integer($value)) {
                            throw new Exception(sprintf('%s field is not an integer', $filter['column']));
                        }
                        $query->where($column, '=', $value);
                        break;
                    case 'string':
                        if (!is_string($value)) {
                            throw new Exception(sprintf('%s field is not a string', $filter['column']));
                        }
                        $query->where($column, 'LIKE', '%' . $value . '%');
                        break;
                    case 'date':
                        $value = Carbon::parse($value);
                        $query->where($column, '=', $value);
                        break;
                        // handle relationships maybe ?
                }
            }

        });

        return $query;
    }
}
