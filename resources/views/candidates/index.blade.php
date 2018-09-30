@extends("layouts.app")

@section("content")


<div class="container">
    <div class="row">
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
        <a href="{{ route('submitcv') }}" class="btn btn-primary">Add Candidate</a>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Qualification</th>
                    <th>Hobbies</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($candidates as $member)
                <tr>
                    <td>{{ $member->name}}</td>
                    <td>{{ $member->company}}</td>
                    <td>{{ $member->email}}</td>
                    <td>{{ $member->qualification}}</td>
                    <td>{{ $member->hobbies or "" }}</td>
                    <td>
                        <a href="{{ route('editcv', $member->id) }}">Edit</a> | <a href="{{ route('deletecv', $member->id) }}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection