<?php
class HomeController
{
    // Hiển thị trang chủ
    function index()
    {
        $conds = [];
        $page = 1;
        $item_per_page = 4;
        $productRepository = new ProductRepository();

        // Lấy sản phẩm nổi bật
        $sorts = ['featured' => 'DESC'];
        $featuredProducts = $productRepository->getBy($conds, $sorts, $page, $item_per_page);

        // Lấy sản phẩm mới nhất
        $sorts = ['created_date' => 'DESC'];
        $latestProducts = $productRepository->getBy($conds, $sorts, $page, $item_per_page);

        // Lấy tất cả danh mục
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->getAll();
        // lưu tên danh mục và danh sách sản phẩm tương ứng
        $categoryProducts = [];

        // Lặp từng danh mục để lấy danh sách sản phẩm tương ứng với danh mục đó
        foreach ($categories as $category) {
            $categoryName = $category->getName();
            $categoryId = $category->getId();
            $conds = [
                'category_id' => [
                    'type' => '=',
                    'val' => $categoryId //3
                ]

            ];
            $products = $productRepository->getBy($conds, [], $page, $item_per_page);
            // SELECT * FROM view_product WHERE category_id = 3
            // Dấu [] bên trái nghĩa là thêm 1 phần tử vào cuối danh sách
            $categoryProducts[] = [
                'categoryName' => $categoryName,
                'products' => $products
            ];
        }
        require 'view/home/index.php';
    }
}
