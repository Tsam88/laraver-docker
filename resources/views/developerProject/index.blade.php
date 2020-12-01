@extends('import')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Developers-Projects</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Developer Id</th>
                    <th>Developer Name</th>
                    <th>Role</th>
                    <th>Project Id</th>
                    <th>Project Title</th>
                    <th>Description</th>
                    <th>Developer Code</th>
                    <th>Due Date</th>
                </tr>
                @foreach($data as $developer)
                    @foreach ($developer->projects as $project)
                    <tr>
                        <td>{{ $developer->id }}</td>
                        <td>{{ $developer->name }}</td>
                        <td>{{ $developer->role }}</td>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->code }}</td>
                        <td>{{ $project->due_date }}</td>
                    </tr>
                    @endforeach
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
