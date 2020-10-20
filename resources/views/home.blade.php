@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="row">
                    <h1 class="col ml-5 pt-4">Users</h1>
                    <div class="col-md-4 ml-auto form-group mt-3 mr-3">
                        <input class="form-control" type="text" name="search_user" id="search_user" placeholder="Search">
                    </div>
                </div>
                <div class="card-body">
                    <div  class="container">
                        <table class="table table-striped bg-white">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Phone</th>
                                <th>Registered</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Unverify</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr id="sid{{ $user->id }}">
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td>
                                    <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a></td>
                                    <td>
                                        <button class="btn-sm btn-danger" data-id="{{ $user->id }}" data-token="{{ csrf_token() }}" >Delete</button>
                                    </td>
                                    <td>
                                        @if($user->email_verified_at)
                                            {!! Form::open(['route' => ['users.unverify', $user], 'method' => 'PUT'])!!}
                                            <div class="form-group">
                                                {!! Form::submit('Unverify', ['class'=>'btn btn-success btn-sm']) !!}
                                            </div>
                                            {!! Form::close() !!}
                                        @else
                                            <div class="form-group">
                                                <button class="btn btn-secondary btn-sm disabled">Unverify</button>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination justify-content-center">
{{--                                {{ $users->links() }}--}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="application/javascript">
    $(".deleteProduct").click(function() {
        //on instead of click
        var id = $(this).data("id");
        var token = $(this).data("token");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax(
            {
                url: "users/delete/"+id,
                type: 'PUT',
                dataType: "JSON",
                data: {
                    "id": id,
                    "_method": 'DELETE',
                    "_token": token
                },
                success: function ()
                {
                    $('#sid'+id).fadeOut(3000);
                }
            });
    });

</script>

<script>
    $(document).ready(function () {
        function fetch_customer_data(query = '') {
            $.ajax({
                url:"{{ route('home.search') }}",
                method: 'GET',
                data:{query:query},
                dataType:'json',
                success:function (data) {
                    $('tbody').html(data.table_data);
                }
            })
        }
        $(document).on('keyup', '#search_user', function () {
            var query = $(this).val();
            fetch_customer_data(query);
        });
    });
</script>
@endsection
