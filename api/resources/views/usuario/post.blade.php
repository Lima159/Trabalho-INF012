<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
}

.header {
  background-color: #9933cc;
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

.container {
  width: 500px;
  clear: both;
}

.container input {
  width: 100%;
  clear: both;
}
</style>
</head>
<body>

<div class="header">
  <h3>Cadastro de Usuários</h3>
</div>

<div class="row">
  <div class="col-3 col-s-3 menu">
    <ul>
      <li> <a href="{{ url('/usuario/get') }}">Voltar</a></li>
    </ul>
  </div>

  <div class="col-6 col-s-9">
    <div>
    <form action="{{ url('/usuario/post/post') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
      <div class="avatar-upload col-12">
          <div class="container">
            {{ csrf_field() }}
              <label for="username">Nome</label>
              <input type="text" name="username" id="username" value=""> 

              <label for="password">Senha</label>
              <input type="text" name="password" id="password" value=""> 

              <label for="email">E-mail</label>
              <input type="text" name="email" id="email" value="">

              <label for="user_registration">Matrícula</label>
              <input type="text" name="user_registration" id="user_registration" value="">

              <label for="adress">Endereço</label>
              <input type="text" name="adress" id="adress" value=""> 

              <label for="tel">Telefone</label>
              <input type="text" name="tel" id="tel" value="">
          </div>
      </div>
      <div class="avatar-upload col-6">
      <button type="submit" class="btn btn-success">Enviar</button>
      </div>
    </form>
  </div>
  </div>

  <div class="col-3 col-s-12">
    <div class="aside">
      <h2>O que é?</h2>
      <p>X.</p>
      <h2>Como fazer?</h2>
      <p>Y.</p>
      <h2>Quando fazer?</h2>
      <p>Z.</p>
    </div>
  </div>
</div>

<div class="footer">
  <p>Desenvolvido por Igor Lima e Paulo Vitor.</p>
</div>

</body>
</html>
