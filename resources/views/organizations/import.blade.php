@extends('adminlte::page')

@section('title','Import Organizations')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Import Organizations</div>
			<div class="panel-body">
				{!! Form::open(['route' => 'organizations_saveimport','files' => 'true']) !!}
					<div class="form-group">
                    	{!! Form::label('organization_file','Select File to Import:',['class'=>'col-md-3']) !!}
                    	
                    		{!! Form::file('organization_file', array('class' => 'form-control')) !!}
                    		{!! $errors->first('organization_file', '<p class="alert alert-danger">:message</p>') !!}
                    	
                	</div>
					
					<div class="form-group">
        				{!! Form::submit('Submit',['class'=>'btn btn-primary pull-right col-md-3']) !!}
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	
</div>
@endsection
