@extends('layouts.app')

@section('content')
<div class="col-md-9 col-lg-9 col-sm-12">

  <main role="main">

    <div class="container">
    <h1>Create new project</h1>
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
        <form method="POST" action="{{ route('projects.store') }}">

          <!-- 
            list the set of 
            company by this user
            if a company is not available
          -->
          @if($companies != null)
            <div class="form-group">
              <label for="comapny-name"><span class="required">*</span>Select company:</label>
              <select name="company_id"
                      class="form-control"
                      required
              >
                @foreach($companies as $company)
                  <option value="{{ $company->id }}"> {{ $company->name }} </option>
                @endforeach
              </select>
            </div>
          @endif

          <div class="form-group">
            <label for="project-name"><span class="required">*</span>Name:</label>
            <input type="text" placeholder="Enter project name here"
                   class="form-control" 
                   id="project-name"
                   required
                   name="name"
                   spellcheck="false"
            >
          </div>

          @if($companies == null)
            <input type="hidden"
                    name="company_id"
                    value="{{ $company_id }}"
            >
          @endif

          <div class="form-group">
            <label for="project_content">Description:</label>
            <textarea placeholder="Enter description"
                   style="resize: vertical"
                   class="form-control autosize-target text-left" 
                   id="project-content"
                   name="description"
                   spellcheck="false">
            </textarea>
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
          {{ csrf_field() }}
        </form>
        </div>
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
          <h6 class="my-0"><a href="/projects">All projects</a></h6>
        </div>
      </li>
    </ul>
  </div>
<div>
@endsection
