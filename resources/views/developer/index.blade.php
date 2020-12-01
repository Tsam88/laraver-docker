@extends('import')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Developers</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Role</th>
                </tr>
                @foreach($data as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->role }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
