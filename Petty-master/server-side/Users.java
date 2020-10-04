import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.TableColumn;
import java.awt.*;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;

public class Users extends JPanel {
    private JTable table;
    private JPanel tableWrapper;
    private JFrame frame;
    private GridBagLayout layout;
    private GridBagConstraints constraints;
    private JButton back;
    private JButton reload;
    private JButton saveChange;
    private JTextField search;
    private JButton search_b;
    private TableColumn tableColumn;
    public Users(JFrame frame)
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
        search = new JTextField();
        search.setPreferredSize(new Dimension(400, 40));
        search.setFont(new Font(Font.SANS_SERIF, 0, 18));
        constraints.gridx = 0;
        constraints.gridy = 0;
        this.add(search,constraints);
        search_b = new JButton("Tìm");
        constraints.gridx = 1;
        constraints.gridy = 0;
        this.add(search_b);
        reload = new JButton("Tải lại");
        constraints.gridx = 1;
        constraints.gridy = 1;
        this.add(reload, constraints);
        saveChange = new JButton("Lưu");
        constraints.gridx = 1;
        constraints.gridy = 2;
        this.add(saveChange, constraints);
        back = new JButton("Quay lại");
        constraints.gridx = 1;
        constraints.gridy = 3;
        constraints.gridheight = 0;
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
        saveChange.addActionListener(e -> {
            try {
                saveChange();
            } catch (Exception ex) {
                ex.printStackTrace();
            }
        });
        search_b.addActionListener(e -> {
            try {
                search();
            } catch (Exception ex) {
                ex.printStackTrace();
            }
        });
    }

    private void search()  throws Exception
    {
        DefaultTableModel model = (DefaultTableModel) table.getModel();
        model.setRowCount(0);
        String url = "jdbc:mysql://localhost/petty";
        Class.forName("com.mysql.jdbc.Driver");
        Connection conn = DriverManager.getConnection(url, "root", "");
        String query = "SELECT * FROM userdetail WHERE customerName LIKE '%" + search.getText() + "%' " +
                "ORDER BY SUBSTRING_INDEX(CONCAT(' ', customerName),' ',-1) COLLATE utf8mb4_vietnamese_ci";
        PreparedStatement statement = conn.prepareStatement(query);
        ResultSet resultSet = statement.executeQuery();
        while(resultSet.next())
        {
            String ID = resultSet.getString("ID");
            String Name = resultSet.getString("customerName");
            String preferName = resultSet.getString("preferName");
            String dateOfBirth = resultSet.getString("DateOfBirth");
            String address = resultSet.getString("address");
            String gender = resultSet.getString("gender");
            String imageLink = resultSet.getString("imageLink");
            String[] s = { ID, Name, preferName, dateOfBirth, address, gender, imageLink};
            model.addRow(s);
        }
        conn.close();
    }

    private void saveChange() throws Exception {
        String url = "jdbc:mysql://localhost/petty";
        Class.forName("com.mysql.jdbc.Driver");
        Connection conn = DriverManager.getConnection(url, "root", "");
        for (int i = 0; i < table.getRowCount(); ++i)
        {
            String query = "UPDATE userdetail SET customerName = ?, preferName = ?, Dateofbirth = ?, address = ? , Gender = ?, imagelink = ? WHERE ID= " + table.getValueAt(i, 0);
            PreparedStatement statement = conn.prepareStatement(query);
            for(int j = 1; j < 7; ++j)
            {
                statement.setString(j, table.getValueAt(i, j).toString());
            }
            statement.execute();
        }
        conn.close();
    }

    private void destroy()
    {
        this.setVisible(false);
        this.removeAll();
        frame.remove(this);
    }

    private void initTable()
    {
        String[] column = {"ID","Tên khách hàng","Tên hiển thị","Ngày sinh", "địa chỉ", "Giới tính","Link ảnh"};
        String[][] data = {};
        table = new JTable(new DefaultTableModel(data, column));
        tableColumn = table.getColumnModel().getColumn(5);
        JComboBox comboBox = new JComboBox();
        comboBox.addItem("Nam");
        comboBox.addItem("Nữ");
        comboBox.addItem("Khác");
        tableColumn.setCellEditor(new DefaultCellEditor(comboBox));
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
        constraints.gridy = 1;
        this.add(tableWrapper, constraints);
    }

    //read data
    private void initData() throws Exception {
        DefaultTableModel model = (DefaultTableModel) table.getModel();
        model.setRowCount(0);
        String url = "jdbc:mysql://localhost/petty";
        Class.forName("com.mysql.jdbc.Driver");
        Connection conn = DriverManager.getConnection(url, "root", "");
        String query = "SELECT * FROM userdetail ORDER BY SUBSTRING_INDEX(CONCAT(' ', customerNAME),' ',-1) COLLATE utf8mb4_vietnamese_ci";
        PreparedStatement statement = conn.prepareStatement(query);
        ResultSet resultSet = statement.executeQuery();
        while(resultSet.next())
        {
            String ID = resultSet.getString("ID");
            String Name = resultSet.getString("customerName");
            String preferName = resultSet.getString("preferName");
            String dateOfBirth = resultSet.getString("DateOfBirth");
            String address = resultSet.getString("address");
            String gender = resultSet.getString("gender");
            String imageLink = resultSet.getString("imageLink");
            model = (DefaultTableModel) table.getModel();
            String[] s = { ID, Name, preferName, dateOfBirth, address, gender, imageLink};
            model.addRow(s);
        }
        conn.close();
    }
}
