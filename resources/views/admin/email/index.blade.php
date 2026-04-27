@extends('admin.layouts.admin')

@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Email Manage</h4>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <h3>Inbox ({{ $unreadCount ?? 0 }} Unread)</h3>

            <table class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($messages as $msg)
                    <tr>
                        <td>{{ $msg->name }}</td>
                        <td>{{ $msg->email }}</td>

                        <td>
                            {{ \Illuminate\Support\Str::limit($msg->message, 40) }}
                        </td>

                        <td>
                            @if($msg->is_read)
                            <span class="text-success">Read</span>
                            @else
                            <span class="text-danger">Unread</span>
                            @endif
                        </td>

                        <td class="text-center">

                            <a href="{{ route('admin.email.show', $msg->id) }}" class="btn btn-sm btn-primary me-2">
                                <i class="fa fa-eye"></i> View 
                            </a>

                            <form action="{{ route('admin.email.destroy', $msg->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this message?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection