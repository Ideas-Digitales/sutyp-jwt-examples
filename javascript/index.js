const { issueToken } = require('./src/server');
const { verifyToken } = require('./src/client');

// SUTyP genera token
const token = issueToken();

// SUTyP envía solicitud http al API de Concesionaria con el token previamente generado

// API de Concesionaria verifica el token 
validToken = verifyToken(token);

if (validToken) {
  console.log('Token is valid');
} else {
  console.log('Token is invalid');
}