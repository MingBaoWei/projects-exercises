<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Calculadora</title>
</head>
<body>

<h2>Calculadora</h2>

<form method="post" action="calcular.jsp">
    <label for="operando1">Operando 1:</label>
    <input type="number" id="operando1" name="operando1" required><br><br>
    
    <label for="operando2">Operando 2:</label>
    <input type="number" id="operando2" name="operando2" required><br><br>
    
    <label for="operacion">Operación:</label>
    <select id="operacion" name="operacion" required>
        <option value="suma">Suma</option>
        <option value="resta">Resta</option>
        <option value="multiplicacion">Multiplicación</option>
        <option value="division">División</option>
    </select><br><br>
    
    <input type="submit" value="Calcular">
</form>

</body>
</html>
