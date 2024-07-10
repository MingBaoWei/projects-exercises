<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>

<h2>Resultado</h2>

<%
    // Recoger los operandos y la operación del formulario
    double operando1 = Double.parseDouble(request.getParameter("operando1"));
    double operando2 = Double.parseDouble(request.getParameter("operando2"));
    String operacion = request.getParameter("operacion");
    
    // Realizar la operación seleccionada
    double resultado = 0;
    if (operacion.equals("suma")) {
        resultado = operando1 + operando2;
    } else if (operacion.equals("resta")) {
        resultado = operando1 - operando2;
    } else if (operacion.equals("multiplicacion")) {
        resultado = operando1 * operando2;
    } else if (operacion.equals("division")) {
        if (operando2 != 0) {
            resultado = operando1 / operando2;
        } else {
            out.println("<p>Error: División por cero</p>");
        }
    }
%>

<p>El resultado de la operación <%= operacion %> es: <%= resultado %></p>

</body>
</html>
