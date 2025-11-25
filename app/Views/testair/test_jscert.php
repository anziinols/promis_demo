<?= $this->extend('templates/adminlte/admindash') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Completion Certificate</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
        }
        canvas {
            border: 1px solid #ccc;
            margin: 20px auto;
        }
        .logo {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<h1>Project Completion Certificate</h1>

<canvas id="certificateCanvas" width="800" height="500"></canvas>

<script>
    // Get the canvas element and its context
    const canvas = document.getElementById('certificateCanvas');
    const ctx = canvas.getContext('2d');

    // Function to draw the certificate layout and text
    function drawCertificate() {
        // Draw the certificate border
        ctx.fillStyle = '#f9f9f9';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        // Draw the logo
        const logoImg = new Image();
        logoImg.src = '<?= imgcheck(session('orglogo')) ?>'; // Replace with the URL of your logo
        logoImg.onload = function() {
            ctx.drawImage(logoImg, canvas.width - 100, 20, 80, 80);
        };

        // Draw the certificate title
        ctx.fillStyle = '#333';
        ctx.font = 'bold 24px Arial';
        ctx.fillText('Project Completion Certificate', 50, 50);

        // Draw the certificate content
        ctx.fillStyle = '#555';
        ctx.font = '16px Arial';
        ctx.fillText('This is to certify that', 50, 150);
        ctx.fillText('John Doe', 50, 180);

        // Draw the completion message
        ctx.fillStyle = '#333';
        ctx.font = 'italic 18px Arial';
        ctx.fillText('has successfully completed the project', 50, 230);

        // Draw the project details
        ctx.fillStyle = '#555';
        ctx.font = '16px Arial';
        ctx.fillText('Project Name: Amazing Project', 50, 280);
        ctx.fillText('Completion Date: January 1, 2023', 50, 310);

        // Draw the signature line
        ctx.beginPath();
        ctx.moveTo(50, 400);
        ctx.lineTo(canvas.width - 50, 400);
        ctx.strokeStyle = '#333';
        ctx.lineWidth = 2;
        ctx.stroke();

        // Draw the signature text
        ctx.fillStyle = '#555';
        ctx.font = '16px Arial';
        ctx.fillText('Authorized Signature', 50, 430);
    }

    // Call the drawCertificate function
    drawCertificate();
</script>

</body>
</html>


<?= $this->endSection(); ?>