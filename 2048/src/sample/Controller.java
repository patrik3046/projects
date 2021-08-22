package sample;

import connectivity.ConnectionClass;
import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.input.KeyCode;
import javafx.scene.input.KeyEvent;
import javafx.scene.layout.GridPane;
import javafx.scene.layout.Pane;
import javafx.scene.layout.VBox;
import java.io.File;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Arrays;
import java.util.Random;

public class Controller {
    private int mapsize = 5;
    private int[][] map = new int[8][8];
    private int[][] olderMap = new int[8][8];
    private int[][] freeSpaces;
    private int nullasMezokSzama;
    private String mode = "number";
    private int level = 11;
    private int levelReached = 1;
    private int record = 0;

    public Label scoreLabel;
    public Label recordLabel;
    public Label gameOverLabel;
    public Pane menuPane;
    public Pane settingsPane;
    public Pane gameOverPane;
    public Pane scoresPane;
    public GridPane mapGrid5;
    public GridPane mapGrid6;
    public GridPane mapGrid8;
    public VBox mapVBox;
    public TextField nameTextField;
    public TextField searchTextField;
    public ChoiceBox gameModeChoiceBox;
    public ChoiceBox gameLevelChoiceBox;
    public ChoiceBox mapSizeChoiceBox;
    public ChoiceBox mapSizeScoresChoiceBox;
    public ListView<String> nameList;
    public ListView <Integer> scoreList;
    
    public ImageView n_0_0;
    public ImageView n_1_0;
    public ImageView n_2_0;
    public ImageView n_3_0;
    public ImageView n_4_0;
    public ImageView n_1_1;
    public ImageView n_1_2;
    public ImageView n_1_3;
    public ImageView n_1_4;
    public ImageView n_0_1;
    public ImageView n_0_2;
    public ImageView n_0_3;
    public ImageView n_0_4;
    public ImageView n_2_1;
    public ImageView n_2_2;
    public ImageView n_2_3;
    public ImageView n_2_4;
    public ImageView n_3_1;
    public ImageView n_3_2;
    public ImageView n_3_3;
    public ImageView n_3_4;
    public ImageView n_4_1;
    public ImageView n_4_2;
    public ImageView n_4_3;
    public ImageView n_4_4;
    public ImageView n_5_0;
    public ImageView n_5_1;
    public ImageView n_5_2;
    public ImageView n_5_3;
    public ImageView n_5_4;
    public ImageView n_0_5;
    public ImageView n_1_5;
    public ImageView n_2_5;
    public ImageView n_3_5;
    public ImageView n_4_5;
    public ImageView n_5_5;
    public ImageView n_0_6;
    public ImageView n_1_6;
    public ImageView n_2_6;
    public ImageView n_3_6;
    public ImageView n_4_6;
    public ImageView n_5_6;
    public ImageView n_6_6;
    public ImageView n_7_6;
    public ImageView n_0_7;
    public ImageView n_1_7;
    public ImageView n_2_7;
    public ImageView n_3_7;
    public ImageView n_4_7;
    public ImageView n_5_7;
    public ImageView n_6_7;
    public ImageView n_7_7;
    public ImageView n_6_0;
    public ImageView n_6_1;
    public ImageView n_6_2;
    public ImageView n_6_3;
    public ImageView n_6_4;
    public ImageView n_6_5;
    public ImageView n_7_0;
    public ImageView n_7_1;
    public ImageView n_7_2;
    public ImageView n_7_3;
    public ImageView n_7_4;
    public ImageView n_7_5;

    public ImageView h_0_0;
    public ImageView h_1_0;
    public ImageView h_2_0;
    public ImageView h_3_0;
    public ImageView h_4_0;
    public ImageView h_1_1;
    public ImageView h_1_2;
    public ImageView h_1_3;
    public ImageView h_1_4;
    public ImageView h_0_1;
    public ImageView h_0_2;
    public ImageView h_0_3;
    public ImageView h_0_4;
    public ImageView h_2_1;
    public ImageView h_2_2;
    public ImageView h_2_3;
    public ImageView h_2_4;
    public ImageView h_3_1;
    public ImageView h_3_2;
    public ImageView h_3_3;
    public ImageView h_3_4;
    public ImageView h_4_1;
    public ImageView h_4_2;
    public ImageView h_4_3;
    public ImageView h_4_4;
    public ImageView h_5_0;
    public ImageView h_5_1;
    public ImageView h_5_2;
    public ImageView h_5_3;
    public ImageView h_5_4;
    public ImageView h_0_5;
    public ImageView h_1_5;
    public ImageView h_2_5;
    public ImageView h_3_5;
    public ImageView h_4_5;
    public ImageView h_5_5;

    public ImageView o_0_0;
    public ImageView o_1_0;
    public ImageView o_2_0;
    public ImageView o_3_0;
    public ImageView o_4_0;
    public ImageView o_1_1;
    public ImageView o_1_2;
    public ImageView o_1_3;
    public ImageView o_1_4;
    public ImageView o_0_1;
    public ImageView o_0_2;
    public ImageView o_0_3;
    public ImageView o_0_4;
    public ImageView o_2_1;
    public ImageView o_2_2;
    public ImageView o_2_3;
    public ImageView o_2_4;
    public ImageView o_3_1;
    public ImageView o_3_2;
    public ImageView o_3_3;
    public ImageView o_3_4;
    public ImageView o_4_1;
    public ImageView o_4_2;
    public ImageView o_4_3;
    public ImageView o_4_4;

    @FXML
    void initialize(){
        mapSizeScoresChoiceBox.getSelectionModel().selectedItemProperty().addListener((obs, oldV, newV) -> {
            try {
                search();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        });

        searchTextField.textProperty().addListener((observable, oldValue, newValue) -> {
            try {
                search();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        });
    }

    public void nextStep(String move) {
        int notSame = 0;
        this.freeSpaces = new int[2][this.mapsize*this.mapsize];
        this.nullasMezokSzama = 0;
        for (int i = 0; i < this.mapsize; i++) {
            System.arraycopy(this.map[i],0,this.olderMap[i],0,this.mapsize);
        }
        switch (move) {
            //lefele lepes
            case "le": {
                //oszlop elejetol a vegeig
                for (int i = 0; i < this.mapsize; i++) {
                    int[] elements = new int[this.mapsize];
                    int size = 0;
                    //sor lentrol felfele
                    for (int j = this.mapsize - 1; j >= 0; j--) {
                        //nem nullas mezok megkeresese
                        if (this.map[j][i] != 0) {
                            elements[size] = this.map[j][i];
                            this.map[j][i] = 0;
                            size++;
                        }
                    }
                    //elemek osszevonasa
                    if (elements.length >= 2) {
                        for (int j = 0; j < elements.length - 1; j++) {
                            if (elements[j] == elements[j + 1]) {
                                scoreLabel.setText((Integer.parseInt(scoreLabel.getText()) + elements[j] * 2) + "");
                                if(Integer.parseInt(scoreLabel.getText()) > this.record) {
                                    recordLabel.setText(scoreLabel.getText());
                                }

                                elements[j] *= 2;
                                elements[j + 1] = 0;

                                if (elements[j] == Math.pow(2,this.level)){
                                    gameOver("win");
                                } else if(elements[j] == 4096){
                                    gameOver("outOfLevels");
                                }
                            }
                        }
                    }
                    //elemek visszairasa az oszlopba
                    int place = this.mapsize - 1;
                    for (int element : elements) {
                        if (element != 0) {
                            this.map[place][i] = element;
                            place--;

                            if(log2(element)>this.levelReached){
                                this.levelReached = log2(element);
                            }
                        }
                    }
                    //szabad helyek feljegyzese
                    for (int j = 0; j < place+1; j++) {
                        this.nullasMezokSzama++;
                        this.freeSpaces[0][this.nullasMezokSzama-1] = j;
                        this.freeSpaces[1][this.nullasMezokSzama-1] = i;
                    }
                }
                break;
            }
            //felfele lepes
            case "fel": {
                //oszlop elejetol a vegeig
                for (int i = 0; i < this.mapsize; i++) {
                    int[] elements = new int[this.mapsize];
                    int size = 0;
                    //sor lentrol felfele
                    for (int j = 0; j < this.mapsize; j++) {
                        //nem nullas mezok megkeresese
                        if (this.map[j][i] != 0) {
                            elements[size] = this.map[j][i];
                            this.map[j][i] = 0;
                            size++;
                        }
                    }
                    //elemek osszevonasa
                    if (elements.length >= 2) {
                        for (int j = 0; j < elements.length - 1; j++) {
                            if (elements[j] == elements[j + 1]) {
                                scoreLabel.setText((Integer.parseInt(scoreLabel.getText()) + elements[j] * 2) + "");
                                if(Integer.parseInt(scoreLabel.getText()) > this.record) {
                                    recordLabel.setText(scoreLabel.getText());
                                }

                                elements[j] *= 2;
                                elements[j + 1] = 0;

                                if (elements[j] == Math.pow(2,this.level)){
                                    gameOver("win");
                                } else if(elements[j] == 4096){
                                    gameOver("outOfLevels");
                                }
                            }
                        }
                    }
                    //elemek visszairasa az oszlopba
                    int place = 0;
                    for (int element : elements) {
                        if (element != 0) {
                            this.map[place][i] = element;
                            place++;

                            if(log2(element)>this.levelReached){
                                this.levelReached = log2(element);
                            }
                        }
                    }
                    //szabad helyek feljegyzese
                    for (int j = place; j < this.mapsize; j++) {
                        this.nullasMezokSzama++;
                        this.freeSpaces[0][this.nullasMezokSzama-1] = j;
                        this.freeSpaces[1][this.nullasMezokSzama-1] = i;
                    }
                }
                break;
            }
            //jobbra lepes
            case "jobb": {
                    //sor elejetol a vegeig
                    for (int i = 0; i < this.mapsize; i++) {
                        int[] elements = new int[this.mapsize];
                        int size = 0;
                        //oszlop lentrol felfele
                        for (int j = this.mapsize-1; j >= 0; j--) {
                            //nem nullas mezok megkeresese
                            if (this.map[i][j] != 0) {
                                elements[size] = this.map[i][j];
                                this.map[i][j] = 0;
                                size++;
                            }
                        }
                        //elemek osszevonasa
                        if (elements.length >= 2) {
                            for (int j = 0; j < elements.length - 1; j++) {
                                if (elements[j] == elements[j + 1]) {
                                    scoreLabel.setText((Integer.parseInt(scoreLabel.getText()) + elements[j] * 2) + "");
                                    if(Integer.parseInt(scoreLabel.getText()) > this.record) {
                                        recordLabel.setText(scoreLabel.getText());
                                    }

                                    elements[j] *= 2;
                                    elements[j + 1] = 0;

                                    if (elements[j] == Math.pow(2,this.level)){
                                        gameOver("win");
                                    } else if(elements[j] == 4096){
                                        gameOver("outOfLevels");
                                    }
                                }
                            }
                        }
                        //elemek visszairasa az oszlopba
                        int place = this.mapsize-1;
                        for (int element : elements) {
                            if (element != 0) {
                                this.map[i][place] = element;
                                place--;

                                if(log2(element)>this.levelReached){
                                    this.levelReached = log2(element);
                                }
                            }
                        }
                        //szabad helyek feljegyzese
                        for (int j = 0; j < place+1; j++) {
                            this.nullasMezokSzama++;
                            this.freeSpaces[0][this.nullasMezokSzama-1] = i;
                            this.freeSpaces[1][this.nullasMezokSzama-1] = j;
                        }
                    }
                    break;
            }
            //balra lepes
            case "bal": {
                //sor elejetol a vegeig
                for (int i = 0; i < this.mapsize; i++) {
                    int[] elements = new int[this.mapsize];
                    int size = 0;
                    //oszlop lentrol felfele
                    for (int j = 0; j < this.mapsize; j++) {
                        //nem nullas mezok megkeresese
                        if (this.map[i][j] != 0) {
                            elements[size] = this.map[i][j];
                            this.map[i][j] = 0;
                            size++;
                        }
                    }
                    //elemek osszevonasa
                    if (elements.length >= 2) {
                        for (int j = 0; j < elements.length - 1; j++) {
                            if (elements[j] == elements[j + 1]) {
                                scoreLabel.setText((Integer.parseInt(scoreLabel.getText()) + elements[j] * 2) + "");
                                if(Integer.parseInt(scoreLabel.getText()) > this.record) {
                                    recordLabel.setText(scoreLabel.getText());
                                }
                                elements[j] *= 2;
                                elements[j + 1] = 0;

                                if (elements[j] == Math.pow(2,this.level)){
                                    gameOver("win");
                                } else if(elements[j] == 4096){
                                    gameOver("outOfLevels");
                                }
                            }
                        }
                    }
                    //elemek visszairasa az oszlopba
                    int place = 0;
                    for (int element : elements) {
                        if (element != 0) {
                            this.map[i][place] = element;
                            place++;

                            if(log2(element)>this.levelReached){
                                this.levelReached = log2(element);
                            }
                        }
                    }
                    //szabad helyek feljegyzese
                    for (int j = place; j < this.mapsize; j++) {
                        this.nullasMezokSzama++;
                        this.freeSpaces[0][this.nullasMezokSzama-1] = i;
                        this.freeSpaces[1][this.nullasMezokSzama-1] = j;
                    }
                }
                break;
            }
        }

        if (this.nullasMezokSzama == 0){
            gameOver("outOfTiles");
        }

        for (int i = 0; i < this.mapsize; i++) {
            if(Arrays.equals(this.olderMap[i],this.map[i])){
               notSame++;
            }
        }

        if(notSame < this.mapsize){
            generateNumber();
            switch (this.mapsize){
                case 5:{
                    displayMap5();
                    break;
                }
                case 6:{
                    displayMap6();
                    break;
                }
                case 8:{
                    displayMap8();
                    break;
                }
            }
        }
    }

    public void displayMap8() {
        File file;
        Image image;
        file = new File("src/sample/images/"+this.mode+this.map[0][0]+".PNG");
        image = new Image(file.toURI().toString());
        n_0_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[0][1]+".PNG");
        image = new Image(file.toURI().toString());
        n_0_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[0][2]+".PNG");
        image = new Image(file.toURI().toString());
        n_0_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[0][3]+".PNG");
        image = new Image(file.toURI().toString());
        n_0_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[0][4]+".PNG");
        image = new Image(file.toURI().toString());
        n_0_4.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][0]+".PNG");
        image = new Image(file.toURI().toString());
        n_1_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][1]+".PNG");
        image = new Image(file.toURI().toString());
        n_1_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][2]+".PNG");
        image = new Image(file.toURI().toString());
        n_1_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][3]+".PNG");
        image = new Image(file.toURI().toString());
        n_1_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][4]+".PNG");
        image = new Image(file.toURI().toString());
        n_1_4.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][0]+".PNG");
        image = new Image(file.toURI().toString());
        n_2_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][1]+".PNG");
        image = new Image(file.toURI().toString());
        n_2_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][2]+".PNG");
        image = new Image(file.toURI().toString());
        n_2_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][3]+".PNG");
        image = new Image(file.toURI().toString());
        n_2_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][4]+".PNG");
        image = new Image(file.toURI().toString());
        n_2_4.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][0]+".PNG");
        image = new Image(file.toURI().toString());
        n_3_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][1]+".PNG");
        image = new Image(file.toURI().toString());
        n_3_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][2]+".PNG");
        image = new Image(file.toURI().toString());
        n_3_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][3]+".PNG");
        image = new Image(file.toURI().toString());
        n_3_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][4]+".PNG");
        image = new Image(file.toURI().toString());
        n_3_4.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][0]+".PNG");
        image = new Image(file.toURI().toString());
        n_4_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][1]+".PNG");
        image = new Image(file.toURI().toString());
        n_4_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][2]+".PNG");
        image = new Image(file.toURI().toString());
        n_4_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][3]+".PNG");
        image = new Image(file.toURI().toString());
        n_4_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][4]+".PNG");
        image = new Image(file.toURI().toString());
        n_4_4.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[5][0]+".PNG");
        image = new Image(file.toURI().toString());
        n_5_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[5][1]+".PNG");
        image = new Image(file.toURI().toString());
        n_5_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[5][2]+".PNG");
        image = new Image(file.toURI().toString());
        n_5_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[5][3]+".PNG");
        image = new Image(file.toURI().toString());
        n_5_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[5][4]+".PNG");
        image = new Image(file.toURI().toString());
        n_5_4.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[5][5]+".PNG");
        image = new Image(file.toURI().toString());
        n_5_5.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[0][5]+".PNG");
        image = new Image(file.toURI().toString());
        n_0_5.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][5]+".PNG");
        image = new Image(file.toURI().toString());
        n_1_5.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][5]+".PNG");
        image = new Image(file.toURI().toString());
        n_2_5.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][5]+".PNG");
        image = new Image(file.toURI().toString());
        n_3_5.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][5]+".PNG");
        image = new Image(file.toURI().toString());
        n_4_5.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[0][6]+".PNG");
        image = new Image(file.toURI().toString());
        n_0_6.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][6]+".PNG");
        image = new Image(file.toURI().toString());
        n_1_6.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][6]+".PNG");
        image = new Image(file.toURI().toString());
        n_2_6.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][6]+".PNG");
        image = new Image(file.toURI().toString());
        n_3_6.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][6]+".PNG");
        image = new Image(file.toURI().toString());
        n_4_6.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[5][6]+".PNG");
        image = new Image(file.toURI().toString());
        n_5_6.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[6][6]+".PNG");
        image = new Image(file.toURI().toString());
        n_6_6.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[7][6]+".PNG");
        image = new Image(file.toURI().toString());
        n_7_6.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[0][7]+".PNG");
        image = new Image(file.toURI().toString());
        n_0_7.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][7]+".PNG");
        image = new Image(file.toURI().toString());
        n_1_7.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][7]+".PNG");
        image = new Image(file.toURI().toString());
        n_2_7.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][7]+".PNG");
        image = new Image(file.toURI().toString());
        n_3_7.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][7]+".PNG");
        image = new Image(file.toURI().toString());
        n_4_7.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[5][7]+".PNG");
        image = new Image(file.toURI().toString());
        n_5_7.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[6][7]+".PNG");
        image = new Image(file.toURI().toString());
        n_6_7.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[7][7]+".PNG");
        image = new Image(file.toURI().toString());
        n_7_7.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[7][0]+".PNG");
        image = new Image(file.toURI().toString());
        n_7_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[7][1]+".PNG");
        image = new Image(file.toURI().toString());
        n_7_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[7][2]+".PNG");
        image = new Image(file.toURI().toString());
        n_7_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[7][3]+".PNG");
        image = new Image(file.toURI().toString());
        n_7_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[7][4]+".PNG");
        image = new Image(file.toURI().toString());
        n_7_4.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[7][5]+".PNG");
        image = new Image(file.toURI().toString());
        n_7_5.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[6][0]+".PNG");
        image = new Image(file.toURI().toString());
        n_6_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[6][1]+".PNG");
        image = new Image(file.toURI().toString());
        n_6_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[6][2]+".PNG");
        image = new Image(file.toURI().toString());
        n_6_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[6][3]+".PNG");
        image = new Image(file.toURI().toString());
        n_6_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[6][4]+".PNG");
        image = new Image(file.toURI().toString());
        n_6_4.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[6][5]+".PNG");
        image = new Image(file.toURI().toString());
        n_6_5.setImage(image);
    }

    public void displayMap6() {
        File file;
        Image image;
        file = new File("src/sample/images/"+this.mode+this.map[0][0]+".PNG");
        image = new Image(file.toURI().toString());
        h_0_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[0][1]+".PNG");
        image = new Image(file.toURI().toString());
        h_0_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[0][2]+".PNG");
        image = new Image(file.toURI().toString());
        h_0_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[0][3]+".PNG");
        image = new Image(file.toURI().toString());
        h_0_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[0][4]+".PNG");
        image = new Image(file.toURI().toString());
        h_0_4.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][0]+".PNG");
        image = new Image(file.toURI().toString());
        h_1_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][1]+".PNG");
        image = new Image(file.toURI().toString());
        h_1_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][2]+".PNG");
        image = new Image(file.toURI().toString());
        h_1_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][3]+".PNG");
        image = new Image(file.toURI().toString());
        h_1_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][4]+".PNG");
        image = new Image(file.toURI().toString());
        h_1_4.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][0]+".PNG");
        image = new Image(file.toURI().toString());
        h_2_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][1]+".PNG");
        image = new Image(file.toURI().toString());
        h_2_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][2]+".PNG");
        image = new Image(file.toURI().toString());
        h_2_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][3]+".PNG");
        image = new Image(file.toURI().toString());
        h_2_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][4]+".PNG");
        image = new Image(file.toURI().toString());
        h_2_4.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][0]+".PNG");
        image = new Image(file.toURI().toString());
        h_3_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][1]+".PNG");
        image = new Image(file.toURI().toString());
        h_3_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][2]+".PNG");
        image = new Image(file.toURI().toString());
        h_3_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][3]+".PNG");
        image = new Image(file.toURI().toString());
        h_3_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][4]+".PNG");
        image = new Image(file.toURI().toString());
        h_3_4.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][0]+".PNG");
        image = new Image(file.toURI().toString());
        h_4_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][1]+".PNG");
        image = new Image(file.toURI().toString());
        h_4_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][2]+".PNG");
        image = new Image(file.toURI().toString());
        h_4_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][3]+".PNG");
        image = new Image(file.toURI().toString());
        h_4_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][4]+".PNG");
        image = new Image(file.toURI().toString());
        h_4_4.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[5][0]+".PNG");
        image = new Image(file.toURI().toString());
        h_5_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[5][1]+".PNG");
        image = new Image(file.toURI().toString());
        h_5_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[5][2]+".PNG");
        image = new Image(file.toURI().toString());
        h_5_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[5][3]+".PNG");
        image = new Image(file.toURI().toString());
        h_5_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[5][4]+".PNG");
        image = new Image(file.toURI().toString());
        h_5_4.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[5][5]+".PNG");
        image = new Image(file.toURI().toString());
        h_5_5.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[0][5]+".PNG");
        image = new Image(file.toURI().toString());
        h_0_5.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][5]+".PNG");
        image = new Image(file.toURI().toString());
        h_1_5.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][5]+".PNG");
        image = new Image(file.toURI().toString());
        h_2_5.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][5]+".PNG");
        image = new Image(file.toURI().toString());
        h_3_5.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][5]+".PNG");
        image = new Image(file.toURI().toString());
        h_4_5.setImage(image);
    }

    public void displayMap5() {
        File file;
        Image image;
        file = new File("src/sample/images/"+this.mode+this.map[0][0]+".PNG");
        image = new Image(file.toURI().toString());
        o_0_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[0][1]+".PNG");
        image = new Image(file.toURI().toString());
        o_0_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[0][2]+".PNG");
        image = new Image(file.toURI().toString());
        o_0_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[0][3]+".PNG");
        image = new Image(file.toURI().toString());
        o_0_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[0][4]+".PNG");
        image = new Image(file.toURI().toString());
        o_0_4.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][0]+".PNG");
        image = new Image(file.toURI().toString());
        o_1_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][1]+".PNG");
        image = new Image(file.toURI().toString());
        o_1_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][2]+".PNG");
        image = new Image(file.toURI().toString());
        o_1_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][3]+".PNG");
        image = new Image(file.toURI().toString());
        o_1_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[1][4]+".PNG");
        image = new Image(file.toURI().toString());
        o_1_4.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][0]+".PNG");
        image = new Image(file.toURI().toString());
        o_2_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][1]+".PNG");
        image = new Image(file.toURI().toString());
        o_2_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][2]+".PNG");
        image = new Image(file.toURI().toString());
        o_2_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][3]+".PNG");
        image = new Image(file.toURI().toString());
        o_2_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[2][4]+".PNG");
        image = new Image(file.toURI().toString());
        o_2_4.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][0]+".PNG");
        image = new Image(file.toURI().toString());
        o_3_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][1]+".PNG");
        image = new Image(file.toURI().toString());
        o_3_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][2]+".PNG");
        image = new Image(file.toURI().toString());
        o_3_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][3]+".PNG");
        image = new Image(file.toURI().toString());
        o_3_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[3][4]+".PNG");
        image = new Image(file.toURI().toString());
        o_3_4.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][0]+".PNG");
        image = new Image(file.toURI().toString());
        o_4_0.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][1]+".PNG");
        image = new Image(file.toURI().toString());
        o_4_1.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][2]+".PNG");
        image = new Image(file.toURI().toString());
        o_4_2.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][3]+".PNG");
        image = new Image(file.toURI().toString());
        o_4_3.setImage(image);
        file = new File("src/sample/images/"+this.mode+this.map[4][4]+".PNG");
        image = new Image(file.toURI().toString());
        o_4_4.setImage(image);
    }

    public void startGame() throws SQLException {
        this.record = getRecord();
        scoreLabel.setText("0");
        recordLabel.setText(""+this.record);
        menuPane.setVisible(false);
        setGridVisibility(true);
        mapVBox.setVisible(true);
        for (int i = 0; i < this.mapsize; i++) {
            for (int j = 0; j < this.mapsize; j++) {
                this.map[i][j] = 0;
                this.olderMap[i][j] = 0;
            }
        }

        Random rand = new Random();
        int x = 0,x2 = 0,y = 0,y2 = 0;
        while(x==x2 && y==y2) {
            x = rand.nextInt(this.mapsize);
            y = rand.nextInt(this.mapsize);
            x2 = rand.nextInt(this.mapsize);
            y2 = rand.nextInt(this.mapsize);
        }
        this.map[x][y] = 2;
        this.map[x2][y2] = 2;
        this.olderMap[x][y] = 2;
        this.olderMap[x2][y2] = 2;

        switch (this.mapsize){
            case 5:{
                displayMap5();
                break;
            }
            case 6:{
                displayMap6();
                break;
            }
            case 8:{
                displayMap8();
                break;
            }
        }
    }

    public void generateNumber(){
        Random rand = new Random();
        int place = rand.nextInt(this.nullasMezokSzama);
        int value = rand.nextInt(100);
        if(value<90){
            this.map[this.freeSpaces[0][place]][this.freeSpaces[1][place]] = 2;
        } else {
            this.map[this.freeSpaces[0][place]][this.freeSpaces[1][place]] = 4;
            if (this.levelReached == 1) {
                this.levelReached = 2;
            }
        }
    }

    public void theStep(KeyEvent key) throws SQLException {
        if(key.getCode() == KeyCode.DOWN){
            nextStep("le");
        } else if(key.getCode() == KeyCode.UP){
            nextStep("fel");
        } else if(key.getCode() == KeyCode.LEFT){
            nextStep("bal");
        } else if(key.getCode() == KeyCode.RIGHT){
            nextStep("jobb");
        }
    }

    public void quitGame(){
        Platform.exit();
    }

    public void gameSettings(){
        menuPane.setVisible(false);
        settingsPane.setVisible(true);
    }

    public void openMenu(){
        gameLevelChoiceBox.setValue(this.level+"");
        mapSizeChoiceBox.setValue(this.mapsize+"x"+this.mapsize);
        if(this.mode.equals("number")){
            gameModeChoiceBox.setValue("Számok");
        } else {
            gameModeChoiceBox.setValue("Betűk");
        }
        settingsPane.setVisible(false);
        mapVBox.setVisible(false);
        setGridVisibility(false);
        menuPane.setVisible(true);
    }

    public void useSettings(){
        this.mapsize = Character.getNumericValue(mapSizeChoiceBox.getValue().toString().charAt(0));
        this.level = Integer.parseInt(gameLevelChoiceBox.getValue().toString());
        if(gameModeChoiceBox.getValue().toString().equals("Számok")){
            this.mode = "number";
        } else {
            this.mode = "letter";
        }

        settingsPane.setVisible(false);
        menuPane.setVisible(true);
    }

    public void back(){
        int notSame = 0;
        for (int i = 0; i < this.mapsize; i++) {
            if(Arrays.equals(this.olderMap[i],this.map[i])){
                notSame++;
            }
        }

        if(notSame < this.mapsize) {
            for (int i = 0; i < this.mapsize; i++) {
                System.arraycopy(this.olderMap[i], 0, this.map[i], 0, this.mapsize);
            }

            switch (this.mapsize){
                case 5:{
                    displayMap5();
                    break;
                }
                case 6:{
                    displayMap6();
                    break;
                }
                case 8:{
                    displayMap8();
                    break;
                }
            }
        }
    }

    public void saveData() throws SQLException {
        if(nameTextField.getText().length() < 3 || nameTextField.getText().length() > 30){
            Alert alert = new Alert(Alert.AlertType.INFORMATION);
            alert.setTitle("Hiba!");
            alert.setHeaderText(null);
            alert.setContentText("A nevednek 3-30 karaktert kell tartalmaznia!");

            alert.showAndWait();
        } else {
            ConnectionClass connectionClass = new ConnectionClass();
            Connection connection = connectionClass.getConnection();
            try {
                String sql = "INSERT INTO scores VALUES(Null,'" + nameTextField.getText() + "'," + scoreLabel.getText() + ",'" + this.mode + "','" + this.mapsize + "x" + this.mapsize + "'," + this.levelReached + ")";
                Statement statement = connection.createStatement();
                try {
                    statement.executeUpdate(sql);

                    gameOverPane.setVisible(false);
                    setGridOpacity(1);
                    setGridDisable(false);
                    mapVBox.setOpacity(1);
                    mapVBox.setDisable(false);
                    if (!gameOverLabel.getText().startsWith("Mentsd el az eddig elért pontszámodat:")) {
                        setGridVisibility(false);
                        menuPane.setVisible(true);
                        mapVBox.setVisible(false);
                    }
                } finally {
                    statement.close();
                }
            } finally {
                connection.close();
            }
        }
    }

    public void gameOver(String reason){
        gameOverPane.setVisible(true);
        setGridOpacity(0.7);
        setGridDisable(true);
        mapVBox.setOpacity(0.7);
        mapVBox.setDisable(true);

        switch (reason){
            case "win":{
                gameOverLabel.setText("Gratulálunk, nyertél! A pontszámod "+this.scoreLabel.getText()+".");
                break;
            }
            case "outOfLevels":{
                gameOverLabel.setText("Sajnáljuk, de elérted a maximum szintet! A pontszámod "+this.scoreLabel.getText()+".");
                break;
            }
            case "outOfTiles":{
                gameOverLabel.setText("Elfogytak a mezők! A pontszámod "+this.scoreLabel.getText()+".");
                break;
            }
            case "backToTheMenu":{
                gameOverLabel.setText("Ne felejtsd el menteni a pontszámodat:" + this.scoreLabel.getText() + "!");
                break;
            }
            case "restart": {
                gameOverLabel.setText("Mentsd el az eddig elért pontszámodat:" + this.scoreLabel.getText() + "!");
                break;
            }
        }
    }

    public int getRecord() throws SQLException {

            ConnectionClass connectionClass = new ConnectionClass();
            Connection connection = connectionClass.getConnection();
        try {
            String sql = "SELECT max(score) FROM scores WHERE size='" + this.mapsize + "x" + this.mapsize + "'";
            Statement statement = connection.createStatement();
            try {
                ResultSet resultSet = statement.executeQuery(sql);
                try {
                    resultSet.next();
                    if (resultSet.getString(1) != null) {
                        return Integer.parseInt(resultSet.getString(1));
                    } else {
                        return 0;
                    }
                } finally {
                    resultSet.close();
                }
            } finally {
                statement.close();
            }
        } finally {
            connection.close();
        }
    }

    public void restartGame() throws SQLException {
        gameOver("restart");
        startGame();
    }

    public void backToTheMenu(){
        gameOver("backToTheMenu");
    }

    public void setGridVisibility(boolean visibility){
        switch (this.mapsize){
            case 5:{
                mapGrid5.setVisible(visibility);
                break;
            }
            case 6:{
                mapGrid6.setVisible(visibility);
                break;
            }
            case 8:{
                mapGrid8.setVisible(visibility);
                break;
            }
        }
    }

    public void setGridOpacity(double opacity){
        switch (this.mapsize){
            case 5:{
                mapGrid5.setOpacity(opacity);
                break;
            }
            case 6:{
                mapGrid6.setOpacity(opacity);
                break;
            }
            case 8:{
                mapGrid8.setOpacity(opacity);
                break;
            }
        }
    }

    public void setGridDisable(boolean disable){
        switch (this.mapsize){
            case 5:{
                mapGrid5.setDisable(disable);
                break;
            }
            case 6:{
                mapGrid6.setVisible(disable);
                break;
            }
            case 8:{
                mapGrid8.setVisible(disable);
                break;
            }
        }
    }

    public  int log2(int number){
        switch (number){
            case 2: return 1;
            case 4: return 2;
            case 8: return 3;
            case 16: return 4;
            case 32: return 5;
            case 64: return 6;
            case 128: return 7;
            case 256: return 8;
            case 512: return 9;
            case 1024: return 10;
            case 2048: return 11;
            case 4096:return 12;
        }
        return 0;
    }

    public void openScores() throws SQLException {
        mapSizeScoresChoiceBox.setValue(mapSizeChoiceBox.getValue().toString());
        scoresPane.setVisible(true);
        setGridOpacity(0.7);
        setGridDisable(true);
        mapVBox.setOpacity(0.7);
        mapVBox.setDisable(true);
        listScores("SELECT name,score FROM scores WHERE size='"+mapSizeScoresChoiceBox.getValue().toString()+"' ORDER BY score DESC");
    }

    public void listScores(String sql) throws SQLException {
        ConnectionClass connectionClass = new ConnectionClass();
        Connection connection = connectionClass.getConnection();
        try {
            Statement statement = connection.createStatement();
            try {
                ResultSet resultSet = statement.executeQuery(sql);
                try {
                    nameList.getItems().clear();
                    scoreList.getItems().clear();

                    for (int i = 0; i < 7; i++) {
                        if (resultSet.next()) {
                            nameList.getItems().add((i+1)+". "+resultSet.getString(1));
                            scoreList.getItems().add(resultSet.getInt(2));
                        } else {
                            break;
                        }
                    }
                } finally {
                    resultSet.close();
                }
            } finally {
                statement.close();
            }
        } finally {
            connection.close();
        }
    }

    public void closeScores(){
        scoresPane.setVisible(false);
        setGridOpacity(1);
        setGridDisable(false);
        mapVBox.setOpacity(1);
        mapVBox.setDisable(false);
        setGridVisibility(true);
    }

    public void search() throws SQLException {
        if(!searchTextField.getText().isEmpty()){
            listScores("SELECT name,score FROM scores WHERE size='"+mapSizeScoresChoiceBox.getValue().toString()+"' AND name LIKE '%"+searchTextField.getText()+"%' ORDER BY score DESC");
        } else {
            listScores("SELECT name,score FROM scores WHERE size='"+mapSizeScoresChoiceBox.getValue().toString()+"' ORDER BY score DESC");
        }
    }
}