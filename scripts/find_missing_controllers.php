<?php
$routes = __DIR__ . '/../routes/web.php';
$controllersDir = __DIR__ . '/../app/Http/Controllers';

if (!file_exists($routes)) {
    echo "routes/web.php not found\n";
    exit(1);
}

$contents = file_get_contents($routes);
// match patterns like 'SomeController@method' or 'SomeController@index' or 'SomeController' (edge cases)
preg_match_all("/'([A-Za-z0-9_\\\\]+)Controller(@|')/", $contents, $matches);
$names = [];
foreach ($matches[1] as $m) {
    // strip possible namespace separators
    $parts = explode('\\\\', $m);
    $name = end($parts) . 'Controller';
    $names[$name] = true;
}

$names = array_keys($names);
sort($names);

// recursively list controller files
$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($controllersDir));
$existing = [];
foreach ($rii as $file) {
    if ($file->isDir()) continue;
    $fname = $file->getFilename();
    if (substr($fname, -4) === '.php') {
        $existing[$fname] = true;
    }
}

$missing = [];
foreach ($names as $n) {
    $filename = $n . '.php';
    if (!isset($existing[$filename])) {
        $missing[] = $n;
    }
}

echo "Found " . count($names) . " referenced controllers in routes/web.php\n";
echo "Existing controller PHP files found: " . count($existing) . "\n\n";

if (!empty($names)) {
    echo "Referenced controllers (sample up to 200):\n";
    $count=0;
    foreach ($names as $n) {
        echo " - $n\n";
        $count++;
        if ($count>=200) break;
    }
    echo "\n";
}

if (!empty($missing)) {
    echo "Missing controllers (need stubs if you want to run route:list):\n";
    foreach ($missing as $m) echo " - $m\n";
    exit(0);
} else {
    echo "No missing controllers detected.\n";
}
