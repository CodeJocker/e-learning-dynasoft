<?php
$envPath = __DIR__ . '/../.env';
if (!file_exists($envPath)) {
    fwrite(STDERR, ".env not found at $envPath\n");
    exit(1);
}
$contents = file_get_contents($envPath);
$lines = preg_split("/\r\n|\n|\r/", $contents);
$env = [];
foreach ($lines as $line) {
    $line = trim($line);
    if ($line === '' || strpos($line, '#') === 0) {
        continue;
    }
    if (strpos($line, '=') === false) {
        continue;
    }
    list($k, $v) = explode('=', $line, 2);
    $k = trim($k);
    $v = trim($v);
    if (strlen($v) >= 2 && (($v[0] === '"' && substr($v, -1) === '"') || ($v[0] === "'" && substr($v, -1) === "'"))) {
        $v = substr($v, 1, -1);
    }
    $env[$k] = $v;
}
$host = $env['DB_HOST'] ?? '127.0.0.1';
$port = $env['DB_PORT'] ?? '3306';
$user = $env['DB_USERNAME'] ?? 'root';
$pass = $env['DB_PASSWORD'] ?? '';
$db = $env['DB_DATABASE'] ?? 'elearning';
try {
    $dsn = sprintf('mysql:host=%s;port=%s', $host, $port);
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo->exec(sprintf('CREATE DATABASE IF NOT EXISTS `%s` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci', $db));
    echo "DB_CREATED_OK\n";
} catch (PDOException $e) {
    fwrite(STDERR, "DB_CREATE_ERROR: " . $e->getMessage() . "\n");
    exit(1);
}

echo "Running migrations (this may ask for DB access)...\n";
$exit = null;
passthru('php artisan migrate --force', $exit);
echo "MIGRATE_EXIT_CODE: $exit\n";
exit($exit);
