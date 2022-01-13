<!DOCTYPE html>
<html>
<head>
	<title>FORM</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body style="background-color: #d3e8d9;">
	<div class="container">
		<div class="row" style="padding-top: 10%; width: 50%; margin: auto;">
			 @if (isset($answer)) 
			 <div class="alert alert-success" role="alert" style="background-color: #3bff93">
			 	{{ $answer }}
			 </div>
			 @endif
				{{ Form::open(array('url' => '/' )) }}
				<div class="form-group">
			    	{{ Form::label('DealName', 'Название cделки',['style' => 'padding-left: 10px']) }}
			    	{{ Form::text('DealName', '', ['class' => 'form-control']) }}
		    	</div>
		    	<div class="form-group" style = "padding-bottom: 10px;">
			    	{{ Form::label('SubjectTask', 'Название задачи', ['style' => 'padding-left: 10px']) }}
			    	{{ Form::text('SubjectTask', '', ['class' => 'form-control']) }}
		    	</div>
		    	{{ Form::submit('Отправить', ['class' => 'btn btn-success']) }}

				{{ Form::close() }}
			
		</div>
	</div>
<?php 


?>
</body>
</html>


 