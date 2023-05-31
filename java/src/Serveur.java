import com.sun.net.httpserver.Headers;
import com.sun.net.httpserver.HttpExchange;
import com.sun.net.httpserver.HttpHandler;
import com.sun.net.httpserver.HttpServer;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.InetSocketAddress;
import java.util.Arrays;
import java.util.concurrent.Executors;
import java.util.logging.Logger;

public class Serveur {
    // logger pour trace
    private static final Logger LOGGER = Logger.getLogger(Serveur.class.getName());
    private static final String SERVEUR = "localhost"; // url de base du service
    private static final int PORT = 8001; // port serveur
    private static final String URL = "/test"; // url de base du service

    // boucle principale qui lance le serveur sur le port 8001, à l'url test
    public static void main(String[] args) {
        HttpServer server = null;
        try {
            server = HttpServer.create(new InetSocketAddress(SERVEUR, PORT), 0);
            server.createContext(URL, new MyHttpHandler());
            server.setExecutor(Executors.newFixedThreadPool(10));
            server.start();
            LOGGER.info("Server started on port " + PORT);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private static class MyHttpHandler implements HttpHandler {
        /**
         * Gère les paramètres de la requête GET
         *
         * @param httpExchange
         * @return première valeur
         */
        private String handleGetRequest(HttpExchange httpExchange) {
            return httpExchange.getRequestURI()
                    .toString()
                    .split("\\?")[1]
                    .split("=")[1];
        }

        /**
         * Gère les paramètres de la requête POST
         *
         * @param httpExchange
         * @return
         */
        private String handlePostRequest(HttpExchange httpExchange) throws IOException {
            InputStream requestBody = httpExchange.getRequestBody();
            BufferedReader reader = new BufferedReader(new InputStreamReader(requestBody));

            StringBuilder requestBodyBuilder = new StringBuilder();
            String line;
            while ((line = reader.readLine()) != null) {
                requestBodyBuilder.append(line).append("\n");
            }

            reader.close();
            String pythonCode = requestBodyBuilder.toString();
            String[] lines = pythonCode.split("\n");
            String keywords = lines[lines.length-2];
            String result1 = AnalyseCodePython.getFonctionsLignes(pythonCode);
            String result2 = AnalyseCodePython.getOccurenceMots(pythonCode, Arrays.asList(keywords.split(",")));
            return result1.substring(0, result1.length() - 1)+","+result2.substring(1);
            
        }

        /**
         * Génère une page HTML de réponse simple
         *
         * @param httpExchange
         * @param requestParamValue
         */
        private void handleResponse(HttpExchange httpExchange, String requestParamValue) throws IOException {
            OutputStream outputStream = httpExchange.getResponseBody();
            StringBuilder htmlBuilder = new StringBuilder();
            htmlBuilder.append(requestParamValue);
            String htmlResponse = htmlBuilder.toString();

            // Ajouter les en-têtes CORS
            Headers headers = httpExchange.getResponseHeaders();
            headers.add("Access-Control-Allow-Origin", "*");
            headers.add("Access-Control-Allow-Methods", "POST, GET");
            headers.add("Access-Control-Allow-Headers", "Content-Type");

            // Indiquer le type de contenu dans la réponse
            headers.add("Content-Type", "text/html");

            // Envoyer la réponse avec le code de statut 200 et la longueur du contenu
            httpExchange.sendResponseHeaders(200, htmlResponse.length());

            // Écrire le contenu de la réponse dans le flux de sortie
            outputStream.write(htmlResponse.getBytes());
            outputStream.flush();
            outputStream.close();
        }

        // Méthode de l'interface à implémenter
        @Override
        public void handle(HttpExchange httpExchange) throws IOException {
            LOGGER.info("Je réponds");
            String requestParamValue = null;
            if ("GET".equals(httpExchange.getRequestMethod())) {
                requestParamValue = handleGetRequest(httpExchange);
            } else if ("POST".equals(httpExchange.getRequestMethod())) {
                requestParamValue = handlePostRequest(httpExchange);
            }
            handleResponse(httpExchange, requestParamValue);
        }
    }
}	
