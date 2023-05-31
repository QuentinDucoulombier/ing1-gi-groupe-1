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
    public static String getFonctionsLignes(String pythonCode) throws IOException {
        int nbLignes = 0;
        int nbFonctions = 0;
        int minLignes = Integer.MAX_VALUE;
        int maxLignes = 0;
        int sumLines = 0;

        List<Integer> functionLines = new ArrayList<>();
        Map<String, Integer> functionCalls = new HashMap<>();

        String[] linesCode = pythonCode.split("\n");

        for (String line : linesCode) {
            if (line.trim().startsWith("def ")) {
                if (!functionLines.isEmpty()) {
                    int numLines = nbLignes - functionLines.get(functionLines.size() - 1);
                    minLignes = Math.min(minLignes, numLines);
                    maxLignes = Math.max(maxLignes, numLines);
                    sumLines += numLines;
                }
                nbFonctions++;
                functionLines.add(nbLignes);
            }
            nbLignes++;

            if (line.contains("(")) {
                String functionName = getFunctionName(line);
                functionCalls.put(functionName, functionCalls.getOrDefault(functionName, 0) + 1);
            }
        }

        if (!functionLines.isEmpty()) {
            int numLines = nbLignes - functionLines.get(functionLines.size() - 1);
            minLignes = Math.min(minLignes, numLines);
            maxLignes = Math.max(maxLignes, numLines);
            sumLines += numLines;
        }

        int moyLignes = (nbFonctions > 0) ? sumLines / nbFonctions : 0;

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

    private static String getFunctionName(String line) {
        int startIndex = line.indexOf("def ") + 4;
        int endIndex = line.indexOf("(");
        return line.substring(startIndex, endIndex).trim();
    }



    public static String getOccurenceMots(String pythonCode, List<String> MotsCles) throws IOException {
        int[] occurrences = new int[MotsCles.size()];
        StringBuilder jsonBuilder = new StringBuilder();
        jsonBuilder.append("{");

        BufferedReader reader = new BufferedReader(new StringReader(pythonCode));
        String line;
        while ((line = reader.readLine()) != null) {
            for (int i = 0; i < MotsCles.size(); i++) {
                String motcle = MotsCles.get(i);
                int index = line.indexOf(motcle);
                while (index != -1) {
                    occurrences[i]++;
                    index = line.indexOf(motcle, index + motcle.length());
                }
            }
        }
        reader.close();
        for (int i=0;i<MotsCles.size()-1;i++) {
            jsonBuilder.append("\""+MotsCles.get(i)+"\":").append(occurrences[i]).append(",");
        }
        jsonBuilder.append("\""+MotsCles.get(MotsCles.size()-1)+"\":").append(occurrences[MotsCles.size()-1]);
        jsonBuilder.append("}");

        return jsonBuilder.toString();

    }
}
