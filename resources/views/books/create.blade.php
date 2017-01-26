@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	<h3>Novo livro</h3>
    	{!! Form::open(['route' => 'books.store','class' => 'form']) !!}
    	
    		@include('books._form')
    	
    		{!! Html::openFormGroup() !!}
    			{!! Button::primary('Enviar')->submit() !!}
    		{!! Html::closeFormGroup() !!}
    	{!! Form::close()!!}
    </div>
</div>
@endsection
