@extends("layouts.app")


@section('content')


<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-push-4">
			<h1>{{ $updateText or "Add" }} Candidate</h1>
		</div>
		<div class="col-md-12">
			@if ($message = Session::get('success'))
				<div class="alert alert-success">
					<p>{{ $message }}</p>
				</div>
			@endif
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
		</div>
		<div class="col-md-4 col-md-push-4">
			<a href="{{ route('managecv') }}" class="btn btn-primary">View Candidates</a>
			<form method="post" enctype="multipart/form-data">
			  {{ csrf_field() }}
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Name</label>
			    <input type="text" name = 'name' class="form-control" id="exampleFormControlInput1" placeholder="Name" value="{{ $candidates->name or old('name') }}">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Company</label>
			    <input type="text" name = 'company'  class="form-control" id="exampleFormControlInput1" placeholder="Company" value="{{ $candidates->company or old('company') }}">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Email</label>
			    <input type="text" name = 'email'  class="form-control" id="exampleFormControlInput1" placeholder="Email" value="{{ $candidates->email or old('email') }}">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Hobbies</label>
			    	@if (!empty($candidates->hobbies))
				    	@php
				    		$hobbies = explode(',', $candidates->hobbies);
				    		$i = 1;
				    		$moreHobbies = '';
				    	@endphp
					@endif
					@if (!empty($hobbies)) 
						@foreach ($hobbies as $hobbiesVal)
				    		<input type="text" name = 'hobbies[]'  class="form-control" id="exampleFormControlInput1" placeholder="Hobbies" value="{{ $hobbiesVal }}">
				    		@if ($i == 1)
						    	<div class="input-group-append">
						    		<button type="button" class="btn btn-outline-secondary add-more-hobbies">+</button>
						    	</div>
				    		@endif
				    		@php
				    		 	++$i;
				    		@endphp
						@endforeach	
					@else
						<input type="text" name = 'hobbies[]'  class="form-control" id="exampleFormControlInput1" placeholder="Hobbies" value="{{ $candidates->hobbies or old('hobbies') }}">	
						<div class="input-group-append">
				    		<button type="button" class="btn btn-outline-secondary add-more-hobbies">+</button>
				    	</div>	    	
					@endif
			    <div class="more-hobbies-container"> </div>
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlSelect1">Qualification</label>
			    <select class="form-control" name = 'qualification'  id="exampleFormControlSelect1" value="{{ $candidates->qualification or old('qualification') }}">
			      <option value="">Choose</option>
			      <option value="Graduate" @if(isset($candidates->qualification) && $candidates->qualification == 'Graduate') {{ "selected" }}  @endif>Graduate</option>
			      <option value="Post Graduate" @if(isset($candidates->qualification) && $candidates->qualification == 'Post graduate') {{ "selected" }}  @endif>Post Graduate</option>
			    </select>
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlFile1">Upload Resume</label>
			    <input type="file" value="{{ $candidates->resume or old('resume') }}" name = 'resume' class="form-control-file" id="exampleFormControlFile1">
			  </div>
			  <button type="submit" class="btn btn-primary">{{ $updateText or "Submit" }}</button>
			</form>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">
	
	$(function(){
		$('.add-more-hobbies').click(function(){
			let total_hobbies = $('input[name="hobbies"]').length;
			$('.more-hobbies-container').append('</br><input type="text" name = "hobbies[]"  class="form-control" id="exampleFormControlInput1" placeholder="Hobbies">');
		});
	})
</script>

@endsection