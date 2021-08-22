package connectivity;

import javafx.scene.control.Alert;

import java.sql.Connection;
import java.sql.DriverManager;

public class ConnectionClass {
    public Connection connection = null;

    public Connection getConnection(){
        String dbName = "scores";
        String userName = "root";
        String password = "";

        try {
            Class.forName("com.mysql.cj.jdbc.Driver").newInstance();

            connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/"+dbName,userName,password);
        } catch (Exception e) {
            Alert alert = new Alert(Alert.AlertType.INFORMATION);
            alert.setTitle("Sikertelen csatlakozás!");
            alert.setHeaderText(null);
            alert.setContentText("Az adatbázishoz való csatlakozás sikertelen! Kérjük keresse fel a játék fejlesztőjét.");

            alert.showAndWait();
        }

        return connection;
    }
}
