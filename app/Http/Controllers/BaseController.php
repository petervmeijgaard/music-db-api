<?php

namespace App\Http\Controllers;

use App\Traits\Restable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

abstract class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Restable;

    /**
     * The default pagination size.
     *
     * @var int The pagination size
     */
    protected $pagination = 5;
    /**
     * The maximum pagination size.
     *
     * @var int The pagination size
     */
    protected $maxLimit = 50;
    /**
     * The minimum pagination size.
     *
     * @var int The pagination size
     */
    protected $minLimit = 1;

    /**
     * Getter for the pagination.
     *
     * @return int The pagination size
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * Sets and checks the pagination.
     *
     * @param int $pagination The given pagination
     */
    public function setPagination($pagination)
    {
        $this->pagination = (int) $this->checkPagination($pagination);
    }

    /**
     * Checks the pagination.
     *
     * @param * $pagination The pagination
     *
     * @return int The corrected pagination
     */
    private function checkPagination($pagination)
    {
        // Pagination should be numeric
        if (!is_numeric($pagination)) {
            return $this->pagination;
        }
        // Pagination should not be less than the minimum limitation
        if ($pagination < $this->minLimit) {
            return $this->minLimit;
        }
        // Pagination should not be greater than the maximum limitation
        if ($pagination > $this->maxLimit) {
            return $this->maxLimit;
        }
        // If the pagination is between the min limit and the max limit, return the pagination
        if (!($pagination > $this->maxLimit) && !($pagination < $this->minLimit)) {
            return $pagination;
        }

        // If all fails, return the default pagination
        return $this->pagination;
    }
}
