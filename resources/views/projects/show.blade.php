@extends('layouts.app')

@section('content')
<div class="col-md-9 col-lg-9 col-sm-12">

  <main role="main">
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="well well-lg">
      <div class="container">
        <h1 class="display-4">{{ $project->name }}</h1>
        <p>{{ $project->description }}</p>
        <!--p><a class="btn btn-primary btn-sm pull-left" href="#" role="button">Add Project</a></p-->
      </div>
    </div>
    <br>

    <hr>

    <!-- we would be including comments here -->
    @include('partials.comments')

    <hr>

    <form method="POST" action="{{ route('comments.store') }}">
      
      <div class="form-group">
        <label for="comment_content">Comment:</label>
        <textarea placeholder="Enter comment"
                style="resize: vertical"
                class="form-control autosize-target text-left" 
                id="comment-content"
                name="body"
                rows="5"
                spellcheck="false">
        </textarea>
      </div>

      <div class="form-group">
        <label for="comment_content">Proof of work done (Url/Photo):</label>
        <textarea placeholder="Enter url (proof of work done)"
                style="resize: vertical"
                class="form-control autosize-target text-left" 
                id="comment-content"
                name="url"
                rows="1"
                spellcheck="false">
        </textarea>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
      <input type="hidden" name="commentable_type" value="App\Project">
      <input type="hidden" name="commentable_id" value="{{ $project->id }}">
      {{ csrf_field() }}
    </form>
    <br>

  </main>
 
</div>



  <div class="col-md-3 col-lg-3 col-sm-12 order-md-2 mb-4">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
      <span class="text-muted">Option</span><br>
    </h4>
    <ul class="list-group mb-3">
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0"><a href="/projects/{{ $project->id }}/edit">Edit</a></h6>
        </div>
      </li>
      @if($project->user_id == Auth::user()->id)
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0">
            
            <a href="#" onClick="_Delete()" class="text-danger">Delete</a>
            <form
              id="delete-form"
              method="POST"
              action="{{ route('projects.destroy', [$project->id]) }}"
              style="display:none;"
            >
              <input type="hidden" name="_method" value="DELETE">
              {{ csrf_field() }}
            </form>
          </h6>
        </div> 
      </li>
      @endif
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0"><a href="/projects/create">Add Project</a></h6>
        </div>
      </li>
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0"><a href="/projects">All projects</a></h6>
        </div>
      </li>
    </ul>

    <!--
        LIST USERS 
    -->
    <form method="POST" action="{{ route('projects.adduser') }}">
      <div class="input-group">
        <input
              type="hidden"
              name="project_id"
              value="{{ $project->id }}"
        >
        <input
              type="text"
              name="email"
              placeholder="Enter email"
              class="form-control"
        >
        <span class="input-group-btn">
          <input
              type = "submit"
              class = "btn btn-default"
              value = "Add"
          >
        </span>
        {{ csrf_field() }}
      </div>
    </form>
    <br>
    <h4 class="d-flex justify-content-between align-items-center mb-3">
      <span class="text-muted">Users</span><br>
    </h4>
    <ul class="list-group mb-3">
    @foreach($project->user as $user)
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0">{{ $user->name }}</h6>
          <small class="text-muted">Team Member</small>
        </div>
      </li>
    @endforeach
      <!--li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0">Samuel Yinka</h6>
          <small class="text-muted">Operations Manager</small>
        </div>
      </li>
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0">Omario John</h6>
          <small class="text-muted">HOD HR</small>
        </div>
      </li-->
    </ul>


  </div>
<div>


<script>
function _Delete(){
  var _delete = confirm('Are you sure you want to delete this project?');
  if(_delete){
    event.preventDefault();
    document.getElementById('delete-form').submit();
  }
}
</script>
@endsection
