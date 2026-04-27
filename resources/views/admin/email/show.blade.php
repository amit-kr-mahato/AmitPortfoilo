@extends('admin.layouts.admin')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Email Detail + Reply Page</h4>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <h3>Message Details</h3>

                <p><b>Name:</b> {{ $message->name }}</p>
                <p><b>Email:</b> {{ $message->email }}</p>
                <p><b>Message:</b> {{ $message->message }}</p>

                <hr>

                <h4>Reply</h4>

                {{-- {{ route('email.reply', $message->id) }} --}}

                <form method="POST" action="#">
                    @csrf
                    <textarea name="message" class="form-control"></textarea>
                    <button class="btn btn-primary mt-2">Send Reply</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection