@extends('layouts.admin')

@section('content')
    @include('partials.errors')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.update') }}" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input
                            type="text"
                            class="form-control"
                            id="title"
                            name="title"
                            value="{{ $post['title'] }}">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input
                            type="text"
                            class="form-control"
                            id="content"
                            name="content"
                            value="{{ $post['content'] }}">
                </div>
                {{ csrf_field() }}
                @foreach($tags as $tag)
                    <div class="checkbox">
                        <label>
                                <input  type="checkbox" name="tags[]" 
                                        {{$post->tags->contains($tag->id)?'checked':''}}
                                        value="{{ $tag->id }}">
                                        {{$tag->name}}
                        </label>
                    </div>
                @endforeach

                <input type="hidden" name="id" value="{{ $postId }}">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection