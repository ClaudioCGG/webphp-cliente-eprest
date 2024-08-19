<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
  </head>
  <body>
    <form action="./register_end.php" method="post">
      <label for="name">Ingrese nombre</label>
      <input type="text" name="name" class="" />
      <br />
      <label for="email">Ingrese correo</label>
      <input type="email" name="email" class="" />
      <br />
      <label for="password">Ingrese una contraseña</label>
      <input type="password" name="password" class="" />
      <br />
      <select name="sector" id="">
        <option value="IT Department">IT Department</option>
        <option value="Sales">Sales</option>
        <option value="Graphic Design">Graphic Design</option>
        <option value="Marketing">Marketing</option>
      </select>
      <button type="submit">Registrarse</button>
    </form>
  </body>
</html>
