import javax.swing.*;
import javax.swing.filechooser.FileNameExtensionFilter;
import java.awt.*;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.regex.Pattern;

public class InsertCustomer extends JPanel {
    private JLabel name_label;
    private JTextField customerName;
    private JLabel preferName_label;
    private JTextField preferName;
    private JLabel gender_label;
    private JComboBox gender;
    private JLabel birth_label;
    private JTextField dateOfBirth;
    private JLabel address_label;
    private JTextField address;
    private JLabel image_label;
    private JButton image;
    private JFileChooser image_chooser;
    private JFrame frame;
    private JLabel username_label;
    private JTextField username;
    private JLabel password_label;
    private JPasswordField passwordField;
    private JLabel email_label;
    private JTextField email;
    private JLabel phoneNumber_label;
    private JTextField phoneNumber;
    private GridBagLayout layout;
    private GridBagConstraints constraints;
    private static int fontSize = 16;
    private String imageLink;
    private JButton back;
    private JButton submit;
    public InsertCustomer(JFrame frame)
    {
        this.frame = frame;
        initBoard();
    }

    private void initBoard()
    {
        constraints = new GridBagConstraints();
        layout = new GridBagLayout();
        setLayout(layout);
        setBounds(0,0, Petty.width, Petty.height);
        setBackground(Color.LIGHT_GRAY);
        setPreferredSize(new Dimension(Petty.width, Petty.height));
        initText();
        initButton();
    }

    private void initText()
    {
        Font font = new Font(Font.SANS_SERIF, Font.PLAIN, fontSize);
        //label
        name_label = new JLabel("Tên thật:");
        name_label.setFont(font);
        preferName_label = new JLabel("Tên hiển thị:");
        preferName_label.setFont(font);
        gender_label = new JLabel("Giới tính:");
        gender_label.setFont(font);
        birth_label = new JLabel("Ngày sinh:");
        birth_label.setFont(font);
        address_label = new JLabel("Địa chỉ:");
        address_label.setFont(font);
        image_label = new JLabel("Ảnh đại diện:");
        image_label.setFont(font);
        username_label = new JLabel("Tên đăng nhập:");
        username_label.setFont(font);
        password_label = new JLabel("Mật khẩu:");
        password_label.setFont(font);
        email_label = new JLabel("Email:");
        email_label.setFont(font);
        phoneNumber_label = new JLabel("Số điện thoại:");
        phoneNumber_label.setFont(font);
        //Field
        customerName = new JTextField();
        customerName.setFont(font);
        customerName.setPreferredSize(new Dimension(800, 50));
        preferName = new JTextField();
        preferName.setFont(font);
        preferName.setPreferredSize(new Dimension(800, 50));
        gender = new JComboBox();
        gender.addItem("Nam");
        gender.addItem("Nữ");
        gender.addItem("Khác");
        dateOfBirth = new JTextField();
        dateOfBirth.setFont(font);
        dateOfBirth.setPreferredSize(new Dimension(800, 50));
        address = new JTextField();
        address.setFont(font);
        address.setPreferredSize(new Dimension(800, 50));
        image = new JButton("Chọn ảnh");
        image.setFont(font);
        image.setPreferredSize(new Dimension(800, 50));
        username = new JTextField();
        username.setFont(font);
        username.setPreferredSize(new Dimension(800, 50));
        passwordField = new JPasswordField();
        passwordField.setPreferredSize(new Dimension(800, 50));
        email = new JTextField();
        email.setFont(font);
        email.setPreferredSize(new Dimension(800, 50));
        phoneNumber = new JTextField();
        phoneNumber.setFont(font);
        phoneNumber.setPreferredSize(new Dimension(800, 50));
        //set grid
        constraints.insets = new Insets(5, 5, 5, 5);
        //customerName
        constraints.gridx = 0;
        constraints.gridy = 0;
        this.add(name_label, constraints);
        constraints.gridx = 1;
        constraints.gridy = 0;
        this.add(customerName, constraints);
        constraints.gridx = 0;
        constraints.gridy = 2;
        this.add(preferName_label, constraints);
        constraints.gridx = 1;
        constraints.gridy = 2;
        this.add(preferName, constraints);
        constraints.gridx = 0;
        constraints.gridy = 4;
        this.add(gender_label, constraints);
        constraints.gridx = 1;
        constraints.gridy = 4;
        this.add(gender, constraints);
        constraints.gridx = 0;
        constraints.gridy = 6;
        this.add(birth_label, constraints);
        constraints.gridx = 1;
        constraints.gridy = 6;
        this.add(dateOfBirth, constraints);
        constraints.gridx = 0;
        constraints.gridy = 8;
        this.add(image_label, constraints);
        constraints.gridx = 1;
        constraints.gridy = 8;
        this.add(image, constraints);
        constraints.gridx = 0;
        constraints.gridy = 10;
        this.add(address_label, constraints);
        constraints.gridx = 1;
        constraints.gridy = 10;
        this.add(address, constraints);
        constraints.gridx = 0;
        constraints.gridy = 12;
        this.add(username_label, constraints);
        constraints.gridx = 1;
        constraints.gridy = 12;
        this.add(username, constraints);
        constraints.gridx = 0;
        constraints.gridy = 14;
        this.add(password_label, constraints);
        constraints.gridx = 1;
        constraints.gridy = 14;
        this.add(passwordField, constraints);
        constraints.gridx = 0;
        constraints.gridy = 16;
        this.add(email_label, constraints);
        constraints.gridx = 1;
        constraints.gridy = 16;
        this.add(email, constraints);
        constraints.gridx = 0;
        constraints.gridy = 18;
        this.add(phoneNumber_label, constraints);
        constraints.gridx = 1;
        constraints.gridy = 18;
        this.add(phoneNumber, constraints);
    }

    private void initButton()
    {
        image_chooser = new JFileChooser();
        image_chooser.setAcceptAllFileFilterUsed(false);
        FileNameExtensionFilter restrict = new FileNameExtensionFilter("only image", "png", "jpg", "bmp", "jpeg");
        image_chooser.addChoosableFileFilter(restrict);
        Font font = new Font(Font.SANS_SERIF, Font.PLAIN, fontSize);
        back = new JButton("Quay lại");
        back.setFont(font);
        constraints.gridx = 0;
        constraints.gridy = 20;
        this.add(back, constraints);
        submit = new JButton("Xác nhận");
        submit.setFont(font);
        constraints.gridx = 1;
        constraints.gridy = 20;
        this.add(submit, constraints);
        addListener();
    }

    private void addListener()
    {
        image.addActionListener(e -> {
            image_chooser.showOpenDialog(frame);
            image_label.setText("Đã chọn");
            if(image_chooser.getSelectedFile() != null)
                imageLink = image_chooser.getSelectedFile().getAbsolutePath();
        });
        back.addActionListener(e -> {
            Insert insert = new Insert(frame);
            frame.add(insert);
            destroy();
        });
        submit.addActionListener(e -> {
            if(checkInput()) {
                try {
                    insert();
                    Insert insert = new Insert(frame);
                    frame.add(insert);
                    destroy();
                } catch (Exception ex) {
                    ex.printStackTrace();
                }
            }
        });
    }

    private boolean checkInput()
    {
        if(customerName.getText().length() == 0 || preferName.getText().length() == 0 || !isDate(dateOfBirth.getText())
        || address.getText().length() == 0 || username.getText().length() == 0 ||
                passwordField.getPassword().length < 6 || phoneNumber.getText().length() == 0)
        {

            return false;
        }
        return true;
    }

    private boolean isDate(String date)
    {
        Pattern pattern = Pattern.compile("\\d{4}\\-(([1-2][0-2])|([0][1-9]|[1-9]))\\-([0-3][0-9])");
        if(pattern.matcher(date).matches())
        {
            return true;
        }
        System.out.println("failed");
        return false;
    }

    private void insert() throws Exception {
        String url = "jdbc:mysql://localhost/petty";
        Class.forName("com.mysql.jdbc.Driver");
        Connection conn = DriverManager.getConnection(url, "root", "");
        String query = "insert into users (username, password, email, phonenumber) value(?, PASSWORD(?), ?, ?)";
        PreparedStatement preparedStatement = conn.prepareStatement(query);
        preparedStatement.setString(1, username.getText());
        preparedStatement.setString(2, passwordField.getText());
        preparedStatement.setString(3, email.getText());
        preparedStatement.setString(4, phoneNumber.getText());
        preparedStatement.execute();
        query = "SELECT ID FROM users WHERE username LIKE '" + username.getText() + "'";
        preparedStatement = conn.prepareStatement(query);
        ResultSet resultSet = preparedStatement.executeQuery();
        resultSet.next();
        Integer ID = resultSet.getInt("ID");
        query = "insert into userdetail (ID, customerName, preferName, gender, dateOfBirth, address, imageLink) " +
                "value(?, ?, ?, ?, ?, ?, ?)";
        preparedStatement = conn.prepareStatement(query);
        preparedStatement.setString(1, ID.toString());
        preparedStatement.setString(2, customerName.getText());
        preparedStatement.setString(3, preferName.getText());
        preparedStatement.setString(4, gender.getSelectedItem().toString());
        preparedStatement.setString(5, dateOfBirth.getText());
        preparedStatement.setString(6, address.getText());
        preparedStatement.setString(7, imageLink);
        preparedStatement.execute();
        conn.close();
    }
    private void destroy()
    {
        this.setVisible(false);
        this.removeAll();
        frame.remove(this);
    }
}
