import javax.swing.*;
import java.awt.*;

public class Statistic extends JPanel {
    private JTextField totalValue;
    private JTextField value;
    private JTextField totalCustomer;
    private JTextField customer;
    private JTextField mostPurchasedProduct;
    private JTextField mostPopularService;
    private JTextField mostPurchasedProductLine;

    private JButton mostPurchasedProductDetail;
    private JButton mostPopularServiceDetail;
    private JButton mostPopularProductLineDetail;

    private GridBagLayout layout;
    private GridBagConstraints constraints;

    private JFrame frame;
    public Statistic(JFrame frame)
    {
        this.frame = frame;
        initBoard();
    }

    private void initBoard()
    {
        constraints = new GridBagConstraints();
        constraints.insets = new Insets(5, 5, 5, 5);
        constraints.anchor = GridBagConstraints.WEST;
        layout = new GridBagLayout();
        setLayout(layout);
        setBounds(0,0, Petty.width, Petty.height);
        setBackground(Color.LIGHT_GRAY);
        setPreferredSize(new Dimension(Petty.width, Petty.height));
        initText();
    }

    private void initText()
    {
        Font font = new Font(Font.SANS_SERIF, Font.PLAIN, 18);
        totalValue = new JTextField("Tổng giá trị các đơn hàng: ");
        totalValue.setFont(font);
        totalValue.setEditable(false);
        value = new JTextField("127,655,000");
        value.setFont(font);
        value.setEditable(false);
        totalCustomer = new JTextField("Số lương khách hàng: ");
        totalCustomer.setFont(font);
        totalCustomer.setEditable(false);
        customer = new JTextField("97");
        customer.setFont(font);
        customer.setEditable(false);
        mostPurchasedProduct = new JTextField("Sản phẩm mua nhiều nhất: ");
        mostPurchasedProduct.setFont(font);
        mostPurchasedProduct.setEditable(false);
        mostPopularService = new JTextField("Dịch vụ phổ biến nhất: ");
        mostPopularService.setFont(font);
        mostPopularService.setEditable(false);
        mostPurchasedProductLine = new JTextField("Dòng sản phẩm phổ biến: ");
        mostPurchasedProductLine.setFont(font);
        mostPurchasedProductLine.setEditable(false);

        mostPurchasedProductDetail = new JButton("Sữa tắm cho chó OEM");
        mostPurchasedProductDetail.setFont(font);
        mostPopularServiceDetail = new JButton("Bệnh viện thú cưng");
        mostPopularServiceDetail.setFont(font);
        mostPopularProductLineDetail = new JButton("Thức ăn cho chó");
        mostPopularProductLineDetail.setFont(font);


        constraints.gridx = 0;
        constraints.gridy = 0;
        this.add(totalValue, constraints);
        constraints.gridx = 1;
        constraints.gridy = 0;
        this.add(value, constraints);

        constraints.gridx = 0;
        constraints.gridy = 1;
        this.add(totalCustomer, constraints);
        constraints.gridx = 1;
        constraints.gridy = 1;
        this.add(customer, constraints);

        constraints.gridx = 0;
        constraints.gridy = 2;
        this.add(mostPurchasedProduct, constraints);
        constraints.gridx = 1;
        constraints.gridy = 2;
        this.add(mostPurchasedProductDetail, constraints);

        constraints.gridx = 0;
        constraints.gridy = 3;
        this.add(mostPopularService, constraints);
        constraints.gridx = 1;
        constraints.gridy = 3;
        this.add(mostPopularServiceDetail, constraints);

        constraints.gridx = 0;
        constraints.gridy = 4;
        this.add(mostPurchasedProductLine, constraints);
        constraints.gridx = 1;
        constraints.gridy = 4;
        this.add(mostPopularProductLineDetail, constraints);
        initData();
    }

    private void initData()
    {

    }
}
