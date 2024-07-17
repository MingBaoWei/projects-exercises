###LOOPS###

#While
condition = 0

while condition < 3:
    print(condition)
    condition += 1
    if condition == 2:
        print("Si es 2 se sale tambien del loop")
        break
else: # Opcional
    print("La condición ya no se cumple")

#For
list = [5, 4, 3, 2, 1]

for element in list:
    print(element) # Sale los elementos del for directamente, por eso mejor llamarlo por element que i

dict = {"Nombre":"Weiming", "Apellido":"Lai", "Edad": 20, 1:"Python"}

#En diotionaries lo que muestra es la "variable" por asi decirlo, osea "Nombre", "Apellido"...
for element in dict:
    print(element)
#PERO se puede mostrar con values()
for element in dict.values():
    print(element)
    if element == "Lai":
        print("Si es Lai se sale tambien del loop")
        break
else:
    print("Bucle finalizado")