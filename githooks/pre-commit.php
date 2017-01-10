#!/usr/bin/php
<?php
/**
 * .git/hooks/pre-commit
 */

/**
 * collect all files which have been added, copied or
 * modified and store them in an array called output
 */
exec('git diff --cached --name-status --diff-filter=ACM', $output);
$topLevel = exec("git rev-parse --show-toplevel");
foreach ($output as $file) {
    $fileName = trim(substr($file, 1));

    /**
     * Only PHP file
     */
    if (pathinfo($fileName, PATHINFO_EXTENSION) == "php") {

        /**
         * Check for errors
         */
        $lint_output = array();
        exec("php -l " . escapeshellarg($fileName), $lint_output, $return);

        if ($return == 0) {

            /**
             * PHP-CS-Fixer && add it back
             */
            exec($topLevel . "/../vendor/bin/php-cs-fixer fix $topLevel".'/'."$fileName");
            exec("git add $topLevel".'/'."$fileName");
        } else {
            echo implode("\n", $lint_output), "\n";

            exit(1);
        }
    }
}

exit(0);
