import java.io.BufferedReader;
import java.io.StringReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import java.util.List;
import java.util.Map;


public class AnalyseCodePython {
    public static void main(String[] args) {
    	try {
    	String pythonCode = "";        
        System.out.println(getFonctionsLignes(pythonCode));
		System.out.println(getOccurenceMots(pythonCode,Arrays.asList("print", "if", "for")));
    	} catch (IOException e) {
			e.printStackTrace();
		}
    }
    //fonctions pour récuperer les informations sur le nb de lignes et de fonctions
    public static String getFonctionsLignes(String pythonCode) throws IOException {
    	//initialisation des variables
        int nbLignes = 0;
        int nbFonctions = 0;
        int minLignes = Integer.MAX_VALUE;
        int maxLignes = 0;
        int sumLignes = 0;
        
        List<Integer> functionLines = new ArrayList<>();
        Map<String, Integer> functionCalls = new HashMap<>();
        
        //récuperer les lignes de code dans un tableau de chaines
        String[] linesCode = pythonCode.split("\n");
        //parcour des lignes
        for (String line : linesCode) {
        	//si fonction
            if (line.trim().startsWith("def ")) {
            	//calculer la somme des lignes et le min/max
                if (!functionLines.isEmpty()) {
                    int numLines = nbLignes - functionLines.get(functionLines.size() - 1);
                    minLignes = Math.min(minLignes, numLines);
                    maxLignes = Math.max(maxLignes, numLines);
                    sumLignes += numLines;
                }
                //calculer nb de fonctions et nb de lignes des fonctions
                nbFonctions++;
                functionLines.add(nbLignes);
            }
            nbLignes++;
            //calcul nombre d'appel
            if (line.contains("(")) {
                String functionName = getFunctionName(line);
                functionCalls.put(functionName, functionCalls.getOrDefault(functionName, 0) + 1);
            }
        }
        
        if (!functionLines.isEmpty()) {
            int numLines = nbLignes - functionLines.get(functionLines.size() - 1);
            minLignes = Math.min(minLignes, numLines);
            maxLignes = Math.max(maxLignes, numLines);
            sumLignes += numLines;
        }

        int moyLignes;
        if (nbFonctions > 0) {
            moyLignes = sumLignes / nbFonctions;
        } else {
            moyLignes = 0;
        }
        //on transforme les données en format JSON
        StringBuilder jsonBuilder = new StringBuilder();
        jsonBuilder.append("{");
        jsonBuilder.append("\"nbLignes\":").append(nbLignes).append(",");
        jsonBuilder.append("\"nbFonctions\":").append(nbFonctions).append(",");
        jsonBuilder.append("\"minLignes\":").append(minLignes).append(",");
        jsonBuilder.append("\"maxLignes\":").append(maxLignes).append(",");
        jsonBuilder.append("\"moyLignes\":").append(moyLignes).append(",");

        jsonBuilder.append("\"fonctions\": [");
        int functionIndex = 1;
        for (Integer functionLine : functionLines) {
            int numLines = (functionIndex == nbFonctions) ? nbLignes - functionLine : functionLines.get(functionIndex) - functionLine;

            jsonBuilder.append("{");
            jsonBuilder.append("\"indiceFonction\":").append(functionIndex).append(",");
            jsonBuilder.append("\"nbLignes\":").append(numLines).append(",");
            jsonBuilder.append("\"nbAppels\":").append(functionCalls.getOrDefault(getFunctionName(linesCode[functionLine]), 0));
            jsonBuilder.append("}");

            if (functionIndex < nbFonctions) {
                jsonBuilder.append(",");
            }
            functionIndex++;
        }
        jsonBuilder.append("]");

        jsonBuilder.append("}");
        return jsonBuilder.toString();
    }
    //fonction pour récuperer le nom de la fonction
    private static String getFunctionName(String line) {
        int startIndex = line.indexOf("def ") + 4;
        int endIndex = line.indexOf("(");
        return line.substring(startIndex, endIndex).trim();
    }


    //fonctions pour calculer le nombre d'occurence d'une liste de mots clés
    public static String getOccurenceMots(String pythonCode, List<String> MotsCles) throws IOException {
    	//initialisation des variables
        int[] occurrences = new int[MotsCles.size()];
        StringBuilder jsonBuilder = new StringBuilder();
        jsonBuilder.append("{");
        //parcours du fichier
        BufferedReader reader = new BufferedReader(new StringReader(pythonCode));
        String line;
        while ((line = reader.readLine()) != null) {
            for (int i = 0; i < MotsCles.size(); i++) {
            	String motcle = MotsCles.get(i);
                //premiere occurence
            	int index = line.indexOf(motcle);
            	//calcul nombre d'occurence
                while (index != -1) {
                    occurrences[i]++;
                    //occurence suivante
                    index = line.indexOf(motcle, index + motcle.length());
                }
            }
        }
        reader.close();
        //création JSON
        for (int i=0;i<MotsCles.size()-1;i++) {
            jsonBuilder.append("\""+MotsCles.get(i)+"\":").append(occurrences[i]).append(",");
        }
        jsonBuilder.append("\""+MotsCles.get(MotsCles.size()-1)+"\":").append(occurrences[MotsCles.size()-1]);
        jsonBuilder.append("}");

        return jsonBuilder.toString();

    }
}
