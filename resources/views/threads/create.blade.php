@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    {{-- Heading --}}
                    <div class="panel-heading">Create a New Thread</div>
                    {{-- END Heading --}}

                    <div class="panel-body">

                        {{-- Form Errors --}}
                        @include ('layouts.partials.errors')
                        {{-- END Form Errors --}}

                        {{-- Create Thread Form --}}
                        <form method="POST" action="/threads">

                            {{ csrf_field() }}

                            {{-- Choose Thread Channel --}}
                            <div class="form-group">
                                <label for="channel_id">Choose a Channel</label>

                                {{-- Thread Channel Dropdown --}}
                                <select id="channel_id" name="channel_id" class="form-control" required>

                                    <option value="" {{ old('channel_id') ? '' : 'selected' }} disabled>
                                        Choose One
                                    </option>

                                    {{-- Loop Existing Channels --}}
                                    @foreach (App\Channel::all() as $channel)
                                        <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                                            {{ $channel->slug }}
                                        </option>
                                    @endforeach
                                    {{-- END Loop Existing Channels --}}

                                </select>
                                {{-- END Thread Channel Dropdown--}}
                            </div>
                            {{-- END Choose Thread Channel --}}

                            {{-- Set Thread Title --}}
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                            </div>
                            {{-- END Set Thread Title --}}

                            {{-- Set Thread Body --}}
                            <div class="form-group">
                                <lable for="body">Body</lable>
                                <textarea id="body" class="form-control" name="body" rows="8" required>{{ old('body') }}</textarea>
                            </div>
                            {{-- END Set Thread Body --}}

                            {{-- Publish Thread Button --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Publish</button>
                            </div>
                            {{-- END Publish Thread Button --}}

                        </form>
                        {{-- END Create Thread Form--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
