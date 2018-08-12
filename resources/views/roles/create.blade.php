@extends('layouts.app')

@section('content')
<div class="col-md-9 col-lg-9 col-sm-12">

  <main role="main">

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <h1>Create new role</h1>
        <div class="col-md-12 col-lg-12 col-sm-12">
        <form method="POST" action="{{ route('roles.store') }}">
          <div class="form-group">
            <label for="company-name"><span class="required">*</span>Name:</label>
            <input type="text" placeholder="Enter role name here"
                   class="form-control" 
                   id="company-name"
                   required
                   name="name"
                   spellcheck="false"
            >
          </div>
          <!--div class="form-group">
            <label for="company_content">Description:</label>
            <textarea placeholder="Enter description"
                   style="resize: vertical"
                   class="form-control autosize-target text-left" 
                   id="company-content"
                   name="description"
                   spellcheck="false">
            </textarea>
          </div-->

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
          <h6 class="my-0"><a href="/roles">All Roles</a></h6>
        </div>
      </li>
    </ul>
  </div>
<div>
@endsection
