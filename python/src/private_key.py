with open("./keys/private.pem", "r") as file:
    private_key = file.read()

__all__ = ["private_key"]
