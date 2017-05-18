<html lang="en">
<head>
	<title>Import - Export Laravel 5</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand">Import - Export in Excel and CSV Laravel 5</a>
			</div>
		</div>
	</nav>
	<div class="container">
		<a href="{{ URL::to('file/download/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
		<a href="{{ URL::to('file/download/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
		<a href="{{ URL::to('file/download/csv') }}"><button class="btn btn-success">Download CSV</button></a>
		<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('file/import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
			<input type="file" name="import_file" />
			<button class="btn btn-primary">Import File</button>
			{{ csrf_field() }}
		</form>
	</div>
</body>
</html>