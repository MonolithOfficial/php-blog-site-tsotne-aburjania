<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/posts.css') }}" rel="stylesheet">
    <title>Posts</title>
</head>
<body>
    <header>
        <h1>{{ auth()->user()->name }}</h1>
    </header>
@if(isset($upForEdit))
    <form class="postCreationForm" action="/update-post" method="post">
@else
    <form class="postCreationForm" action="/add-post" method="post">
@endif
        <div class="formLeft">
            <input type="text" placeholder="Title" id="title" @isset($upForEdit) value="{{$upForEdit->title}}" @endisset name="title">
            @csrf

            <input type="text" placeholder="Subtitle" id="subTitle" @isset($upForEdit) value="{{$upForEdit->subTitle}}" @endisset name="subTitle">

            <input type="text" placeholder="Publisher" id="publisher" @isset($upForEdit) value="{{$upForEdit->publisher}}" @endisset name="publisher">

            <input type="date" id="date" @isset($upForEdit) value="{{$upForEdit->date}}" @endisset name="date">
        </div>
        <div class="formRight">
            <textarea id="excerpt" placeholder="Description" @isset($upForEdit) value="{{$upForEdit->excerpt}}" @endisset name="excerpt" rows="4" cols="30">@isset($upForEdit) {{$upForEdit->excerpt}} @endisset</textarea>
            <br>

        @if(isset($upForEdit))
            <input type="hidden" value="{{$upForEdit->id}}" name="id">
            <button id="submit">Change</button>
        @else
            <button id="submit">Submit</button>
        @endif
        </div>
        
    </form>
    <div class="postsHolder">
    @foreach($posts as $post)
        <div class="post">
            <div class="innerPost">
                <p>Title: {{ $post->title }}</p><br>
                <p>subTitle: {{ $post->subTitle }}</p><br>
                <p>publisher: {{ $post->publisher }}</p><br>
                <p>date: {{ $post->date }}</p><br>
                <p>excerpt: {{ $post->excerpt }}...</p><br>

                <div class="controls">
                    <a class="delete" href="/delete-post/{{$post->id}}">Delete</a>
                    <a class="edit" href="/edit-post/{{$post->id}}">Edit</a>
                </div>
                
            </div>
        </div>
    @endforeach
    </div>   
</body>
</html>