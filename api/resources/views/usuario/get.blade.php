<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<style>
* {
  box-sizing: border-box;
}

.row::after {
  content: "";
  clear: both;
  display: table;
}

[class*="col-"] {
  float: left;
  padding: 15px;
}

html {
  font-family: "Lucida Sans", sans-serif;
  background: url("/images/biblioteca.png");
}

.header {
  background-color: #99ccff;
  color: #ffffff;
  padding: 15px;
}

.menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.menu li {
  padding: 8px;
  margin-bottom: 7px;
  background-color: #33b5e5;
  color: #ffffff;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.menu li:hover {
  background-color: #0099cc;
}

.aside {
  background-color: #33b5e5;
  padding: 15px;
  color: #ffffff;
  text-align: center;
  font-size: 14px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.footer {
  background-color: #0099cc;
  color: #ffffff;
  text-align: center;
  font-size: 12px;
  padding: 15px;
}

/* For mobile phones: */
[class*="col-"] {
  width: 100%;
}

@media only screen and (min-width: 600px) {
  /* For tablets: */
  .col-s-1 {width: 8.33%;}
  .col-s-2 {width: 16.66%;}
  .col-s-3 {width: 25%;}
  .col-s-4 {width: 33.33%;}
  .col-s-5 {width: 41.66%;}
  .col-s-6 {width: 50%;}
  .col-s-7 {width: 58.33%;}
  .col-s-8 {width: 66.66%;}
  .col-s-9 {width: 75%;}
  .col-s-10 {width: 83.33%;}
  .col-s-11 {width: 91.66%;}
  .col-s-12 {width: 100%;}
}
@media only screen and (min-width: 768px) {
  /* For desktop: */
  .col-1 {width: 8.33%;}
  .col-2 {width: 16.66%;}
  .col-3 {width: 25%;}
  .col-4 {width: 33.33%;}
  .col-5 {width: 41.66%;}
  .col-6 {width: 50%;}
  .col-7 {width: 58.33%;}
  .col-8 {width: 66.66%;}
  .col-9 {width: 75%;}
  .col-10 {width: 83.33%;}
  .col-11 {width: 91.66%;}
  .col-12 {width: 100%;}
}
</style>
</head>
<body>

<script src="https://kit.fontawesome.com/8c1ffbfc2c.js" crossorigin="anonymous"></script>

<div class="header" align="center">
  <h1>Visualizar Usuários</h1>
</div>

<div class="row">
  <div class="col-3 col-s-3 menu">
      <ul>
        <li> <a href="{{ url('/usuario/post') }}">Adicionar Novo Registro</a></li>
      </ul>
    </div>

  <div class="col-6 col-s-9">    
    <table border="1px solid black;" style="background-color: white">
      <thead>
        <tr>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Matrícula</th>
          <th>Endereço</th>
          <th>Telefone</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($newbody as $item)
          <tr>
            <td> {{ $item['username'] }} </td>
            <td> {{ $item['email'] }} </td>
            <td> {{ $item['user_registration'] }} </td>
            <td> {{ $item['adress'] }} </td>
            <td> {{ $item['tel'] }} </td>
            <td>
              <a href="{{ URL('/usuario/edit', [$item['user_registration']]) }}" class="far fa-edit"></a>
              <a href="{{ URL('/usuario/delete', [$item['user_registration']]) }}" class="far fa-trash-alt"></a>
            </td>
          </tr>
        @endforeach
      </tbody>      
    </table>
  </div>
  <div class="col-3 col-s-12">
    <div class="aside">
      <ul>
        <li> <a href="{{ url('/') }}" style="font-size: 25px;">Início</a></li>
        <li> <a href="{{ url('/usuario/get') }}" style="font-size: 25px;">Usuários</a></li>
        <li> <a href="{{ url('/livro/get') }}" style="font-size: 25px;">Livros</a></li>
        <li> <a href="{{ url('/emprestimo/get') }}" style="font-size: 25px;">Empréstimos</a></li>
        <li> <a href="{{ url('/sessao/get') }}" style="font-size: 25px;">Sessões</a></li>
      </ul>
    </div>
  </div>
  
</div>

<div class="footer">
  <p>Desenvolvido por Igor Lima e Paulo Vitor.</p>
</div>

</body>
</html>
