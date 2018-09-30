<?php

/**
 * @author Saurabh Mishra <saurabh.mishrr@gmail.com>
 * @version 1
 *
 */


namespace App\Repositories;
use App\Candidate;

class Candidates 
{
    /*
    |--------------------------------------------------------------------------
    | Candidates Repository
    |--------------------------------------------------------------------------
    |
    | This repository is responsible for handling all operations handled by
    | CandidatesController
    |
    */

    /**
     * Which model's object will be used.
     *
     * @var Object
     */
	private $model;

	/**
     * Create a new model instance.
     *
     * @return void
     */
	public function __construct() 
	{
		$this->model = new Candidate;
	}

    /**
     * Get candidate's data for an incoming request.
     *
     * @param  Array  $options
     * @return Object
     */
	public function getAllCandidates(Array $options)
	{
		$this->result = '';
		if (array_key_exists('orderBy', $options)) {
			if (is_array($options['orderBy'])) {
				foreach ($options['orderBy'] as $key => $value) {
					$this->result = ($this->model)->orderBy($key,$value);
				}
			}
		}
		if (array_key_exists('where', $options)) {
			$where = []; 
			if (is_array($options['where'])) {
				foreach ($options['where'] as $key => $value) {
					foreach ($value as $condition => $compareWith) {
						$condition = str_replace('eq', '=', $condition);
						$where[] = [$key, $condition, $compareWith];
					}
				}
			}
			$this->result = ($this->model)->where($where);
		}
		return ($this->result)->get();
	}

    /**
     * Store or Update candidate's data for an incoming request.
     *
     * @param  Object  $data
     * @param  String  $filePath
     * @param  Int     $id
     * @return Object
     */
	public function storeOrUpdateCandidatesData($data, $filePath = null, $id = null) 
	{
		if (!empty($data)) {

			if (!empty($filePath)) {
	    		($this->model)->resume = $filePath;
			}

			if (!empty($id)) {
				$this->model = ($this->model)->find($id);
			}

			$hobbies = array_unique($data->hobbies);
			($this->model)->name = $data->name;
	    	($this->model)->email = $data->email;
	    	($this->model)->company = $data->company;
	    	($this->model)->hobbies = implode(',', $hobbies);
	    	($this->model)->qualification = $data->qualification;
	    	($this->model)->save();
		}
	}

    /**
     * Get candidate's data by primary key.
     *
     * @param  Int  $id
     * @return Object
     */
	public function getCandidateDataById(int $id)
	{
		return ($this->model)->find($id);
	}

    /**
     * Delete candidate's data by primary key.
     *
     * @param  Int  $id
     * @return Object
     */
	public function deleteCandidateData($id)
	{
		($this->model)->destroy($id);
	}
}