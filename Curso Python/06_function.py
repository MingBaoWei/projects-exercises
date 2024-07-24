###Funtions###

#1
def function():
    print("Esto es una función")

verdadero = False

if verdadero == False:
    function()

#2
def suma(first_num, segond_num):
    print(first_num + segond_num)

suma(2, 4)
suma("2", "4")

#3 With return
def sumawithreturn(first_num_r, segond_num_r):
    nume = first_num_r + segond_num_r
    return nume

soluone = sumawithreturn(2, 4)
print(soluone)
solutwo = sumawithreturn("2", "4")
print(solutwo)