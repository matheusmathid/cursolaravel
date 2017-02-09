<?php

namespace CodeEduBook\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;
use CodePub\Criteria\CriteriaTrashedInterface;

/**
 * Interface CategoryRepository
 * @package namespace CodePub\Repositories;
 */
interface CategoryRepository extends RepositoryInterface, CriteriaTrashedInterface
{
	public function listsWithMutators($column, $key = null);
}
