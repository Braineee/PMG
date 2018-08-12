@extends('layouts.app')

@section('content')
<div class="col-md-9 col-lg-9 col-sm-12">

  <main role="main">
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-3">{{ $company->name }}</h1>
        <p>{{ $company->description }}</p>
        <p><a class="btn btn-primary btn-sm pull-left" href="/projects/create/{{ $company->id }}" role="button">Add Project</a></p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        @foreach($company->projects as $project)
        <div class="col-md-4">
          <h2>{{ $project->name }}</h2>
          <p>{{ $project->description }}</p>
          <p><a class="btn btn-secondary" href="/projects/{{ $project->id }}" role="button">View Project »</a></p>
        </div>
        @endforeach
      </div>

      <hr>

    </div> <!-- /container -->

  </main>

</div>



  <div class="col-md-3 col-lg-3 col-sm-12 order-md-2 mb-4">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
      <span class="text-muted">Option</span><br>
    </h4>
    <ul class="list-group mb-3">
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0"><a href="/companies/{{ $company->id }}/edit">Edit</a></h6>
        </div>
      </li>
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0">
            
            <a href="#" onClick="_Delete()" class="text-danger">Delete</a>
            <form
              id="delete-form"
              method="POST"
              action="{{ route('companies.destroy', [$company->id]) }}"
              style="display:none;"
            >
              <input type="hidden" name="_method" value="DELETE">
              {{ csrf_field() }}
            </form>
          </h6>
        </div>
      </li>
      <!--li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0"><a href=""  class="text-success">Add new staff</a></h6>
        </div>
      </li-->
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0"><a href="/projects/create/{{ $company->id }}">Add Project</a></h6>
        </div>
      </li>
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0"><a href="/companies/create">Create Company</a></h6>
        </div>
      </li>
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0"><a href="/companies">All Companies</a></h6>
        </div>
      </li>
    </ul>

    <!--h4 class="d-flex justify-content-between align-items-center mb-3">
      <span class="text-muted">Staffs</span><br>
    </h4>
    <ul class="list-group mb-3">
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0">Phillp Daniel</h6>
          <small class="text-muted">Sales Manager</small>
        </div>
      </li>
      <li class="list-group-item d-flex justify-content-between lh-condensed">
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
      </li>
    </ul-->

  </div>
<div>
<script>
function _Delete(){
  var _delete = confirm('Are you sure you want to delete this Company?');
  if(_delete){
    event.preventDefault();
    document.getElementById('delete-form').submit();
  }
}
</script>
@endsection
