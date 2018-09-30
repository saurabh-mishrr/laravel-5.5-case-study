<?php
/**
 * @author Saurabh Mishra
 * @version 1
 * 
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidate;
use Validator;

class CandidatesController extends Controller
{
    public function index()
    {
    	$candidates = Candidate::orderBy('name', 'asc')->paginate(10);
    	return view('candidates.index', compact('candidates'));
    } 

    public function create()
    {
    	return view('candidates.form');
    }

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

    	$model = new Candidate;
    	$model->name = $request->name;
    	$model->email = $request->email;
    	$model->company = $request->company;
    	$model->qualification = $request->qualification;
    	$model->resume = $path;
    	$model->save();

    	return redirect()->route('managecv')->with('message', 'Data Saved Successfully!');
    	
    }

    public function edit($id) 
    {
    	$candidates = Candidate::find($id);
    	$updateText = 'Update';

    	return view('candidates.form', compact('candidates', 'updateText'));
    }

    public function update(Request $request, Candidate $candidates, $id)
    {
    	$validator = Validator::make($request->all(),[
    		'name' => 'required|max:20',
    		'company' => 'required|max:50',
    		'hobbies' => 'required',
    		'qualification' => 'required|max:50|in:Graduate,Post Graduate',
    		'email' => 'required|email',
    		'resume' => 'nullable|mimes:doc,pdf,docx'
    	])->validate();
    	if ($validator->fails()) {
    		return redirect()->back()->withInput();
    	}
    	#$path = $request->resume->store('resumes');
    	$candidate = Candidate::find($id);
    	$candidate->name = $request->name;
    	$candidate->email = $request->email;
    	$candidate->company = $request->company;
    	$candidate->qualification = $request->qualification;
    	#$candidate->resume = $path;
    	$candidate->save();
    	return redirect()->route('managecv')->with('success','Data Updated successfully');
    }

    public function destroy($id)
    {
    	Candidate::destroy($id);
    	return redirect()->route('managecv')->with('success','Data Deleted successfully');
    }
}
