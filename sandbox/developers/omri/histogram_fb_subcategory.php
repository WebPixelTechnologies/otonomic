<?php
define('DB_NAME', 'wp');
define('DB_USER', 'root');
define('DB_PASSWORD', 'otoOTO2611');
define('DB_HOST', 'dbmaster.otonomic.com');

$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);
$stmt = $db->query("SELECT site_id, user_id, slug, name, category, ip, category_list, created FROM otonomic_sites");

$fid = fopen('otonomic_sites_fb_subcategories.csv', 'w');
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $subcategories = json_decode($row['category_list']);

    foreach((array)$subcategories as $subcategory) {
        $data = [
            'site_id' => $row['site_id'],
            'user_id' => $row['user_id'],
            'slug' => $row['slug'],
            'name' => $row['name'],
            'category' => $row['category'],
            'subcategory_id' => $subcategory->id,
            'subcategory_name' => $subcategory->name,
            'created' => $row['created'],
            'ip' => $row['ip'],
        ];
        fputcsv($fid, $data);
        echo $row['site_id']."<br/>";
    }
}
fclose($fid);
