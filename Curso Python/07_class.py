###Classes##
# Mejor tener un archivo para una clase

class Person:
    def __init__(self, name, surname):
        self.name = name
        self.surname = surname
        self.full_name = f"{name} {surname}"

    def aprender(self):
        print(f"{self.full_name} Está aprendiendo Python")

person_one = Person("Weiming", "Lai")
print(f"{person_one.name} {person_one.surname}")
print(person_one.full_name)
person_one.aprender()