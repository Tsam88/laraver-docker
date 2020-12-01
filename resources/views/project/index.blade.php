@extends('import')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Projects</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Code</th>
                    <th>Due Date</th>
                </tr>
                @foreach($data as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->title }}</td>
                    <td>{{ $row->description }}</td>
                    <td>{{ $row->code }}</td>
                    <td>{{ $row->due_date }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
