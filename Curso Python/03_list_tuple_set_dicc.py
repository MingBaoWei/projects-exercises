# Sets (no mantienen el orden de los elementos y no permiten elementos duplicados)
my_set = set()
my_other_set = {}

print(type(my_set)) 
print(type(my_other_set)) # Es tipo diccionario inicialmente {}

my_other_set = {"Set", 1}
print(type(my_other_set))

# Lists (Muchos metodos, sí se puede cambiar)
my_list = list()
my_other_list = []

my_list = {"list", 2}

print(type(my_list)) 
print(my_list)

# Tuples (Pocos metodos, no se puede cambiar, para variables constantes)
my_tuple = tuple()
my_other_tuple = ()

my_tuple = {"tuple", 3}

print(type(my_tuple)) 
print(my_tuple)

# Dictionaries (mantienen el orden de los elementos)
my_dict = dict()
my_other_dict = {}

print(type(my_other_dict)) 

my_other_dict = {"Nombre":"Weiming", "Apellido":"Lai", "Edad": 20, 1:"Python"}

my_dict = {
    "Nombre":"Weiming", 
    "Apellido":"Lai", 
    "Edad": 20, 
    "Lenguajes":{"Python","Java"},
    1:1.7
}

print(my_dict)
print(my_other_dict)