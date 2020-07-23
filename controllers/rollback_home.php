<?

include dirname(__FILE__, 2) . "/templates/quanly_session.php";


/** Bây giờ thực hiện chức năng rollback home page */
header("Location: http://" . $_SERVER["HTTP_HOST"]);
