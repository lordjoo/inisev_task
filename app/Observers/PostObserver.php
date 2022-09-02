<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\UserNotification;
use App\Notifications\NewPostNotification;

class PostObserver
{

    /**
     * @param Post $post
     * @return void
     */
    public function  created(Post $post)
    {
        $notifiable_users = $post->website->users;

        if ($notifiable_users?->count() > 0) {
            foreach ($notifiable_users as $notifiable_user) {
                $notifiable_user->notify(new NewPostNotification($post));
                $notifiable_user->notifications()->create([
                    'post_id' => $post->id,
                ]);
            }
        }
        $post->update([
            'notification_sent' => true,
        ]);
    }


}
