<?php

namespace App\Filter;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

/**
* 
*/
class Filter
{
	protected $request;

	protected $builder;

	function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function filters()
	{
		return $this->request->all();
	}

	public function apply(Builder $builder)
	{
		$this->builder = $builder;

		foreach ($this->filters() as $name => $value) {
			
			if (method_exists($this, $name)) {
				$this->$name(array_filter([$value]));
			}
		}
	}

	
}