import javax.swing.*;
import java.awt.*;

public class Insert extends JPanel{
    private JButton insertProduct;
    private JButton insertCustomer;
    private JButton insertService;
    private JButton back;
    public static int buttonLocX = 100;
    public static int buttonWidth = 150;
    public static int buttonHeight = 50;
    private JFrame frame;
    public Insert(JFrame frame)
    {
        this.frame = frame;
        initBoard();
    }

    private void initBoard()
    {
        setLayout(null);
        setBounds(0,0, Petty.width, Petty.height);
        setBackground(Color.LIGHT_GRAY);
        setPreferredSize(new Dimension(Petty.width, Petty.height));
        initButton();
    }

    private void initButton()
    {
        insertProduct = new JButton("Nhập hàng");
        insertProduct.setBounds(buttonLocX, 100, buttonWidth, buttonHeight);
        this.add(insertProduct);
        insertService = new JButton("Nhập dịch vụ");
        insertService.setBounds(buttonLocX, 200, buttonWidth, buttonHeight);
        this.add(insertService);
        insertCustomer = new JButton("Nhập khách hàng");
        insertCustomer.setBounds(buttonLocX, 300, buttonWidth, buttonHeight);
        this.add(insertCustomer);
        back = new JButton("Quay lại");
        back.setBounds(buttonLocX, 400, buttonWidth, buttonHeight);
        this.add(back);
        addListener();
    }

    private void addListener()
    {
        insertProduct.addActionListener(e -> {
            InsertProduct insertProduct = new InsertProduct(frame);
            frame.add(insertProduct);
            this.destroy();
        });
        insertService.addActionListener(e -> {

        });
        insertCustomer.addActionListener(e -> {
            InsertCustomer insertCustomer = new InsertCustomer(frame);
            frame.add(insertCustomer);
            this.destroy();
        });
        back.addActionListener(e -> {
            MainMenu mainMenu = new MainMenu(frame);
            frame.add(mainMenu);
            this.removeAll();
            this.setVisible(false);
            frame.remove(this);
        });
    }

    private void destroy()
    {
        this.setVisible(false);
        this.removeAll();
        frame.remove(this);
    }

}
