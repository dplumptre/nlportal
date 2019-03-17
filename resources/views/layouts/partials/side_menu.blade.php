





 






<div class="list-group">
<a href="{{ route('home')}}" class="list-group-item list-group-item-action">Dashboard</a>

@if(auth()->user()->hasRole('admin'))
<a href="{{ route('admin.all.users')}}" class="list-group-item list-group-item-action">Users</a>
<a href="{{ route('admin.view.role')}}" class="list-group-item list-group-item-action">Roles</a>
<a href="{{ route('admin.view.major_issue')}}" class="list-group-item list-group-item-action">Category</a>
<a href="{{ route('admin.view.post')}}" class="list-group-item list-group-item-action">Posts</a>

  @endif


</div>
