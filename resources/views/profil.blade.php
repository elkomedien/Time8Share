@extends('layouts.app')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ Lang::get('profil.title') }}</div>

                <div class="panel-body">
        <div class="panel panel-default">

            <div class="panel-body">
		{{$user->name}}
	   </div>
	   <div align=right>Modifier</div>
	</div>
        <div class="panel panel-default">

            <div class="panel-body">
		@if (count($skills) > 0)
                  @foreach ($skills as $skill)
		
			<div>{{ $skill->name }}</div>
		  @endforeach		

		@endif
           </div>
	  <div align=right>Modifier</div>
        </div>

        <div class="panel panel-default">

            <div class="panel-body">
               <div>{{Lang::get('profil.shares') }} </div>
               <div>{{Lang::get('profil.friends') }} </div>
               <div>{{Lang::get('profil.responses') }} </div>

           </div>
        </div>

    </div>
</div>


@endsection
