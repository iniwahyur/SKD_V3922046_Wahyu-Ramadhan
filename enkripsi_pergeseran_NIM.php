<?php
function encryptShift($plaintext, $shift) {
    $encryptedText = '';
    
    for ($i = 0; $i < strlen($plaintext); $i++) {
        $char = $plaintext[$i];
        
        if (ctype_alpha($char)) {
            $isUpperCase = ctype_upper($char);
            $char = ord($char);
            $char = ($char - ($isUpperCase ? 65 : 97) + $shift) % 26;
            $char = $char < 0 ? $char + 26 : $char;
            $char = $char + ($isUpperCase ? 65 : 97);
            $char = chr($char);
        }
        
        $encryptedText .= $char;
    }
    
    return $encryptedText;
}

function decryptShift($encryptedText, $shift) {
    return encryptShift($encryptedText, -$shift);
}

if (isset($_POST['encrypt'])) {
    $plaintext = $_POST['plaintext'];
    $shift = 46;
    $encrypted = encryptShift($plaintext, $shift);
} elseif (isset($_POST['decrypt'])) {
    $ciphertext = $_POST['ciphertext'];
    $shift = 46;
    $decrypted = decryptShift($ciphertext, $shift);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enkripsi dan Dekripsi Pergeseran 46</title>
</head>
<body>
    <h1>Enkripsi dan Dekripsi Pergeseran 46</h1>
    <form method="post" action="">
        <label for="plaintext">Plaintext:</label>
        <input type="text" id="plaintext" name="plaintext">
        <input type="submit" name="encrypt" value="Enkripsi">
    </form>
    <?php
    if (isset($encrypted)) {
        echo "<p>Teks Terenkripsi: $encrypted</p>";
    }
    ?>
    <form method="post" action="">
        <label for="ciphertext">Ciphertext:</label>
        <input type="text" id="ciphertext" name="ciphertext">
        <input type="submit" name="decrypt" value="Dekripsi">
    </form>
    <?php
    if (isset($decrypted)) {
        echo "<p>Teks Terdekripsi: $decrypted</p>";
    }
    ?>
</body>
</html>
