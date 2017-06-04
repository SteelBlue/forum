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

                    @if (auth()->check())
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <form>
                                <div class="form-group">
                                    <label></label>
                                </div>
                            </form>
                        </div>
                    </div>

                    <br>
                    @endif

                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            @foreach ($thread->replies as $reply)
                                @include ('threads.partials.reply')
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
