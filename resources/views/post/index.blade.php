@extends('import')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Posts</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Photo</th>
                </tr>
                @foreach($data as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->title }}</td>
                    <td>{{ $row->description }}</td>
                    <td>{{ $row->photo }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
