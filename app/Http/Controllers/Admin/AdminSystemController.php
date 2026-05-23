<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use App\Models\ActivityLog;

class AdminSystemController extends Controller
{
    public function tools()
    {
        return view('admin.system.tools');
    }

    public function runTool(Request $request)
    {
        $tool = $request->input('tool');
        
        try {
            switch ($tool) {
                case 'storage:link':
                    Artisan::call('storage:link');
                    $message = 'Storage link created successfully.';
                    break;
                case 'optimize:clear':
                    Artisan::call('optimize:clear');
                    $message = 'Configuration, routes, views, and caches cleared successfully.';
                    break;
                case 'cache:clear':
                    Artisan::call('cache:clear');
                    $message = 'Application cache cleared successfully.';
                    break;
                default:
                    return back()->with('error', 'Invalid tool specified.');
            }
            
            ActivityLog::log('System Tool Run', "Ran system tool: {$tool}");
            
            return back()->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Error running tool: ' . $e->getMessage());
        }
    }

    public function logs()
    {
        $logPath = storage_path('logs/laravel.log');
        $logs = [];
        
        if (File::exists($logPath)) {
            $logsContent = File::get($logPath);
            // Limit size for display to avoid breaking the browser
            if (strlen($logsContent) > 100000) {
                $logsContent = substr($logsContent, -100000);
                $logsContent = "...(truncated)\n" . $logsContent;
            }
            $logs = $logsContent;
        } else {
            $logs = 'Log file does not exist or is empty.';
        }

        return view('admin.system.logs', compact('logs'));
    }

    public function clearLogs()
    {
        $logPath = storage_path('logs/laravel.log');
        if (File::exists($logPath)) {
            File::put($logPath, '');
            ActivityLog::log('System Logs Cleared', "Cleared laravel.log file");
            return back()->with('success', 'Logs cleared successfully.');
        }
        
        return back()->with('error', 'Log file not found.');
    }
}
