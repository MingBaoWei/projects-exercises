import java.io.*;
import javax.servlet.http.*;

public class PrimerServlet extends HttpServlet {
    @Override
    public void doGet(HttpServletRequest solicitud, HttpServletResponse respuesta) throws IOException {
        // Configurar el tipo de contenido de la respuesta
        respuesta.setContentType("text/html");

        // Obtener los parámetros del formulario
        String usuario = solicitud.getParameter("usuario");
        String contraseña = solicitud.getParameter("contraseña");

        // Configurar el objeto Writer para escribir la respuesta
        PrintWriter out = respuesta.getWriter();
        out.println("<html>");
        out.println("<head><title>Resultado del Inicio de Sesión</title></head>");
        out.println("<body>");

        // Verificar las credenciales
        if (usuario != null && contraseña != null && usuario.equals("laura") && contraseña.equals("laura")) {
            out.println("<h1>Usuario Correcto</h1>");
            out.println("<p>Bienvenido, " + usuario + "!</p>");
        } else {
            out.println("<h1>Usuario Incorrecto</h1>");
            out.println("<p>Usuario o contraseña incorrectos. Por favor, intente nuevamente.</p>");
        }

        out.println("</body>");
        out.println("</html>");
    }
}
