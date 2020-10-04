

import javax.swing.*;
import javax.swing.filechooser.FileNameExtensionFilter;
import javax.swing.text.NumberFormatter;
import java.awt.*;
import java.sql.*;

public class InsertProduct extends JPanel{
    private JTextField keywords;
    private JLabel keywordsLabel;
    private JTextField productLine;
    private JLabel productLineLabel;
    private JTextField productName;
    private JLabel productNameLabel;
    private JButton image;
    private JLabel imageLabel;
    private JFileChooser image_chooser;
    private JFormattedTextField productQuantity;
    private JLabel productQuantityLabel;
    private JFormattedTextField price;
    private JLabel priceLabel;
    private JTextField producer;
    private JLabel producerLabel;
    private JTextArea productDescription;
    private JPanel descriptionWrapper;
    private JLabel productDescriptionLabel;
    private JFrame frame;
    private GridBagLayout layout;
    private GridBagConstraints constraints;
    public static int textLocX = 100;
    public static int fontSize = 16;
    private JButton back;
    private JButton submit;
    private String imageLink;

    public InsertProduct(JFrame frame){
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

    private void initButton()
    {
        imageLink = "";
        back = new JButton("Quay lại");
        image_chooser = new JFileChooser();
        image_chooser.setAcceptAllFileFilterUsed(false);
        FileNameExtensionFilter restrict = new FileNameExtensionFilter("only image", "png", "jpg", "bmp", "jpeg");
        image_chooser.addChoosableFileFilter(restrict);
        constraints.gridx = 0;
        constraints.gridy = 16;
        constraints.gridwidth = 1;
        back.setFont(new Font(Font.SANS_SERIF, 0, fontSize));
        this.add(back, constraints);
        submit = new JButton("Xác nhận");
        constraints.gridx = 1;
        constraints.gridy = 16;
        constraints.gridwidth = 1;
        submit.setFont(new Font(Font.SANS_SERIF, 0, fontSize));
        this.add(submit, constraints);
        addListener();
    }

    private void addListener()
    {
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

        image.addActionListener(e -> {
            image_chooser.showOpenDialog(frame);
            imageLabel.setText("Đã chọn");
            if(image_chooser.getSelectedFile() != null)
                imageLink = image_chooser.getSelectedFile().getAbsolutePath();
        });
    }

    private boolean checkInput()
    {
        if(keywords.getText().length() != 0 && productLine.getText().length() != 0
                && productName.getText().length() != 0 && imageLink.length() != 0
                && productQuantity.getText().length() != 0 && price.getText().length() != 0
                && producer.getText().length() != 0 && productDescription.getText().length() != 0)
        {
            return true;
        }
        return false;
    }

    void insert() throws Exception
    {
        String url = "jdbc:mysql://localhost/petty";
        Class.forName("com.mysql.jdbc.Driver");
        Connection conn = DriverManager.getConnection(url, "root", "");
        String query = "insert into products (keywords, productline, productname, image, productQuantity, " +
                "price, producer, productDescription) value(?, ?, ?, ? ,?, ?, ?, ?)";
        PreparedStatement preparedStatement = conn.prepareStatement(query);
        preparedStatement.setString(1, keywords.getText());
        preparedStatement.setString(2, productLine.getText());
        preparedStatement.setString(3, productName.getText());
        preparedStatement.setString(4, imageLink);
        preparedStatement.setString(5, productQuantity.getText());
        preparedStatement.setString(6, price.getText());
        preparedStatement.setString(7, producer.getText());
        preparedStatement.setString(8, productDescription.getText());

        preparedStatement.execute();
        conn.close();
    }

    private void destroy()
    {
        this.setVisible(false);
        this.removeAll();
        frame.remove(this);
    }

    private void initText()
    {
        descriptionWrapper = new JPanel(new GridLayout(1, 1));
        //Label
        keywordsLabel = new JLabel("Từ khoá");
        Font font = new Font(Font.SANS_SERIF, Font.PLAIN, fontSize);
        keywordsLabel.setFont(font);
        productLineLabel = new JLabel("Dòng sản phẩm");
        productLineLabel.setFont(font);
        productNameLabel = new JLabel("Tên sản phẩm");
        productNameLabel.setFont(font);
        imageLabel = new JLabel("Chưa chọn ảnh");
        imageLabel.setFont(font);
        productQuantityLabel = new JLabel("Số lượng trong kho");
        productQuantityLabel.setFont(font);
        priceLabel = new JLabel("Giá");
        priceLabel.setFont(font);
        producerLabel = new JLabel("Nhà sản xuất");
        producerLabel.setFont(font);
        productDescriptionLabel = new JLabel("Miêu tả");
        productDescriptionLabel.setFont(font);
        //Text field
        keywords = new JTextField();
        keywords.setFont(font);
        keywords.setPreferredSize(new Dimension(800, 50));
        productLine = new JTextField();
        productLine.setFont(font);
        productLine.setPreferredSize(new Dimension(800, 50));
        productName = new JTextField();
        productName.setFont(font);
        productName.setPreferredSize(new Dimension(800, 50));
        image = new JButton("Chọn ảnh");
        image.setFont(font);
        image.setPreferredSize(new Dimension(800, 50));
        productQuantity = new JFormattedTextField(new NumberFormatter());
        productQuantity.setFont(font);
        productQuantity.setPreferredSize(new Dimension(800, 50));
        price = new JFormattedTextField(new NumberFormatter());
        price.setFont(font);
        price.setPreferredSize(new Dimension(800, 50));
        producer = new JTextField();
        producer.setFont(font);
        producer.setPreferredSize(new Dimension(800, 50));
        productDescription = new JTextArea(10, 50);
        productDescription.setFont(font);
        productDescription.setLineWrap(true);
        descriptionWrapper.add(productDescription);

        constraints.insets = new Insets(5, 5, 5, 5);
        //line 1
        constraints.gridx = 0;
        constraints.gridy = 0;
        this.add(keywordsLabel, constraints);
        constraints.gridx = 1;
        constraints.gridy = 0;
        this.add(keywords, constraints);
        //line 2
        constraints.gridx = 0;
        constraints.gridy = 2;
        this.add(productLineLabel, constraints);
        constraints.gridx = 1;
        constraints.gridy = 2;
        this.add(productLine, constraints);
        //line 3
        constraints.gridx = 0;
        constraints.gridy = 4;
        this.add(productNameLabel, constraints);
        constraints.gridx = 1;
        constraints.gridy = 4;
        this.add(productName, constraints);
        //line 4
        constraints.gridx = 0;
        constraints.gridy = 6;
        this.add(imageLabel, constraints);
        constraints.gridx = 1;
        constraints.gridy = 6;
        this.add(image, constraints);
        //line 5
        constraints.gridx = 0;
        constraints.gridy = 8;
        this.add(productQuantityLabel, constraints);
        constraints.gridx = 1;
        constraints.gridy = 8;
        this.add(productQuantity, constraints);
        //line 6
        constraints.gridx = 0;
        constraints.gridy = 10;
        this.add(priceLabel, constraints);
        constraints.gridx = 1;
        constraints.gridy = 10;
        this.add(price, constraints);
        //line 7
        constraints.gridx = 0;
        constraints.gridy = 12;
        this.add(producerLabel, constraints);
        constraints.gridx = 1;
        constraints.gridy = 12;
        this.add(producer, constraints);
        //line 8
        constraints.gridx = 0;
        constraints.gridy = 14;
        this.add(productDescriptionLabel, constraints);
        constraints.gridx = 1;
        constraints.gridy = 14;
        this.add(descriptionWrapper, constraints);
        JScrollPane scrollPane = new JScrollPane(productDescription, ScrollPaneConstants.VERTICAL_SCROLLBAR_AS_NEEDED,
                ScrollPaneConstants.HORIZONTAL_SCROLLBAR_AS_NEEDED);
        descriptionWrapper.add(scrollPane);
    }
}
