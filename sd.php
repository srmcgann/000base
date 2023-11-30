<?php
  error_reporting(E_ERROR | E_PARSE);
  if(sizeof($argv)>1){
    $oldDomain = 'efx\.cantelope\.org';
    $newDomain = $argv[1];
    $parts = explode('.', $oldDomain);
    $modString = "find ./ \( -type d -name .git -prune \) -o -type f -print0 | xargs -0 sed -i 's/$oldDomain/$newDomain/g'";
    @rmdir("converted");
    @unlink("new.zip");
    mkdir("converted");
    exec('cp * converted -r &> /dev/null');
    exec('cp .* converted &> /dev/null');
    chdir('converted');
    echo "\n\nrecursing & compressing...... one moment...\n\n";
    exec($modString);
    exec("zip new.zip * -r");
    exec("mv new.zip ../$newDomain.zip");
    chdir("..");
    exec("rm -rf converted");
    echo "\n\nconversion complete. updated contents compressed into \"$newDomain.zip\"\n\n";
  }
?>
