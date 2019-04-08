@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="quote">{{ $post->title }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <p>Likes: {{ $post->likes()->count() }} - <a href="{{ route('blog.post.like', ['id'=>$post->id]) }}">Like</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>Tags: 
                @foreach($post->tags as $tag)
                    <span> - {{ $tag->name }} - </span>
                @endforeach
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>{{ $post->content }}</p>
        </div>
    </div>
@endsection