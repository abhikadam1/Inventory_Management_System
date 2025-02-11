<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class SendTestMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $timeStamp = strtotime(now());
        Storage::put("myfile{$timeStamp}.txt", "This is a new text file created in Laravel. \n {$timeStamp}");

        // $filePath = storage_path("app/myfile2$timeStamp.txt");
        // $content = "This is a new text file created in Laravel.";
        // // Create and write content
        // File::put($filePath, $content);

        // $filePath = public_path("myfile1$timeStamp.txt");
        // $content = "This file is stored in the public folder.";
        // File::put($filePath, $content);
    }
}
