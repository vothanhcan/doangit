<?php
class ProductController
{
    // Hiển thị danh sách sản phẩm
    function index()
    {
        // Lấy tất cả các danh mục sản phẩm đổ ra view
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->getAll();

        $conds = [];
        $sorts = [];
        $page = $_GET['page'] ?? 1;
        $item_per_page = 10;
        // tìm theo danh mục
        $category_id = $_GET['category_id'] ?? null;
        if ($category_id) {
            $conds = [
                'category_id' => [
                    'type' => '=',
                    'val' => $category_id //3
                ]
            ];
            // SELECT * FROM view_product WHERE category_id = 3
        }
        // tìm theo khoảng giá
        // vd: price-range=500000-1000000
        $priceRange = $_GET['price-range'] ?? null;
        if ($priceRange) {
            $temp = explode('-', $priceRange);
            $start_price = $temp[0];
            $end_price = $temp[1];
            $conds = [
                'sale_price' => [
                    'type' => 'BETWEEN',
                    'val' => "$start_price AND $end_price" //
                ]
            ];
            // SELECT * FROM view_product WHERE sale_price BETWEEN 500000 AND 1000000
            // trường hợp đặc biệt: price-range=1000000-greater
            if ($end_price == 'greater') {
                $conds = [
                    'sale_price' => [
                        'type' => '>=',
                        'val' => $start_price //1000000
                    ]
                ];
                // SELECT * FROM view_product WHERE sale_price >= 1000000
            }
        }

        // Sắp xếp
        // sort=price-asc
        $sort = $_GET['sort'] ?? null;
        if ($sort) {
            $temp = explode('-', $sort);
            $dummyCol = $temp[0];
            $order = strtoupper($temp[1]);
            // bảng ánh xạ
            $map = [
                'price' => 'sale_price',
                'alpha' => 'name',
                'created' => 'created_date'
            ];
            $colName = $map[$dummyCol];

            $sorts = [$colName => $order];
            // $sorts = ['sale_price' => 'ASC'];
            // SELECT * FROM view_product ORDER BY sale_price ASC
        }
        // tìm kiếm
        // search=Kem+làm+trắng
        // dấu + chỗ thanh địa chỉ trình duyệt có ý nghĩa là khoảng trắng
        $search = $_GET['search'] ?? '';
        if ($search) {
            $conds = [
                'name' => [
                    'type' => 'LIKE',
                    'val' => "'%$search%'" //Kem làm trắng
                ]
            ];
            // SELECT * FROM view_product WHERE name LIKE '%Kem làm trắng%'
        }

        $productRepository = new ProductRepository();
        $products = $productRepository->getBy($conds, $sorts, $page, $item_per_page);

        // 24 sản phẩm, mỗi trang 10 sản phẩm => có 3 trang
        // ceil(24/10) => 3
        $totalProducts = $productRepository->getBy($conds, $sorts);
        // count là hàm đếm số lượng phần tử trong danh sách (array)
        $totalPage = ceil(count($totalProducts) / $item_per_page);
        require 'view/product/index.php';
    }

    function detail()
    {
        $id = $_GET['id'];
        $productRepository = new ProductRepository();
        $product = $productRepository->find($id);
        $category_id = $product->getCategoryId();
        // Lấy những sản phẩm có liên quan đổ lên view
        $conds = [
            'category_id' => [
                'type' => '=',
                'val' => $category_id //3
            ],
            'id' => [
                'type' => '!=',
                'val' => $id //5
            ]
        ];
        // SELECT * FROM view_product WHERE category_id = 3 AND id != 5
        $relatedProducts = $productRepository->getBy($conds);

        // Lấy tất cả các danh mục sản phẩm đổ ra view
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->getAll();

        require 'view/product/detail.php';
    }

    function storeComment()
    {
        // Lấy dữ liệu từ người dùng đổ vào array data
        $data = [];
        $data["email"] = $_POST['email'];
        $data["fullname"] = $_POST['fullname'];
        $data["star"] = $_POST['rating'];
        $data["created_date"] = date('Y-m-d H:i:s');
        $data["description"] = $_POST['description'];
        $data["product_id"] = $_POST['product_id'];

        $commentRepository = new CommentRepository();
        $commentRepository->save($data);

        $productRepository = new ProductRepository();
        $product = $productRepository->find($data["product_id"]);
        require 'view/product/comments.php';
    }
}
