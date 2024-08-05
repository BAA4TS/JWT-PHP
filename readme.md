# JWT PHP Demo

Esta es una demostración simple de cómo implementar JSON Web Tokens (JWT) en PHP. El proyecto incluye dos archivos principales para mostrar los conceptos básicos del JWT:

1. **Al iniciar sesión por primera vez**: Se crea un token JWT.
2. **Al iniciar sesión por segunda vez**: Se muestra en la consola los datos del token JWT.

## Archivos

- `api.php`: Maneja la autenticación y la gestión del JWT.
- `login.php`: Proporciona una interfaz HTML para que los usuarios inicien sesión y creen un JWT.

![Video de demostración](/source/JWT.mp4)

## Descripción

### `api.php`

Este archivo es responsable de manejar la autenticación de usuarios y la generación de JWT. Su funcionamiento es el siguiente:

1. **Validación de Solicitud POST:**
   - **Entrada:** Espera una solicitud POST con un cuerpo JSON que contenga `username` y `password`.
   - **Errores de Entrada:** Devuelve un error si los campos `username` o `password` están vacíos.
   - **Autenticación:** Verifica si `username` y `password` coinciden con los valores predefinidos (`carlos` y `1234`). Si no coinciden, devuelve un error.

2. **Manejo de Cookies JWT:**
   - **Cookie JWT Existente:** Si ya hay una cookie JWT (`JWT`), se decodifica y se muestra el contenido del token.
   - **Cookie JWT Ausente:** Si no hay una cookie JWT, se genera un nuevo JWT con los siguientes datos en el payload:
     - `iss` (Issuer): La URL del emisor.
     - `aud` (Audience): La URL del destinatario.
     - `iat` (Issued At): La fecha y hora de emisión.
     - `nbf` (Not Before): La fecha y hora en la que el token empieza a ser válido.
     - `Nombre`: Nombre del usuario (en este caso, "Carlos").

   El JWT se guarda en una cookie llamada `JWT`, válida durante 30 días. La respuesta JSON confirma el éxito.

### `login.php`

Este archivo ofrece un formulario simple para que los usuarios puedan iniciar sesión. El formulario envía una solicitud POST a `api.php` con las credenciales del usuario.

- **Formulario de Inicio de Sesión:** Incluye campos para nombre de usuario y contraseña.
- **JavaScript:** Maneja el envío del formulario con `fetch` a `api.php`. La respuesta del servidor (ya sea un error o el JWT) se muestra en la consola del navegador.

## Instalación

Este proyecto utiliza la librería [Firebase PHP-JWT](https://github.com/firebase/php-jwt). Instálala usando Composer:

```bash
composer require firebase/php-jwt
```

## Uso

1. **Inicia el servidor PHP:**

   Usa el servidor de desarrollo de PHP con el siguiente comando:

   ```bash
   php -S localhost:8000
   ```

2. **Accede a la página de inicio de sesión:**

   Navega a `http://localhost:8000/login.php` en tu navegador.

3. **Inicia sesión:**

   Usa las credenciales:

   - Usuario: `carlos`
   - Contraseña: `1234`

   Al iniciar sesión, se enviará una solicitud POST a `api.php`. Si las credenciales son válidas, se generará un JWT y se guardará en una cookie. Si ya tienes un JWT válido en la cookie, se mostrará en la consola.

---

Esta es una demostración simple para entender el funcionamiento de los JWT en PHP.
