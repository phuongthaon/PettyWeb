import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.TableColumn;
import java.awt.*;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;

public class Order extends JPanel {
    private JButton back;
    private JButton reload;
    private GridBagLayout layout;
    private GridBagConstraints constraints;
    private JPanel tableWrapper;
    private JTable table;
    private JFrame frame;
    public Order(JFrame frame)
    {
        this.frame = frame;
        initBoard();
    }

    private void initBoard()
    {
        constraints = new GridBagConstraints();
        constraints.insets = new Insets(5, 5, 5, 5);
        layout = new GridBagLayout();
        setLayout(layout);
        tableWrapper = new JPanel(new GridLayout(1, 1));
        tableWrapper.setPreferredSize(new Dimension(800, 600));
        setBounds(0,0, Petty.width, Petty.height);
        setBackground(Color.LIGHT_GRAY);
        setPreferredSize(new Dimension(Petty.width, Petty.height));
        initButton();
        initTable();
    }

    private void initButton()
    {
        reload = new JButton("Tải lại");
        constraints.gridx = 1;
        constraints.gridy = 0;
        this.add(reload, constraints);
        back = new JButton("Quay lại");
        constraints.gridx = 1;
        constraints.gridy = 1;
        this.add(back, constraints);
        addListener();
    }

    private void addListener()
    {
        back.addActionListener(e -> {
            MainMenu mainMenu = new MainMenu(frame);
            frame.add(mainMenu);
            destroy();
        });
        reload.addActionListener(e -> {
            try {
                initData();
            } catch (Exception ex) {
                ex.printStackTrace();
            }
        });
    }

    private void destroy()
    {
        this.setVisible(false);
        this.removeAll();
        frame.remove(this);
    }

    private void initTable()
    {
        String[] column = {"Mã đơn hàng","Ngày đặt","Ngày yêu cầu giao","Ngày giao", "Tình trạng", "Phản hồi"};
        String[][] data = {};
        table = new JTable(new DefaultTableModel(data, column));
        try {
            initData();
        } catch (Exception e) {
            e.printStackTrace();
        }
        tableWrapper.add(table);
        JScrollPane scrollPane = new JScrollPane(table, JScrollPane.VERTICAL_SCROLLBAR_AS_NEEDED,
                JScrollPane.HORIZONTAL_SCROLLBAR_AS_NEEDED);
        tableWrapper.add(scrollPane);
        constraints.gridx = 0;
        constraints.gridy = 0;
        this.add(tableWrapper, constraints);
    }

    private void initData() throws Exception {
        DefaultTableModel model = (DefaultTableModel) table.getModel();
        model.setRowCount(0);
        String url = "jdbc:mysql://localhost/petty";
        Class.forName("com.mysql.jdbc.Driver");
        Connection conn = DriverManager.getConnection(url, "root", "");
        String query = "SELECT * FROM orderproducts ORDER BY orderDate DESC";
        PreparedStatement statement = conn.prepareStatement(query);
        ResultSet resultSet = statement.executeQuery();
        while(resultSet.next())
        {
            String orderNumber = resultSet.getString("orderNumber");
            String orderDate = resultSet.getString("orderDate");
            String requiredDate = resultSet.getString("requiredDate");
            String shippedDate = "N/A";
            if(resultSet.getString("shippedDate") != null)
            {
                shippedDate = resultSet.getString("shippedDate");
            }
            String status = "N/A";
            if(resultSet.getString("status") != null)
            {
                status = resultSet.getString("status");
            }
            model = (DefaultTableModel) table.getModel();
            String[] s = { orderNumber, orderDate, requiredDate, shippedDate, status};
            model.addRow(s);
        }
        conn.close();
    }
}
