using System.IdentityModel.Tokens.Jwt;
using System.Security.Claims;
using System.Security.Cryptography;
using Microsoft.IdentityModel.Tokens;

namespace SutypJwtExample;

public class Server
{
    public Server()
    {
        var path = Directory.GetCurrentDirectory();
        var pemPath = $"{path}/private.pem";
        pem = File.ReadAllText(pemPath).ToCharArray();
    }

    private char[] pem;

    public string GenerateJWT()
    {
        var tokenHandler = new JwtSecurityTokenHandler();
        ReadOnlySpan<char> pemSpan = new ReadOnlySpan<char>(pem);
        var rsa = new RSAOpenSsl();
        rsa.ImportFromPem(pemSpan);
        var securityKey = new RsaSecurityKey(rsa);
        
        var payload = new JwtPayload(
            issuer: DefinedClaims.Issuer,
            audience: DefinedClaims.Audience,
            claims: new[] { new Claim(System.IdentityModel.Tokens.Jwt.JwtRegisteredClaimNames.Sub, DefinedClaims.Sub) },
            notBefore: null,
            expires: DateTime.UtcNow.AddSeconds(30)
        );

        var header = new JwtHeader(new SigningCredentials(securityKey, SecurityAlgorithms.RsaSha256));
        var securityToken = new JwtSecurityToken(header, payload);
        return tokenHandler.WriteToken(securityToken);
    }
}
