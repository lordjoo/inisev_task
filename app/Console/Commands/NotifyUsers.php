<?php

namespace App\Console\Commands;

use App\Models\Website;
use App\Notifications\NewPostNotification;
use Illuminate\Console\Command;

class NotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $websites = Website::all();
        foreach ($websites as $website) {
            $this->info('Website: ' . $website->name);
            $posts = $website->posts;
            foreach ($posts as $post) {
                $already_notified_users = $post->notifications->pluck('user_id');
                $notifiable_users = $website->users()->whereNotIn('user_id', $already_notified_users)->get();
                if ($notifiable_users?->count() > 0) {
                    foreach ($notifiable_users as $notifiable_user) {
                        $this->info('Notifying user: ' . $notifiable_user->name);
                        $notifiable_user->notify(new NewPostNotification($post));
                        $notifiable_user->notifications()->create([
                            'post_id' => $post->id,
                        ]);
                    }
                }
            }
        }
    }
}
