using SutypJwtExample;

var server = new Server();
var jwt = server.GenerateJWT();
Console.WriteLine($"\nJWT generado: {jwt}\n");
Console.WriteLine("Solicitud HTTP SUTyP -> Concesionaria con JWT\n\n");
var client = new Client();
var valid = client.verifyToken(jwt);

if (valid)
{
    Console.WriteLine("Token válido");
}
else
{
    Console.WriteLine("Token inválido");
}