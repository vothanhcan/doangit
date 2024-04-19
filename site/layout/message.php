<?php
$message = '';
$class = '';
if (isset($_SESSION['success'])) {
    $message = $_SESSION['success'];
    // xóa phần tử có key là success
    unset($_SESSION['success']);
    $class = 'success';
} else if (isset($_SESSION['error'])) {
    $message = $_SESSION['error'];
    // xóa phần tử có key là error
    unset($_SESSION['error']);
    $class = 'danger';
}
?>
<!-- .alert.alert-success -->
<?php if ($message) : ?>
    <div class="alert alert-<?= $class ?> mt-3 text-center"><?= $message ?></div>
<?php endif ?>