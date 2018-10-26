/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package assistance;

import java.io.IOException;
import java.net.URISyntaxException;
import java.util.logging.*;
import javax.swing.JFrame;

/**
 *
 * @author user
 */
public class Assistance {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        JFrame frame = new Index();
        frame.setSize(320, 300);
        frame.setDefaultCloseOperation(frame.EXIT_ON_CLOSE);
        frame.setVisible(true);
    }
}
