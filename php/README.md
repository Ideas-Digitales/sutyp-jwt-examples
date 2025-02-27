# Comunicación JWT

## Requerimientos de ejecución C#

- PHP 8.3+

## Documentación de la implementación

Esta implementación está basada en el esquema de llave pública / privada RSA. El sistema SUTyP es quien ha de generar el JWT utilizando la llave privada, mientras que el backend del API de la concesionaria será quien autentique el JWT utilizando la llave pública que les será proporcionada.

[Implementación de la validación JWT para las concesionarias](./src/Client.php)

Las concesionarias solamente van a requerir de la llave pública, no obstante, para ejecutar el [ejemplo de flujo completo](./src/Server.php) de implementación es necesario generar una llave privada y posteriormente una pública utilizando la llave privada generada con anterioridad.

```
openssl genrsa -out ./keys/private.pem 4096 && \
openssl rsa -in ./keys/private.pem -out ./keys/public.pem -pubout
```

Por otra parte, en el código se proporcionan [claims de ejemplo](./src/Claim.php), no obstante éstos claims deben ser acordados por ambas partes (SUTyP y Concesionarias), ya que deben ser exactamente los mismos tanto para generar como para verificar el JWT.