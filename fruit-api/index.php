<?php
// index.php - Simple RESTful Products API (similar to fakestoreapi)
// Endpoints:
//  GET    /products            -> list all
//  GET    /products/{id}       -> get one
//  POST   /products            -> create
//  PUT    /products/{id}       -> update (full/partial)
//  DELETE /products/{id}       -> delete

require_once __DIR__ . '/db.php';

// Basic CORS for local dev
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(204);
  exit;
}
header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Adjust base path if project in subfolder, e.g., '/api/'
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$segments = array_values(array_filter(explode('/', substr($path, strlen($basePath))), fn($s) => $s !== ''));
$resource = $segments[0] ?? '';
$id = isset($segments[1]) ? intval($segments[1]) : null;

function read_json_body() {
  $raw = file_get_contents('php://input');
  $data = json_decode($raw, true);
  if (json_last_error() !== JSON_ERROR_NONE) {
    return null;
  }
  return $data;
}

function send($status, $payload) {
  http_response_code($status);
  echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  exit;
}

if ($resource !== 'products') {
  send(404, ['error' => 'Not Found']);
}

if ($method === 'GET' && $id === null) {
  // list all products
  $stmt = $pdo->query("SELECT * FROM products ORDER BY id ASC");
  $rows = $stmt->fetchAll();
  // Convert JSON columns (sizes, images) back to arrays if stored as strings
  foreach ($rows as &$r) {
    foreach (['sizes','images'] as $j) {
      if (isset($r[$j]) && is_string($r[$j])) {
        $tmp = json_decode($r[$j], true);
        if (json_last_error() === JSON_ERROR_NONE) $r[$j] = $tmp;
      }
    }
  }
  send(200, $rows);
}

if ($method === 'GET' && $id !== null) {
  $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
  $stmt->execute([$id]);
  $row = $stmt->fetch();
  if (!$row) send(404, ['error' => 'Product not found']);
  foreach (['sizes','images'] as $j) {
    if (isset($row[$j]) && is_string($row[$j])) {
      $tmp = json_decode($row[$j], true);
      if (json_last_error() === JSON_ERROR_NONE) $row[$j] = $tmp;
    }
  }
  send(200, $row);
}

if ($method === 'POST') {
  $data = read_json_body();
  if (!$data) send(400, ['error' => 'Invalid JSON body']);
  // minimal validation
  $title = $data['title'] ?? null;
  $brand = $data['brand'] ?? '';
  $category = $data['category'] ?? '';
  $price = $data['price'] ?? null;
  if (!$title || $price === null) {
    send(400, ['error' => 'Missing required fields: title, price']);
  }
  $description = $data['description'] ?? null;
  $stock = intval($data['stock'] ?? 0);
  $color = $data['color'] ?? null;
  $sizes = isset($data['sizes']) ? json_encode($data['sizes'], JSON_UNESCAPED_UNICODE) : null;
  $thumbnail = $data['thumbnail'] ?? null;
  $images = isset($data['images']) ? json_encode($data['images'], JSON_UNESCAPED_UNICODE) : null;
  $rating = isset($data['rating']) ? floatval($data['rating']) : null;
  $is_active = isset($data['is_active']) ? intval($data['is_active']) : 1;

  $sql = "INSERT INTO products (title,brand,category,description,price,stock,color,sizes,thumbnail,images,rating,is_active)
          VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
  $pdo->prepare($sql)->execute([$title,$brand,$category,$description,$price,$stock,$color,$sizes,$thumbnail,$images,$rating,$is_active]);
  $newId = $pdo->lastInsertId();
  $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
  $stmt->execute([$newId]);
  $row = $stmt->fetch();
  if (isset($row['sizes']) && is_string($row['sizes'])) $row['sizes'] = json_decode($row['sizes'], true);
  if (isset($row['images']) && is_string($row['images'])) $row['images'] = json_decode($row['images'], true);
  send(201, $row);
}

if ($method === 'PUT' && $id !== null) {
  $data = read_json_body();
  if (!$data) send(400, ['error' => 'Invalid JSON body']);

  // Build dynamic update
  $fields = ['title','brand','category','description','price','stock','color','sizes','thumbnail','images','rating','is_active'];
  $set = [];
  $vals = [];
  foreach ($fields as $f) {
    if (array_key_exists($f, $data)) {
      $val = $data[$f];
      if (in_array($f, ['sizes','images'])) {
        $val = json_encode($val, JSON_UNESCAPED_UNICODE);
      }
      $set[] = "`$f` = ?";
      $vals[] = $val;
    }
  }
  if (empty($set)) send(400, ['error' => 'No fields to update']);
  $vals[] = $id;
  $sql = "UPDATE products SET " . implode(', ', $set) . " WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute($vals);

  $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
  $stmt->execute([$id]);
  $row = $stmt->fetch();
  if (!$row) send(404, ['error' => 'Product not found after update']);
  foreach (['sizes','images'] as $j) {
    if (isset($row[$j]) && is_string($row[$j])) {
      $tmp = json_decode($row[$j], true);
      if (json_last_error() === JSON_ERROR_NONE) $row[$j] = $tmp;
    }
  }
  send(200, $row);
}

if ($method === 'DELETE' && $id !== null) {
  $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
  $stmt->execute([$id]);
  send(200, ['status' => 'ok', 'deleted_id' => $id]);
}

send(405, ['error' => 'Method Not Allowed']);
