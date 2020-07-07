<?php

namespace App\Http\Controllers\Cisco\Scripts;

// use App\Router;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

/**
 *  Cisco Router
 */

class CiscoScriptsController extends Controller
{

    public function scripts()
    {
        return view('script.view');
        // $response = '';

        // return response()->json([ 'response' => $response ]);
    }

    public function createFiles()
    {
        /* Remote File Name and Path */
        $remote_file = 'files.zip';

        /* FTP Account (Remote Server) */
        $ftp_host = 'your-ftp-host.com'; /* host */
        $ftp_user_name = 'ftp-username@your-ftp-host.com'; /* username */
        $ftp_user_pass = 'ftppassword'; /* password */


        /* File and path to send to remote FTP server */
        $local_file = 'files.zip';

        /* Connect using basic FTP */
        $connect_it = ftp_connect( $ftp_host );

        /* Login to FTP */
        $login_result = ftp_login( $connect_it, $ftp_user_name, $ftp_user_pass );

        /* Send $local_file to FTP */ /* Download */
        if ( ftp_put( $connect_it, $remote_file, $local_file, FTP_BINARY ) ) {
            echo "Successfully transfer/created $local_file\n";
        }
        else {
            echo "There was a problem\n";
        }

        /* Close the connection */
        ftp_close( $connect_it );
    }

    public function zipFiles()
    {
        /* ZIP File name and path */
        $zip_file = 'files.zip';

        /* Exclude Files */
        $exclude_files = array();
        $exclude_files[] = realpath( $zip_file );
        $exclude_files[] = realpath( 'zip.php' );

        /* Path of current folder, need empty or null param for current folder */
        $root_path = realpath( '' );

        /* Initialize archive object */
        $zip = new ZipArchive;
        $zip_open = $zip->open( $zip_file, ZipArchive::CREATE );

        /* Create recursive files list */
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator( $root_path ),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        /* For each files, get each path and add it in zip */
        if( !empty( $files ) ){

            foreach( $files as $name => $file ) {

                /* get path of the file */
                $file_path = $file->getRealPath();

                /* only if it's a file and not directory, and not excluded. */
                if( !is_dir( $file_path ) && !in_array( $file_path, $exclude_files ) ){

                    /* get relative path */
                    $file_relative_path = str_replace( $root_path, '', $file_path );

                    /* Add file to zip archive */
                    $zip_addfile = $zip->addFile( $file_path, $file_relative_path );
                }
            }
        }

        /* Create ZIP after closing the object. */
        $zip_close = $zip->close();

    }

    public function extractFiles()
    {
        $file = 'file.zip';

        $path = pathinfo( realpath( $file ), PATHINFO_DIRNAME );

        $zip = new ZipArchive;
        $res = $zip->open($file);
        if ($res === TRUE) {
            $zip->extractTo( $path );
            $zip->close();
            echo "WOOT! $file extracted to $path";
        }
        else {
            echo "Doh! I couldn't open $file";
        }

    }

    public function zipAndExtract( Request $request )
    {
        /* Source File URL */
        // $remote_file_url = 'http://origin-server-url/files.zip';

        // /* New file name and path for this file */
        // $local_file = 'files.zip';

        // /* Copy the file from source url to server */
        // $copy = copy( $remote_file_url, $local_file );

        /* Source File Name and Path */
        $remote_file = 'files.zip';

        /* FTP Account */
        $ftp_host = 'your-ftp-host.com'; /* host */
        $ftp_user_name = 'ftp-username@your-ftp-host.com'; /* username */
        $ftp_user_pass = 'ftppassword'; /* password */


        /* New file name and path for this file */
        $local_file = 'files.zip';

        /* Connect using basic FTP */
        $connect_it = ftp_connect( $ftp_host );

        /* Login to FTP */
        $login_result = ftp_login( $connect_it, $ftp_user_name, $ftp_user_pass );

        /* Download $remote_file and save to $local_file */
        if ( ftp_get( $connect_it, $local_file, $remote_file, FTP_BINARY ) ) {
            echo "WOOT! Successfully written to $local_file\n";
        }
        else {
            echo "Doh! There was a problem\n";
        }

        /* Close the connection */
        ftp_close( $connect_it );


    }
}