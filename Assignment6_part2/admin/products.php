<?php
$dataDir = __DIR__ . '/../data/';
$productsFile = $dataDir . 'products.csv';

// Read all products from CSV
function get_all_products() {
    global $productsFile;
    $products = [];
    if (!file_exists($productsFile)) {
        return $products;
    }
    if (($handle = fopen($productsFile, 'r')) !== false) {
        $headers = null;
        $index = 0;
        while (($data = fgetcsv($handle, 0, ',')) !== false) {
            if ($headers === null) {
                $headers = $data;
                continue;
            }
            $row = ['id' => $index];
            foreach ($headers as $i => $h) {
                $row[$h] = isset($data[$i]) ? $data[$i] : '';
            }
            $products[] = $row;
            $index++;
        }
        fclose($handle);
    }
    return $products;
}

// Get a specific product by ID
function get_product_by_id($id) {
    $products = get_all_products();
    foreach ($products as $p) {
        if ($p['id'] == $id) {
            return $p;
        }
    }
    return null;
}

// Add a new product
function create_product($product) {
    global $productsFile;
    $products = get_all_products();
    
    // Create new product with new ID
    $newId = count($products);
    $newProduct = array_merge(['id' => $newId], $product);
    $products[] = $newProduct;
    
    // Save back to CSV
    save_products_to_csv($products);
    return $newProduct;
}

// Update an existing product
function update_product($id, $productData) {
    $products = get_all_products();
    foreach ($products as &$p) {
        if ($p['id'] == $id) {
            $p = array_merge($p, $productData);
            save_products_to_csv($products);
            return $p;
        }
    }
    return null;
}

// Delete a product
function delete_product($id) {
    $products = get_all_products();
    $products = array_filter($products, function($p) use ($id) {
        return $p['id'] != $id;
    });
    // Re-index IDs
    $products = array_values($products);
    foreach ($products as &$p) {
        $p['id'] = array_search($p, $products);
    }
    save_products_to_csv($products);
    return true;
}

// Save products to CSV file
function save_products_to_csv($products) {
    global $productsFile;
    if (empty($products)) {
        $handle = fopen($productsFile, 'w');
        fputcsv($handle, ['Product', 'ShortDescription', 'Applications']);
        fclose($handle);
        return;
    }
    
    if (($handle = fopen($productsFile, 'w')) !== false) {
        // Write header
        $headers = ['Product', 'ShortDescription', 'Applications'];
        fputcsv($handle, $headers);
        
        // Write data rows
        foreach ($products as $p) {
            $row = [
                $p['Product'] ?? '',
                $p['ShortDescription'] ?? '',
                $p['Applications'] ?? ''
            ];
            fputcsv($handle, $row);
        }
        fclose($handle);
    }
}
?>
