@extends('adminlte::page')

@section('title','Import Members')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Import Members - <a href="{{ asset('/templates/ictau_member_upload_template.xlsx')  }}" >Download template</a> </div>
			<div class="panel-body">

				{!! Form::open(['route' => 'members_saveimport','files' => 'true']) !!}
					<div class="form-group">
                    	{!! Form::label('members_file','Select File to Import:',['class'=>'col-md-3']) !!}
                    	
                    		{!! Form::file('members_file', array('class' => 'form-control')) !!}
                    		{!! $errors->first('members_file', '<p class="alert alert-danger">:message</p>') !!}
                    	
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
