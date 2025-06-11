<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Handle the backup functionality.
     *
     * @return \Illuminate\Http\Response
     */
    public function backup()
    {
        // TODO: Implement backup logic
        return view('backup');
    }

    /**
     * Descargar backup de la base de datos.
     */
public function downloadBackup()
{
    $dbName = env('inventory');
    $dbUser = env('root');
    $dbPass = env('root');
    $dbHost = env('DB_HOST', '127.0.0.1');
    $fileName = 'backup_' . date('Y_m_d_H_i_s') . '.sql';
    $filePath = storage_path("app/$fileName");

    $mysqldump = env('MYSQLDUMP_PATH', 'C:\laragon\bin\mysql\mysql-5.7.24-winx64\bin\mysqldump.exe');

    if (!file_exists($mysqldump)) {
        return back()->with('error', 'No se encontró mysqldump.exe. Ajusta la ruta en el archivo .env.');
    }

    $command = "\"$mysqldump\" --user=$dbUser --password=$dbPass --host=$dbHost $dbName > \"$filePath\"";
    exec($command, $output, $result);

    if ($result !== 0 || !file_exists($filePath)) {
        return back()->with('error', 'No se pudo generar el backup.');
    }

    return response()->download($filePath)->deleteFileAfterSend(true);
}

}

