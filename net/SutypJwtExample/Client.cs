using System;
using System.IdentityModel.Tokens.Jwt;
using System.Security.Claims;
using System.Security.Cryptography;
using Microsoft.IdentityModel.Tokens;

namespace SutypJwtExample;

public class Client
{
    public Client()
    {
        var path = Directory.GetCurrentDirectory();
        var pemPath = $"{path}/public.pem";
        pem = File.ReadAllText(pemPath).ToCharArray();
    }
    private char[] pem;

    public bool verifyToken(string jwt)
    {
        var tokenHandler = new JwtSecurityTokenHandler();
        ReadOnlySpan<char> pemSpan = new ReadOnlySpan<char>(pem);
        var rsa = new RSAOpenSsl();
        rsa.ImportFromPem(pemSpan);
        var securityKey = new RsaSecurityKey(rsa);
        
        TokenValidationParameters parameters = new TokenValidationParameters()
        {
            ValidateIssuer = true,
            ValidIssuer = DefinedClaims.Issuer,
            ValidateAudience = true,
            ValidAudience = DefinedClaims.Audience,
            ValidateIssuerSigningKey = true,
            IssuerSigningKey = securityKey,
            ClockSkew = TimeSpan.Zero
        };

        try
        {
            var claimsPrincipal = tokenHandler.ValidateToken(jwt, parameters, out SecurityToken validatedToken);
            var claims = claimsPrincipal.Claims.AsEnumerable();

            // "sub" claim is mapped to "http://schemas.xmlsoap.org/ws/2005/05/identity/claims/nameidentifier"
            var sub = claimsPrincipal.FindFirst(c => c.Type == ClaimTypes.NameIdentifier);

            if (sub == null)
            {
                throw new Exception("\"sub\" claim not found");
            }

            if (sub.Value != DefinedClaims.Sub)
            {
                throw new Exception("Invalid \"sub\" claim");
            }

            return true;
        }
        catch(Exception e)
        {
            Console.WriteLine("Invalid token: " + e);
            return false;
        }
    }
}
