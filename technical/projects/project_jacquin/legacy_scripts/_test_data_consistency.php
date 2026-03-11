<?php
/**
 * _test_data_consistency.php
 * Suite de pruebas de CONSISTENCIA CRUZADA de datos — project_jacquin
 *
 * Verifica que la información entre roles (Admin, Docente, Estudiante)
 * sea coherente y no haya conflictos de horario, asignaciones huérfanas
 * ni cruces de datos rotos.
 *
 * Bloques:
 *   C1 — Inscripciones Activas con horario asignado
 *   C2 — Horarios activos con docente asignado
 *   C3 — Sin conflictos de horario por estudiante
 *   C4 — Sin conflictos de horario por docente
 *   C5 — Vista cruzada Admin (APIs retornan datos completos)
 *
 * Uso: php jacquin_api/_test_data_consistency.php
 */

define('BASE_URL', 'http://127.0.0.1:8080/jacquin_api/');
require_once __DIR__ . '/config/connection.php';

// ══════════════════════════════════════════════════════════════════════════════
// Framework mínimo
// ══════════════════════════════════════════════════════════════════════════════

$pass = 0;
$fail = 0;
$warnings = 0;
$currentBlock = '';

function block(string $name): void {
    global $currentBlock;
    $currentBlock = $name;
    echo "\n\033[34m━━━ $name ━━━\033[0m\n";
}

function ok(string $name, string $detail = ''): void {
    global $pass, $currentBlock;
    $pass++;
    echo "  \033[32m✔ PASS\033[0m  $name" . ($detail ? " \033[90m→ $detail\033[0m" : '') . "\n";
}

function fail(string $name, string $detail = ''): void {
    global $fail, $currentBlock;
    $fail++;
    echo "  \033[31m✘ FAIL\033[0m  $name" . ($detail ? " \033[31m→ $detail\033[0m" : '') . "\n";
}

function warn(string $name, string $detail = ''): void {
    global $warnings;
    $warnings++;
    echo "  \033[33m⚠ WARN\033[0m  $name" . ($detail ? " \033[33m→ $detail\033[0m" : '') . "\n";
}

// Helper HTTP para pruebas C5
function http_get(string $path): array {
    $ch = curl_init(BASE_URL . $path);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 10,
        CURLOPT_FOLLOWLOCATION => true,
    ]);
    $body   = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $clean = ltrim($body, "\xEF\xBB\xBF");
    return ['status' => $status, 'json' => @json_decode($clean, true)];
}

// ══════════════════════════════════════════════════════════════════════════════

echo "\033[1m
╔══════════════════════════════════════════════════════════════╗
║   SUITE DE CONSISTENCIA CRUZADA — project_jacquin            ║
╚══════════════════════════════════════════════════════════════╝\033[0m\n";
echo "Fecha: " . date('Y-m-d H:i:s') . "\n";

// ══════════════════════════════════════════════════════════════════════════════
// C1 — INSCRIPCIONES ACTIVAS TIENEN HORARIO
// ══════════════════════════════════════════════════════════════════════════════
block('C1 — Inscripciones Activas con horario asignado');

$stmt = $pdo->query("
    SELECT e.id_enrollment, u.full_name as student, c.course_name
    FROM enrollments e
    JOIN usuario u ON e.student_id = u.id_usuario
    JOIN courses c ON e.course_id = c.id_course
    WHERE e.status = 'Activo'
");
$activeEnrollments = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalActivo = count($activeEnrollments);
ok("Total inscripciones Activas encontradas: $totalActivo");

$sinHorario = [];
foreach ($activeEnrollments as $e) {
    $stmt2 = $pdo->prepare("SELECT COUNT(*) FROM enrollment_schedules WHERE enrollment_id = ?");
    $stmt2->execute([$e['id_enrollment']]);
    $count = (int) $stmt2->fetchColumn();
    if ($count === 0) {
        $sinHorario[] = "#{$e['id_enrollment']} {$e['student']} → {$e['course_name']}";
    }
}

if (count($sinHorario) === 0) {
    ok("Todas las inscripciones Activas tienen al menos 1 horario asignado");
} else {
    $total = count($sinHorario);
    fail("$total inscripción(es) Activa(s) SIN horario asignado");
    foreach ($sinHorario as $item) {
        echo "        \033[31m→ $item\033[0m\n";
    }
}

// Verificar si hay enrollments_schedules huérfanos (apuntan a enrollment inexistente)
$stmt = $pdo->query("
    SELECT COUNT(*) FROM enrollment_schedules es
    LEFT JOIN enrollments e ON es.enrollment_id = e.id_enrollment
    WHERE e.id_enrollment IS NULL
");
$orphanES = (int) $stmt->fetchColumn();
if ($orphanES === 0) {
    ok("Sin enrollment_schedules huérfanos");
} else {
    warn("$orphanES enrollment_schedules apuntan a inscripciones inexistentes");
}

// ══════════════════════════════════════════════════════════════════════════════
// C2 — HORARIOS CON INSCRITOS TIENEN DOCENTE ASIGNADO
// ══════════════════════════════════════════════════════════════════════════════
block('C2 — Horarios activos tienen docente asignado');

$stmt = $pdo->query("
    SELECT s.id_schedule, s.day, s.time_start, s.time_end,
           c.course_name,
           s.teacher_id as legacy_teacher_id,
           (SELECT COUNT(*) FROM schedule_teachers st WHERE st.id_schedule = s.id_schedule) as teachers_count,
           (SELECT COUNT(*) FROM enrollment_schedules es
            JOIN enrollments e ON es.enrollment_id = e.id_enrollment
            WHERE es.schedule_id = s.id_schedule AND e.status = 'Activo') as active_students
    FROM schedules s
    JOIN courses c ON s.id_course = c.id_course
    HAVING active_students > 0
");
$schedulesWithStudents = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalSchedules = count($schedulesWithStudents);
ok("Horarios con estudiantes activos: $totalSchedules");

$sinDocente = [];
$conDocente = 0;
foreach ($schedulesWithStudents as $s) {
    $hasTeacher = ($s['teachers_count'] > 0) || ($s['legacy_teacher_id'] > 0);
    if (!$hasTeacher) {
        $sinDocente[] = "#{$s['id_schedule']} {$s['course_name']} {$s['day']} {$s['time_start']} ({$s['active_students']} estudiantes)";
    } else {
        $conDocente++;
    }
}

if (count($sinDocente) === 0) {
    ok("Todos los horarios con inscritos tienen docente asignado ($conDocente/$totalSchedules)");
} else {
    $total = count($sinDocente);
    fail("$total horario(s) con estudiantes activos SIN docente asignado");
    foreach ($sinDocente as $item) {
        echo "        \033[31m→ $item\033[0m\n";
    }
}

// Verificar schedule_teachers huérfanos
$stmt = $pdo->query("
    SELECT COUNT(*) FROM schedule_teachers st
    LEFT JOIN schedules s ON st.id_schedule = s.id_schedule
    WHERE s.id_schedule IS NULL
");
$orphanST = (int) $stmt->fetchColumn();
if ($orphanST === 0) {
    ok("Sin schedule_teachers huérfanos");
} else {
    warn("$orphanST schedule_teachers apuntan a horarios inexistentes");
}

// ══════════════════════════════════════════════════════════════════════════════
// C3 — SIN CONFLICTOS DE HORARIO POR ESTUDIANTE
// ══════════════════════════════════════════════════════════════════════════════
block('C3 — Sin conflictos de horario por estudiante');

// Obtener estudiantes con 2+ horarios activos
$stmt = $pdo->query("
    SELECT e.student_id, u.full_name
    FROM enrollments e
    JOIN usuario u ON e.student_id = u.id_usuario
    JOIN enrollment_schedules es ON e.id_enrollment = es.enrollment_id
    WHERE e.status = 'Activo'
    GROUP BY e.student_id
    HAVING COUNT(es.schedule_id) >= 2
");
$studentsMultiple = $stmt->fetchAll(PDO::FETCH_ASSOC);

ok("Estudiantes con 2+ horarios activos: " . count($studentsMultiple));

$conflictosEstudiante = [];
foreach ($studentsMultiple as $student) {
    // Obtener todos los horarios de este estudiante
    $stmt2 = $pdo->prepare("
        SELECT s.id_schedule, s.day, s.time_start, s.time_end, c.course_name
        FROM enrollment_schedules es
        JOIN enrollments e ON es.enrollment_id = e.id_enrollment
        JOIN schedules s ON es.schedule_id = s.id_schedule
        JOIN courses c ON s.id_course = c.id_course
        WHERE e.student_id = ? AND e.status = 'Activo'
        ORDER BY s.day, s.time_start
    ");
    $stmt2->execute([$student['student_id']]);
    $schedules = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    // Verificar cruces (mismo día, horarios solapados)
    for ($i = 0; $i < count($schedules); $i++) {
        for ($j = $i + 1; $j < count($schedules); $j++) {
            $a = $schedules[$i];
            $b = $schedules[$j];
            if ($a['day'] === $b['day']) {
                // Solapamiento: A inicia antes de que B termine Y A termina después de que B inicia
                if ($a['time_start'] < $b['time_end'] && $a['time_end'] > $b['time_start']) {
                    $conflictosEstudiante[] = "{$student['full_name']}: {$a['course_name']} {$a['day']} {$a['time_start']}-{$a['time_end']} ↔ {$b['course_name']} {$b['day']} {$b['time_start']}-{$b['time_end']}";
                }
            }
        }
    }
}

if (count($conflictosEstudiante) === 0) {
    ok("Sin conflictos de horario entre estudiantes (" . count($studentsMultiple) . " verificados)");
} else {
    fail(count($conflictosEstudiante) . " conflicto(s) de horario detectados en estudiantes");
    foreach ($conflictosEstudiante as $c) {
        echo "        \033[31m→ $c\033[0m\n";
    }
}

// ══════════════════════════════════════════════════════════════════════════════
// C4 — SIN CONFLICTOS DE HORARIO POR DOCENTE
// ══════════════════════════════════════════════════════════════════════════════
block('C4 — Sin conflictos de horario por docente');

// Obtener docentes con 2+ horarios asignados
$stmt = $pdo->query("
    SELECT st.id_teacher, u.full_name
    FROM schedule_teachers st
    JOIN usuario u ON st.id_teacher = u.id_usuario
    GROUP BY st.id_teacher
    HAVING COUNT(st.id_schedule) >= 2
");
$teachersMultiple = $stmt->fetchAll(PDO::FETCH_ASSOC);

// También verificar vía schedules.teacher_id legacy
$stmtLegacy = $pdo->query("
    SELECT s.teacher_id as id_teacher, u.full_name
    FROM schedules s
    JOIN usuario u ON s.teacher_id = u.id_usuario
    WHERE s.teacher_id IS NOT NULL
    GROUP BY s.teacher_id
    HAVING COUNT(s.id_schedule) >= 2
");
$teachersLegacy = $stmtLegacy->fetchAll(PDO::FETCH_ASSOC);

// Combinar sin duplicados
$allTeacherIds = array_unique(array_merge(
    array_column($teachersMultiple, 'id_teacher'),
    array_column($teachersLegacy, 'id_teacher')
));

ok("Docentes con 2+ horarios asignados: " . count($allTeacherIds));

$conflictosDocente = [];
foreach ($allTeacherIds as $teacherId) {
    $stmt2 = $pdo->prepare("
        SELECT DISTINCT s.id_schedule, s.day, s.time_start, s.time_end, c.course_name
        FROM schedules s
        JOIN courses c ON s.id_course = c.id_course
        WHERE s.id_schedule IN (
            SELECT id_schedule FROM schedule_teachers WHERE id_teacher = ?
            UNION
            SELECT id_schedule FROM schedules WHERE teacher_id = ?
        )
        ORDER BY s.day, s.time_start
    ");
    $stmt2->execute([$teacherId, $teacherId]);
    $schedules = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    // Obtener nombre del docente
    $stmtName = $pdo->prepare("SELECT full_name FROM usuario WHERE id_usuario = ?");
    $stmtName->execute([$teacherId]);
    $teacherName = $stmtName->fetchColumn() ?: "ID#$teacherId";

    // Verificar cruces
    for ($i = 0; $i < count($schedules); $i++) {
        for ($j = $i + 1; $j < count($schedules); $j++) {
            $a = $schedules[$i];
            $b = $schedules[$j];
            if ($a['day'] === $b['day']) {
                if ($a['time_start'] < $b['time_end'] && $a['time_end'] > $b['time_start']) {
                    $conflictosDocente[] = "$teacherName: {$a['course_name']} {$a['day']} {$a['time_start']}-{$a['time_end']} ↔ {$b['course_name']} {$b['day']} {$b['time_start']}-{$b['time_end']}";
                }
            }
        }
    }
}

if (count($conflictosDocente) === 0) {
    ok("Sin conflictos de horario entre docentes (" . count($allTeacherIds) . " verificados)");
} else {
    fail(count($conflictosDocente) . " conflicto(s) de horario detectados en docentes");
    foreach ($conflictosDocente as $c) {
        echo "        \033[31m→ $c\033[0m\n";
    }
}

// ══════════════════════════════════════════════════════════════════════════════
// C5 — VISTA CRUZADA ADMIN (APIs retornan datos completos)
// ══════════════════════════════════════════════════════════════════════════════
block('C5 — Vista cruzada Admin (APIs con datos relacionales)');

// C5.1: get_user_details retorna schedules[] para un estudiante Activo
$stmt = $pdo->query("
    SELECT DISTINCT e.student_id
    FROM enrollments e
    JOIN enrollment_schedules es ON e.id_enrollment = es.enrollment_id
    WHERE e.status = 'Activo'
    LIMIT 1
");
$studentWithSchedule = $stmt->fetchColumn();

if ($studentWithSchedule) {
    $r = http_get("get_user_details.php?id=$studentWithSchedule");
    if ($r['status'] === 200 && $r['json']['success']) {
        $enrolled = $r['json']['data']['enrolled'] ?? [];
        $hasSchedules = false;
        foreach ($enrolled as $e) {
            if (!empty($e['schedules'])) { $hasSchedules = true; break; }
        }
        if ($hasSchedules) {
            ok("get_user_details.php retorna schedules[] para estudiante Activo (ID:$studentWithSchedule)");
        } else {
            fail("get_user_details.php: enrolled[] existe pero schedules[] está vacío para ID:$studentWithSchedule");
        }
        // Verificar que teacher_name no sea nulo
        $withTeacher = array_filter($enrolled, fn($e) => !empty($e['teacher_name']) && $e['teacher_name'] !== 'Por asignar');
        ok("Inscripciones con teacher_name definido: " . count($withTeacher) . "/" . count($enrolled));
    } else {
        fail("get_user_details.php falló para ID:$studentWithSchedule — HTTP {$r['status']}");
    }
} else {
    warn("No hay estudiantes con inscripción Activa + horario para verificar");
}

// C5.2: admin_get_course_full_details retorna students + schedules + teachers
$stmt = $pdo->query("
    SELECT e.course_id FROM enrollments e
    JOIN enrollment_schedules es ON e.id_enrollment = es.enrollment_id
    WHERE e.status = 'Activo'
    LIMIT 1
");
$courseWithStudents = $stmt->fetchColumn();

if ($courseWithStudents) {
    $r = http_get("admin_get_course_full_details.php?course_id=$courseWithStudents");
    if ($r['status'] === 200 && ($r['json']['success'] ?? false)) {
        $data = $r['json']['data'] ?? [];
        $studentsCount = count($data['students'] ?? []);
        $schedulesCount = count($data['schedules'] ?? []);

        if ($studentsCount > 0) {
            ok("admin_get_course_full_details retorna $studentsCount estudiante(s) para curso ID:$courseWithStudents");
        } else {
            fail("admin_get_course_full_details: students[] vacío para curso ID:$courseWithStudents");
        }

        if ($schedulesCount > 0) {
            ok("admin_get_course_full_details retorna $schedulesCount horario(s)");
            // Verificar que algún horario tenga teacher
            $schedules = $data['schedules'];
            $withTeacher = array_filter($schedules, fn($s) => !empty($s['teacher_name']) || !empty($s['teachers']));
            if (count($withTeacher) > 0) {
                ok("Al menos " . count($withTeacher) . " horario(s) con docente asignado");
            } else {
                warn("Ningún horario tiene docente asignado en este curso");
            }
            // Verificar enrolled_count en horarios
            $withCount = array_filter($schedules, fn($s) => isset($s['enrolled_count']));
            ok("Horarios con enrolled_count: " . count($withCount) . "/$schedulesCount");
        } else {
            warn("admin_get_course_full_details: schedules[] vacío para curso ID:$courseWithStudents");
        }

        // Verificar que students tienen schedules_assigned
        $students = $data['students'] ?? [];
        if (!empty($students)) {
            $withSched = array_filter($students, fn($s) => !empty($s['schedules_assigned']));
            ok("Estudiantes con schedules_assigned: " . count($withSched) . "/" . count($students));
        }

    } elseif ($r['status'] === 403) {
        warn("admin_get_course_full_details requiere sesión de Admin — no se puede probar sin cookie (HTTP 403)");
    } else {
        fail("admin_get_course_full_details falló para curso ID:$courseWithStudents — HTTP {$r['status']} | " . json_encode($r['json']));
    }
} else {
    warn("No hay cursos con inscripciones activas para verificar");
}

// C5.3: get_schedules retorna enrolled_count y teacher_name
$stmt = $pdo->query("SELECT id_course FROM schedules LIMIT 1");
$sampleCourse = $stmt->fetchColumn();
if ($sampleCourse) {
    $r = http_get("get_schedules.php?course_id=$sampleCourse");
    if ($r['status'] === 200 && ($r['json']['success'] ?? false)) {
        $scheds = $r['json']['data'] ?? [];
        if (!empty($scheds)) {
            $first = $scheds[0];
            ok("get_schedules.php retorna " . count($scheds) . " horario(s) para curso ID:$sampleCourse");
            isset($first['teacher_name']) ? ok("Campo teacher_name presente en horarios") : fail("Campo teacher_name AUSENTE en horarios");
            isset($first['enrolled_count']) ? ok("Campo enrolled_count presente en horarios") : fail("Campo enrolled_count AUSENTE en horarios");
            isset($first['quota']) ? ok("Campo quota presente en horarios") : fail("Campo quota AUSENTE en horarios");
        } else {
            warn("get_schedules.php: curso ID:$sampleCourse no tiene horarios");
        }
    } else {
        fail("get_schedules.php falló — HTTP {$r['status']}");
    }
}

// ══════════════════════════════════════════════════════════════════════════════
// ESTADÍSTICAS GENERALES DE LA BD
// ══════════════════════════════════════════════════════════════════════════════
echo "\n\033[34m━━━ Estadísticas de la Base de Datos ━━━\033[0m\n";

$stats = [
    'Usuarios totales'               => "SELECT COUNT(*) FROM usuario",
    'Admins (rol 1)'                 => "SELECT COUNT(*) FROM usuario WHERE id_rol = 1",
    'Docentes (rol 2)'               => "SELECT COUNT(*) FROM usuario WHERE id_rol = 2",
    'Estudiantes (rol 3)'            => "SELECT COUNT(*) FROM usuario WHERE id_rol = 3",
    'Cursos'                         => "SELECT COUNT(*) FROM courses",
    'Horarios'                       => "SELECT COUNT(*) FROM schedules",
    'Inscripciones Activas'          => "SELECT COUNT(*) FROM enrollments WHERE status = 'Activo'",
    'Inscripciones Pendientes'       => "SELECT COUNT(*) FROM enrollments WHERE status = 'Pendiente'",
    'enrollment_schedules registros' => "SELECT COUNT(*) FROM enrollment_schedules",
    'schedule_teachers asignaciones' => "SELECT COUNT(*) FROM schedule_teachers",
];

foreach ($stats as $label => $query) {
    $val = $pdo->query($query)->fetchColumn();
    echo "  \033[90m$label:\033[0m \033[37m$val\033[0m\n";
}

// ══════════════════════════════════════════════════════════════════════════════
// RESUMEN FINAL
// ══════════════════════════════════════════════════════════════════════════════

$total = $pass + $fail;
echo "\n\033[1m╔══════════════════════════════════════════════════════════════╗\033[0m\n";
echo "\033[1m║                      RESUMEN FINAL                          ║\033[0m\n";
echo "\033[1m╠══════════════════════════════════════════════════════════════╣\033[0m\n";
printf("║  Total: %-3d  |  \033[32m✔ PASS: %-3d\033[0m  |  \033[31m✘ FAIL: %-3d\033[0m  |  \033[33m⚠ WARN: %-3d\033[0m  ║\n", $total, $pass, $fail, $warnings);
echo "\033[1m╚══════════════════════════════════════════════════════════════╝\033[0m\n";

if ($fail > 0) {
    echo "\n\033[31mACCIÓN REQUERIDA: Hay inconsistencias en los datos. Revisa los FAIL arriba.\033[0m\n";
} elseif ($warnings > 0) {
    echo "\n\033[33mSistema consistente con advertencias menores. Revisa los WARN arriba.\033[0m\n";
} else {
    echo "\n\033[32m✔ Sistema completamente consistente. Todos los cruces de datos son correctos.\033[0m\n";
}
