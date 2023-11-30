<?php
  error_reporting(E_ERROR | E_PARSE);
  if(sizeof($argv)>1){
    $oldDomain = 'efx\.cantelope\.org';
    $oldDBUSER = 'id21284549_user';
    $oldDB     = 'id21284549_videodemos2';
    $newDomain = $argv[1];
    $newDBUSER = $argv[2];
    $newDB = $argv[3];
    $parts = explode('.', $oldDomain);
    $modString1 = "find ./ \( -type d -name .git -prune \) -o -type f -print0 | xargs -0 sed -i 's/$oldDomain/$newDomain/g'";
    $modString2 = "find ./ \( -type d -name .git -prune \) -o -type f -print0 | xargs -0 sed -i 's/$oldDBUSER/$newDBUSER/g'";
    $modString3 = "find ./ \( -type d -name .git -prune \) -o -type f -print0 | xargs -0 sed -i 's/$oldDB/$newDB/g'";
    @rmdir("converted");
    @unlink("*.zip");
    mkdir("converted");
    exec('cp * converted -r &> /dev/null');
    exec('cp .* converted &> /dev/null');
    chdir('converted');
    echo "\n\nrecursing & compressing...... one moment...\n\n";
    exec($modString1);
    exec($modString2);
    exec($modString3);
    exec("zip new.zip * -r");
    exec("mv new.zip ../$newDomain.zip");
    chdir("..");
    exec("rm -rf converted");
    echo "\n\nconversion complete. updated contents compressed into \"$newDomain.zip\"\n\n";
  }
?>
