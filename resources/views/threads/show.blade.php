@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">

            <div class="col-md-8">

                {{-- Thread Panel --}}
                <div class="panel panel-default">

                    <div class="panel-heading">
                        {{ $thread->title }}
                    </div>

                    <div class="panel-body">
                        {{ $thread->body  }}
                    </div>

                </div>
                {{-- END Thread Panel --}}

                {{-- Thread Replies Panel --}}
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
                                <p>Currently there are not replies to this thread.</p>
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
                        <div class="panel-footer">
                            <span class="text-center center-block">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.</span>
                        </div>
                    @endif
                </div>
                {{-- END Thread Replies Panel --}}

            </div>

            <div class="col-md-4">

                {{-- Sidebar Panel --}}
                <div class="panel panel-default">

                    <div class="panel-heading">Thread Details</div>

                    <div class="panel-body">
                        <p>
                            This thread was published {{ $thread->created_at->diffForHumans() }}<br>
                            By: <a href="#">{{ $thread->owner->name }}</a><br>
                        </p>

                        @if ($thread->replies_count)
                            <p>
                                Thread {{ str_plural('Reply', $thread->replies_count) }}: {{ $thread->replies_count }}
                            </p>
                        @else
                            <p>
                                <strong>No Replies</strong>
                            </p>
                        @endif

                    </div>

                </div>
                {{-- END Sidebar Panel --}}

            </div>

        </div>

    </div>
@endsection
