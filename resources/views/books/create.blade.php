@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	<h3>Novo livro</h3>
    	{!! Form::open(['route' => 'books.store','class' => 'form']) !!}
    	
    	<div class='form-group'>
    		{!! Form::label('title','Título') !!}
    		{!! Form::text('title',null,['class' => 'form-control']) !!}
    	</div>
    	
    	<div class='form-group'>
    		{!! Form::label('subtitle','Subtítulo') !!}
    		{!! Form::text('subtitle',null,['class' => 'form-control']) !!}
    	</div>
    	
    	<div class='form-group'>
    		{!! Form::label('price','Valor') !!}
    		{!! Form::text('price',null,['class' => 'form-control']) !!}
    	</div>
    	
    	<div class='form-group'>
    		{!! Form::submit('Cadastrar livro',['class' => 'btn btn-primary']) !!}
    	</div>
    	{!! Form::close()!!}
    </div>
</div>
@endsection
