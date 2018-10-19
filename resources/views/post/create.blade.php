
<h1>Create Post</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{route('post.store')}}">
    {{csrf_field()}}
    <input type="text" name="title"/>
    <input type="text" name="author[name]"/>
    <input type="text" name="author[desc]"/>
    <textarea cols="20" rows="5" name="body"></textarea>
    <button type="submit">submit</button>
</form>