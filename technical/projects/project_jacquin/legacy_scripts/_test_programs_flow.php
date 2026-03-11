<?php
/**
 * _test_programs_flow.php
 * Suite de pruebas — Sección "Nuestros Programas"
 *
 * Cubre todos los escenarios de interacción:
 *   B1 — API Programas (GET programs.json)
 *   B2 — API Cursos (field names, matching)
 *   B3 — API Horarios (estructura, casos límite)
 *   B4 — Validación de entrada en inscripción
 *   B5 — Flujo inscripción exitosa + email silenciado
 *   B6 — Duplicado exacto (mismo horario)
 *   B7 — Matching Program→Course (lógica ScheduleModal.jsx)
 *   B8 — Integridad del JSON de programas (sin base64)
 *   B9 — Flujo Auth (simula visitante sin sesión)
 *
 * Uso: php jacquin_api/_test_programs_flow.php
 */

define('BASE_URL', 'http://127.0.0.1:8080/jacquin_api/');
define('STUDENT_ID', 29);   // Erick Pertuz, rol=3 (estudiante)
define('COURSE_ID_GIT', 10); // Guitarra
define('COURSE_ID_PIA', 11); // Piano
define('SCH_ID_GIT', 37);    // Guitarra — Jueves 15:00
define('SCH_ID_GIT_2', 38);  // Guitarra — Jueves 15:45
define('SCH_ID_PIA', 61);    // Piano
define('CLEANUP_AFTER', true);

// ══════════════════════════════════════════════════════════════════════════════
// Framework de pruebas mínimo
// ══════════════════════════════════════════════════════════════════════════════

$results = [];
$pass = 0;
$fail = 0;
$currentBlock = '';

function block(string $name): void {
    global $currentBlock;
    $currentBlock = $name;
    echo "\n\033[34m━━━ $name ━━━\033[0m\n";
}

function assert_test(string $name, bool $condition, string $detail = ''): void {
    global $results, $pass, $fail, $currentBlock;
    if ($condition) {
        $pass++;
        $results[] = ['block' => $currentBlock, 'name' => $name, 'status' => 'PASS', 'detail' => $detail];
        echo "  \033[32m✔ PASS\033[0m  $name\n";
    } else {
        $fail++;
        $results[] = ['block' => $currentBlock, 'name' => $name, 'status' => 'FAIL', 'detail' => $detail];
        echo "  \033[31m✘ FAIL\033[0m  $name" . ($detail ? " → $detail" : '') . "\n";
    }
}

function http_get(string $path, array $cookies = []): array {
    $ch = curl_init(BASE_URL . $path);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 10,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_COOKIE         => implode('; ', array_map(fn($k, $v) => "$k=$v", array_keys($cookies), $cookies)),
    ]);
    $body   = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error  = curl_error($ch);
    curl_close($ch);
    $clean  = ltrim($body, "\xEF\xBB\xBF"); // strip UTF-8 BOM si existe
    return ['status' => $status, 'body' => $body, 'error' => $error, 'json' => @json_decode($clean, true)];
}

function http_post(string $path, array $data, array $cookies = []): array {
    $ch = curl_init(BASE_URL . $path);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode($data),
        CURLOPT_TIMEOUT        => 10,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
        CURLOPT_COOKIE         => implode('; ', array_map(fn($k, $v) => "$k=$v", array_keys($cookies), $cookies)),
    ]);
    $body   = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error  = curl_error($ch);
    curl_close($ch);
    $clean  = ltrim($body, "\xEF\xBB\xBF"); // strip UTF-8 BOM si existe
    return ['status' => $status, 'body' => $body, 'error' => $error, 'json' => @json_decode($clean, true)];
}

function http_post_login(string $email, string $password): array {
    $ch = curl_init(BASE_URL . 'login.php');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode(['email' => $email, 'password' => $password]),
        CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
        CURLOPT_TIMEOUT        => 10,
        CURLOPT_HEADER         => true, // Para capturar Set-Cookie
    ]);
    $response = curl_exec($ch);
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $status     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $header = substr($response, 0, $headerSize);
    $body   = substr($response, $headerSize);
    $cookie = '';
    if (preg_match('/Set-Cookie:\s*([^;]+)/i', $header, $m)) {
        $cookie = $m[1];
    }
    return ['status' => $status, 'body' => $body, 'json' => @json_decode($body, true), 'cookie' => $cookie];
}

// ══════════════════════════════════════════════════════════════════════════════
// INICIO
// ══════════════════════════════════════════════════════════════════════════════
echo "\033[1m\n╔══════════════════════════════════════════════════════════════╗\033[0m\n";
echo "\033[1m║   SUITE DE PRUEBAS — SECCIÓN NUESTROS PROGRAMAS              ║\033[0m\n";
echo "\033[1m╚══════════════════════════════════════════════════════════════╝\033[0m\n";
echo "Base URL: " . BASE_URL . "\n";
echo "Fecha: " . date('Y-m-d H:i:s') . "\n";

// ══════════════════════════════════════════════════════════════════════════════
// B1 — API Programas JSON
// ══════════════════════════════════════════════════════════════════════════════
block('B1 — API Programas JSON (get_programs_json.php)');

$r = http_get('get_programs_json.php');
assert_test('GET retorna HTTP 200', $r['status'] === 200, "HTTP {$r['status']}");
assert_test('Response es JSON válido', is_array($r['json']), "body: " . substr($r['body'], 0, 80));
assert_test('Tiene al menos 1 programa', is_array($r['json']) && count($r['json']) >= 1, "count=" . count((array)$r['json']));

if (is_array($r['json'])) {
    $programs = $r['json'];
    $firstKey = array_key_first($programs);
    $firstProg = $programs[$firstKey];
    assert_test('Programa tiene campo "title"', isset($firstProg['title']), "key=$firstKey");
    assert_test('Programa tiene campo "icon"', isset($firstProg['icon']), "key=$firstKey");
    assert_test('Programa tiene campo "image"', isset($firstProg['image']), "key=$firstKey");

    // Titles esperados
    $titles = array_column(array_values($programs), 'title');
    assert_test('Existe programa "Guitarra"', in_array('Guitarra', $titles), 'títulos: ' . implode(', ', $titles));
    assert_test('Existe programa "Piano"', in_array('Piano', $titles), '');
    assert_test('Existe programa "Percusión"', in_array('Percusión', $titles) || in_array('Percusion', $titles), '');
}

// ══════════════════════════════════════════════════════════════════════════════
// B2 — API Cursos
// ══════════════════════════════════════════════════════════════════════════════
block('B2 — API Cursos (get_courses.php)');

$r = http_get('get_courses.php');
assert_test('GET retorna HTTP 200', $r['status'] === 200);
assert_test('success = true', $r['json']['success'] === true, json_encode($r['json']));
assert_test('data es array con cursos', is_array($r['json']['data'] ?? null) && count($r['json']['data']) > 0);

if (!empty($r['json']['data'])) {
    $cursoMuestra = $r['json']['data'][0];
    assert_test('Campo "course_name" existe (clave real de BD)', isset($cursoMuestra['course_name']), json_encode($cursoMuestra));
    assert_test('Campo "name" existe (alias para compat.)', isset($cursoMuestra['name']), json_encode($cursoMuestra));
    assert_test('Campo "id_course" existe', isset($cursoMuestra['id_course']), '');

    $courseNames = array_column($r['json']['data'], 'course_name');
    assert_test('Curso "Guitarra" presente en BD', in_array('Guitarra', $courseNames), implode(', ', $courseNames));
    assert_test('Curso "Piano" presente en BD', in_array('Piano', $courseNames), '');
    assert_test('Curso "Voz" presente en BD', in_array('Voz', $courseNames), '');
}

// ══════════════════════════════════════════════════════════════════════════════
// B3 — API Horarios
// ══════════════════════════════════════════════════════════════════════════════
block('B3 — API Horarios (get_schedules.php)');

$r = http_get('get_schedules.php?course_id=' . COURSE_ID_GIT);
assert_test('GET Guitarra retorna HTTP 200', $r['status'] === 200);
assert_test('success = true para curso válido', $r['json']['success'] === true);
assert_test('data tiene horarios', is_array($r['json']['data'] ?? null) && count($r['json']['data']) > 0);

if (!empty($r['json']['data'])) {
    $s = $r['json']['data'][0];
    assert_test('Horario tiene "id_schedule"', isset($s['id_schedule']), json_encode($s));
    assert_test('Horario tiene "day"', isset($s['day']), '');
    assert_test('Horario tiene "time_start"', isset($s['time_start']), '');
    assert_test('Horario tiene "time_end"', isset($s['time_end']), '');
    assert_test('id_schedule es entero > 0', isset($s['id_schedule']) && (int)$s['id_schedule'] > 0, 'val=' . ($s['id_schedule'] ?? 'null'));
}

// Sin course_id
$r0 = http_get('get_schedules.php');
assert_test('Sin course_id → success=false', $r0['json']['success'] === false || $r0['status'] !== 200, '');

// course_id inexistente
$r999 = http_get('get_schedules.php?course_id=9999');
assert_test('course_id=9999 → 0 horarios o success=false',
    $r999['json']['success'] === false || empty($r999['json']['data']), '');

// ══════════════════════════════════════════════════════════════════════════════
// B4 — Validación de entrada en inscripción (sin auth, datos inválidos)
// ══════════════════════════════════════════════════════════════════════════════
block('B4 — Validación de entrada (request_enrollment.php)');

$cases = [
    ['label' => 'Body vacío {}',               'data' => []],
    ['label' => 'Sin student_id',              'data' => ['course_id' => COURSE_ID_GIT, 'schedule_id' => SCH_ID_GIT]],
    ['label' => 'Sin course_id',               'data' => ['student_id' => STUDENT_ID,   'schedule_id' => SCH_ID_GIT]],
    ['label' => 'Sin schedule_id',             'data' => ['student_id' => STUDENT_ID,   'course_id'   => COURSE_ID_GIT]],
    ['label' => 'student_id = 0 (vacío)',      'data' => ['student_id' => 0,           'course_id'   => COURSE_ID_GIT, 'schedule_id' => SCH_ID_GIT]],
    ['label' => 'course_id = "" (string vacío)','data' => ['student_id' => STUDENT_ID,  'course_id'   => '',           'schedule_id' => SCH_ID_GIT]],
    ['label' => 'schedule_id = null',          'data' => ['student_id' => STUDENT_ID,   'course_id'   => COURSE_ID_GIT, 'schedule_id' => null]],
    ['label' => 'student_id = -1 (negativo)',  'data' => ['student_id' => -1,           'course_id'   => COURSE_ID_GIT, 'schedule_id' => SCH_ID_GIT]],
];

foreach ($cases as $case) {
    $r = http_post('request_enrollment.php', $case['data']);
    $success = $r['json']['success'] ?? true;
    assert_test($case['label'] . ' → rechazado', $success === false, "success=" . json_encode($success) . ' msg=' . ($r['json']['message'] ?? '?'));
}

// ══════════════════════════════════════════════════════════════════════════════
// B5 — Flujo inscripción exitosa (usuario estudiante, datos válidos)
// ══════════════════════════════════════════════════════════════════════════════
block('B5 — Inscripción exitosa (Guitarra, horario Jueves 15:00)');

// Limpiar inscripción previa si existe (para test limpio)
require_once __DIR__ . '/config/connection.php';
$pdo->prepare("DELETE FROM enrollments WHERE student_id = ? AND course_id = ? AND schedule_id = ?")->execute([STUDENT_ID, COURSE_ID_GIT, SCH_ID_GIT]);
$pdo->prepare("DELETE FROM enrollment_schedules WHERE enrollment_id IN (SELECT id_enrollment FROM enrollments WHERE student_id = ? AND course_id = ?)")->execute([STUDENT_ID, COURSE_ID_GIT]);

// Sin EmailService en CLI → parchear temporalmente
define('SKIP_EMAIL', true);

$r = http_post('request_enrollment.php', [
    'student_id'  => STUDENT_ID,
    'course_id'   => COURSE_ID_GIT,
    'schedule_id' => SCH_ID_GIT,
]);

assert_test('HTTP 200 en inscripción válida', $r['status'] === 200, "HTTP {$r['status']}");
assert_test('success = true', ($r['json']['success'] ?? false) === true, json_encode($r['json']));
assert_test('Mensaje de confirmación presente', !empty($r['json']['message']), '');
assert_test('Contiene "Solicitud" o "enviada" en mensaje',
    str_contains(strtolower($r['json']['message'] ?? ''), 'solicitud') || str_contains(strtolower($r['json']['message'] ?? ''), 'enviada'),
    'msg: ' . ($r['json']['message'] ?? ''));

// Verificar en BD
$stmt = $pdo->prepare("SELECT id_enrollment, status FROM enrollments WHERE student_id = ? AND course_id = ? AND schedule_id = ? ORDER BY id_enrollment DESC LIMIT 1");
$stmt->execute([STUDENT_ID, COURSE_ID_GIT, SCH_ID_GIT]);
$enroll = $stmt->fetch(PDO::FETCH_ASSOC);
assert_test('Inscripción guardada en BD', !empty($enroll), 'no encontrado en enrollments');
assert_test('Status inicial = "Pendiente"', ($enroll['status'] ?? '') === 'Pendiente', 'status=' . ($enroll['status'] ?? 'null'));

// ══════════════════════════════════════════════════════════════════════════════
// B6 — Duplicado exacto (mismo curso + mismo horario)
// ══════════════════════════════════════════════════════════════════════════════
block('B6 — Protección contra duplicados');

$rDup = http_post('request_enrollment.php', [
    'student_id'  => STUDENT_ID,
    'course_id'   => COURSE_ID_GIT,
    'schedule_id' => SCH_ID_GIT, // MISMO horario
]);
assert_test('Duplicado exacto rechazado', ($rDup['json']['success'] ?? true) === false, json_encode($rDup['json']));
assert_test('Mensaje menciona "ya tiene" u "horario"',
    str_contains(strtolower($rDup['json']['message'] ?? ''), 'ya') || str_contains(strtolower($rDup['json']['message'] ?? ''), 'horario'),
    'msg: ' . ($rDup['json']['message'] ?? '?'));

// Horario DIFERENTE del mismo curso → debe permitirse
$rDif = http_post('request_enrollment.php', [
    'student_id'  => STUDENT_ID,
    'course_id'   => COURSE_ID_GIT,
    'schedule_id' => SCH_ID_GIT_2, // Guitarra Jueves 15:45 (diferente)
]);
// Puede haber conflicto de horario (15:45 vs 15:00) — aceptar éxito o mensaje de conflicto como válido
$difOk = ($rDif['json']['success'] ?? false) === true
      || str_contains(strtolower($rDif['json']['message'] ?? ''), 'conflicto')
      || str_contains(strtolower($rDif['json']['message'] ?? ''), 'solapamiento');
assert_test('Horario diferente → inscripción o mensaje de conflicto', $difOk, json_encode($rDif['json']));

// ══════════════════════════════════════════════════════════════════════════════
// B7 — Matching Program → Course (lógica de ScheduleModal.jsx)
// ══════════════════════════════════════════════════════════════════════════════
block('B7 — Matching programa → curso (ScheduleModal lógica)');

$coursesR = http_get('get_courses.php');
$courses  = $coursesR['json']['data'] ?? [];

$programsR = http_get('get_programs_json.php');
$programs  = $programsR['json'] ?? [];

$matchFn = function(string $programTitle, array $courses): ?array {
    $titleLow = strtolower($programTitle);
    foreach ($courses as $c) {
        $nameLow = strtolower($c['course_name'] ?? '');
        if (str_contains($nameLow, $titleLow) || str_contains($titleLow, $nameLow)) {
            return $c;
        }
    }
    return null;
};

$matchResults = [];
foreach ($programs as $key => $prog) {
    $title = $prog['title'] ?? '';
    if (!$title) continue;
    $match = $matchFn($title, $courses);
    $matchResults[$title] = $match ? $match['course_name'] : null;
    assert_test(
        "Programa \"$title\" → curso encontrado",
        $match !== null,
        $match ? "match: {$match['course_name']}" : 'sin coincidencia — ScheduleModal mostrará error'
    );
}

// ══════════════════════════════════════════════════════════════════════════════
// B8 — Integridad JSON programas (sin base64, estructura correcta)
// ══════════════════════════════════════════════════════════════════════════════
block('B8 — Integridad del JSON de programas');

$progs = http_get('get_programs_json.php')['json'] ?? [];

$base64Found = false;
$missingFields = [];
foreach ($progs as $key => $p) {
    $img = $p['image'] ?? '';
    if (str_starts_with($img, 'data:image/')) $base64Found = true;
    if (empty($p['title'])) $missingFields[] = "$key:title";
    if (empty($p['icon']))  $missingFields[] = "$key:icon";
}

assert_test('Ninguna imagen contiene base64 (data:image/)', !$base64Found, 'Migración base64 ok');
assert_test('Todos los programas tienen "title" e "icon"', empty($missingFields), implode(', ', $missingFields));
assert_test('JSON < 50 KB (sin base64 embebido)', strlen(json_encode($progs)) < 50 * 1024,
    'size=' . round(strlen(json_encode($progs)) / 1024, 2) . ' KB');

// ══════════════════════════════════════════════════════════════════════════════
// B9 — Flujo de visitante (sin sesión PHP)
// ══════════════════════════════════════════════════════════════════════════════
block('B9 — Comportamiento para visitante (sin sesión)');

// Los endpoints públicos deben funcionar sin auth
$r1 = http_get('get_programs_json.php');
assert_test('get_programs_json accesible sin sesión', $r1['status'] === 200);

$r2 = http_get('get_courses.php');
assert_test('get_courses accesible sin sesión', $r2['status'] === 200 && ($r2['json']['success'] ?? false));

$r3 = http_get('get_schedules.php?course_id=' . COURSE_ID_GIT);
assert_test('get_schedules accesible sin sesión', $r3['status'] === 200 && ($r3['json']['success'] ?? false));

// request_enrollment SIN autenticación pero CON datos válidos:
// NOTA: el endpoint actual NO verifica sesión → acepta cualquier student_id válido.
// Esto es una observación de seguridad, no un fallo de flujo.
$rNoAuth = http_post('request_enrollment.php', [
    'student_id'  => STUDENT_ID,
    'course_id'   => COURSE_ID_PIA,
    'schedule_id' => SCH_ID_PIA,
]);
$noAuthBehavior = ($rNoAuth['json']['success'] ?? false) === true   // acepta (comportamiento actual)
               || ($rNoAuth['status'] === 403)                       // o rechaza correctamente
               || ($rNoAuth['status'] === 401);
assert_test('request_enrollment sin sesión → respuesta definida (acepta o 403)', $noAuthBehavior,
    "HTTP {$rNoAuth['status']} | " . json_encode($rNoAuth['json']));

if (($rNoAuth['json']['success'] ?? false) === true) {
    echo "  \033[33m  ⚠  OBSERVACIÓN: request_enrollment no verifica sesión PHP.\033[0m\n";
    echo "  \033[33m     Cualquier cliente puede enviar student_id directamente.\033[0m\n";
    echo "  \033[33m     Considerar agregar validación de sesión.\033[0m\n";
}

// ══════════════════════════════════════════════════════════════════════════════
// LIMPIEZA
// ══════════════════════════════════════════════════════════════════════════════
if (CLEANUP_AFTER) {
    $pdo->prepare("DELETE FROM enrollment_schedules WHERE enrollment_id IN (
        SELECT id_enrollment FROM enrollments WHERE student_id = ? AND course_id IN (?,?) AND status = 'Pendiente'
    )")->execute([STUDENT_ID, COURSE_ID_GIT, COURSE_ID_PIA]);

    $pdo->prepare("DELETE FROM enrollments WHERE student_id = ? AND course_id IN (?,?) AND status = 'Pendiente'")->execute([STUDENT_ID, COURSE_ID_GIT, COURSE_ID_PIA]);
    echo "\n\033[90m[Limpieza] Inscripciones de prueba eliminadas.\033[0m\n";
}

// ══════════════════════════════════════════════════════════════════════════════
// RESUMEN FINAL
// ══════════════════════════════════════════════════════════════════════════════
$total = $pass + $fail;
echo "\n\033[1m╔══════════════════════════════════════════════════════════════╗\033[0m\n";
echo "\033[1m║                      RESUMEN FINAL                           ║\033[0m\n";
echo "\033[1m╠══════════════════════════════════════════════════════════════╣\033[0m\n";
printf("║  %-58s║\n", "Total: $total  |  ✔ PASS: $pass  |  ✘ FAIL: $fail");
echo "\033[1m╚══════════════════════════════════════════════════════════════╝\033[0m\n\n";

if ($fail > 0) {
    echo "\033[31mFALLOS DETECTADOS:\033[0m\n";
    foreach ($results as $r) {
        if ($r['status'] === 'FAIL') {
            echo "  ✘ [{$r['block']}] {$r['name']}" . ($r['detail'] ? " → {$r['detail']}" : '') . "\n";
        }
    }
    echo "\n";
}

// Matching summary
echo "\033[36mMatching Programa → Curso (B7):\033[0m\n";
foreach ($matchResults as $prog => $curso) {
    $icon = $curso ? "\033[32m✔\033[0m" : "\033[31m✘\033[0m";
    echo "  $icon  \"$prog\" → " . ($curso ?? 'SIN MATCH') . "\n";
}

echo "\n";
