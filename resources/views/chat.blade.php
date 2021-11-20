@extends('layout.base')

@section('body')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Messages</h2>

                <div class="clearfix">
                    @foreach ($messages as $message)
                        <p>
                            {{$message->user->name}} : {{$message->message}}
                        </p>
                    @endforeach
                </div>

                <form method="post" action="messages" >
                    @csrf

                    <div class="input-group">
                        <input
                            type="text"
                            name="message"
                            class="form-control"
                            placeholder="Type your message here..."
                        >
                        <button
                            class="btn btn-primary"
                            type="submit"
                        >
                        Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
