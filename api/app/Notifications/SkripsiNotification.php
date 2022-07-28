<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SkripsiNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    private $pengajuanSkripsi;
    public function __construct($pengajuanSkripsi)
    {
        $this->pengajuanSkripsi = $pengajuanSkripsi;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'pengajuan_skripsi_id' => $this->pengajuanSkripsi->pengajuan_skripsi_id,
            'jawaban_status_pengajuan' => $this->pengajuanSkripsi->jawaban_status_pengajuan,
            'telah_disetujui_kaprodi' => $this->pengajuanSkripsi->telah_disetujui_kaprodi,
            'type'=> 'notification',

        ];
    }
}
