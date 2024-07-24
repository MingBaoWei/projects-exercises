### Exception Handling ###

try:
    print(5 + "5")
except:
    print("Error!")
else:
    print("Se ejecuta si NO hay excepciones")
finally:
    print("Siempre se ejecuta")

# Excepciones por tipo
try:
    print(5 + "5")
except TypeError as error: #Se ejecuta esto porque el error es TypeError
    print(error) # Ha petado pero no se bloquea, ahora podemos ahcer cosas con el mismo error
    print("Error de tipo TypeError")
except ValueError:
    print("Error!")