@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#">{{ $thread->owner->name }}</a> posted: 
                        {{ $thread->title }}
                    </div>

                    <div class="panel-body">
                        {{ $thread->body  }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-primary">
                    <div class="panel-heading">Replies</div>

                    <br>

                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            @if (count($thread->replies))
                                @foreach ($thread->replies as $reply)
                                    @include ('threads.partials.reply')
                                @endforeach
                            @else
                                <span>Currently there are not replies to this thread.</span>
                            @endif
                        </div>
                    </div>

                    @if (auth()->check())
                        <hr>

                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <form method="POST" action="{{ $thread->path() . '/replies' }}">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <textarea name="body" id="body" class="form-control" rows="5" placeholder="Have something to say?"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Reply</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
