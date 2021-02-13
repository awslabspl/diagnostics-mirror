<?php


use diagnosticsphp\core\utilities\deleteFolderContent;
use PHPUnit\Framework\TestCase;

/**
 * Class deleteFolderContentTest
 * @note THIS IS DANGEROUS
 * @covers Exception
 * @since 10/02/2021
 */
class deleteFolderContentTest extends TestCase
{
    /**
     * @throws Exception
     * @since 10/02/2021
     * @param deleteFolderContent
     */
    public function testDelete_folder_and_contents_classes()
    {
        if ((!file_exists(CLASS_FOLDER)) && (!is_readable(CLASS_FOLDER))){
            throw new Exception(NON_EXISTENT_OR_NOT_READABLE);
        } else {
            $this->doDelete();
        }
    }

    /**
     * @author awslabspl
     * @see https://en.wikipedia.org/wiki/Dry_run_(testing)
     * @see https://en.wikipedia.org/wiki/Code_review
     * @see https://github.com/awslabspl/diagnostics-php/issues/17
     */
    private function doDelete(){
        $files = glob(CLASS_FOLDER . '*');

        /**
         * shell_exec('sudo rm -R '.CLASS_FOLDER) would DELETE folder where classes resides: WE DONT WANT THIS TO HAPPEN.
         * Instead, just do a `dry-run`, it means: SIMULATE command execution and ASSESS the outcome.
         * As `rm` command does not have `--dry-run` switch, we will just send output `to the void` instead.....
         *
         *
         * To learn more about dry-running in software development, see https://en.wikipedia.org/wiki/Code_review
         */
        if (!$this->checkFilePermissions()){
            die(UNABLE_TO_CONTINUE);
        } else {
            foreach ($files as $file) {
                // @Todo: change `-r -dr` to `-rd` ( https://github.com/awslabspl/diagnostics-php/issues/17 )
                shell_exec('sudo rm -r -d '.CLASS_FOLDER.' > /dev/$1');
            }
        }
    }

    private function checkFilePermissions(){
        $f = GENERAL_CLASS;
        return chmod($f);
    }
}
