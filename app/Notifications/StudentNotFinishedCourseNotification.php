<?php

namespace App\Notifications;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentNotFinishedCourseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public Enrollment $enrollment;
    public function __construct(Enrollment $enrollment)
    {
        $this->enrollment = $enrollment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $course = $this->enrollment->course;
        return (new MailMessage)
            ->from('MostafaArafa@example.com', 'Mostafa Arafa')
            ->subject('Come back to complete your course')
            ->line('Keep going with your course')
            ->action($course->title, url("/api/course/{$this->enrollment->course_id}"))
            ->line('You finished '.$this->enrollment->progress.'% from the course' );
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $course = $this->enrollment->course;
        return [
            'message' => 'Keep going with your course '.$course->title.', You finished '.$this->enrollment->progress.'% from the course'
        ];
    }
}
