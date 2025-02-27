import jwt
import time
from claims import claims
from private_key import private_key

def issue_token():
    """
    Generación del JWT por parte del servidor SUTyP
    
    :returns: string
    """
    iss = claims['iss']
    aud = claims['aud']
    sub = claims['sub']

    # NumericDate
    # A JSON numeric value representing the number of seconds from
    # 1970-01-01T00:00:00Z UTC until the specified UTC date/time,
    # ignoring leap seconds.  This is equivalent to the IEEE Std 1003.1,
    # 2013 Edition [POSIX.1] definition "Seconds Since the Epoch", in
    # which each day is accounted for by exactly 86400 seconds, other
    # than that non-integer values can be represented.  See RFC 3339
    # [RFC3339] for details regarding date/times in general and UTC in
    # particular.
    exp = int(time.time()) + 3600  # Current time in seconds + 1 hour (3600 seconds)

    token = jwt.encode({
        'iss': iss,
        'aud': aud,
        'sub': sub,
        'exp': exp,
    }, private_key, algorithm='RS256')

    return token

if __name__ == "__main__":
    print(issue_token())