@extends('layouts.app')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>  

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ Lang::get('home.dashboard') }}</div>

                <div class="panel-body">
                    {{ Lang::get('home.skills') }}

			 <!-- Display Validation Errors -->
		        @include('common.errors')

		        <!-- New Skill Form -->
		        <form action="/skill" method="POST" class="form-horizontal">
		            {{ csrf_field() }}

		            <!-- Skill Name -->
		            <div class="form-group">
		                <label for="skill" class="col-sm-3 control-label">{{ Lang::get('home.skill') }}</label>

                		<div class="col-sm-6">
		                    <!-- input type="text" name="name" id="skill-name" class="form-control"-->
				    <input class="typeahead form-control" style="margin:0px auto;width:300px;" type="text" name="name" id="skill-name" >
		                </div>
		            </div>

		            <!-- Add Skill Button -->
		            <div class="form-group">
		                <div class="col-sm-offset-3 col-sm-6">
		                    <button type="submit" class="btn btn-default">
		                        <i class="fa fa-plus"></i> {{ Lang::get('home.add_skill') }}
                		    </button>
		                </div>
		            </div>
		        </form>
@if (count($skills) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ Lang::get('home.current_skills') }}
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>{{ Lang::get('home.skill') }}</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($skills as $skill)
                            <tr>
                                <!-- Skill Name -->
                                <td class="table-text">
                                    <div>{{ $skill->name }}</div>
                                </td>

                                <td>

<tr>
    <!-- Skill Name -->
    <td class="table-text">
        <div>{{ $skill->name }}</div>
    </td>

    <!-- Delete Button -->
    <td>
        <form action="/skill/{{ $skill->id }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <button>{{ Lang::get('home.delete_skill') }}</button>
<input type="hidden" name="_method" value="DELETE">
        </form>
    </td>
</tr>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
</script>


@endsection
