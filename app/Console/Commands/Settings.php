<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Settings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:settings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $per = 0;
        $jsonFile = public_path('permissions.json');
        if (File::exists($jsonFile)) {
            $jsonContent = File::get($jsonFile);
            $permissions = json_decode($jsonContent, true);

            if (is_array($permissions)) {
                foreach ($permissions as $permission){
                    if (\Spatie\Permission\Models\Permission::where('name',$permission['name'])->exists() == null) {
                        \Spatie\Permission\Models\Permission::create($permission);
                        $per++;
                    }
                }
            }
        }
        if ($per)
            $this->info("Permissions {$per} write done! ✔️");

        return 0;
    }
}
