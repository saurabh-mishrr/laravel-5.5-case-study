<?php

/**
 * @author Saurabh Mishra <saurabh.mishrr@gmail.com>
 * @version 1
 *
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidate;
use App\Repositories\Candidates as CandidateRepo;
use Validator;
use App\Rules\CandidateEmailValidate;

class CandidatesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Candidates Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling all operations perform on 
    | candidates table
    |
    */

    /**
     * Which repository object will be used.
     *
     * @var Object
     */
	private $repo;

	/**
     * Create a new repository instance.
     *
     * @return void
     */
	public function __construct()
	{
		$this->repo = new CandidateRepo;
	}

    /**
     * Get all candidate's data.
     *
     * @return void
     */
    public function index()
    {
    	$candidates = ($this->repo)->getAllCandidates(array('orderBy' => array('name' => 'asc')));
    	return view('candidates.index', compact('candidates'));
    } 

    /**
     * Display add candidate's data form.
     *
     * @return void
     */
    public function create()
    {
    	return view('candidates.form');
    }

    /**
     * Add candidate's data for an incoming request.
     *
     * @param  Object  $request
     * @return void
     */
    public function store(Request $request)
    {

    	$validator = Validator::make($request->all(),[
    		'name' => 'required|max:20',
    		'company' => 'required|max:50',
    		'hobbies' => 'required',
    		'qualification' => 'required|max:50|in:Graduate,Post Graduate',
    		'email' => 'required|unique:candidates|email',
    		'resume' => 'required|mimes:doc,pdf,docx|max:5000'
    	])->validate();
    	
    	$path = $request->resume->store('resumes');

    	($this->repo)->storeOrUpdateCandidatesData($request, $path);

    	return redirect()->route('managecv')->with('message', 'Data Saved Successfully!');
    	
    }

    /**
     * Display update candidate's data form.
     *
     * @param  Int  $id
     * @return void
     */
    public function edit(int $id) 
    {
    	$candidates = ($this->repo)->getCandidateDataById($id);
    	$updateText = 'Update';
    	return view('candidates.form', compact('candidates', 'updateText'));
    }

    /**
     * Update candidate's data for an incoming request.
     *
     * @param  Object  $request
     * @param  Object  $candidates
     * @param  Int     $id
     * @return void
     */
    public function update(Request $request, Candidate $candidates, $id)
    {
    	$validator = Validator::make($request->all(),[
    		'name' => 'required|max:20',
    		'company' => 'required|max:50',
    		'hobbies' => 'required',
    		'qualification' => 'required|max:50|in:Graduate,Post Graduate',
    		'email' => ['required', 'email', new CandidateEmailValidate($id)],
    		'resume' => 'nullable|mimes:doc,pdf,docx'
    	])->validate();
    	$path = null;
    	if ($request->resume) {
    		$path = $request->resume->store('resumes');
    	}
    	($this->repo)->storeOrUpdateCandidatesData($request, $path, $id);
    	return redirect()->route('managecv')->with('success','Data Updated successfully');
    }

    /**
     * Delete candidate's data for an incoming request.
     *
     * @param  Int     $id
     * @return void
     */
    public function destroy(int $id)
    {
    	($this->repo)->deleteCandidateData($id);
    	return redirect()->route('managecv')->with('success','Data Deleted successfully');
    }
}
