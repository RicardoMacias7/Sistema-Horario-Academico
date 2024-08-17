<?php
require('../fpdf/fpdf.php'); // Ajusta la ruta según tu estructura de archivos
include_once '../model/conexion.php'; // Asegúrate de incluir tu archivo de conexión

class PDF extends FPDF
{
    function Header()
    {
        // Encabezado del PDF (puedes personalizarlo según tus necesidades)
        $this->SetFont('Arial', 'B', 15);
        $this->Image('https://bytewebster.com/img/logo.png',35,8,15);
        $this->Cell(0, 10, 'Instituto Educativo RMTC - Horarios de Clase', 0, 1, 'C');
        $this->Ln(); // Salto de línea
        // Cabecera de la tabla
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(30, 10, utf8_decode('Días'), 1, 0, 'C');
        $this->Cell(30, 10, utf8_decode('Hora Inicio'), 1, 0, 'C');
        $this->Cell(30, 10, utf8_decode('Hora Fin'), 1, 0, 'C');
        $this->Cell(30, 10, utf8_decode('Docente'), 1, 0, 'C');
        $this->Cell(30, 10, utf8_decode('Asignatura'), 1, 0, 'C');
        $this->Cell(40, 10, utf8_decode('Curso'), 1, 0, 'C');
        $this->Ln(); // Salto de línea
    }

    function Footer()
    {
        // Pie de página del PDF
    }
}

// Crear instancia de la clase PDF
$pdf = new PDF();

// Agregar una página al PDF
$pdf->AddPage();

// Consulta a la base de datos
$sql = "SELECT horas_clases.id, horas_clases.dia_semana, horas_clases.hora_inicio, horas_clases.hora_fin, 
               docentes.nombre as nombre_docente, asignaturas.nombre as nombre_asignatura, cursos.nombre as nombre_curso
        FROM horas_clases
        LEFT JOIN docentes ON horas_clases.id_docente = docentes.id
        LEFT JOIN asignaturas ON horas_clases.id_asignatura = asignaturas.id
        LEFT JOIN cursos ON horas_clases.id_curso = cursos.id";
$result = mysqli_query($conex, $sql);

// Agregar datos al PDF
$pdf->SetFont('Arial', '', 8);
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(30, 10, utf8_decode($row['dia_semana']), 1,0,'C');
    $pdf->Cell(30, 10, utf8_decode($row['hora_inicio']), 1,0,'C');
    $pdf->Cell(30, 10, utf8_decode($row['hora_fin']),1,0,'C');
    $pdf->Cell(30, 10, utf8_decode($row['nombre_docente']),1,0,'C');
    $pdf->Cell(30, 10, utf8_decode($row['nombre_asignatura']),1,0,'C');
    $pdf->Cell(40, 10, utf8_decode($row['nombre_curso']), 1,0,'C');
    $pdf->Ln(); // Salto de línea
}

// Nombre del archivo PDF
$nombre_archivo = "horarios_clase.pdf";

// Enviar el PDF al navegador
$pdf->Output($nombre_archivo, 'D');

// Cerrar la conexión a la base de datos
mysqli_close($conex);
?>