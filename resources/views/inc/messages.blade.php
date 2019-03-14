{{-- here we check the fail validation /session value ie session success & session values --}}
@if(count($errors) > 0)
   @foreach ($errors->all() as $error)
      <div class ="alert alert-danger">
           {{$error}}
      </div>
   @endforeach
@endif

@if(session('succuss'))
   <div class = "alert alert-success">
          {{session('success')}}
   </div>
@endif

@if(session('error'))
   <div class = "alert alert-danger">
          {{session('error')}}
   </div>
@endif