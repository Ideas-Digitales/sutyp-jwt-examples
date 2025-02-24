const jwt = require('jsonwebtoken');
const { claims } = require('./claims');
const publicKey = require('./publicKey');

/**
 * Verificación del JWT por parte del API de la concesionaria
 * 
 * @returns boolean
 */
function verifyToken(token) {

  const { iss, aud, sub } = claims;

  try {
    const decoded = jwt.verify(token, publicKey, { audience: aud, issuer: iss, subject: sub  });
    console.log('Token verified:', decoded); // Token verificado exitosamente
    return true;
  } catch (error) {
    console.error('Invalid token:', error);
    return false;
  }
}

module.exports = { verifyToken };