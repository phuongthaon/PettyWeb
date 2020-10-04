import javax.swing.*;
import java.awt.*;

public class MainMenu extends JPanel {
    private JButton insert;
    private JButton order;
    private JButton users;
    private JButton statistic;
    private JButton quit;
    private JFrame frame;
    public static int buttonLocX = 100;
    public static int buttonWidth = 150;
    public static int buttonHeight = 50;
    public MainMenu(JFrame frame)
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
        insert = new JButton("Nhập mới");
        insert.setBounds(buttonLocX,100,buttonWidth, 50 );
        this.add(insert);
        users = new JButton("Khách hàng");
        users.setBounds(buttonLocX, 200, buttonWidth, buttonHeight);
        this.add(users);
        order = new JButton("Đơn hàng");
        order.setBounds(buttonLocX, 300, buttonWidth, buttonHeight);
        this.add(order);
        statistic = new JButton("Thống kê");
        statistic.setBounds(buttonLocX, 400, buttonWidth, buttonHeight);
        this.add(statistic);
        quit = new JButton("Thoát");
        quit.setBounds(buttonLocX, 500, buttonWidth, buttonHeight);
        this.add(quit);
        addListener();
    }

    private void destroy()
    {
        this.setVisible(false);
        this.removeAll();
        frame.remove(this);
    }

    private void addListener()
    {
        insert.addActionListener(e -> {
            Insert insert = new Insert(frame);
            frame.add(insert);
            destroy();
        });
        users.addActionListener(e -> {
            Users users = new Users(frame);
            frame.add(users);
            destroy();
        });
        order.addActionListener(e -> {
            Order order = new Order(frame);
            frame.add(order);
            destroy();
        });
        statistic.addActionListener(e -> {
            Statistic statistic = new Statistic(frame);
            frame.add(statistic);
            destroy();
        });
        quit.addActionListener(e -> {
            this.setVisible(false);
            frame.dispose();
            System.exit(0);
        });
    }
}
