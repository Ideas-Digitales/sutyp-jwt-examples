import jwt
from claims import claims
from public_key import public_key

def verify_token(token):
    """
    Verificación del JWT por parte del API de la concesionaria
    
    :returns: boolean
    """
    iss = claims['iss']
    aud = claims['aud']
    sub = claims['sub']

    try:
        decoded = jwt.decode(token, public_key, audience=aud, issuer=iss, subject=sub, algorithms=['RS256'])
        print('Token verified:', decoded)  # Token verificado exitosamente
        return True
    except jwt.InvalidTokenError as error:
        print('Invalid token:', error)
        return False

if __name__ == "__main__":
    # Example usage
    token = "your_jwt_token_here"
    verify_token(token)