with open('./keys/public.pem', 'r') as file:
    public_key = file.read()

__all__ = ['public_key']