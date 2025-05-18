
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Auto Claim Form</title>
    <style>
        input, button {
            margin: 8px;
            padding: 10px;
            width: 90%;
            display: block;
        }
        .buttons {
            display: flex;
            justify-content: space-around;
        }
    </style>
</head>
<body>
    <h2>3RS GIVEAWAY AUTO CLAIM</h2>
    <label>Base Account:</label>
    <input type="text" id="baseAccount" placeholder="Enter Base Account" value="123456">
    <label>Suffix:</label>
    <input type="number" id="suffix" value="0">
    <div class="buttons">
        <button onclick="startAuto()">Start</button>
        <button onclick="stopAuto()">Stop</button>
        <button onclick="toggleLoop()">Loop</button>
    </div>
    <form id="claimForm" method="GET">
        <input type="text" name="mo" id="mo" placeholder="Account Number" required>
        <input type="hidden" name="capture" value="yes">
        <button type="submit" name="submit" id="claimBtn">Claim</button>
    </form>

    <script>
        let autoInterval = null;
        let loopEnabled = false;
        let claimCount = 0;

        function autoClaim() {
            const base = document.getElementById('baseAccount').value;
            let suffix = parseInt(document.getElementById('suffix').value);
            const mo = document.getElementById('mo');
            mo.value = base + suffix.toString().padStart(1, '0');

            document.getElementById('claimForm').submit();

            claimCount++;
            if (claimCount >= 4) {
                claimCount = 0;
                suffix++;
                document.getElementById('suffix').value = suffix;
            }

            if (!loopEnabled) {
                stopAuto();
            }
        }

        function startAuto() {
            if (!autoInterval) {
                autoInterval = setInterval(autoClaim, 2000); // every 2 seconds
            }
        }

        function stopAuto() {
            clearInterval(autoInterval);
            autoInterval = null;
        }

        function toggleLoop() {
            loopEnabled = !loopEnabled;
            alert("Loop is now " + (loopEnabled ? "enabled" : "disabled"));
        }
    </script>

<?php
if (isset($_GET['submit'])) {
    $mo = $_GET['mo'];
    echo "<p>Auto Claim Submitted for: <strong>$mo</strong></p>";
}
?>
</body>
</html>
