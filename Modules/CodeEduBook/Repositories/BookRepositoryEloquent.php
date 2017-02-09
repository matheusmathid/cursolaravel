<?php

namespace CodeEduBook\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Models\Book;
use CodePub\Criteria\CriteriaTrashedTrait;
use CodePub\Repositories\RepositoryRestoreTrait;
/**
 * Class BookRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class BookRepositoryEloquent extends BaseRepository implements BookRepository
{
	use CriteriaTrashedTrait;
	use RepositoryRestoreTrait;
	
	protected $fieldSearchable = [
		'title' => 'like',
		'subtitle',
		'user.name',
        'categories.name' => 'like'
	];
	
	public function create(array $attributes){
		$model = parent::create($attributes);
		$model->categories()->sync($attributes['categories']);
	}
	
	public function update(array $attributes,$id){
		$model = parent::update($attributes,$id);
		$model->categories()->sync($attributes['categories']);
	}
	
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Book::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
