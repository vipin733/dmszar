<?php

namespace App\Filter\Teacher\Student;

use App\Filter\Filter;

/**
* 
*/
class StudentHomeWorkFilter extends Filter
{
	

	public function course($value)
	{
		$this->builder->where('course_id',$value);
	}

	public function subject($value)
	{
		$this->builder->where('subject_id',$value);
	}

	public function section($value)
	{
		$this->builder->where('section_id',$value);
	}

	public function session($value)
	{
		$this->builder->where('asession_id',$value);
	}
}