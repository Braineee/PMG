<div class="container">
    @foreach($comments as $comment)
    <div class="media comment-box">
        <div class="media-left">
            <a href="#">
                <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading"><a href="/users/{{ $comment->user->id }}">{{ $comment->user->name }}</a></h4>
            <p>
            {{ $comment->body }}
            <br>
            Proof:<a href="#">{{ $comment->url }}</a>
            <br>
            <br>
            <small class="pull-right">commented on {{ $comment->created_at }}</small>
            </p>
        
        </div>
    </div>
    @endforeach
</div> <!-- /container -->