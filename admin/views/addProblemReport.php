<?php
session_start();
if ($_SESSION['user'] == "") {
    header("Location: ../../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Reporte de Problema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<?php
include '../conf/conf.php';

// Consultar estudiantes y profesores para los select
$queryStudents = "SELECT id_students, first_name_students FROM students";
$stmtStudents = $connection->prepare($queryStudents);
$stmtStudents->execute();
$students = $stmtStudents->fetchAll(PDO::FETCH_ASSOC);

$queryTeachers = "SELECT id_user, first_name_user FROM users WHERE user_type_id = (SELECT id_user_type FROM user_types WHERE user_type = 'teacher')";
$stmtTeachers = $connection->prepare($queryTeachers);
$stmtTeachers->execute();
$teachers = $stmtTeachers->fetchAll(PDO::FETCH_ASSOC);

$queryCareers = "SELECT id_career_course, name_career_course FROM careers_courses";
$stmtCareers = $connection->prepare($queryCareers);
$stmtCareers->execute();
$careers = $stmtCareers->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h1 class="mb-4">Crear Nuevo Reporte de Problema</h1>
    <form action="../controllers/addProblemReportController.php" method="POST">
        <div class="form-group">
            <label for="student">Estudiante:</label>
            <select class="form-control" id="student" name="student_id" required>
                <option value="">Selecciona un estudiante</option>
                <?php foreach ($students as $student): ?>
                    <option value="<?php echo $student['id_students']; ?>"><?php echo $student['first_name_students']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="teacher">Profesor:</label>
            <select class="form-control" id="teacher" name="teacher_id" required>
                <option value="">Selecciona un profesor</option>
                <?php foreach ($teachers as $teacher): ?>
                    <option value="<?php echo $teacher['id_user']; ?>"><?php echo $teacher['first_name_user']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="career">Carrera:</label>
            <select class="form-control" id="career" name="career_course_id" required>
                <option value="">Selecciona una carrera</option>
                <?php foreach ($careers as $career): ?>
                    <option value="<?php echo $career['id_career_course']; ?>"><?php echo $career['name_career_course']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="report_date">Fecha de Reporte:</label>
            <input type="date" class="form-control" id="report_date" name="report_date" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Guardar Nuevo Reporte</button>
        <a href="../views/problemsReports.php" class="btn btn-danger mt-4">Regresar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
