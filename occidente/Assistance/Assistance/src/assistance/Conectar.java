/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package assistance;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

/**
 *
 * @author user
 */
public class Conectar {
    private static Connection conn;
    private static final String driver = "com.mysql.jdbc.Driver";
    
    private static final String user = "dbo710921271";
    private static final String host="db710921271.db.1and1.com";
    private static final String bd="db710921271";
    
    /*
    private static final String user = "root";
    private static final String host="localhost";
    private static final String bd="assistance_control";
    */
    private static final String password = "QzAfqx2X8yEGJVUd";
    private static final String puerto="3306";

    private static final String url = "jdbc:mysql://"+host+":"+puerto+"/"+bd+"";
    private static final String connectionString = "jdbc:mysql://"+host+":"+puerto+"/"+bd+"?user="+user+"&password="+password+"&useUnicode=true&characterEncoding=UTF-8";



    public Conectar() {
        conn = null;
        try{
            Class.forName(driver);
            conn = DriverManager.getConnection(url, user, password);
            //conn =  DriverManager.getConnection(connectionString);
            if(conn != null){
                System.out.println("Conexion establecida...");
            }
        }catch( ClassNotFoundException | SQLException e){
            System.out.println("Error en conectar"+e);
        }
    }
    //con este metodo nos conectamos a la BD
    public Connection getConnection(){
        return conn;
    }
    //con este metodo cerramos conexiones
    public void desconectar(){
        conn = null;
        if(conn== null){
            System.out.println("Conexion terminada...");
        }
    }
}
