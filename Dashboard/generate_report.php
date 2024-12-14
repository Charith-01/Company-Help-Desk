<?php
require('libs/fpdf.php');
include('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reportType = $_POST['report_type'];

    // Create a new PDF document
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Report Type Logic
    if ($reportType === 'tickets') {
        // Title
        $pdf->Cell(190, 10, 'Tickets Report', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Ln(10);

        // Table Headers
        $headers = ['Ticket ID', 'User ID', 'Ticket Title', 'Ticket Description', 'Issue Type', 'Status'];
        $widths = [20, 20, 30, 50, 40, 30];

    } elseif ($reportType === 'users') {
        // Title
        $pdf->Cell(190, 10, 'Users Report', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Ln(10);

        // Table Headers
        $headers = ['User ID', 'User Name', 'Email', 'Role', 'Company ID'];
        $widths = [20, 50, 60, 30, 30];

    } elseif ($reportType === 'companies') {
        // Title
        $pdf->Cell(190, 10, 'Companies Report', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Ln(10);

        // Table Headers
        $headers = ['Company ID', 'Name', 'Email', 'Type'];
        $widths = [40, 50, 50, 50];

    } else {
        die("Invalid Report Type.");
    }

    // Render Table Headers
    $pdf->SetFillColor(200, 220, 255); // Light blue background
    foreach ($headers as $index => $header) {
        $pdf->Cell($widths[$index], 10, $header, 1, 0, 'C', true);
    }
    $pdf->Ln();

    // Fetch Data
    if ($reportType === 'tickets') {
        $query = "SELECT ticket_id, user_id, ticket_title, ticket_description, issue_type, ticket_status FROM tickets";
    } elseif ($reportType === 'users') {
        $query = "SELECT id, user_name, email, role, company_id FROM users";
    } elseif ($reportType === 'companies') {
        $query = "SELECT company_id, company_name, company_email, company_type FROM companies";
    }

    $result = $conn->query($query);
    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    // Render Table Content
    $pdf->SetFont('Arial', '', 10);
    while ($row = $result->fetch_assoc()) {
        $i = 0; // Counter to access column widths
        foreach ($row as $column) {
            $pdf->Cell($widths[$i], 10, $column, 1, 0, 'C');
            $i++;
        }
        $pdf->Ln();
    }

    // Output the PDF
    $pdf->Output('D', $reportType . '_report.pdf');
    exit;
}
?>
