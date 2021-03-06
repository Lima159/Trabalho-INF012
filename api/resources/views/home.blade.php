@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" align="center">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Você está logado!
                </div>
                Você será redirecionado para a tela inicial em alguns segundos
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">   
    function Redirect() 
    {  
        window.location="{{ url('/') }}"; 
    } 
    //document.write("You will be redirected to a new page in 5 seconds"); 
    setTimeout('Redirect()', 5000);   
</script>
@endsection
