@extends('layouts.app')

@section('content')
<div class="col-md-6 col-lg-6 col-md-offset-4 col-lg-offset-3">
	<div class="card">
	  <div class="card-header">
			List of Users 
			&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
			&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
			&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
			&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
			&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
			&ensp;&ensp;
			<!--a href="/projects/create" class="pull-right btn btn-primary btn-sm">Create Project</a-->
	  </div>
	  <div class="card-body">
	    <ul class="list-group">
	    @foreach($users as $user)
		  <li class="list-group-item">
				<a href="/users/{{ $user->id }}">{{ $user->name }}</a> <br>
			
				<span><a href="#" onClick="_Delete()" class="text-danger">Delete</a></span>
				<form
					id="delete-form"
					method="POST"
					action="{{ route('users.deleteUser', [$user->id]) }}"
					style="display:none;"
				>
					<input type="hidden" name="_method" value="GET">
					{{ csrf_field() }}
				</form>
			</li>
		  @endforeach
		</ul>
	  </div>
	</div>
</div>
@endsection

<script>
function _Delete(){
  var _delete = confirm('Are you sure you want to delete this user?');
  if(_delete){
    event.preventDefault();
    document.getElementById('delete-form').submit();
  }
}
</script>