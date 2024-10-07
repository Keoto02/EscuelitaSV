<?php
session_start();
if ($_SESSION['user'] == "") {
    header("Location: ../../index.php");
}

include '../conf/conf.php';

// Obtener el ID del reporte a editar
$problemReportId = $_GET['id'];

// Consultar el reporte actual
$queryReport = "SELECT * FROM problem_reports WHERE id = :id";
$stmtReport = $connection->prepare($queryReport);
$stmtReport->bindParam(':id', $problemReportId);
$stmtReport->execute();
$report = $stmtReport->fetch(PDO::FETCH_ASSOC);

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Reporte de Problema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Modificar Reporte de Problema</h1>
    <form action="../controllers/editProblemReportController.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $problemReportId; ?>">

        <div class="form-group">
            <label for="student">Estudiante:</label>
            <select class="form-control" id="student" name="student_id" required>
                <option value="">Selecciona un estudiante</option>
                <?php foreach ($students as $student): ?>
                    <option value="<?php echo $student['id_students']; ?>" 
                        <?php echo ($student['id_students'] == $report['student_id']) ? 'selected' : ''; ?>>
                        <?php echo $student['first_name_students']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="teacher">Profesor:</label>
            <?php 
                if($_SESSION["username"] == "Admin"){
            ?>
            <select class="form-control" id="teacher" name="teacher_id" required>
                <option value="">Selecciona un profesor</option>
                <?php foreach ($teachers as $teacher): ?>
                    <option value="<?php echo $teacher['id_user']; ?>"
                        <?php echo ($teacher['id_user'] == $report['teacher_id']) ? 'selected' : ''; ?>>
                        <?php echo $teacher['first_name_user']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php 
                }else{
            ?>
            <input type="text" class="form-control" id="teacher" name="teacher_id" value="<?= $_SESSION["username"] ?>" required disabled>
            <?php 
                }
            ?>
        </div>

        <div class="form-group">
            <label for="career">Carrera:</label>
            <select class="form-control" id="career" name="career_course_id" required>
                <option value="">Selecciona una carrera</option>
                <?php foreach ($careers as $career): ?>
                    <option value="<?php echo $career['id_career_course']; ?>"
                        <?php echo ($career['id_career_course'] == $report['career_course_id']) ? 'selected' : ''; ?>>
                        <?php echo $career['name_career_course']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="report_date">Fecha de Reporte:</label>
            <input type="date" class="form-control" id="report_date" name="report_date" value="<?php echo $report['report_date']; ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $report['description']; ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Guardar Cambios</button>
        <a href="../views/problemsReports.php" class="btn btn-danger mt-4">Regresar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
