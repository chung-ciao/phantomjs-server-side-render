<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Design as DesignModel;
class OrderReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ciao:order:reset';

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
     * @return mixed
     */
    public function handle()
    {
        $modelOptions = ['Article', 'Post', 'Design', 'Product'];
        $modelName = $this->choice('Model Name?', $modelOptions);
        $model = 'App\\Models\\'.$modelName;
        $target = new $model;
        $datas = $target::orderby('updated_at', 'asc')
            ->get();
        foreach($datas as $index => $data) {
            $message = "[$index]\t"."title: ".$data->title.", ";
            $message .= "name: ".$data->name."\n";
            $this->line($message);
            $data->data_order = $index;
            $data->save();
            usleep(100);
        }
        $this->info('Order Reset Successfully!');
    }
}
