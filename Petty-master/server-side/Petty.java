import javax.swing.*;
import java.awt.*;
import java.io.IOException;

public class Petty extends JFrame{
    public static int width = 1200;
    public static int height = 800;
    public Petty()
    {
        pack();
        setVisible(true);
        setSize(width, height);
        setResizable(false);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setLocationRelativeTo(null);
        setLayout(null);
        setTitle("Petty");
        setBackground(Color.LIGHT_GRAY);
        runMySQL();
        MainMenu menu = new MainMenu(this);
        this.add(menu);
    }

    private void runMySQL()
    {
        String command = "C:\\xampp\\mysql\\bin\\mysqld.exe";

        try
        {
            Process process = Runtime.getRuntime().exec(command);
        }
        catch (IOException e)
        {
            e.printStackTrace();
        }
    }

    public static void main(String[] args)
    {
        EventQueue.invokeLater(() -> {
            Petty petty = new Petty();
        });

    }
}
