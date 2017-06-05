@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Threads</div>

                    <div class="panel-body">
                        @if (count($threads))
                            @foreach ($threads as $thread)
                                <article>
                                    <h4>
                                        <a href="{{ $thread->path() }}">
                                            {{ $thread->title }}
                                        </a>
                                    </h4>
                                    <div class="body">{{ $thread->body  }}</div>
                                </article>

                                <hr>
                            @endforeach
                        @else
                            <span>Currently there are no threads available.</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
